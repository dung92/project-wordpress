<?php

namespace WPDesk\ShopMagic\Automation;

use ShopMagicVendor\WPDesk\Persistence\Adapter\ArrayContainer;
use WPDesk\ShopMagic\Action\Action;
use WPDesk\ShopMagic\Action\ActionFactory2;
use WPDesk\ShopMagic\ActionExecution\ExecutionStrategyFactory;
use WPDesk\ShopMagic\AutomationOutcome\OutcomeReposistory;
use WPDesk\ShopMagic\Event\Event;
use WPDesk\ShopMagic\Event\EventFactory2;
use WPDesk\ShopMagic\Event\NullEvent;
use WPDesk\ShopMagic\Filter\FilterFactory2;
use WPDesk\ShopMagic\Filter\FilterLogic;

/**
 * @package WPDesk\ShopMagic\Automation
 */
final class Automation implements \JsonSerializable {
	/** @var int */
	private $id;

	/** @var Event|null */
	private $event;

	/** @var AutomationPersistence */
	private $persistence;

	/** @var EventFactory2 */
	private $event_factory;

	/** @var FilterFactory2 */
	private $filter_factory;

	/** @var ActionFactory2 */
	private $action_factory;

	/** @var ExecutionStrategyFactory */
	private $execution_factory;

	public function __construct(
		$automation_id,
		EventFactory2 $event_factory,
		FilterFactory2 $filter_factory,
		ActionFactory2 $action_factory,
		ExecutionStrategyFactory $execution_factory
	) {
		$this->id                = (int) $automation_id;
		$this->event_factory     = $event_factory;
		$this->filter_factory    = $filter_factory;
		$this->action_factory    = $action_factory;
		$this->execution_factory = $execution_factory;
		$this->persistence       = new AutomationPersistence( $automation_id );
	}

	/**
	 * @return string
	 */
	public function get_name() {
		return get_post( $this->id )->post_title;
	}

	public function initialize() {
		/** @noinspection NullPointerExceptionInspection False positive in $automation->get_event. */
		$this->get_event()->initialize();
	}

	/**
	 * Has real event and at least one action.
	 *
	 * @return bool
	 */
	public function is_fully_configured() {
		return ! $this->get_event() instanceof NullEvent && count( $this->get_actions() ) > 0;
	}

	/**
	 * @return int
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * @return Event
	 */
	public function get_event() {
		if ( $this->event === null ) {
			$filter = $this->create_filter();

			$this->event = $this->event_factory->create_event( $this->persistence->get_event_slug(), $this, $filter );
			$this->event->update_fields_data( new ArrayContainer( $this->persistence->get_event_data() ) );
		}

		return $this->event;
	}

	/**
	 * @return FilterLogic
	 */
	private function create_filter() {
		return $this->persistence->get_filters_as_group( $this->filter_factory );
	}

	/**
	 * Event should run this method when is fired.
	 *
	 * @param Event $event
	 */
	public function event_fired( Event $event ) {
		global $wpdb;
		$outcomeRepository = new OutcomeReposistory( $wpdb );
		foreach ( $this->get_actions() as $index => $action ) {
			do_action( 'shopmagic/core/automation/event_fired', $this, $event, $action );
			if ( apply_filters( 'shopmagic/core/automation/should_execute_action', true, $this, $event, $action ) ) {
				$unique_id = $outcomeRepository->prepare_for_outcome( $this, $event, $action, $index );
//				if ( $this->event_has_valid_data( $event ) ) {
					$strategy  = $this->execution_factory->create_strategy( $this, $event, $action, $index );
					$strategy->execute( $this, $event, $action, $index, $unique_id );
//				} else {
//					$outcomeRepository->log_note( $unique_id, "Automation #{$this->get_id()} \"{$this->get_name()}\" event \"{$event->get_name()}\" has fired but did not provide all declared data." );
//				}
			}
		}
	}

	private function event_has_valid_data( Event $event ): bool {
		$declared = $event->get_provided_data_domains();
		$provided = $event->get_provided_data();
		foreach ( $declared as $expected_data_type ) {
			if ( ! $provided[ $expected_data_type ] instanceof $expected_data_type ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @return Action[]
	 */
	public function get_actions() {
		$actions = [];
		foreach ( $this->persistence->get_actions_data() as $action_data ) {
			$actions[] = $this->action_factory->create_action( $action_data['_action'],
				new ArrayContainer( $action_data ) );
		}

		return $actions;
	}

	/**
	 * @param int $index
	 *
	 * @return bool
	 */
	public function has_action( $index ) {
		return isset( $this->get_actions()[ $index ] );
	}

	/**
	 * @param int $index
	 *
	 * @return Action
	 */
	public function get_action( $index ) {
		return $this->get_actions()[ $index ];
	}

	public function jsonSerialize() {
		return [
			'id' => $this->id
		];
	}
}
