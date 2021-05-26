<?php

namespace WPDesk\ShopMagic\Filter\Builtin\Customer;

use WPDesk\ShopMagic\CommunicationList\CommunicationListRepository;
use WPDesk\ShopMagic\Filter\Builtin\CustomerFilter;
use WPDesk\ShopMagic\Filter\ComparisionType\SelectManyToManyType;
use WPDesk\ShopMagic\Placeholder\Builtin\Customer\CustomerEmail;

class CustomerListFilter extends CustomerFilter {
	/**
	 * @inheritDoc
	 */
	public function get_name() {
		return __( 'Customer - Subscribed to List', 'shopmagic-for-woocommerce' );
	}

	/**
	 * @inheritDoc
	 */
	public function passed() {
		$customer_email_placeholder = new CustomerEmail();
		$customer_email_placeholder->set_provided_data( $this->provided_data );
		$lists_ids = CommunicationListRepository::get_email_lists_ids( $customer_email_placeholder->value( [] ) );

		return $this->get_type()->passed(
			$this->fields_data->get( SelectManyToManyType::VALUE_KEY ),
			$this->fields_data->get( SelectManyToManyType::CONDITION_KEY ),
			$lists_ids
		);
	}

	/**
	 * @inheritDoc
	 */
	protected function get_type() {
		return new SelectManyToManyType( CommunicationListRepository::get_lists_as_select_options() );
	}

}
