<?php
/**
 * @var \WPDesk\ShopMagic\Admin\Queue\TableList $queue_table
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Queue', 'shopmagic-for-woocommerce' ); ?></h1>

	<form method="GET" id="mainform" action="<?php echo \WPDesk\ShopMagic\Admin\Queue\ListMenu::get_url() ?>">
		<input type="hidden" name="post_type" value="shopmagic_automation" />
		<input type="hidden" name="page" value="queue" />
		<?php $queue_table->display(); ?>
	</form>
</div>
