<?php

use \WPDesk\ShopMagic\Admin\Outcome;

/**
 * @var \WPDesk\ShopMagic\AutomationOutcome\SingleOutcome $outcome
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php echo sprintf( __( 'Outcome log #%s', 'shopmagic-for-woocommerce' ), esc_html( $outcome->get_execution_id() ) ); ?></h1>

	<?php if ( count( $outcome->get_logs() ) === 0 ): ?>
		<p><?php _e( 'Outcome log is empty', 'shopmagic-for-woocommerce' ) ?></p>
	<?php else: ?>
		<table class="form-table">
			<tbody>
			<?php foreach ( $outcome->get_logs() as $log ): ?>
				<tr>
					<th><?php _e( 'Timestamp', 'shopmagic-for-woocommerce' ); ?></th>
					<td><?php echo \WPDesk\ShopMagic\Helper\WordPressFormatHelper::format_wp_datetime_with_seconds( $log->get_created_date() ); ?></td>
				</tr>
				<tr>
					<th><?php _e( 'Message', 'shopmagic-for-woocommerce' ); ?></th>
					<td><?php echo esc_html( $log->get_note() ); ?></td>
				</tr>
				<tr>
					<th><?php _e( 'Context', 'shopmagic-for-woocommerce' ); ?></th>
					<td>
						<?php foreach ( $log->get_context() as $key => $value ): ?>
							<p><strong><?php echo esc_html( $key ); ?>: </strong></p>
							<pre><?php echo esc_html( var_export( $value, true ) ); ?></pre>
						<?php endforeach; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>

	<a href="<?php echo Outcome\ListMenu::get_url(); ?>"><?php _e( '&larr; Go back', 'shopmagic-for-woocommerce' ); ?></a>
</div>
