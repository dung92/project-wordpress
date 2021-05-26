<?php

use \WPDesk\ShopMagic\Automation\Automation;
use \WPDesk\ShopMagic\Automation\AutomationPostType;
use \WPDesk\ShopMagic\Admin\Queue;
use \WPDesk\ShopMagic\Admin\Outcome;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * @var Automation $automation
 * @var \Generator|\WC_Order[] $matched_orders_generator
 */
?>

<div class="wrap manual-action-confirm">
	<h1 class="wp-heading-inline"><?php _e( 'ShopMagic / Manual Actions', 'shopmagic-for-woocommerce' ); ?></h1>
	<h2><?php _e( 'Automation: ' ); ?><?php echo $automation->get_name(); ?></h2>

	<div class="notice notice-success">
		<p><strong><?php echo __( 'Actions have beed added to the queue and will run shortly.', 'shopmagic-for-woocommerce' ); ?></strong></p>
	</div>

	<div class="confirm-footer">
		<a href="<?php echo Queue\ListMenu::get_url( $automation->get_id() ); ?>" class="button button-primary"><?php _e( 'View in queue', 'shopmagic-for-woocommerce' ); ?></a>
		<a href="<?php echo Outcome\ListMenu::get_url( $automation->get_id() ); ?>" class="button button-primary"><?php _e( 'View in outcomes', 'shopmagic-for-woocommerce' ); ?></a>

		<span class="manual-action-confirm-or">
			<?php _e( 'or', 'shopmagic-for-woocommerce' ); ?>
			<a href="<?php echo AutomationPostType::get_url() ?>"><?php _e( 'go back to automations', 'shopmagic-for-woocommerce' ); ?></a>
		</span>
	</div>
</div>
