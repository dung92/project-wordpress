<?php

namespace WPDesk\ShopMagic\Event;

use Psr\Container\ContainerInterface;
use WPDesk\ShopMagic\Automation\Automation;
use WPDesk\ShopMagic\DataSharing\DataLayer;
use WPDesk\ShopMagic\Filter\FilterLogic;

/**
 * ShopMagic Events Base class.
 *
 * @package WPDesk\ShopMagic\Event
 */
abstract class BasicEvent implements Event {
	/** @var Automation */
	protected $automation;

	/** @var FilterLogic */
	protected $filter;

	/** @var ContainerInterface */
	protected $fields_data;

	public function __clone() {
		$this->automation = null;
		$this->filter = null;
		$this->fields_data = null;
	}

	/**
	 * @inheritDoc
	 */
	public function update_fields_data( ContainerInterface $data ) {
		$this->fields_data = $data;
	}

	/**
	 * @inheritDoc
	 */
	public function get_provided_data_domains() {
		return [];
	}

	/**
	 * @inheritDoc
	 */
	public function get_fields() {
		return [];
	}

	/**
	 * @inheritDoc
	 */
	public function get_provided_data() {
		return [];
	}

	/**
	 * @inheritDoc
	 */
	public function set_automation( Automation $automation ) {
		$this->automation = $automation;
	}

	/**
	 * @inheritDoc
	 */
	public function set_filter_logic( FilterLogic $filter ) {
		$this->filter = $filter;
	}

	/**
	 * Run registered actions from automation
	 *
	 * @since 1.0.0
	 */
	protected function run_actions() {
		$this->filter->set_provided_data( ( new DataLayer( $this, [ $this->automation ] ) )->get_provided_data() );
		if ( apply_filters( 'shopmagic/core/event/filter_passed', $this->filter->passed(), $this ) ) {
			$this->automation->event_fired( $this );
		}
	}

	/**
	 * Returns the description of the current Event
	 *
	 * @return string Event description
	 * @since   1.0.4
	 */
	public function get_description() {
		return __( 'No description provided for this event.', 'shopmagic' );
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize() {
		return [];
	}

	/**
	 * @inheritDoc
	 */
	public function set_from_json( array $serializedJson ) {
		// nothing to do here
	}
}
