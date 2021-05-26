<?php


namespace WPDesk\ShopMagic\Optin;

use WPDesk\ShopMagic\CommunicationList\CommunicationListRepository;

/**
 * Opt-in related behaviours for a new user account.
 *
 * @package WPDesk\ShopMagic\Optin
 */
class NewUserBehaviour {
	public function hooks() {
		add_action( 'user_register', array( $this, 'optin_to_softs' ) );
	}

	/**
	 * @param int $user_id
	 *
	 * @internal
	 */
	public function optin_to_softs( $user_id ) {
		global $wpdb;
		$user = get_user_by( 'id', $user_id );
		if ( $user instanceof \WP_User ) {
			$optin_repo = new EmailOptRepository( $wpdb );
			$ct_repo    = new CommunicationListRepository( $wpdb );

			$optin_repo->soft_opt_in( $user->user_email, $ct_repo->get_soft_optin_communication_types() );
		}
	}
}
