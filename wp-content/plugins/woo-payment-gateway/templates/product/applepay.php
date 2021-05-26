<?php
/**
 * @version 3.2.7
 * @package Braintree/Templates
 * @var WC_Braintree_Payment_Gateway $gateway
 */
?>
<div class="wc-braintree-applepay-product-checkout-container">
	<?php
	wc_braintree_get_template( 'applepay-button.php', array(
		'gateway' => $gateway,
		'button'  => $gateway->product_gateway_option->get_option( 'button' ),
		'type'    => $gateway->product_gateway_option->get_option( 'button_type_product' )
	) ) ?>
</div>