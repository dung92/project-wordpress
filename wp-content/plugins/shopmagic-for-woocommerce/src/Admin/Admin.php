<?php

namespace WPDesk\ShopMagic\Admin;

use Automattic\WooCommerce\Admin\PageController;
use WPDesk\ShopMagic\Action\ActionFactory2;
use WPDesk\ShopMagic\Admin\Automation\ActionMetabox;
use WPDesk\ShopMagic\Admin\Automation\EventMetabox;
use WPDesk\ShopMagic\Admin\Automation\FilterMetabox;
use WPDesk\ShopMagic\Admin\Automation\ManualActionsMetabox;
use WPDesk\ShopMagic\Admin\Automation\PlaceholderDialog;
use WPDesk\ShopMagic\Admin\Automation\PlaceholdersMetabox;
use WPDesk\ShopMagic\Admin\Automation\RecipesExport;
use WPDesk\ShopMagic\Admin\Automation\RecipesTab;
use WPDesk\ShopMagic\Admin\CommunicationList\CommunicationListSettingsMetabox;
use WPDesk\ShopMagic\Admin\OptIns;
use WPDesk\ShopMagic\Admin\SelectAjaxField\AutomationSelectAjax;
use WPDesk\ShopMagic\Admin\SelectAjaxField\CustomerSelectAjax;
use WPDesk\ShopMagic\Admin\Settings\Settings;
use WPDesk\ShopMagic\Admin\Welcome\Welcome;
use WPDesk\ShopMagic\Automation\AutomationFactory;
use WPDesk\ShopMagic\Automation\AutomationPostType;
use WPDesk\ShopMagic\CommunicationList\CommunicationListPostType;
use WPDesk\ShopMagic\Event\EventFactory2;
use WPDesk\ShopMagic\Filter\FilterFactory2;
use WPDesk\ShopMagic\FormIntegration;
use WPDesk\ShopMagic\Helper\PluginInstaller;
use WPDesk\ShopMagic\Integration\AdFreePlugins;
use WPDesk\ShopMagic\Placeholder\PlaceholderFactory2;

/**
 * Admin ShopMagic Front Manager.
 *
 * @package WPDesk\ShopMagic\Admin
 */
final class Admin {
	/** @var string */
	private $plugin_url;

	/** @var EventFactory2 */
	private $event_factory;

	/** @var FilterFactory2 */
	private $filter_factory;

	/** @var ActionFactory2 */
	private $action_factory;

	/** @var PlaceholderFactory2 */
	private $placeholder_factory;

	/** @var AutomationFactory */
	private $automation_factory;

	/** @var FormIntegration */
	private $form_integration;

	/** @var bool */
	private $is_pro_active;

	function __construct(
			$plugin_url,
			EventFactory2 $event_factory,
			FilterFactory2 $filter_factory,
			ActionFactory2 $action_factory,
			PlaceholderFactory2 $placeholder_factory,
			AutomationFactory $automation_factory,
			FormIntegration $form_integration,
			bool $is_pro_active
	) {
		$this->plugin_url          = $plugin_url;
		$this->event_factory       = $event_factory;
		$this->filter_factory      = $filter_factory;
		$this->action_factory      = $action_factory;
		$this->placeholder_factory = $placeholder_factory;
		$this->automation_factory  = $automation_factory;
		$this->form_integration    = $form_integration;
		$this->is_pro_active       = $is_pro_active;
	}

	private function we_need_styles(): bool {
		$need = ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'shopmagic_automation' );
		$need = $need || ( is_admin() && isset( $_GET['post'] ) && ( get_post( $_GET['post'] )->post_type === 'shopmagic_automation' ) );

