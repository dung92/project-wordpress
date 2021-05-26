<?php

namespace WPDesk\ShopMagic\Integration\Mailchimp;

use WPDesk\ShopMagic\Action\BasicAction;
use WPDesk\ShopMagic\Automation\Automation;
use WPDesk\ShopMagic\Event\Event;
use WPDesk\ShopMagic\FormField\Field\CheckboxField;
use WPDesk\ShopMagic\FormField\Field\SelectField;
use WPDesk\ShopMagic\LoggerFactory;
use WPDesk\ShopMagic\Placeholder\Builtin\Customer\CustomerEmail;

/**
 * ShopMagic add to MailChimp list action.
 */
final class AddToMailChimpListAction extends BasicAction {
	/**
	 * @inheritDoc
	 */
	public function get_required_data_domains() {
		return [ \WP_User::class, \WC_Order::class ];
	}

	/**
	 * @inheritDoc
	 */
	public function get_name() {
		return __( 'Add Customer to Mailchimp List', 'shopmagic-for-woocommerce' );
	}

	/**
	 * @inheritDoc
	 */
	public function get_fields() {
		$fields = [];

		try {
			$mc_apiKey_from_settings = get_option( 'wc_settings_tab_mailchimp_api_key', false );
			$mailchimp               = new APITools( $mc_apiKey_from_settings );

			$fields[] = ( new SelectField() )
				->set_name( '_mailchimp_list_id' )
				->set_label( __( 'The default list ID is', 'shopmagic-for-woocommerce' ) )
				->set_options( $mailchimp->get_all_lists_options() );

		} catch ( \Throwable $e ) {
			LoggerFactory::get_logger()->error( "Mailchimp while preparing fields: {$e->getMessage()}", [ 'exception' => $e ] );
		}

		return array_merge( $fields, [
			( new CheckboxField() )
				->set_name( '_mailchimp_doubleoptin' )
				->set_default_value( get_option( 'wc_settings_tab_mailchimp_double_optin', 'yes' ) )
				->set_label( __( 'Double opt-in', 'shopmagic-for-woocommerce' ) )
				->set_description( __( 'Send customers an opt-in confirmation email when they subscribe. (Unchecking may be against Mailchimp policy.)',
					'shopmagic-for-woocommerce' ) )
		] );
	}

	/**
	 * @inheritDoc
	 */
	public function execute( Automation $automation, Event $event ) {
		try {
			$list_id     = Settings::get_option( 'wc_settings_tab_mailchimp_list_id' );
			$doubleoptin = $this->placeholder_processor->process( $this->fields_data->get( '_mailchimp_doubleoptin' ) );
			$api_key     = Settings::get_option( 'wc_settings_tab_mailchimp_api_key', false );
			$mail_chimp  = new APITools( $api_key );

			if ( empty( $list_id ) || empty( $api_key ) ) {
				return false;
			}

			if ( $this->is_order_provided() ) {
				$order = $this->get_order();

				return $mail_chimp->add_member_from_order( $order, $list_id, $doubleoptin );
			}
			if ( ! $this->is_user_guest() ) {
				$customer = $this->get_user();

				return $mail_chimp->add_member_from_user( $customer, $list_id, $doubleoptin );
			}
			$email_placeholder = new CustomerEmail();
			$email_placeholder->set_provided_data( $this->provided_data );
			$email = $email_placeholder->value( [] );
			if ( ! empty( $email ) ) {
				return $mail_chimp->add_member_from_email( $email, $list_id, $doubleoptin );
			}
		} catch ( \Throwable $e ) {
			LoggerFactory::get_logger()->error( "Mailchimp exception: {$e->getMessage()}", [ 'exception' => $e ] );

			return false;
		}

		return false;
	}
}
