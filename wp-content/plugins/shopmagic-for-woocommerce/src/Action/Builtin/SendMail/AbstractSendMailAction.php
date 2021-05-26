<?php

namespace WPDesk\ShopMagic\Action\Builtin\SendMail;

use ShopMagicVendor\WPDesk\Persistence\Adapter\ArrayContainer;
use ShopMagicVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\ShopMagic\Action\BasicAction;
use WPDesk\ShopMagic\Action\HasCustomAdminHeader;
use WPDesk\ShopMagic\Automation\Automation;
use WPDesk\ShopMagic\DataSharing\TestDataProvider;
use WPDesk\ShopMagic\Event\Event;
use WPDesk\ShopMagic\FormField\Field\CheckboxField;
use WPDesk\ShopMagic\FormField\Field\InputTextField;
use WPDesk\ShopMagic\Integration\Postmark;
use WPDesk\ShopMagic\Placeholder\Builtin\Customer\CustomerUnsubscribeUrl;
use WPDesk\ShopMagic\Placeholder\PlaceholderFactoryCore;
use WPDesk\ShopMagic\Placeholder\PlaceholderProcessor;

/**
 * Abstract base for email actions.
 * Methods ::get_raw_message and ::get_message_field are templates to complete.
 *
 * @internal Do not extend outside ShopMagic plugin. Protected methods can be changed without notice.
 */
abstract class AbstractSendMailAction extends BasicAction implements HasCustomAdminHeader, Hookable {
	const PARAM_TEMPLATE_TYPE = 'template_type';
	const PARAM_TO = 'to_value';
	const PARAM_BCC = 'bcc_value';
	const PARAM_SUBJECT = 'subject_value';
	const PARAM_HEADING = 'heading_value';
	const PARAM_MESSAGE_TEXT = 'message_text';
	const PARAM_UNSUBSCRIBE = 'unsubscribe';

	/** @var bool[] This is abstract class and we need some hooks to run only once for all instances */
	private static $hooked_already = [];

	/**
	 * Unique name of ajax hook for mail testing.
	 *
	 * @return string
	 */
	abstract protected function get_mail_test_hook_name(): string;

	/**
	 * @var Postmark Integration with Postmark Streams service. Adds additional fields and integrates with PostMark plugin.
	 */
	protected $postmark_integration;

	public function __construct() {
		$this->postmark_integration = new Postmark();
	}

	public function get_required_data_domains(): array {
		return [];
	}

	public function get_fields(): array {
		$fields = [];

		$fields[] = ( new InputTextField() )
			->set_label( __( 'To', 'shopmagic-for-woocommerce' ) )
			->set_default_value( '{{ customer.email }}' )
			->set_name( self::PARAM_TO );

		$fields[] = ( new InputTextField() )
			->set_label( __( 'BCC', 'shopmagic-for-woocommerce' ) )
			->set_description( __( 'Send a copy of the emails. Useful if you want to send a copy to yourself. This field is not included in action delivery reports.', 'shopmagic-for-woocommerce' ) )
			->set_name( self::PARAM_BCC );

		$fields[] = ( new InputTextField() )
			->set_label( __( 'Subject', 'shopmagic-for-woocommerce' ) )
			->set_name( self::PARAM_SUBJECT );

		return $fields;
	}

	public function execute( Automation $automation, Event $event ): bool {
		$to = $this->placeholder_processor->process( $this->fields_data->get( self::PARAM_TO ) );

		return $this->execute_internal( $to );
	}

	/**
	 * Used by production and testing execution.
	 *
	 * @param string $to
	 *
	 * @return bool
	 */
	private function execute_internal( string $to ): bool {
		$bcc     = $this->fields_data->has( self::PARAM_BCC ) ? $this->placeholder_processor->process( $this->fields_data->get( self::PARAM_BCC ) ) : '';
		$subject = $this->placeholder_processor->process( $this->get_subject_raw() );

		$message = $this->get_message_content();

		$headers = [
			'Content-Type: ' . $this->get_mail_content_type()
		];
		if ( ! empty( $bcc ) ) {
			$headers[] = "Bcc:  $bcc";
		}

		try {
			$this->postmark_integration->hook_to_postmark_if_enabled( $this->fields_data );
			add_filter( 'wp_mail_content_type', array( $this, 'get_mail_content_type' ) );

			//Set From and To to match WooCommerce Settings
			add_filter( 'wp_mail_from', $wp_mail_from_handle = static function ( $email ) {
				return get_option( 'woocommerce_email_from_address' );
			} );
			add_filter( 'wp_mail_from_name', $wp_mail_from_name_handle = static function ( $name ) {
				return get_option( 'woocommerce_email_from_name' );
			} );

			$error_result         = null;
			$catch_error_callback = static function ( \WP_Error $error ) use ( &$error_result ) {
				$error_result = $error;
			};
			add_action( 'wp_mail_failed', $catch_error_callback );

			$result = wp_mail( $to, $subject, $message, $headers );
			if ( ! $result ) {
				if ( $error_result instanceof \WP_Error ) {
					$this->logger->alert( $error_result->get_error_message(), [
						'Code'           => $error_result->get_error_code(),
						'Error_data'     => $error_result->get_error_data(),
						\WP_Error::class => $error_result
					] );
				} else {
					$this->logger->alert( "WordPress did not send the mail but unfortunately no reason was given" );
				}
			}

			return $result;
		} finally {
			$this->postmark_integration->clear_hooks();
			remove_action( 'wp_mail_failed', $catch_error_callback );
			remove_filter( 'wp_mail_from', $wp_mail_from_handle );
			remove_filter( 'wp_mail_from_name', $wp_mail_from_name_handle );
			remove_filter( 'wp_mail_content_type', array( $this, 'get_mail_content_type' ) );
		}
	}

