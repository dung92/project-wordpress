<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Order;

use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceOrderBasedPlaceholder;
use WPDesk\ShopMagic\Placeholder\Helper\DateFormatHelper;

final class OrderDatePaid extends WooCommerceOrderBasedPlaceholder {
	/** @var DateFormatHelper */
	private $date_format_helper;

	public function __construct() {
		$this->date_format_helper = new DateFormatHelper();
	}

	/**
	 * @inheritDoc
	 */
	public function get_slug() {
		return parent::get_slug() . '.date_paid';
	}

	/**
	 * @inheritDoc
	 */
	public function get_supported_parameters() {
		return $this->date_format_helper->get_supported_parameters();
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		return $this->date_format_helper->format_date( $this->get_order()->get_date_paid(), $parameters );
	}
}
