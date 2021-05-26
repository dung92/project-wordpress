<?php
/**
 * @var \WPDesk\ShopMagic\FormField\Field $field
 * @var string $name_prefix
 * @var string $value
 */
?>
<?php wp_nonce_field( $field->get_meta_value( 'action' ), $name_prefix . $field->get_name() );
