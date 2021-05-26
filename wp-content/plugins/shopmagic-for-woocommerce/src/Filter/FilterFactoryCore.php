<?php

namespace WPDesk\ShopMagic\Filter;

use WPDesk\ShopMagic\DataSharing\DataProvider;
use WPDesk\ShopMagic\DataSharing\DataReceiver;
use WPDesk\ShopMagic\DataSharing\ProviderReceiverMatcher;
use WPDesk\ShopMagic\Filter\Builtin\Customer\CustomerIdFilter;
use WPDesk\ShopMagic\Filter\Builtin\Customer\CustomerListFilter;
use WPDesk\ShopMagic\Filter\Builtin\Order\OrderNoteContent;
use WPDesk\ShopMagic\Filter\Builtin\Order\OrderNoteType;
use WPDesk\ShopMagic\Filter\Builtin\Order\OrderItems;

final class FilterFactoryCore implements FilterFactory2 {
	/** @var Filter[] */
	private static $filters_cache;

	/**
	 * @return Filter[]
	 */
	public function get_filter_list(): array {
		if ( empty( self::$filters_cache ) ) {
			self::$filters_cache = apply_filters( 'shopmagic/core/filters', $this->get_build_in_filters() );
		}

		return self::$filters_cache;
	}

	/**
	 * @param string $slug
	 *
	 * @return Filter
	 */
	public function create_filter( string $slug ): Filter {
		return clone $this->get_filter( $slug );
	}

	/**
	 * @param DataProvider $provider
	 *
	 * @return DataReceiver[]|Filter[]
	 */
	public function get_filter_list_to_handle( DataProvider $provider ): array {
		$list = ProviderReceiverMatcher::matchReceivers( $provider, $this->get_filter_list() );
		uasort( $list, function ( Filter $a, Filter $b ) {
			$group_compare = strcmp( $a->get_group_slug(), $b->get_group_slug() );
			if ( $group_compare === 0 ) {
				return strcmp( $a->get_name(), $b->get_name() );
			}

			return $group_compare;
		} );

		return $list;
	}

	/**
	 * @param string
	 *
	 * @return Filter
	 */
	public function get_filter( string $slug ): Filter {
		$filters = $this->get_filter_list();
		if ( isset( $filters[ $slug ] ) ) {
			return apply_filters( 'shopmagic/core/single_filter', $filters[ $slug ] );
		}

		return new NullFilter();
	}

	/**
	 * @return Filter[]
	 */
	private function get_build_in_filters(): array {
		return [
			'shopmagic_product_purchased_filter' => new OrderItems(), // warning - legacy key
			'order_note_type'                    => new OrderNoteType(),
			'order_note_content'                 => new OrderNoteContent(),
			'customer_id'                        => new CustomerIdFilter(),
			'customer_communication_type'        => new CustomerListFilter()
		];
	}
}
