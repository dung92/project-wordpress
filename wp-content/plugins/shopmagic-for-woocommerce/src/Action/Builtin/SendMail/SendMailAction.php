<?php

namespace WPDesk\ShopMagic\Action\Builtin\SendMail;

use Psr\Container\NotFoundExceptionInterface;
use WPDesk\ShopMagic\FormField\Field\InputTextField;
use WPDesk\ShopMagic\FormField\Field\SelectField;
use WPDesk\ShopMagic\FormField\Field\WyswigField;

/**
 * Action to send emails.
 */
final class SendMailAction extends AbstractSendMailAction {
	public function get_name(): string {
		return __( 'Send Email', 'shopmagic-for-woocommerce' );
	}

	protected function get_mail_test_hook_name(): string {
		return 'test_send_mail';
	}

	public function get_fields(): array {
		return $this->postmark_integration->append_fields_if_enabled( array_merge( parent::get_fields(),
			[
				( new InputTextField() )
					->set_label( __( 'Heading', 'shopmagic-for-woocommerce' ) )
					->set_name( self::PARAM_HEADING ),
				( new SelectField() )
					->set_label( __( 'Template', 'shopmagic-for-woocommerce' ) )
					->set_name( self::PARAM_TEMPLATE_TYPE )
					->set_options( [
						WooCommerceMailTemplate::NAME => __( 'WooCommerce Template', 'shopmagic-for-woocommerce' ),
						PlainMailTemplate::NAME       => __( 'None', 'shopmagic-for-woocommerce' )
					] ),
				( new WyswigField() )
					->set_label( __( 'Message', 'shopmagic-for-woocommerce' ) )
					->set_name( self::PARAM_MESSAGE_TEXT ),
				$this->get_unsubscribe_field()
			] ) );
	}

	/**
	 * Creates a template class of a given type.
	 *
	 * @param string $template_type Type to create.
	 *
	 * @return MailTemplate
	 */
	private function create_template( string $template_type ): MailTemplate {
		$heading = $this->fields_data->has( self::PARAM_HEADING ) ? $this->placeholder_processor->process( $this->fields_data->get( self::PARAM_HEADING ) ) : '';
		switch ( $template_type ) {
			case WooCommerceMailTemplate::NAME:
				if ( $this->should_append_unsubscribe() ) {
					$unsubscribe_url = $this->get_unsubscribe_url();
				} else {
					$unsubscribe_url = null;
				}

				return new WooCommerceMailTemplate( $heading, $unsubscribe_url );
		}

		return new PlainMailTemplate();
	}

	protected function get_message_content(): string {
		$message =
			/**
			 * @ignore
			 * @see SendPlainTextMailAction
			 */
			apply_filters( 'shopmagic/core/action/sendmail/raw_message', wpautop( $this->placeholder_processor->process( $this->fields_data->get( self::PARAM_MESSAGE_TEXT ) ) ) );

		try {
			if ( $this->fields_data->has( self::PARAM_TEMPLATE_TYPE ) ) {
				$template_type = $this->placeholder_processor->process( $this->fields_data->get( self::PARAM_TEMPLATE_TYPE ) );
			} else {
				$template_type = PlainMailTemplate::NAME;
			}
		} catch ( NotFoundExceptionInterface $e ) {
			$template_type = PlainMailTemplate::NAME;
		}

		$message = $this->create_template( $template_type )->wrap_content( $message );

		if ( $template_type === PlainMailTemplate::NAME && $this->should_append_unsubscribe() ) {
			$unsubscribe_url = $this->get_unsubscribe_url();
			$message         .= "<br /><br /><a href='{$unsubscribe_url}'>" . __( 'Click to unsubscribe', 'shopmagic-for-woocommerce' ) . '</a>';
		}

		return $message;
	}
}
