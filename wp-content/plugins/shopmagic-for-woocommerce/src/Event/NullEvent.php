<?php

namespace WPDesk\ShopMagic\Event;

use Psr\Container\ContainerInterface;
use WPDesk\ShopMagic\Automation\Automation;
use WPDesk\ShopMagic\Filter\FilterLogic;

class NullEvent implements Event {
	public function get_provided_data_domains() {
		return [];
	}

	public function get_provided_data() {
		return [];
	}

	public function get_name() {
		return __( 'Event does not exist', 'shopmagic-for-woocommerce' );
	}

	public function get_group_slug() {
		return '';
	}

	public function get_description() {
		return '';
	}

	public function initialize() {

	}

	public function set_filter_logic( FilterLogic $filter ) {

	}

	public function set_automation( Automation $automation ) {

	}

	public function supports_deferred_check() {
		return false;
	}

	public function get_fields() {
		return [];
	}

	public function jsonSerialize() {

	}

	public function set_from_json( array $serializedJson ) {

	}

	public function update_fields_data( ContainerInterface $data ) {

	}
}
