<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Order;

use WPDesk\ShopMagic\FormField\Field\SelectField;
use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceOrderBasedPlaceholder;

final class OrderDownloads extends WooCommerceOrderBasedPlaceholder {
	/**
	 * @inheritDoc
	 */
	public function get_slug(): string {
		return parent::get_slug() . '.downloads';
	}

	/**
	 * @inheritDoc
	 */
	public function get_supported_parameters(): array {
		return [
			( new SelectField() )
				->set_label( __( 'Is email in plain text', 'shopmagic-for-woocommerce' ) )
				->set_name( 'plaintext' )
				->set_options( [
					'no'  => __( 'No', 'shopmagic-for-woocommerce' ),
					'yes' => __( 'Yes', 'shopmagic-for-woocommerce' )
				] )
		];
	}


	/**
	 * @inheritDoc
	 */
	public function value( array $parameters ): string {
		$order = $this->get_order();
		if ( ! $order instanceof \WC_Order ) {
			return '';
		}

		$plain_text = isset( $parameters['plaintext'] ) && $parameters['plaintext'] === 'yes';

		ob_start();

		\WC_Emails::instance()->order_downloads( $order, false, $plain_text );

		return ob_get_clean();
	}
}
