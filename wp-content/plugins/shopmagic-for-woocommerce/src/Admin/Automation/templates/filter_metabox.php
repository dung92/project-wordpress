<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * @var string $nonce_action
 * @var string $nonce_name
 */
?>

<div id="filters">
	<?php echo wp_nonce_field( $nonce_action, $nonce_name ); ?>

	<div id="filter-group-area"></div>

	<div id="filter-config-area" class="config-area shopmagic-tfoot">
		<div class="shopmagic-fr">
			<button id="add-filter-group" style="display: none" class="button button-primary button-large"
					type="button"><?php _e( '+ New Filter Group', 'shopmagic-for-woocommerce' ); ?></button>
		</div>
	</div>
</div>
