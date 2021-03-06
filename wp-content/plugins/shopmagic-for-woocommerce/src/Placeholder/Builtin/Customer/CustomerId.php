<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Customer;

use WPDesk\ShopMagic\Placeholder\Builtin\UserBasedPlaceholder;

final class CustomerId extends UserBasedPlaceholder {
	public function get_slug() {
		return parent::get_slug() . '.id';
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		return ! empty( $this->get_customer()->ID ) ? $this->get_customer()->ID : '';
	}
}
