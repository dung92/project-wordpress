<?php

namespace WPDesk\ShopMagic\Frontend;

use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\ShopMagic\CommunicationList\CommunicationListRepository;
use WPDesk\ShopMagic\Customer\CustomerFactory;
use WPDesk\ShopMagic\Optin\EmailOptModel;
use WPDesk\ShopMagic\Optin\EmailOptRepository;
use WPDesk\ShopMagic\Placeholder\Builtin\Customer\CustomerEmail;

/**
 * Communication type info for customer. Optins/optouts.
 *
 * @package WPDesk\ShopMagic\Frontend
 */
final class ListsOnCheckout {
	public function hooks() {
		add_action( 'woocommerce_checkout_after_terms_and_conditions', [ $this, 'render_after_terms_optins' ] );
		add_action( 'woocommerce_checkout_order_processed', [ $this, 'save_checkout_optins' ], 20, 3 );
		// TODO: user signin optins
//		add_action( 'woocommerce_register_form', [ $this, 'dies' ], 20 );
//		add_action( 'woocommerce_created_customer', [ $this, 'dies' ], 20 );
	}

	/**
	 * Save optin/optout after checkout.
	 *
	 * @param int $order_id
	 * @param array $posted_data
	 * @param \WC_Order $order
	 */
	public function save_checkout_optins( $order_id, $posted_data, $order ) {
		global $wpdb;

		$email    = $this->get_email( $order );
		$opt_repo = new EmailOptRepository( $wpdb );
		$ct_repo  = new CommunicationListRepository( $wpdb );
		foreach ( $ct_repo->get_checkout_communication_types() as $type ) {
			if ( isset( $_POST['shopmagic_optin'][ $type->get_id() ] ) && $_POST['shopmagic_optin'][ $type->get_id() ] === 'yes' ) {
				$opt_repo->opt_in( $email, $type->get_id() );
			}
		}
		$opt_repo->soft_opt_in( $email, $ct_repo->get_soft_optin_communication_types() );
	}

	/**
	 * Returns email wherever can be found.
	 *
	 * @param \WC_Order|null $order
	 *
	 * @return string
	 */
	private function get_email( $order = null ) {
		if ( $order instanceof \WC_Order ) {
			return $order->get_billing_email();
		}
		$session      = \WooCommerce::instance()->session;
		$session_data = $session->get( 'customer' );
		if ( isset( $session_data['email'] ) ) {
			return sanitize_email( $session_data['email'] );
		}

		return '';
	}

	/**
	 * Render optin/optout checkboxes in checkout.
	 */
	public function render_after_terms_optins() {
		global $wpdb;
		$renderer    = new FrontRenderer();
		$opt_repo    = new EmailOptRepository( $wpdb );
		$ct_repo     = new CommunicationListRepository( $wpdb );
		$types       = $ct_repo->get_checkout_communication_types();
		$optins_info = $opt_repo->find_by_email( $this->get_email() );
		foreach ( $types as $type ) {
			echo $renderer->render( 'checkout_optin', [
				'type'     => $type,
				'opt_ins'  => $optins_info,
				'opted_in' => $optins_info->is_opted_in( $type->get_id() )
			] );
		}
	}
}
