<?php

namespace WPDesk\ShopMagic\Admin\Welcome;

class Welcome {
	/** @var bool */
	private $is_pro_active;

	public function __construct( bool $is_pro_active ) {
		$this->is_pro_active = $is_pro_active;
	}

	/**
	 * Setup Welcome Mat Redirect
	 *
	 * Select active automations,  register according events and setup its classes
	 *
	 * @since   1.0.0
	 */
	public function hooks() {
		register_activation_hook( SHOPMAGIC_BASE_FILE, array( $this, 'welcome_activate' ) );
		register_deactivation_hook( SHOPMAGIC_BASE_FILE, array( $this, 'welcome_deactivate' ) );

		add_action( 'admin_init', array( $this, 'safe_welcome_redirect' ) );
		add_action( 'admin_menu', array( $this, 'welcome_page' ) );
	}

	/**
	 * Add the transient.
	 *
	 * Add the welcome page transient.
	 *
	 * @since 1.0.0
	 */
	public function welcome_activate() {
		// Transient max age is 60 seconds.
		set_transient( '_welcome_redirect_shopmagic', true, 60 );
	}

	/**
	 * Delete the Transient on plugin deactivation.
	 *
	 * Delete the welcome page transient.
	 *
	 * @since   2.0.0
	 */
	public function welcome_deactivate() {
		delete_transient( '_welcome_redirect_shopmagic' );
	}

	/**
	 * Safe Welcome Page Redirect.
	 *
	 * Safe welcome page redirect which happens only
	 * once and if the site is not a network or MU.
	 *
	 * @since    1.0.0
	 */
	public function safe_welcome_redirect() {
		// Bail if no activation redirect transient is present. (if ! true).
		if ( ! get_transient( '_welcome_redirect_shopmagic' ) ) {
			return;
		}

		// Delete the redirect transient.
		delete_transient( '_welcome_redirect_shopmagic' );

		// Bail if activating from network or bulk sites.
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
			return;
		}

		// Redirects to Welcome Page.
		wp_safe_redirect( add_query_arg(
			array(
				'page' => 'shopmagic_welcome_page'
			),
			admin_url( 'edit.php?post_type=shopmagic_automation' )
		) );
	}

	/**
	 * Welcome Page Sub menu.
	 *
	 * Add the welcome page inside ShopMagic menu.
	 *
	 * @since    1.0.0
	 */
	public function welcome_page() {
		// Add a global varaible to save the sub menu.
		global $shopmagic_sub_menu;

		// Sub menu itself.
		$shopmagic_sub_menu = add_submenu_page(
			'edit.php?post_type=shopmagic_automation',
			__( 'Start Here', 'shopmagic-for-woocommerce' ),
			__( 'Start Here', 'shopmagic-for-woocommerce' ),
			'manage_options',
			'shopmagic_welcome_page',
			array( $this, 'welcome_page_content' ) );
	}

	/**
	 * Welcome Page View.
	 *
	 * Welcome page content i.e. HTML/CSS/PHP.
	 *
	 * @since    1.0.0
	 */
	public function welcome_page_content() {
		require_once( __DIR__ . '/views/shopmagic_welcome-view.php' );
	}
}
