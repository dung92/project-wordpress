<?php

namespace WPDesk\ShopMagic\Admin\Automation\AutomationFormFields;

use WPDesk\ShopMagic\FormField\BasicField;

final class ProEventInfoField extends BasicField {
	public function __construct() {
		parent::__construct();
		$this->set_name('');
	}

	public function get_template_name() {
		return 'pro-event-info';
	}
}
