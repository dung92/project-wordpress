<?php

namespace WPDesk\ShopMagic\Event;

use WPDesk\ShopMagic\Customer\Customer;
use WPDesk\ShopMagic\Customer\CustomerFactory;
use WPDesk\ShopMagic\Exception\ReferenceNoLongerAvailableException;

abstract class UserCommonEvent extends BasicEvent {
	/**
	 * @var int
	 */
	protected $user_id;

	/**
	 * @var Customer
	 */
	protected $customer;

	/** @var CustomerFactory */
	protected $customer_factory;

	public function __construct( CustomerFactory $factory = null ) {
		if ( $factory === null ) { // @TODO: remove fallback in 3.0
			$this->customer_factory = new CustomerFactory();
		} else {
			$this->customer_factory = $factory;
		}
	}

	public function get_group_slug() {
		return EventFactory2::GROUP_USERS;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize() {
		return array_merge( parent::jsonSerialize(), [
			'user_id'        => $this->user_id,
			'customer_id'    => $this->customer->get_id(),
			'guest'          => $this->customer->is_guest(),
			'customer_email' => $this->customer->get_email()
		] );
	}

	/**
	 * @inheritDoc
	 */
	public function set_from_json( array $serializedJson ) {
		parent::set_from_json( $serializedJson );
		$user_id = $serializedJson['user_id'];
		if ( ! empty( $user_id ) ) {
			$this->user_id = $user_id;
			if ( ! get_user_by( 'id', $user_id ) instanceof \WP_User ) {
				throw new ReferenceNoLongerAvailableException( __( "User {$serializedJson['user_id']} no longer exists.", 'shopmagic-for-woocommerce' ) );
			}
		}

		$customer_id = $serializedJson['customer_id'];
		if ( ! empty( $customer_id ) ) {
			$this->customer = $this->customer_factory->create_from_id( $customer_id );
		} else { // for saved events without customer data
			$this->customer = $this->customer_factory->create_from_user( $this->get_user() );
		}
	}

	/**
	 * @inheritDoc
	 */
	public function get_provided_data_domains() {
		return [ Customer::class ];
	}

	/**
	 * @inheritDoc
	 */
	public function get_provided_data() {
		$data[ Customer::class ] = $this->get_customer();
		if ( $this->user_id !== null ) {
			$data[ \WP_User::class ] = $this->get_user();
		}

		return $data;
	}

	/**
	 * Returns the user objects, associated with an event
	 *
	 * @return \WP_User
	 */
	protected function get_user(): \WP_User {
		return new \WP_User( $this->user_id );
	}

	protected function get_customer(): Customer {
		$this->ensure_customer();

		return $this->customer;
	}

	private function ensure_customer() {
		if ( $this->customer === null ) {
			$this->customer = ( new CustomerFactory() )->create_from_user( $this->get_user() );
		}
	}
}
