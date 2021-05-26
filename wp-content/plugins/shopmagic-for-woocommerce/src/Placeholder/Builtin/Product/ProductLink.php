<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Product;

use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceProductBasedPlaceholder;

final class ProductLink extends WooCommerceProductBasedPlaceholder {

	public function get_slug() {
		return parent::get_slug() . '.link';
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		return $this->get_product()->get_permalink();
	}
}
