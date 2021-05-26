<?php

namespace WPDesk\ShopMagic\Filter\Builtin\Customer;

use WPDesk\ShopMagic\Filter\Builtin\CustomerFilter;
use WPDesk\ShopMagic\Filter\ComparisionType\IntegerType;

class CustomerIdFilter extends CustomerFilter {
	/**
	 * @inheritDoc
	 */
	public function get_name() {
		return __( 'Customer - ID', 'shopmagic-for-woocommerce' );
	}

	/**
	 * @inheritDoc
	 */
	public function passed() {
		$customer_id = $this->get_user()->ID;

		return $this->get_type()->passed(
			$this->fields_data->get( IntegerType::VALUE_KEY ),
			$this->fields_data->get( IntegerType::CONDITION_KEY ),
			$customer_id
		);
	}

	/**
	 * @inheritDoc
	 */
	protected function get_type() {
		return new IntegerType();
	}

}
