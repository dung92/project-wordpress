<?php

use WPDesk\ShopMagic\Action\Builtin\SendMail\PlainMailTemplate;
use WPDesk\ShopMagic\Action\Builtin\SendMail\WooCommerceMailTemplate;

/**
 * @var \WPDesk\ShopMagic\FormField\Field $field
 * @var string $name_prefix
 * @var string $value
 */
?>
<tr class="shopmagic-field">
	<td class="shopmagic-label">
		<label for="<?php echo $field->get_name(); ?>">
			<?php echo esc_html($field->get_label()); ?>

			<?php if ( $field->has_description_tip() ): ?>
				<?php echo wc_help_tip( wp_kses_post( $field->get_description_tip() ) ); ?>
			<?php endif ?>
		</label>

		<?php if ( $field->has_description() ): ?>
			<p class="content"><?php echo wp_kses_post( $field->get_description() ); ?></p>
		<?php endif ?>
	</td>

	<td class="shopmagic-input">
		<select id="<?php echo $field->get_name(); ?>"
		        name="<?php echo esc_attr( $name_prefix ); ?>[<?php echo esc_attr( $field->get_name() ); ?>]">

			<?php if ( $field->has_placeholder() ): ?><option value=""><?php echo esc_html( $field->get_placeholder() ); ?></option><?php endif; ?>

			<?php foreach ( $field->get_possible_values() as $possible_value => $label ): ?>
				<option
					<?php if ( $possible_value === $value || (\is_numeric($possible_value) && \is_numeric($value) && (int) $possible_value === (int) $value)): ?>selected="selected"<?php endif; ?>
					value="<?php echo esc_attr( $possible_value ); ?>"
				><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>
	</td>
</tr>
