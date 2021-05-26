<?php

use WPDesk\ShopMagic\Action\Builtin\SendMail\AbstractSendMailAction;
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

<?php foreach ( $automation->get_actions() as $index => $action ): ?>
	<tr class="action">
		<th><?php _e( 'Action', 'shopmagic-for-woocommerce' ); ?> #<?php echo $index + 1; ?></th>

		<td>
			<ul>
				<li>
					<strong><?php _e( 'Type:', 'shopmagic-for-woocommerce' ); ?></strong> <?php echo $action->get_name(); ?>
				</li>

				<?php
				$description = $action->get_fields_data()->get( '_action_title' );
				if ( $description ): ?>
					<li>
						<strong><?php _e( 'Description:', 'shopmagic-for-woocommerce' ); ?></strong> <?php echo $description; ?>
					</li>
				<?php endif; ?>

				<?php if ( $action instanceof AbstractSendMailAction ): ?>
					<li>
						<strong><?php _e( 'Subject: ', 'shopmagic-for-woocommerce' ); ?></strong><?php echo $action->get_subject_raw(); ?>
					</li>
				<?php endif; ?>

				<?php do_action( 'shopmagic/core/manual_action/confirm_template/after_action_fields', $action, $automation ); ?>
			</ul>
		</td>
	</tr>
<?php endforeach; ?>

