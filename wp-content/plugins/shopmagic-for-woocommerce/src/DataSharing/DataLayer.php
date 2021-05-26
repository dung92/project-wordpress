<?php

namespace WPDesk\ShopMagic\DataSharing;

use WPDesk\ShopMagic\DataSharing\ProviderHelper\DataProviderCustomerEnrichment;
use WPDesk\ShopMagic\DataSharing\ProviderHelper\DataProviderMerger;
use WPDesk\ShopMagic\DataSharing\ProviderHelper\DataProviderMixed;

/**
 * Links all possible data and shares it using DataProvider interface.
 *
 * @package WPDesk\ShopMagic\DataSharing
 */
class DataLayer implements DataProvider {
	/** @var DataProvider */
	private $provider;

	/**
	 * @param DataProvider $provider
	 * @param object[] $additional_data Data to merge into provided data. Should have unique classes as class will be extracted using reflection.
	 */
	public function __construct( DataProvider $provider, array $additional_data = [] ) {
		$partial_provider    = new DataProviderMerger( [
				$provider,
				new DataProviderMixed( $additional_data )
			]
		);
		$enrichment_provider = new DataProviderCustomerEnrichment( $partial_provider );

		$this->provider = new DataProviderMerger( [
			$partial_provider,
			$enrichment_provider
		] );
	}

	/**
	 * @inheritDoc
	 */
	public function get_provided_data_domains() {
		return $this->provider->get_provided_data_domains();
	}

	/**
	 * @inheritDoc
	 */
	public function get_provided_data() {
		return $this->provider->get_provided_data();
	}

	/**
	 * @return array
	 */
	public function jsonSerialize() {
		return $this->provider->jsonSerialize();
	}
}
