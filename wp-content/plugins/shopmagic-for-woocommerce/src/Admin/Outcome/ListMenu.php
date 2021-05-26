<?php

namespace WPDesk\ShopMagic\Admin\Outcome;

use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\ShopMagic\Automation\AutomationPostType;

/**
 * Admin outcome list.
 *
 * @package WPDesk\ShopMagic\Admin\CommunicationType
 */
final class ListMenu {
	const SLUG = 'outcome';

	public function hooks() {
		add_action( 'admin_menu', function () {
			add_submenu_page(
				AutomationPostType::POST_TYPE_MENU_URL,
				__( 'Outcome', 'shopmagic-for-woocommerce' ),
				__( 'Outcomes', 'shopmagic-for-woocommerce' ),
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

	public function render_page_action() {
		$outcome_table = new TableList();
		$outcome_table->prepare_items();

		$renderer = ( new SimplePhpRenderer( new DirResolver( __DIR__ . DIRECTORY_SEPARATOR . 'templates' ) ) );
		echo $renderer->render( 'table', [ 'outcome_table' => $outcome_table ] );
	}
}
