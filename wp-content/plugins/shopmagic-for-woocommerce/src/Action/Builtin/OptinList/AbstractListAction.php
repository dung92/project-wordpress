<?php


namespace WPDesk\ShopMagic\Action\Builtin\OptinList;


use WPDesk\ShopMagic\FormField\Field\InputTextField;
use WPDesk\ShopMagic\Action\BasicAction;
use WPDesk\ShopMagic\Automation\Automation;
use WPDesk\ShopMagic\CommunicationList\CommunicationListRepository;
use WPDesk\ShopMagic\Event\Event;
use WPDesk\ShopMagic\FormField\Field\SelectField;
use WPDesk\ShopMagic\Optin\EmailOptRepository;

abstract class AbstractListAction extends BasicAction {
	const PARAM_LIST = 'list';
	const PARAM_EMAIL = 'email';

	final public function execute( Automation $automation, Event $event ): bool {
		$email = $this->get_email();
		if ( ! empty( $email ) ) {
			$list_id   = absint( $this->fields_data->get( self::PARAM_LIST ) );
			$list_name = get_the_title( $list_id );

			return $this->do_list_action( $email, $list_id, $list_name );
		}

		return false;
	}

	private function get_email(): string {
		return $this->placeholder_processor->process( $this->fields_data->get( self::PARAM_EMAIL ) );
	}

	abstract protected function do_list_action( string $email, int $list_id, string $list_name ): bool;

	final public function get_required_data_domains(): array {
		return [];
	}

	final public function get_fields(): array {
		return [
			( new SelectField() )
				->set_label( __( 'List', 'shopmagic-for-woocommerce' ) )
				->set_options( CommunicationListRepository::get_lists_as_select_options() )
				->set_name( self::PARAM_LIST ),
			( new InputTextField() )
				->set_label( __( 'Email', 'shopmagic-for-woocommerce' ) )
				->set_placeholder( __( 'E-mail or a placeholder with an e-mail', 'shopmagic-for-woocommerce' ) )
				->set_name( self::PARAM_EMAIL )
		];
	}

	final protected function get_opt_repo(): EmailOptRepository {
		global $wpdb;

		return new EmailOptRepository( $wpdb );
	}
}
