<?php
/**
 * @var \WPDesk\ShopMagic\FormField\Field $field
 * @var string $name_prefix
 * @var string $value
 */
?>
<tr class="shopmagic-field">
	<td class="shopmagic-label">
		<label for="<?php echo esc_attr( $field->get_name() ); ?>"><?php echo esc_html( $field->get_label() ); ?></label>
	</td>

	<td class="shopmagic-input">
		<input
			type="radio"
			name="<?php echo $name_prefix; ?>[<?php echo $field->get_name(); ?>]"
			id="<?php echo esc_attr( $field->get_name() ); ?>"
			value="<?php echo esc_html( $value ); ?>"/>
	</td>
</tr>
