<?php
/**
 * @var \WPDesk\ShopMagic\FormField\Field $field
 * @var string $name_prefix
 * @var string $value
 */
?>
<?php wp_print_styles( 'media-views' ); ?>
<script>
	window.SM_EditorInitialized = true;
</script>

<tr class="shopmagic-field">
	<td class="shopmagic-label">
		<label for="message_text"><?php echo esc_html( $field->get_label() ); ?></label>

		<p class="content"><?php _e( 'Copy and paste placeholders (including double brackets) from the metabox on the right to personalize.',
				'shopmagic-for-woocommerce' ); ?></p>
	</td>

	<td class="shopmagic-input">
		<?php
		$id              = uniqid( 'wyswig_' );
		$editor_settings = array(
			'textarea_name' => esc_attr( $name_prefix ) . '[' . esc_attr( $field->get_name() ) . ']'
		);

		wp_editor( wp_kses_post( $value ), $id, $editor_settings );
		?>
		<script type="text/javascript">
			(function () {
				ShopMagic.wyswig.init('<?php echo $id; ?>');
			}());
		</script>

	</td>
</tr>
