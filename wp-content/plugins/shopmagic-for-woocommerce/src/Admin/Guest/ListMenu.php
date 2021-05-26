<?php

namespace WPDesk\ShopMagic\Admin\Guest;

use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\ShopMagic\Automation\AutomationPostType;

/**
 * Admin guest list.
 *
 * @package WPDesk\ShopMagic\Admin\CommunicationType
 */
final class ListMenu {
	const SLUG = 'guests';

	public function hooks() {
		add_action( 'admin_menu', function () {
			add_submenu_page(
				AutomationPostType::POST_TYPE_MENU_URL,
				__( 'Guest', 'shopmagic-for-woocommerce' ),
				__( 'Guests', 'shopmagic-for-woocommerce' ),
				'manage_options',
				self::SLUG,
				[ $this, 'render_page_action' ]
			);
		} );
	}

	/**
	 * @param int|null $automation_id Optional id to generate url with automation filter
	 *
	 * @return string
	 */
	public static function get_url( $automation_id = null ) {
		$params = [
			'page' => self::SLUG
		];
		if ( $automation_id !== null ) {
			$params['form_filter[automation_id]'] = (int) $automation_id;
		}

		return AutomationPostType::get_url() . '&' . http_build_query( $params );
	}

	/**
	 * @internal
	 */
	public function render_page_action() {
		$guest_table = new TableList();
		$guest_table->prepare_items();

		$renderer = ( new SimplePhpRenderer( new DirResolver( __DIR__ . DIRECTORY_SEPARATOR . 'templates' ) ) );
		echo $renderer->render( 'table', [ 'guest_table' => $guest_table ] );
	}
}
