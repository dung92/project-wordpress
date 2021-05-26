<?php

namespace WPDesk\ShopMagic\Event;

use Psr\Container\ContainerInterface;
use WPDesk\ShopMagic\Admin\Automation\AutomationFormFields\ProEventInfoField;
use WPDesk\ShopMagic\Automation\Automation;
use WPDesk\ShopMagic\Filter\FilterLogic;

/**
 * Base class for events that shows info about PRO upgrades.
 */
abstract class ImitationCommonEvent implements Event {
	/**
	 * @inheritDoc
	 */
	public function get_fields() {
		$fields = [];

		$fields[] = ( new ProEventInfoField() );

		return $fields;
	}

	public function initialize() {
	}

	public function get_group_slug() {
		return EventFactory2::GROUP_PRO;
	}

	public function set_filter_logic( FilterLogic $filter ) {
	}

	public function set_automation( Automation $automation ) {
	}

	public function jsonSerialize() {
	}

	public function set_from_json( array $serializedJson ) {
	}

	public function get_provided_data_domains() {
		return [];
	}

	public function get_provided_data() {
		return [];
	}

	public function update_fields_data( ContainerInterface $data ) {
	}
}
