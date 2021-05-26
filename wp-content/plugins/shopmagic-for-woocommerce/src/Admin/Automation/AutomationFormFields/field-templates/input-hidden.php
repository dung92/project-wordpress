<?php
/**
 * @var \WPDesk\ShopMagic\FormField\Field $field
 * @var string $name_prefix
 * @var string $value
 */
?>
<tr>
	<td class="shopmagic-input">
		<input
			type="hidden"
			name="<?php echo $name_prefix; ?>[<?php echo $field->get_name(); ?>]"
			id="<?php echo esc_attr( $field->get_name() ); ?>"
			value="<?php echo esc_html( $value ); ?>"/>
	</td>
</tr>
