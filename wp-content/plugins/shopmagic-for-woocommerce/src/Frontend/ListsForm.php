<?php

namespace WPDesk\ShopMagic\Frontend;

use WPDesk\ShopMagic\Guest\GuestDAO;
use WPDesk\ShopMagic\Guest\GuestFactory;
use WPDesk\ShopMagic\Optin\EmailOptRepository;

/**
 * Lists signup forms
 *
 * @package WPDesk\ShopMagic\Frontend
 */
final class ListsForm {
	const ASSETS_HANDLE = 'shopmagic-form';
	const NONCE = 'shopmagic_form';

	public function hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		add_shortcode( 'shopmagic_form', [ $this, 'render_form' ] );

		add_action( 'wp_ajax_sm_subscribe_user_to_list', [ $this, 'subscribe_user_to_list' ], 0 );
		add_action( 'wp_ajax_nopriv_sm_subscribe_user_to_list', [ $this, 'subscribe_user_to_list' ] );
	}

	public function render_form( $atts ): string {
		$atts = array_change_key_case( (array) $atts, CASE_LOWER );

		$form_atts = shortcode_atts( [
			'id'     => '',
			'name'   => true,
			'labels' => true,
		], $atts );

		$list_id   = absint( $form_atts['id'] );
		$show_name = filter_var( $form_atts['name'], FILTER_VALIDATE_BOOLEAN );

		if ( empty( $list_id ) ) {
			return '';
		}

		wp_enqueue_style( self::ASSETS_HANDLE );
		wp_enqueue_script( self::ASSETS_HANDLE );
		wp_localize_script( self::ASSETS_HANDLE, 'shopmagic_form', [
			'ajax_url'  => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( self::NONCE ),
			'show_name' => $show_name
		] );

		$renderer = new FrontRenderer();
		$email    = $this->get_email();

		return $renderer->render( 'lists_form', [
			'list_id'     => $list_id,
			'show_name'   => $show_name,
			'show_labels' => filter_var( $form_atts['labels'], FILTER_VALIDATE_BOOLEAN ),
			'email'       => $email,
			'opted_in'    => $this->is_subscribed_to_list( $email, $list_id )
		] );
	}


	/**
	 * @internal
	 */
	public function enqueue_scripts() {
		wp_register_style( self::ASSETS_HANDLE, SHOPMAGIC_PLUGIN_URL . 'assets/css/frontend.css', [], SHOPMAGIC_VERSION );
		wp_register_script( self::ASSETS_HANDLE, SHOPMAGIC_PLUGIN_URL . 'assets/js/frontend.js', [ 'jquery' ], SHOPMAGIC_VERSION, true );
	}

	/**
	 * @return false|\WP_User
	 */
	private function get_user() {
		return get_user_by( 'id', get_current_user_id() );
	}

	private function get_email(): string {
		$email = '';

		if ( is_user_logged_in() ) {
			$email = $this->get_user()->user_email;
		}

		return $email;
	}

	private function get_opt_repo(): EmailOptRepository {
		global $wpdb;

		return new EmailOptRepository( $wpdb );
	}

	private function is_subscribed_to_list( $email, $list_id ): bool {
		$optins_info = $this->get_opt_repo()->find_by_email( $email );

		return $optins_info->is_opted_in( $list_id );
	}

	/**
	 * @internal
	 */
	public function subscribe_user_to_list() {
		if ( ! wp_verify_nonce( $_REQUEST['nonce'], self::NONCE ) ) {
			wp_send_json_error();
		}

		$data = [];
		parse_str( $_POST['serialized'], $data );

		$show_name = $_POST['show_name'];
		$name      = sanitize_text_field( $data['shopmagic-name'] );
		$email     = sanitize_email( $data['shopmagic-email'] );
		$list_id   = absint( $data['shopmagic-list'] );

		if ( empty( $email ) ) {
			wp_send_json_error( __( 'Please enter your e-mail!', 'shopmagic-for-woocommerce' ) );
		}

		if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			wp_send_json_error( __( 'Please enter a valid e-mail!', 'shopmagic-for-woocommerce' ) );
		}

		if ( $show_name && empty( $name ) ) {
			wp_send_json_error( __( 'Please enter your name!', 'shopmagic-for-woocommerce' ) );
		}

		if ( $this->is_subscribed_to_list( $email, $list_id ) ) {
			wp_send_json_error( __( 'You are already subscribed to this list.', 'shopmagic-for-woocommerce' ) );
		} else {
			// Add opt-in
			$this->get_opt_repo()->opt_in( $email, $list_id );

			// New add guest
			global $wpdb;

			$guest_repository = new GuestDAO( $wpdb );
			$guest_factory    = new GuestFactory( $guest_repository );
			$guest            = $guest_factory->create_from_email_and_db( $email );
			$guest->set_meta_value( 'first_name', $name );
			$guest_repository->save( $guest );

			wp_send_json_success( __( 'You have been successfully subscribed!', 'shopmagic-for-woocommerce' ) );
		}
	}
}
