<?php
/**
 * @var \ShopMagicVendor\WPDesk\Forms\Field $field
 * @var string $name_prefix
 * @var string $value
 */
?>
<tr class="shopmagic-field">
	<td class="shopmagic-label">
		<label for="<?php echo esc_attr( $field->get_name() ); ?>"><?php echo esc_html( $field->get_label() ); ?></label>

		<?php if ( $field->has_description() ): ?>
			<p class="content"><?php echo wp_kses_post( $field->get_description() ); ?></p>
		<?php endif ?>
	</td>

	<td class="shopmagic-input">
		<input
			type="text"
			name="<?php echo $name_prefix; ?>[<?php echo $field->get_name(); ?>]"
			<?php if ($field->has_placeholder()): ?>
				placeholder="<?php echo esc_attr($field->get_placeholder()); ?>"
			<?php endif; ?>
			id="<?php echo esc_attr( $field->get_name() ); ?>"
			value="<?php echo esc_html( $value ); ?>"/>
	</td>
</tr>
