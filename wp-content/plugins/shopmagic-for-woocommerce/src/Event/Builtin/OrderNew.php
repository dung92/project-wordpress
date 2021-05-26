<?php

namespace WPDesk\ShopMagic\Event\Builtin;

use WPDesk\ShopMagic\Event\EventMutex;
use WPDesk\ShopMagic\Event\OrderCommonEvent;

final class OrderNew extends OrderCommonEvent {
	/** @var EventMutex */
	private $event_mutex;

	public function __construct( EventMutex $event_mutex ) {
		$this->event_mutex = $event_mutex;
	}

	/**
	 * @inheritDoc
	 */
	public function get_name() {
		return __( 'New Order', 'shopmagic-for-woocommerce' );
	}

	/**
	 * @inheritDoc
	 */
	public function get_description() {
		return __( 'Triggered when a new order is created', 'shopmagic-for-woocommerce' );
	}

	/**
	 * @inheritDoc
	 */
	public function process_event( $order_id, $order ) {
		if ( $this->event_mutex->check_uniqueness_once( spl_object_hash( $this ), [ 'order_id' => $order_id ] ) ) {
			$this->order = $order;
			$this->run_actions();
		}
	}

	/**
	 * @inheritDoc
	 */
	public function initialize() {
		add_action( 'woocommerce_new_order', array( $this, 'process_event' ), self::PRIORITY_AFTER_DEFAULT, 2 );
		add_action( 'woocommerce_api_create_order', array( $this, 'process_event' ), self::PRIORITY_AFTER_DEFAULT, 2 );
	}
}