		return $need;
	}

	private function clear_other_styles() {
		// compatibility with special-occasion-reminder plugin
		if ( class_exists( \SOR_Public::class ) ) {
			add_action( 'admin_enqueue_scripts', function () {
				$styles = wp_styles();
				$styles->remove( 'bootstrap4' );
			}, 100 );
		}
	}

	public function hooks() {
		$need_styles = $this->we_need_styles();
		if ( $need_styles && ! class_exists( \WC_Admin_Assets::class, false )
		) {
			class_exists( \WC_Admin_Assets::class );
		}
		if ( $need_styles ) {
			$this->clear_other_styles();
		}

		add_action( 'admin_init', function () {
			( new EventMetabox( $this->event_factory, $this->filter_factory, $this->placeholder_factory, $this->form_integration ) )->initialize();
			( new FilterMetabox( $this->filter_factory, $this->form_integration ) )->initialize();
			( new ActionMetabox( $this->action_factory, $this->form_integration ) )->initialize();
			( new ManualActionsMetabox() )->hooks();

			( new CommunicationListSettingsMetabox() )->hooks();
			( new PlaceholdersMetabox() )->initialize();

			AutomationSelectAjax::hooks();
			CustomerSelectAjax::hooks();
		} );

		( new OptIns\ListMenu() )->hooks();

		( new Queue\CancelQueueAction() )->hooks();
		( new Queue\ListMenu() )->hooks();

		( new Outcome\ListMenu() )->hooks();
		( new Outcome\SingleOutcome() )->hooks();

		( new Guest\ListMenu() )->hooks();
		( new Guest\SingleGuest() )->hooks();

		( new Automation\ManualActionsConfirmPage( $this->automation_factory ) )->hooks();


		( new Settings() )->hooks();
		( new Welcome( $this->is_pro_active ) )->hooks();
		( new PlaceholderDialog( $this->placeholder_factory ) )->hooks();
		( new AdFreePlugins() )->hooks();

		( new RecipesTab($this->event_factory, $this->filter_factory, $this->action_factory, $this->placeholder_factory) )->hooks();
		if ( defined( 'SHOPMAGIC_RECIPE_EXPORT' ) && SHOPMAGIC_RECIPE_EXPORT ) {
			( new RecipesExport() )->hooks();
		}

		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

		add_filter( 'mce_external_plugins', [ $this, 'setup_tinymce_plugin' ] );
		add_filter( 'mce_buttons', [ $this, 'add_tinymce_toolbar_button' ] );
	}

	/**
	 * Includes admin scripts in admin area
	 *
	 * @param string $hook hook, describes page
	 */
	public function admin_scripts( $hook ) {
		wp_register_style( 'shopmagic-admin', SHOPMAGIC_PLUGIN_URL . 'assets/css/admin-style.css', [],
				SHOPMAGIC_VERSION );

		$current_screen = get_current_screen();

		if ( $current_screen instanceof \WP_Screen && ( $current_screen->id === 'dashboard_page_manual-action-confirm' || in_array( $current_screen->post_type, [
								AutomationPostType::TYPE,
								CommunicationListPostType::TYPE
						], true ) ) ) {

			wp_enqueue_style( 'shopmagic-admin' );
			wp_enqueue_style( 'woocommerce_admin_styles' );
			wp_enqueue_script( 'filter-groups', SHOPMAGIC_PLUGIN_URL . 'assets/js/filter-groups.js', [], SHOPMAGIC_VERSION, true );
			wp_enqueue_script( 'filter-element', SHOPMAGIC_PLUGIN_URL . 'assets/js/filter-element.js', [ 'filter-groups' ], SHOPMAGIC_VERSION, true );
			wp_enqueue_script( 'jquery-ui-progressbar' );

			wp_enqueue_script( 'shopmagic-admin-handler', SHOPMAGIC_PLUGIN_URL . 'assets/js/admin-handler.js', [
					'jquery',
					'jquery-blockui',
					'jquery-ui-datepicker',
					'jquery-ui-tabs',
					'wc-admin-meta-boxes',
					'wc-backbone-modal',
					'wp-util'
			], SHOPMAGIC_VERSION . '1', false );

			// https://github.com/javve/list.js
			wp_enqueue_script( 'listjs', SHOPMAGIC_PLUGIN_URL . 'assets/js/list.min.js', '', '1.5.0', true );

			wp_localize_script( 'shopmagic-admin-handler', 'ShopMagic', [
							'ajaxurl' => admin_url( 'admin-ajax.php' ),

							'and'           => __( 'and', 'shopmagic-for-woocommerce' ),
							'or'            => __( 'or', 'shopmagic-for-woocommerce' ),
							'remove'        => __( 'Remove', 'shopmagic-for-woocommerce' ),
							'select_filter' => __( 'Select filter', 'shopmagic-for-woocommerce' ),
							'Automations'   => __( 'Automations', 'shopmagic-for-woocommerce' ),
							'ReadyRecipes'   => __( 'Ready-to-use Recipes', 'shopmagic-for-woocommerce' ),

							'paramProcessNonce' => wp_create_nonce( 'shopmagic-ajax-process-nonce' ),
					]
			);

			wp_enqueue_media();
			wp_enqueue_editor();
			?>
			<div style="display: none"><?php wp_editor( '', 'shopmagic_editor' ); ?></div><?php
		}
	}


	/**
	 * Includes additional TinyMCE plugin, which is not shipped with WP
	 *
	 * @param array $plugins array of plugins
	 *
	 * @return array array of plugins
	 */
	public function setup_tinymce_plugin( $plugins ) {
		$plugins['imgalign'] = $this->plugin_url . '/assets/js/tinymce/imgalign/plugin.js';

		return $plugins;
	}

	/**
	 * Adds a button to the TinyMCE / Visual Editor which the user can click
	 * to insert a link with a custom CSS class.
	 *
	 * @param array $buttons Array of registered TinyMCE Buttons
	 *
	 * @return array Modified array of registered TinyMCE Buttons
	 */
	public function add_tinymce_toolbar_button( $buttons ) {
		array_push( $buttons, '|', 'imgalign' );

		return $buttons;
	}
}
