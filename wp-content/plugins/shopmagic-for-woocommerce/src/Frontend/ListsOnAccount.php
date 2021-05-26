<?php

namespace WPDesk\ShopMagic\Frontend;

use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\ShopMagic\CommunicationList\CommunicationListRepository;
use WPDesk\ShopMagic\Optin\EmailOptRepository;

/**
 * Communication type info for customer. Optins/optouts.
 *
 * @package WPDesk\ShopMagic\Frontend
 */
final class ListsOnAccount {
	const ACCOUNT_PAGE_ID_OPTION_KEY = 'shopmagic_communication_account_page_id';
	const ACCOUNT_SHORTCODE = 'shopmagic_communication_preferences';

	/**
	 * @param string $email
	 * @param int|null $list_id
	 *
	 * @return string
	 */
	public static function get_unsubscribe_url( $email, $list_id ) {
		$hash = md5( $email . SECURE_AUTH_SALT );

		$link = get_permalink( get_option( self::ACCOUNT_PAGE_ID_OPTION_KEY ) );

		return $link . ( strpos( $link, '?' ) !== false ? '&' : '?' ) . http_build_query( [
				'email' => $email,
				'hash'  => $hash
			] );
	}

	public function hooks() {
		add_shortcode( self::ACCOUNT_SHORTCODE, [ $this, 'communication_preferences_shortcode' ] );
		if ( apply_filters( 'shopmagic/core/communication_type/account_page_show', true ) ) {
			add_filter( 'woocommerce_account_menu_items', [ $this, 'new_menu_items' ] );
			add_action( 'woocommerce_account_' . $this->get_slug() . '_endpoint', [ $this, 'nav_menu_content' ] );
			add_filter( 'query_vars', [ $this, 'add_query_vars' ], 0 );
		}
	}

	/**
	 * @param array $vars
	 *
	 * @return array
	 *
	 * @internal
	 */
	public function add_query_vars( $vars ) {
		$vars[] = $this->get_slug();

		return $vars;
	}

	/**
	 * @return string
	 */
	private function get_slug() {
		return apply_filters( 'shopmagic/core/communication_type/account_page_slug', 'communication-preferences' );
	}

	/**
	 * Insert the new endpoint into the My Account menu.
	 *
	 * @param array $items
	 *
	 * @return array
	 *
	 * @internal
	 */
	public function new_menu_items( $items ) {
		$logout_item = false;

		if ( isset( $items['customer-logout'] ) ) {
			$logout_item = $items['customer-logout'];
			unset( $items['customer-logout'] );
		}

		$items[ $this->get_slug() ] = $this->get_title();

		if ( $logout_item ) {
			$items['customer-logout'] = $logout_item;
		}

		return $items;
	}

	/**
	 * @return string
	 */
	private function get_title() {
		return apply_filters( 'shopmagic/core/communication_type/account_page_title', __( 'Communication', 'shopmagic-for-woocommerce' ) );
	}

	/**
	 * @internal WooCommerce communication preferences callback.
	 */
	public function nav_menu_content() {
		echo $this->communication_preferences_shortcode();
	}

	/**
	 * @return string
	 * @internal This is a shortcode. Do not use outside the class.
	 *
	 */
	public function communication_preferences_shortcode() {
		global $wpdb;

		$email = $this->get_email_for_shortcode();
		if ( empty( $email ) ) {
			return '';
		}
		if ( isset( $_POST['email'] ) ) {
			$this->save_opt_changes( $email, $_POST );
			wc_print_notice( __( 'Your communication preferences have been updated.', 'shopmagic-for-woocommerce' ) );
		}

		$renderer = new FrontRenderer();
		$opt_repo = new EmailOptRepository( $wpdb );
		$ct_repo  = new CommunicationListRepository( $wpdb );
		$types    = $ct_repo->get_account_communication_types();

		return $renderer->render( 'communication_preferences', [
			'email'    => $email,
			'hash'     => isset( $_REQUEST['hash'] ) ? sanitize_text_field( $_REQUEST['hash'] ) : null,
			'types'    => $types,
			'renderer' => $renderer,
			'opt_ins'  => $opt_repo->find_by_email( $email )
		] );
	}

	/**
	 * Returns email or redirects.
	 *
	 * @return string
	 */
	private function get_email_for_shortcode() {
		if ( ! is_user_logged_in() ) {
			if ( isset( $_REQUEST['email'], $_REQUEST['hash'] ) && self::validate_unsubscribe_hash( $_REQUEST['email'], $_REQUEST['hash'] ) ) {
				return sanitize_email( $_REQUEST['email'] );
			}

			return '';

		}

		return wp_get_current_user()->user_email;
	}

	/**
	 * @param string $email
	 * @param string $hash
	 *
	 * @return bool
	 */
	public static function validate_unsubscribe_hash( $email, $hash ) {
		return md5( $email . SECURE_AUTH_SALT ) === $hash;
	}

	/**
	 * @param string $email
	 * @param array $request
	 */
	private function save_opt_changes( $email, $request ) {
		global $wpdb;
		$opt_repo = new EmailOptRepository( $wpdb );
		$ct_repo  = new CommunicationListRepository( $wpdb );
		$optins   = $opt_repo->find_by_email( $email );
		$types    = $ct_repo->get_account_communication_types();
		foreach ( $types as $type ) {
			if ( isset( $request['shopmagic_optin'][ $type->get_id() ] ) && $request['shopmagic_optin'][ $type->get_id() ] === 'yes' ) {
				if ( ! $optins->is_opted_in( $type->get_id() ) ) {
					$opt_repo->opt_in( $email, $type->get_id() );
				}
			} elseif ( ! $optins->is_opted_out( $type->get_id() ) ) {
				$opt_repo->opt_out( $email, $type->get_id() );
			}
		}
	}
}
