<?php
/**
 * @var \WPDesk\ShopMagic\Guest\Guest $guest
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Guest details', 'shopmagic-for-woocommerce' ); ?></h1>

	<table class="form-table">
		<tr>
			<th><?php _e( 'ID', 'shopmagic-for-woocommerce' ); ?></th>
			<td><?php echo (int) $guest->get_id(); ?></td>
		</tr>
		<tr>
			<th><?php _e( 'E-mail', 'shopmagic-for-woocommerce' ); ?></th>
			<td><?php echo sprintf( '<a href="mailto:%s">%s</a>', esc_html( $guest->get_email() ), esc_html( $guest->get_email() ) ); ?></td>
		</tr>
		<?php if ( $guest->has_meta_value( 'first_name' ) ): ?>
			<tr>
				<th><?php _e( 'First name', 'shopmagic-for-woocommerce' ); ?></th>
				<td><?php echo esc_html( $guest->get_meta_value( 'first_name' ) ); ?></td>
			</tr>
		<?php endif; ?>
		<?php if ( $guest->has_meta_value( 'last_name' ) ): ?>
			<tr>
				<th><?php _e( 'Last name', 'shopmagic-for-woocommerce' ); ?></th>
				<td><?php echo esc_html( $guest->get_meta_value( 'last_name' ) ); ?></td>
			</tr>
		<?php endif; ?>
		<?php if ( $guest->has_meta_value( 'billing_phone' ) ): ?>
			<tr>
				<th><?php _e( 'Phone', 'shopmagic-for-woocommerce' ); ?></th>
				<td><?php echo esc_html( $guest->get_meta_value( 'billing_phone' ) ); ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<th><?php _e( 'Address', 'shopmagic-for-woocommerce' ); ?></th>
			<td>
				<p>
					<?php if ( $guest->has_meta_value( 'billing_address_1' ) ): ?>
						<?php echo esc_html( $guest->get_meta_value( 'billing_address_1' ) ); ?>
					<?php endif; ?>
					<?php if ( $guest->has_meta_value( 'billing_address_2' ) ): ?>
						<?php echo esc_html( $guest->get_meta_value( 'billing_address_2' ) ); ?>
					<?php endif; ?>
				</p>
				<p>
					<?php if ( $guest->has_meta_value( 'billing_postcode' ) ): ?>
						<?php echo esc_html( $guest->get_meta_value( 'billing_postcode' ) ); ?>
					<?php endif; ?>
					<?php if ( $guest->has_meta_value( 'billing_city' ) ): ?>
						<?php echo esc_html( $guest->get_meta_value( 'billing_city' ) ); ?>
					<?php endif; ?>
				</p>
				<?php if ( $guest->has_meta_value( 'billing_country' ) ): ?>
					<?php echo esc_html( $guest->get_meta_value( 'billing_country' ) ); ?>
				<?php endif; ?>
			</td>
		</tr>

		<tr>
			<th><?php _e( 'Created', 'shopmagic-for-woocommerce' ); ?></th>
			<td><?php echo \WPDesk\ShopMagic\Helper\WordPressFormatHelper::format_wp_datetime( $guest->get_created() ); ?></td>
		</tr>

		<tr>
			<th><?php _e( 'Last active', 'shopmagic-for-woocommerce' ); ?></th>
			<td><?php echo \WPDesk\ShopMagic\Helper\WordPressFormatHelper::format_wp_datetime( $guest->get_updated() ); ?></td>
		</tr>
	</table>
</div>
