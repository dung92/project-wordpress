<?php

namespace WPDesk\ShopMagic\Event;

use WPDesk\ShopMagic\Exception\ReferenceNoLongerAvailableException;

abstract class OrderCommonEvent extends BasicEvent {
	const PRIORITY_AFTER_DEFAULT = 100;

	/** @var \WC_Order|\WC_Order_Refund */
	protected $order;

	/**
	 * @inheritDoc
	 */
	public function get_group_slug() {
		return EventFactory2::GROUP_ORDERS;
	}

	/**
	 * @inheritDoc
	 */
	public function get_provided_data_domains() {
		return [ \WC_Order::class, \WP_User::class ];
	}

	/**
	 * @inheritDoc
	 */
	public function get_provided_data() {
		return [ \WC_Order::class => $this->get_order(), \WP_User::class => $this->get_user() ];
	}

	/**
	 * @param $order_id
	 * @param \WC_Order|\WC_Order_Refund|\WC_Abstract_Order $order
	 *
	 * @internal
	 */
	public function process_event( $order_id, $order ) {
		$this->order = $order;
		$this->run_actions();
	}

	/**
	 * Returns the order objects, associated with an event
	 *
	 * @return \WC_Order|\WC_Order_Refund
	 */
	protected function get_order() {
		return $this->order;
	}

	/**
	 * Returns the user objects, associated with an event
	 *
	 * @return \WP_User
	 *
	 * @deprecated Use Customer instead.
	 */
	protected function get_user() {
		return $this->get_order()->get_user();
	}

	/**
	 * @return array Normalized event data required for Queue serialization.
	 */
	public function jsonSerialize() {
		return array_merge( parent::jsonSerialize(), [
			'order_id' => $this->get_order()->get_id()
		] );
	}

	/**
	 * @param array $serializedJson @see jsonSerialize
	 *
	 * @throws ReferenceNoLongerAvailableException When serialized object reference is no longer valid. ie. order no loger exists.
	 */
	public function set_from_json( array $serializedJson ) {
		parent::set_from_json( $serializedJson );
		$this->order = wc_get_order( $serializedJson['order_id'] );
		if ( ! $this->order instanceof \WC_Order && ! $this->order instanceof \WC_Order_Refund ) {
			throw new ReferenceNoLongerAvailableException( __( "Order {$serializedJson['order_id']} no longer exists.", 'shopmagic-for-woocommerce' ) );
		}
	}
}
