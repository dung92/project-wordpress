<?php

namespace WPDesk\ShopMagic\Admin\Automation;

use WPDesk\ShopMagic\Automation\AutomationPersistence;
use WPDesk\ShopMagic\Automation\AutomationPostType;
use WPDesk\ShopMagic\AutomationOutcome\OutcomeReposistory;

final class ManualActionsMetabox extends AbstractMetabox {
	const SUBMIT_NAME = 'manual_automation';
	const PRIORITY_LAST = 999;

	public function hooks() {
		add_meta_box( 'shopmagic_manual_actions_metabox', __( 'Manual actions', 'shopmagic-for-woocommerce' ), array(
			$this,
			'render_metabox'
		), 'shopmagic_automation', 'side', 'high' );

		add_action( 'save_post', array( $this, 'redirect_manual_automation_submit' ), self::PRIORITY_LAST );
	}

	/**
	 * @param int $post_id
	 *
	 * @internal save_post action
	 */
	public function redirect_manual_automation_submit( $post_id ) {
		if ( current_user_can( 'manage_options' ) && isset( $_POST['post_type'], $_POST[ self::SUBMIT_NAME ] ) && $_POST['post_type'] === AutomationPostType::TYPE ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			wp_redirect( admin_url( 'edit.php?post_type=shopmagic_automation&' . http_build_query( [
					'page' => ManualActionsConfirmPage::SLUG,
					'post' => $post_id
				] ) ) );
			exit;
		}
	}

	/**
	 * @param \WP_Post $post
	 * @param $box
	 *
	 * @return void
	 *
	 * @internal shopmagic_manual_actions_metabox render callback
	 */
	public function render_metabox( \WP_Post $post, $box ) {
		global $wpdb;
		$persistence = new AutomationPersistence( $post->ID );
		$user        = $persistence->get_manual_action_user();
		if ( $user instanceof \WP_User ) {
			$username = "{$user->first_name} {$user->last_name}";
		} else {
			$username = __( "User no longer exists", 'shopmagic-for-woocommerce' );
		}

		if ( $persistence->is_manual_action_ever_started() ) {
			echo $this->get_renderer()->render( 'manual_actions_metabox_done', [
				'username'      => $username,
				'datetime'      => $persistence->get_manual_action_wp_datetime(),
				'automation_id' => $post->ID
			] );
		} else {
			echo $this->get_renderer()->render( 'manual_actions_metabox_run', [
				'name' => self::SUBMIT_NAME
			] );
		}
	}
}
