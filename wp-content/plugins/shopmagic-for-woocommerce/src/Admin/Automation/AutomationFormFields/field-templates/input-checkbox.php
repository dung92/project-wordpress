<?php
/**
 * @var \WPDesk\ShopMagic\FormField\Field $field
 * @var string $name_prefix
 * @var string $value
 */
?>
<tr class="shopmagic-field">
	<td class="shopmagic-label">
		<label for="<?php echo esc_attr( $field->get_name() ); ?>">
			<?php echo esc_html( $field->get_label() ); ?>

			<?php if ( $field->has_description_tip() ): ?>
				<?php echo wc_help_tip( wp_kses_post( $field->get_description_tip() ) ); ?>
			<?php endif ?>

		</label>

		<?php if ( $field->has_description() ): ?>
			<p class="content"><?php echo wp_kses_post( $field->get_description() ); ?></p>
		<?php endif ?>

	</td>

	<td class="shopmagic-input">
		<input type="hidden" name="<?php echo $name_prefix; ?>[<?php echo $field->get_name(); ?>]" value="no"/>

		<?php if ( $field->get_type() === 'checkbox' && $field->has_sublabel() ) : ?>
			<label>
		<?php endif; ?>



			<input
			type="checkbox"
			name="<?php echo $name_prefix; ?>[<?php echo $field->get_name(); ?>]"
			id="<?php echo esc_attr( $field->get_name() ); ?>"
			value="yes"
			<?php if ( $value === 'yes' ): ?>checked="checked"<?php endif; ?>
		/>

		<?php if ( $field->get_type() === 'checkbox' && $field->has_sublabel() ) : ?>
			<?php echo esc_html( $field->get_sublabel() ); ?></label>
		<?php endif; ?>

	</td>
</tr>
