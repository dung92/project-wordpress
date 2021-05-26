<?php

namespace WPDesk\ShopMagic\Admin\OptIns;

use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\ShopMagic\Automation\AutomationPostType;

/**
 * Admin optin list.
 *
 * @package WPDesk\ShopMagic\Admin\CommunicationType
 */
final class ListMenu {
	const SLUG = 'optin';

	public function hooks() {
		add_action( 'admin_menu', function () {
			add_submenu_page(
				AutomationPostType::POST_TYPE_MENU_URL,
				__( 'Opt-ins', 'shopmagic-for-woocommerce' ),
				__( 'Opt-ins', 'shopmagic-for-woocommerce' ),
				'manage_options',
				self::SLUG,
				[ $this, 'render_page_action' ]
			);
		} );
	}

	public function render_page_action() {
		$optin_table = new TableList();
		$optin_table->prepare_items();

		$renderer = ( new SimplePhpRenderer( new DirResolver( __DIR__ . DIRECTORY_SEPARATOR . 'list-templates' ) ) );
		echo $renderer->render( 'table', [ 'optin_table' => $optin_table ] );
	}
}
