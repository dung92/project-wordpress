<?php
/**
 * @var ShopMagicVendor\WPDesk\Forms\Field $field
 * @var string $name_prefix
 * @var string $value
 */
?>

<select class="wc-product-search"
		style="width:203px;"
		name="<?php echo esc_attr( $name_prefix ); ?>[<?php echo esc_attr( $field->get_name() ); ?>]"
		data-placeholder="<?php _e( 'Search for a customer&hellip;', 'shopmagic-for-woocommerce' ); ?>"
		data-action="<?php echo \WPDesk\ShopMagic\Admin\SelectAjaxField\CustomerSelectAjax::get_ajax_action_name(); ?>"
		data-allow_clear="true"
>
	<?php if ( $value ) {
		$user = get_user_by( 'id', $value );
		echo '<option value="' . $value . '"' . selected( true, true, false ) . '>' . \WPDesk\ShopMagic\Admin\SelectAjaxField\CustomerSelectAjax::convert_value_to_option_text( $value ) . '</option>';
	} ?>
</select>
