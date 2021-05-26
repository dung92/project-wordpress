<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Order;

use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceOrderBasedPlaceholder;

final class OrderCustomerNote extends WooCommerceOrderBasedPlaceholder {

	public function get_slug() {
		return parent::get_slug() . '.customer_note';
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		$order = $this->get_order();

		if ( ! $order instanceof \WC_Order ) {
			return '';
		}

		return $order->get_customer_note();
	}
}