	/**
	 * Returns mail subject without placeholder processing.
	 *
	 * @return string
	 */
	public function get_subject_raw(): string {
		return (string) $this->fields_data->get( self::PARAM_SUBJECT );
	}

	/**
	 * Should return mail content from fields. Should also process the placeholders using passed processor object.
	 *
	 * @return string
	 */
	abstract protected function get_message_content(): string;

	/**
	 * Action callback to set more complex context type for sending email
	 *
	 * @return string content type for email
	 *
	 * @internal
	 */
	public function get_mail_content_type(): string {
		return 'text/html';
	}

	/**
	 * @inheritDoc
	 */
	public function render_header( $action_index ): string {
		$current_user = wp_get_current_user();
		if ( $current_user instanceof \WP_User ) {
			$email = $current_user->user_email;
		} else {
			$email = '';
		}

		return ( new SimplePhpRenderer( new DirResolver( __DIR__ . '/templates' ) ) )
			->render( 'action_header', [
				'action'       => $this,
				'action_index' => $action_index,
				'email'        => $email,
				'hook_name'    => $this->get_mail_test_hook_name()
			] );
	}

	public function send_mail_test() {
		if ( current_user_can( 'manage_options' ) ) {
			$test_data_provider = ( new TestDataProvider() );
			$this->set_placeholder_processor( new PlaceholderProcessor( new PlaceholderFactoryCore(), $test_data_provider ) );
			$this->set_provided_data( $test_data_provider->get_provided_data() );

			$action_data = array();
			parse_str( $_POST['action_data'], $action_data );
			$action_data       = reset( $action_data['actions'] );
			$action_data       = array_map( function ( $item ) {
				return wp_unslash( $item );
			}, $action_data );
			$this->fields_data = new ArrayContainer( $action_data );

			$to = sanitize_email( $_POST['email'] );
			try {
				$success = $to ? $this->execute_internal( $to ) : false;
				$this->logger->debug( 'Sending test mail', [ 'to' => $to, 'success' => $success ] );

				if ( $success ) {
					$text = sprintf( __( 'Test email has been sent. Check your inbox. %sClose modal%s', 'shopmagic-for-woocommerce' ), '<a class="close-dialog" href="#">', '</a>' );
				} elseif ( empty( $to ) ) {
					$text = __( 'Error: please enter a valid email!', 'shopmagic-for-woocommerce' );
				} else {
					$text = __( 'There was an error when sending a test email. Check your settings and try again.', 'shopmagic-for-woocommerce' );
				}
			} catch ( \TypeError $e ) {
				$success = false;
				$text    = __( 'Error: There is no data (i.e. orders) in your store to send test email!', 'shopmagic-for-woocommerce' );
				$this->logger->error( 'TypeError Exception in ' . __CLASS__ . '::' . __METHOD__, [
					'exception' => $e,
					'to'        => $to
				] );
			} catch ( \Throwable $e ) {
				$success = false;
				$this->logger->error( 'Exception in ' . __CLASS__ . '::' . __METHOD__, [
					'exception' => $e,
					'to'        => $to
				] );
				$text = sprintf( __( 'Error: %s!', 'shopmagic-for-woocommerce' ), $e->getMessage() );
			}

			if ( $success ) {
				$class = 'success';
			} else {
				$class = 'error';
			}

			$message = '<section class="notice notice-' . $class . '"><p>' . $text . '</p></section>';

			wp_send_json( [ 'response' => $message ] );
		}
		wp_die();
	}

	public function hooks() {
		$hook_name = $this->get_mail_test_hook_name();
		if ( ! isset( self::$hooked_already[ $hook_name ] ) ) {
			add_action( 'wp_ajax_shopmagic_' . $hook_name, [ $this, 'send_mail_test' ] );
			self::$hooked_already[ $hook_name ] = true;
		}
	}

	protected function get_unsubscribe_field(): CheckboxField {
		return ( new CheckboxField() )
			->set_label( __( 'Unsubscribe link', 'shopmagic-for-woocommerce' ) )
			->set_name( self::PARAM_UNSUBSCRIBE )
			->set_sublabel( __( 'Add unsubscribe link in the message footer', 'shopmagic-for-woocommerce' ) )
			->set_description_tip( __( 'If you send the email to a list, include the unsubscribe link, so that the customers can opt out if they don\'t want to receive more emails.', 'shopmagic-for-woocommerce' ) );
	}

	protected function should_append_unsubscribe(): bool {
		if ( $this->fields_data->has( self::PARAM_UNSUBSCRIBE ) ) {
			return $this->fields_data->get( self::PARAM_UNSUBSCRIBE ) === 'yes';
		}

		return false;
	}

	protected function get_unsubscribe_url(): string {
		$customer_unsubscribe = new CustomerUnsubscribeUrl();
		$customer_unsubscribe->set_provided_data( $this->provided_data );

		return apply_filters( 'shopmagic/core/action/sendmail/unsubscribe_url', $customer_unsubscribe->value( [] ) );
	}
}
