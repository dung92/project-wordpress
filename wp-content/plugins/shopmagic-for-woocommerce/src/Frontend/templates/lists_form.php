<?php
/**
 * Override this template by copying it to yourtheme/shopmagic/lists_form.php
 *
 * @var int $list_id List id.
 * @var bool $show_name True if name field visible, false if not.
 * @var bool $show_labels True if labels visible, false if not.
 * @var string $email Current user email.
 * @var bool $opted_in True when is on the list, false if not.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="shopmagic-form-<?php echo $list_id; ?>" class="shopmagic-form">
	<form action="" method="post" target="_self">
		<?php if ( $show_name ) : ?>
			<p class="shopmagic-form-field shopmagic-form-field-name">
				<?php if ( $show_labels ) : ?>
					<label class="shopmagic-label"
						   for="shopmagic-name-<?php echo $list_id; ?>"><?php _e( 'First name', 'shopmagic-for-woocommerce' ); ?>
						<span class="shopmagic-required required">*</span></label>
				<?php endif; ?>

				<input id="shopmagic-name-<?php echo $list_id; ?>" class="shopmagic-input shopmagic-input-name"
					   type="text"
					   name="shopmagic-name" value=""
					   placeholder="<?php _e( 'First name', 'shopmagic-for-woocommerce' ); ?>" required>
			</p>
		<?php endif; ?>

		<p class="shopmagic-form-field shopmagic-form-field-email">
			<?php if ( $show_labels ) : ?>
				<label class="shopmagic-label"
					   for="shopmagic-email-<?php echo $list_id; ?>"><?php _e( 'Email', 'shopmagic-for-woocommerce' ); ?>
					<span class="shopmagic-required required">*</span></label>
			<?php endif; ?>

			<input id="shopmagic-email-<?php echo $list_id; ?>" class="shopmagic-input shopmagic-input-email"
				   type="email"
				   name="shopmagic-email" value="<?php echo $email; ?>"
				   placeholder="<?php _e( 'Email', 'shopmagic-for-woocommerce' ); ?>" required>
		</p>

		<?php if ( $opted_in ) : ?>
			<p class="shopmagic-message"><?php _e( 'You are already subscribed to this list.', 'shopmagic-for-woocommerce' ); ?></p>
		<?php endif; ?>

		<p class="shopmagic-form-field shopmagic-form-field-submit">
			<input class="shopmagic-submit" type="submit"
				   value="<?php _e( 'Sign up', 'shopmagic-for-woocommerce' ); ?>"
				   <?php if ( $opted_in ) : ?>disabled<?php endif; ?>>
		</p>

		<p id="shopmagic-message-<?php echo $list_id; ?>" class="shopmagic-message hide"></p>

		<input type="hidden" name="shopmagic-list" value="<?php echo $list_id; ?>">
	</form>
</div>

