<?php

namespace WPDesk\ShopMagic\Admin\Automation;

use WPDesk\ShopMagic\Automation\AutomationPersistence;
use WPDesk\ShopMagic\Automation\AutomationPostType;
use WPDesk\ShopMagic\Filter\FilterFactory2;
use WPDesk\ShopMagic\FormIntegration;

final class FilterMetabox extends AbstractMetabox {
	const NOONCE_NAME = 'shopmagic_filter_meta_box';
	const NOONCE_ACTION = 'save_filter_from_metabox';

	/** @var FilterFactory2 */
	private $filter_factory;

	/** @var FormIntegration */
	private $form_integration;

	public function __construct( FilterFactory2 $filter_factory, FormIntegration $form_integration ) {
		$this->filter_factory   = $filter_factory;
		$this->form_integration = $form_integration;
	}

	public function initialize() {
		$this->add_actions();
		$this->setup();
	}

	/**
	 * Setup metabox.
	 *
	 * @since   1.0.0
	 */
	private function setup() {
		add_meta_box( 'shopmagic_filter_metabox', __( 'Filter', 'shopmagic-for-woocommerce' ), array(
			$this,
			'draw_metabox'
		), 'shopmagic_automation', 'normal' );

	}

	/**
	 * Adds action hooks.
	 *
	 * @since   1.0.0
	 */
	private function add_actions() {
		add_action( 'save_post', array( $this, 'save_filter_from_metabox' ) );
		add_action( 'wp_ajax_shopmagic_load_filter_params', array( $this, 'render_filter_from_post' ) );
	}

	/**
	 * Display metabox in admin side
	 *
	 * @param \WP_Post $post
	 *
	 * @since   1.0.0
	 */
	public function draw_metabox( $post ) {
		echo $this->get_renderer()->render( 'filter_metabox', [
			'nonce_action' => self::NOONCE_ACTION,
			'nonce_name'   => self::NOONCE_NAME
		] );
	}

	/**
	 * Post save processor
	 *
	 * @param string $post_id
	 *
	 * @since   1.0.0
	 */
	public function save_filter_from_metabox( $post_id ) {
		if ( isset( $_POST['post_type'] ) && $_POST['post_type'] === AutomationPostType::TYPE ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			if ( ! wp_verify_nonce( $_POST[ self::NOONCE_NAME ], self::NOONCE_ACTION ) ) {
				return;
			}

			if ( ! isset( $_POST['_filters'] ) || ! is_array( $_POST['_filters'] ) ) {
				$_POST['_filters'] = [];
			}

			$automation_persistence = new AutomationPersistence( $post_id );
			$automation_persistence->save_filters_data( $_POST['_filters'], $this->form_integration, $this->filter_factory );
		}
	}
}
