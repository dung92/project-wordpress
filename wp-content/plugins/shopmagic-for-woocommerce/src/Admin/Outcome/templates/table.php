<?php
/**
 * @var \WPDesk\ShopMagic\Admin\Outcome\TableList $outcome_table
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Outcomes', 'shopmagic-for-woocommerce' ); ?></h1>

	<form method="GET" id="mainform" action="<?php echo \WPDesk\ShopMagic\Admin\Outcome\ListMenu::get_url() ?>">
		<input type="hidden" name="post_type" value="shopmagic_automation" />
		<input type="hidden" name="page" value="outcome" />

		<?php $outcome_table->display(); ?>
	</form>
</div>
