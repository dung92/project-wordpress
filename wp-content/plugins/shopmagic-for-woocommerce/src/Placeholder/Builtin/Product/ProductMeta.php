<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Product;

use WPDesk\ShopMagic\Admin\Automation\PlaceholderDialog;
use WPDesk\ShopMagic\FormField\Field\InputTextField;
use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceProductBasedPlaceholder;

final class ProductMeta extends WooCommerceProductBasedPlaceholder {
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

		$product    = $this->get_product();
		$product_id = $product->get_id();
		$value      = get_post_meta( $product_id, $key, true );

		if ( empty( $value ) && $product->is_type( 'variation' ) ) {
			$parent_id = $product->get_parent_id();
			$parent    = wc_get_product( $parent_id );
			$value     = $parent ? get_post_meta( $parent_id, $key, true ) : '';
		}

		return (string) $value;
	}
}
