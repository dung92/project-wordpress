<?php

use \WPDesk\ShopMagic\Automation\Automation;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * @var Automation $automation
 * @var \Iterator $matched_items_generator
 * @var \WPDesk\ShopMagic\DataSharing\RenderableItemProvider $item_renderer
 * @var \ShopMagicVendor\WPDesk\View\Renderer\Renderer $renderer
 * @var string $ajax_action
 * @var int $count
 */
?>

<div class="wrap manual-action-confirm">
	<h1 class="wp-heading-inline"><?php _e( 'ShopMagic / Manual Actions', 'shopmagic-for-woocommerce' ); ?></h1>
	<h2><?php _e( 'Automation: ' ); ?><?php echo esc_html($automation->get_name()); ?></h2>

	<table class="form-table">
		<tbody>
		<tr>
			<th><?php _e( 'Matched items', 'shopmagic-for-woocommerce' ); ?></th>

			<td id="manual-items-queue-match"
				data-automation-id="<?php echo esc_attr( $automation->get_id() ); ?>"
				data-page-match-url="<?php echo admin_url( 'admin-ajax.php?action=' . $ajax_action ); ?>"
				data-count="<?php echo esc_attr( $count ); ?>"
				data-default-pagesize="100">

				<div class="items">
					<ul class="item-list"></ul>

					<div class="item-summary">
						<?php _e( 'Total: ', 'shopmagic-for-woocommerce' ); ?><span class="item-list-counter"><?php _e( 'Processing...', 'shopmagic-for-woocommerce' ); ?></span>
					</div>
					<div class="queued-progressbar"></div>
				</div>
			</td>
		</tr>

		<?php echo $renderer->render( 'manual_actions_confirm_automation_info', [ 'automation' => $automation ] ); ?>

	</tbody>
</table>

<div class="confirm-footer" style="display: none">
	<form method="POST">
		<input type="hidden" name="ids" />
		<input class="button button-primary" type="submit" name="run" value="<?php _e( 'Run actions now', 'shopmagic-for-woocommerce' ); ?>"/>
		<span class="manual-action-confirm-or">
			<?php _e( 'or', 'shopmagic-for-woocommerce' ); ?>
			<a href="<?php echo get_edit_post_link( $automation->get_id() ); ?>"><?php _e( 'go back end edit', 'shopmagic-for-woocommerce' ); ?></a>
		</span>
	</form>
</div>
