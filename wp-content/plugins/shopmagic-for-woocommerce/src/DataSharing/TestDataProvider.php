<?php

namespace WPDesk\ShopMagic\DataSharing;

use WPDesk\ShopMagic\Customer\Customer;
use WPDesk\ShopMagic\Customer\CustomerFactory;
use WPDesk\ShopMagic\Guest\GuestDAO;
use WPDesk\ShopMagic\Guest\GuestFactory;

/**
 * Provides test data. Uses last created order as \WC_Order
 *
 * @package WPDesk\ShopMagic\DataSharing
 */
class TestDataProvider implements DataProvider {
	/**
	 * @inheritDoc
	 */
	public function get_provided_data_domains() {
		if ( $this->can_provide_order() ) {
			$domains[] = \WC_Order::class;
			$domains[] = \WP_User::class;
			$domains[] = \WP_Post::class;
			$domains[] = Customer::class;
			$domains[] = \WC_Subscription::class;
		}

		return apply_filters( 'shopmagic/core/test_data_provider/domains', $domains );
	}

	/**
	 * @return \WC_Order|null
	 */
	private function get_test_order() {
		$orders = wc_get_orders( [
			'limit'   => 1,
			'orderby' => 'date_created',
			'order'   => 'DESC'
		] );

		return reset( $orders );
	}

	/**
	 * @return \WC_Subscription|null
	 */
	private function get_test_subscription() {
		if ( function_exists( 'wcs_get_subscriptions' ) ) {
			$subscriptions = wcs_get_subscriptions( [
				'limit'   => 1,
				'orderby' => 'date_created',
				'order'   => 'DESC'
			] );

			return reset( $subscriptions );
		}

		return null;
	}

	/**
	 * If provider can really provide an order.
	 *
	 * @return bool
	 */
	public function can_provide_order() {
		return $this->get_test_order() instanceof \WC_Abstract_Order;
	}

	/**
	 * If provider can really provide an subscription.
	 *
	 * @return bool
	 */
	public function can_provide_subscription() {
		return $this->get_test_subscription() instanceof \WC_Subscription;
	}

	/**
	 * @inheritDoc
	 */
	public function get_provided_data() {
		$data = [];
		if ($this->can_provide_subscription()) {
			$subscription = $this->get_test_subscription();
			$data[ \WC_Subscription::class ] = $subscription;
		}
		if ( $this->can_provide_order() ) {
			$customer_factory         = new CustomerFactory();
			$test_order               = $this->get_test_order();
			$test_user                = $test_order->get_user();
			$data[ \WC_Order::class ] = $test_order;
			$data[ \WP_Post::class ]  = $test_order;
			if ( $test_user instanceof \WP_User ) {
				$data[ \WP_User::class ] = $test_user;
				$data[ Customer::class ] = $customer_factory->create_from_user_and_order( $test_user, $test_order );
			} else {
				global $wpdb;
				$guest                   = ( new GuestFactory( new GuestDAO( $wpdb ) ) )->create_from_order_and_db( $test_order );
				$data[ Customer::class ] = $customer_factory->create_from_guest( $guest );
			}
		}

		return apply_filters( 'shopmagic/core/test_data_provider/data', $data );
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize() {
		return [];
	}
}
