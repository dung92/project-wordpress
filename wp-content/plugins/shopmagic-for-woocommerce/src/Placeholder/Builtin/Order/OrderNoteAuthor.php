<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Order;

use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceOrderNoteBasedPlaceholder;


final class OrderNoteAuthor extends WooCommerceOrderNoteBasedPlaceholder {


	public function get_slug() {
		return parent::get_slug() . '.author';
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		return $this->get_order_note()->comment_author;
	}
}
