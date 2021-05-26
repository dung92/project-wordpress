<?php

namespace WPDesk\ShopMagic\Admin\Settings;

use Psr\Container\ContainerInterface;
use ShopMagicVendor\WPDesk\Persistence\Adapter\ArrayContainer;
use WPDesk\ShopMagic\FormField\Field\CheckboxField;
use WPDesk\ShopMagic\FormField\Field\InputTextField;
use WPDesk\ShopMagic\FormField\Field\SubmitField;
use WPDesk\ShopMagic\Tracker\TrackerNotices;

final class GeneralSettings extends FieldSettingsTab {
	/**
	 * @inheritDoc
	 */
	protected function get_fields() {
		return [
			( new CheckboxField() )
				->set_label( __( 'Help Icon', 'shopmagic-for-woocommerce' ) )
				->set_sublabel( __( 'Disable help icon', 'shopmagic-for-woocommerce' ) )
				->set_description( __( 'Help icon shows only on ShopMagic pages with help articles and ability to ask for help. If you do not want the help icon to display, you can entirely disable it here.',
					'shopmagic-for-woocommerce' ) )
				->set_name( 'disable_beacon' ),

			( new CheckboxField() )
				->set_label( __( 'Usage Data', 'shopmagic-for-woocommerce' ) )
				->set_sublabel( __( 'Enable', 'shopmagic-for-woocommerce' ) )
				->set_description( sprintf( __( 'Help us improve ShopMagic and allow us to collect insensitive plugin usage data, %sread more%s.',
					'shopmagic-for-woocommerce' ), '<a href="' . TrackerNotices::USAGE_DATA_URL . '" target="_blank">',
					'</a>' ) )
				->set_name( 'wpdesk_tracker_agree' ),

			( new CheckboxField() )
				->set_label( __( 'Enable session tracking ', 'shopmagic-for-woocommerce' ) )
				->set_default_value('yes')
				->set_description_tip( __( 'Session tracking uses cookies to remember users when they are not signed in. This means carts can be tracked when the user is signed out. ', 'shopmagic-slack' ) )
				->set_name( 'enable_session_tracking' ),

			( new CheckboxField() )
				->set_label( __( 'Enable pre-submit data capture ', 'shopmagic-for-woocommerce' ) )
				->set_description_tip( __( 'Capture guest customer data before forms are submitted e.g. during checkout. ', 'shopmagic-slack' ) )
				->set_name( 'enable_pre_submit' ),

			( new SubmitField() )
				->set_name( 'save' )
				->set_label( __( 'Save changes', 'shopmagic-for-woocommerce' ) )
				->add_class( 'button-primary' )
		];
	}

	/**
	 * @inheritDoc
	 */
	public static function get_tab_slug() {
		return 'general';
	}

	/**
	 * @inheritDoc
	 */
	public function get_tab_name() {
		return __( 'General', 'shopmagic-for-woocommerce' );
	}
}
