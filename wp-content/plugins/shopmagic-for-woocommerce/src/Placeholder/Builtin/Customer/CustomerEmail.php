<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Customer;

use WPDesk\ShopMagic\Placeholder\Builtin\UserBasedPlaceholder;

final class CustomerEmail extends UserBasedPlaceholder {
	public function get_slug() {
		return parent::get_slug() . '.email';
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		if ( $this->is_comment_provided() ) {
			$fallback = $this->get_comment()->comment_author_email;
		} else {
			$fallback = '';
		}

		return ! empty( $this->get_customer()->get_email() ) ? $this->get_customer()->get_email() : $fallback;
	}
}
