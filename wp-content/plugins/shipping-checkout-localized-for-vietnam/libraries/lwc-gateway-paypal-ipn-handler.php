<?php
/*
*
* WC_Gateway_Paypal_IPN_Handler
*
*/

if (!defined('ABSPATH')) exit;

if (!class_exists('WC_Gateway_Paypal_IPN_Handler')) return;

if (!class_exists('WLFVN_Gateway_Paypal_IPN_Handler')) {
	class WLFVN_Gateway_Paypal_IPN_Handler extends WC_Gateway_Paypal_IPN_Handler {

		protected function validate_currency($order, $currency) {}

		protected function validate_amount($order, $amount) {}
	}
}
