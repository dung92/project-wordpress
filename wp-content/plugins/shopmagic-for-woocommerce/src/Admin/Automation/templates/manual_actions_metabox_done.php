<?php

use WPDesk\ShopMagic\Admin\Queue;
use WPDesk\ShopMagic\Admin\Outcome;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var string $datetime
 * @var string $username
 * @var int $automation_id
 */

?>

<p><?php printf( __( 'Actions were triggered on %s by %s.', 'shopmagic-for-woocommerce' ), esc_html( $datetime ), esc_html( $username ) ); ?></p>

<p><?php _e( 'If you want to run them again, please duplicate this automation.', 'shopmagic-for-woocommerce' ); ?></p>

<div class="metabox-footer">
	<a href="<?php echo Queue\ListMenu::get_url( $automation_id ); ?>"><?php _e( 'Queue', 'shopmagic-for-woocommerce' ); ?></a> /
	<a href="<?php echo Outcome\ListMenu::get_url( $automation_id ); ?>"><?php _e( 'Outcomes', 'shopmagic-for-woocommerce' ); ?></a>
</div>
