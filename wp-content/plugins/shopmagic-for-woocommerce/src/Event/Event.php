<?php

namespace WPDesk\ShopMagic\Event;

use ShopMagicVendor\WPDesk\Forms\FieldProvider;
use ShopMagicVendor\WPDesk\Forms\FieldsDataReceiver;
use WPDesk\ShopMagic\Automation\Automation;
use WPDesk\ShopMagic\DataSharing\DataProvider;
use WPDesk\ShopMagic\Exception\ReferenceNoLongerAvailableException;
use WPDesk\ShopMagic\Filter\FilterLogic;

/**
 * When event knows it fires it should check if there are no filters that blocks it.
 * If no filter blocked the Event then it notifies the Automation object about it.
 * Automation decides what to do with it next.
 *
 * @see EventFactory2::create_event() - prototype pattern
 *
 * @TODO: in 3.0 add _clone method - should be explicitly used even when empty
 *
 * @package WPDesk\ShopMagic\Event
 */
interface Event extends DataProvider, FieldProvider, FieldsDataReceiver {
	/**
	 * Name is a translated name of the Event that will be visible in admin panel.
	 * The name should not contain html.
	 *
	 * @return string
	 */
	public function get_name();

	/**
	 * @return string
	 */
	public function get_group_slug();

	/**
	 * Description is a translated description of the Event that will be visible in admin panel.
	 * The description should not contain html.
	 *
	 * @return string
	 */
	public function get_description();

	/**
	 * @return void
	 */
	public function initialize();

	/**
	 * @param FilterLogic $filter
	 *
	 * @return void
	 */
	public function set_filter_logic( FilterLogic $filter );

	/**
	 * @param Automation $automation
	 *
	 * @return void
	 */
	public function set_automation( Automation $automation );

	/**
	 * Event should serialize the data that are internal for existence of the event.
	 *
	 * @return array
	 */
	public function jsonSerialize();

	/**
	 * Reverse jsonSerialize. What has been serialized should be possible to unserialize.
	 *
	 * @param array $serializedJson
	 *
	 * @return void
	 *
	 * @throws ReferenceNoLongerAvailableException When object reference from json no longer points to a real object.
	 */
	public function set_from_json( array $serializedJson );
}
