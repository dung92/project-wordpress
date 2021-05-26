<?php
/**
 * @var \WPDesk\ShopMagic\Admin\CommunicationList\OptInListTableList $optin_table
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="wrap">
	<h1 class="wp-heading-inline"><?php _e( 'Opt-ins', 'shopmagic-for-woocommerce' ); ?></h1>

	<form method="post" id="mainform" action="">
		<?php $optin_table->search_box( __( 'Search for email', 'shopmagic-for-woocommerce' ), 'email' ); ?>
		<?php $optin_table->display(); ?>
	</form>
</div>
