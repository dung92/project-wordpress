<?php

namespace WPDesk\ShopMagic\Customer;

interface CustomerProvider {
	public function get_customer(): Customer;

	public function is_customer_provided(): bool;
}
