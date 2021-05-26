<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Order;

use ShopMagicVendor\WPDesk\View\Renderer\Renderer;
use WPDesk\ShopMagic\FormField\Field\SelectField;
use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceOrderBasedPlaceholder;

class OrderProductsOrdered extends WooCommerceOrderBasedPlaceholder {
	/** @var Renderer */
	private $renderer;

	public function __construct( Renderer $renderer ) {
		$this->renderer = $renderer;
	}

	public function get_slug(): string {
		return parent::get_slug() . '.products_ordered';
	}

	protected function get_possible_templates(): array {
		return apply_filters( 'shopmagic/core/placeholder/products_ordered/templates', [
			'unordered_list'       => __( 'Bullet list', 'shopmagic-for-woocommerce' ),
			'comma_separated_list' => __( 'Comma separated list', 'shopmagic-for-woocommerce' ),
			'grid_2_col'           => __( 'Grid - 2 columns', 'shopmagic-for-woocommerce' ),
			'grid_3_col'           => __( 'Grid - 3 columns', 'shopmagic-for-woocommerce' )
		] );
	}

	/**
	 * @inheritDoc
	 */
	public function get_supported_parameters(): array {
		return [
			( new SelectField() )
				->set_name( 'template' )
				->set_label( __( 'Template', 'shopmagic-for-woocommerce' ) )
				->set_options( $this->get_possible_templates() )
				->set_required()
		];
	}

	/**
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( array $parameters ): string {
		$items         = $this->is_order_provided() ? $this->get_order()->get_items() : [];
		$products      = [];
		$product_names = [];

		try {
			foreach ( $items as $item ) {
				$product = $item->get_product();
				if ( $product instanceof \WC_Product ) {
					$products[]      = $item->get_product();
					$product_names[] = $item->get_product()->get_name();
				}
			}

			if ( ! empty( $parameters['template'] ) ) {
				$template = $parameters['template'];
			} else {
				$template = array_keys( $this->get_possible_templates() )[0];
			}

			return $this->renderer->render( $template, [
				'order_items'   => $items,
				'products'      => $products,
				'product_names' => $product_names,
				'parameters'    => $parameters
			] );
		} catch ( \Throwable $e ) {
			throw $e;
		}
	}
}
