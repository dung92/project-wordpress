<?php

namespace WPDesk\ShopMagic\Admin\SelectAjaxField;

use WPDesk\ShopMagic\Automation\AutomationPostType;
use WPDesk\ShopMagic\FormField\BasicField;

class AutomationSelectAjax extends BasicField {
	/**
	 * @inheritDoc
	 */
	public function get_template_name() {
		return 'automation-select';
	}

	/**
	 * @return string
	 */
	public static function get_ajax_action_name() {
		return 'shopmagic_automation';
	}

	/**
	 * @internal
	 */
	public static function automation_select_ajax() {
		if ( ! isset( $_GET['term'] ) || ! current_user_can( 'manage_woocommerce' ) ) {
			die;
		}
		$term = sanitize_text_field( $_GET['term'] );

		$limit = 80;
		if ( 3 > strlen( $term ) ) {
			$limit = 20;
		}

		if ( empty( $term ) ) {
			wp_die();
		}

		$query = new \WP_Query(
			[
				's'              => mb_strtolower( $term, 'UTF-8' ),
				'posts_per_page' => $limit,
				'post_type'      => AutomationPostType::TYPE,
				'post_status'    => 'publish',
				'orderby'        => 'title'
			]
		);

		$automations = $query->get_posts();

		$results = [];
		foreach ( $automations as $automation_post ) {
			$results[ $automation_post->ID ] = sprintf(
				esc_html__( '%1$s', 'shopmagic-for-woocommerce' ), $automation_post->post_title
			);
		}

		wp_send_json( $results );
	}

	public static function hooks() {
		add_action( 'wp_ajax_' . self::get_ajax_action_name(), "\WPDesk\ShopMagic\Admin\SelectAjaxField\AutomationSelectAjax::automation_select_ajax" );
	}
}
