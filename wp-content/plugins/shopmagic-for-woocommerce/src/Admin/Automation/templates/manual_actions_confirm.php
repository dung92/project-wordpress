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
 */
?>

<div class="wrap manual-action-confirm">
	<h1 class="wp-heading-inline"><?php _e( 'ShopMagic / Manual Actions', 'shopmagic-for-woocommerce' ); ?></h1>
	<h2><?php _e( 'Automation: ' ); ?><?php echo $automation->get_name(); ?></h2>

	<table class="form-table">
		<tbody>
		<tr>
			<th><?php _e( 'Matched items', 'shopmagic-for-woocommerce' ); ?></th>

			<td>
				<div class="items">
					<ul class="item-list">
						<?php $counter = 0; ?>
						<?php foreach ( $matched_items_generator as $order ): ?>
							<?php $counter ++; ?>
							<?php echo $item_renderer->render_item( $order ); ?>
						<?php endforeach; ?>
					</ul>

					<div class="item-summary">
						<?php _e( 'Total: ', 'shopmagic-for-woocommerce' ); ?><?php echo $counter; ?>
					</div>
				</div>
			</td>
		</tr>

		<?php echo $renderer->render( 'manual_actions_confirm_automation_info', [ 'automation' => $automation ] ); ?>

	</tbody>
</table>

<div class="confirm-footer">
	<form method="POST">
		<input class="button button-primary" type="submit" name="run" value="<?php _e( 'Run actions now', 'shopmagic-for-woocommerce' ); ?>"/>
		<span class="manual-action-confirm-or">
			<?php _e( 'or', 'shopmagic-for-woocommerce' ); ?>
			<a href="<?php echo get_edit_post_link( $automation->get_id() ); ?>"><?php _e( 'go back end edit', 'shopmagic-for-woocommerce' ); ?></a>
		</span>
	</form>
</div>
