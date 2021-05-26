<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Customer;

use WPDesk\ShopMagic\CommunicationList\CommunicationListRepository;
use WPDesk\ShopMagic\FormField\Field\SelectField;
use WPDesk\ShopMagic\Frontend\ListsOnAccount;
use WPDesk\ShopMagic\Placeholder\Builtin\UserBasedPlaceholder;

final class CustomerUnsubscribeUrl extends UserBasedPlaceholder {
	/**
	 * @inheritDoc
	 */
	public function get_slug() {
		return parent::get_slug() . '.unsubscribe_url';
	}

	/**
	 * @inheritDoc
	 */
	public function get_supported_parameters() {
		return [
			( new SelectField() )
				->set_name( 'list' )
				->set_label( __( 'List', 'shopmagic-for-woocommerce' ) )
				->set_options( CommunicationListRepository::get_lists_as_select_options() )
				->set_placeholder( __( 'Select...', 'shopmagic-for-woocommerce' ) )
		];
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		$email_placeholder = new CustomerEmail();
		$email_placeholder->set_provided_data( $this->provided_data );

		$list = isset( $parameters['list'] ) ? $parameters['list'] : null;

		return ListsOnAccount::get_unsubscribe_url( $email_placeholder->value( [] ), $list );
	}
}
