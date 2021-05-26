<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Order;

use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceOrderBasedPlaceholder;

final class OrderPaymentUrl extends WooCommerceOrderBasedPlaceholder {

	public function get_slug(): string {
		return parent::get_slug() . '.payment_url';
	}

	public function value( array $parameters ): string {
		$order = $this->get_order();
		if ( $order instanceof \WC_Order ) {
			return $this->get_order()->get_checkout_payment_url();
		}

		return '';
	}
}
