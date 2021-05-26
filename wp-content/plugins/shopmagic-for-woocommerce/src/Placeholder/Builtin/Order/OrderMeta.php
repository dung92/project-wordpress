<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Order;

use WPDesk\ShopMagic\FormField\Field\InputTextField;
use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceOrderBasedPlaceholder;


final class OrderMeta extends WooCommerceOrderBasedPlaceholder {
	const PARAM_KEY_NAME = 'key';

	public function get_slug() {
		return parent::get_slug() . '.meta';
	}

	/**
	 * @inheritDoc
	 */
	public function get_supported_parameters() {
		return [
			( new InputTextField() )
				->set_required()
				->set_name( self::PARAM_KEY_NAME )
				->set_label( __( 'The meta key to retrieve', 'shopmagic-for-woocommerce' ) )
		];
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ) {
		$key = $parameters[ self::PARAM_KEY_NAME ];

		if ( ! $key ) {
			return '';
		}

		$value = $this->get_order()->get_meta( $key, true );

		if ( empty( $value ) ) {
			$value = get_post_meta( $this->get_order()->get_id(), $key, true );
		}

		return (string) $value;
	}
}
