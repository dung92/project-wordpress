<?php
/**
 * Override this template by copying it to yourtheme/shopmagic/communication_preferences.php
 *
 * @var \WPDesk\ShopMagic\CommunicationList\CommunicationList[] $types
 * @var string $email
 * @var string $hash
 * @var ShopMagicVendor\WPDesk\View\Renderer\Renderer $renderer
	 * @var \WPDesk\ShopMagic\Optin\EmailOptModel $opt_ins
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<p><?php echo __('You are managing preferences for ', 'shopmagic-for-woocommerce' ); ?><?php echo $email; ?>.</p>

<form method="post">
	<input type="hidden" name="email" value="<?php echo esc_attr( $email ) ?>"/>
	<input type="hidden" name="hash" value="<?php echo esc_attr( $hash ) ?>"/>

	<p class="shopmagic-optin form-row">
		<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">

			<input type="checkbox" class="shopmagic-communication-form__preference-checkbox" checked="checked" disabled="disabled">

			<span class="shopmagic-optin__checkbox-text"><?php _e( 'Account and order information', 'shopmagic-for-woocommerce' ); ?></span>
		</label>

		<?php _e( 'Receive important information about your orders and account.', 'shopmagic-for-woocommerce' ) ?>
	</p>

	<?php foreach ( $types as $type ): ?>
		<p class="shopmagic-optin form-row">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">

				<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
					   name="shopmagic_optin[<?php echo esc_attr( $type->get_id() ); ?>]" <?php checked( $opt_ins->is_opted_in( $type->get_id() ) ); ?>
					   id="shopmagic_optin_<?php echo esc_attr( $type->get_id() ); ?>"
					   value="yes"/>

				<span class="shopmagic-optin__checkbox-text"><?php echo esc_html( $type->get_checkbox_label() ); ?></span>
			</label>
			<?php echo esc_html( $type->get_checkbox_description() ); ?>
		</p>

	<?php endforeach; ?>
	<input type="submit" value="<?php echo __('Save changes', 'shopmagic-for-woocommerce'); ?>" />
</form>
