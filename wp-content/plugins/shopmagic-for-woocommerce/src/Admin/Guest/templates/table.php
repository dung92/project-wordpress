<?php
/**
 * @var \WPDesk\ShopMagic\Admin\Outcome\TableList $guest_table
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Guests', 'shopmagic-for-woocommerce' ); ?></h1>

	<form method="GET" id="mainform" action="<?php echo \WPDesk\ShopMagic\Admin\Outcome\ListMenu::get_url() ?>">
		<input type="hidden" name="post_type" value="shopmagic_automation" />
		<input type="hidden" name="page" value="outcome" />

		<?php $guest_table->display(); ?>
	</form>
</div>
