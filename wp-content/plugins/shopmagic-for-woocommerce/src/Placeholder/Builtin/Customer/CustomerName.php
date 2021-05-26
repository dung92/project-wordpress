<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Customer;

use WPDesk\ShopMagic\Placeholder\Builtin\UserBasedPlaceholder;

final class CustomerName extends UserBasedPlaceholder {

	public function get_slug() {
		return parent::get_slug() . '.name';
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		if ( $this->is_comment_provided() ) {
			$fallback = $this->get_comment()->comment_author;
		} else {
			$fallback = '';
		}

		return ( ! empty( $this->get_customer()->get_full_name() ) ? $this->get_customer()->get_full_name() : $fallback );
	}
}
