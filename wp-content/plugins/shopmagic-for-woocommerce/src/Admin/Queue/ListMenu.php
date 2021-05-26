<?php

namespace WPDesk\ShopMagic\Admin\Queue;

use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\ShopMagic\Automation\AutomationPostType;
use \WC_Queue_Interface;

/**
 * Admin optin list.
 *
 * @package WPDesk\ShopMagic\Admin\CommunicationType
 */
final class ListMenu {
	const SLUG = 'queue';

	/** @var WC_Queue_Interface */
	private $queue;

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

	public function hooks() {
		add_action( 'admin_menu', function () {
			add_submenu_page(
				AutomationPostType::POST_TYPE_MENU_URL,
				__( 'Queue', 'shopmagic-for-woocommerce' ),
				__( 'Queue', 'shopmagic-for-woocommerce' ),
				'manage_options',
				self::SLUG,
				[ $this, 'render_page_action' ]
			);
		} );

		add_action( 'woocommerce_init', function () {
			$this->queue = \WC_Queue::instance();
		} );
	}

	public function render_page_action() {
		$queue_table = new TableList( $this->queue );
		$queue_table->prepare_items();

		$renderer = ( new SimplePhpRenderer( new DirResolver( __DIR__ . DIRECTORY_SEPARATOR . 'list-templates' ) ) );
		echo $renderer->render( 'table', [ 'queue_table' => $queue_table ] );
	}
}
