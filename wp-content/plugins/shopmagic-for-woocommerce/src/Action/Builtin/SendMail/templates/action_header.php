<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * @var \WPDesk\ShopMagic\Action\Builtin\SendMail\AbstractSendMailAction $action
 * @var int $action_index
 * @var string $email
 * @var string $hook_name
 */
?>

<span class="action-actions">
	<a href="#" class="send_test_email"
	   data-dialog-id="dialog_<?php echo $action_index; ?>"><?php _e( 'Send test', 'shopmagic-for-woocommerce' ); ?></a>
</span>

<div id="dialog_<?php echo $action_index; ?>" title="Send test email" style="display: none;">
	<table class="shopmagic-table">
		<tbody>
			<tr class="shopmagic-field">
				<td class="shopmagic-label">
					<label><?php _e( 'Email', 'shopmagic-for-woocommerce' ); ?> <span class="required">*</span></label>
				</td>

				<td class="shopmagic-input">
					<input type="text" class="email_to_test" value="<?php echo $email; ?>" placeholder="<?php _e( 'Enter email...', 'shopmagic-for-woocommerce' ); ?>"/>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="dialog-result"></div>

	<div class="dialog-button">
		<button data-hook-name="<?php echo $hook_name; ?>" class="button-primary test_email_button"><?php _e( 'Send test email', 'shopmagic-for-woocommerce' ); ?></php></button>
	</div>
</div>
