<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Customer;

use WPDesk\ShopMagic\Placeholder\Builtin\UserBasedPlaceholder;

final class CustomerLastName extends UserBasedPlaceholder {

	public function get_slug() {
		return parent::get_slug() . '.last_name';
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		return $this->get_customer()->get_last_name();
	}
}
