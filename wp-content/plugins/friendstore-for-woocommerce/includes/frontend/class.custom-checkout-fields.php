<?php
/**
 * Copyright (c) VietFriend, Inc. and its affiliates. All Rights Reserved
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 *
 * @package FriendStore for WooCommerce
 */

defined('ABSPATH') || exit;

if (!class_exists('FoW_Custom_Checkout_Fields')) {
    class FoW_Custom_Checkout_Fields {

        function __construct() {
            add_filter('woocommerce_get_country_locale', array($this, 'fsw_woocommerce_get_country_locale'), 999, 1);

            // Đổi label của field nếu cần.
            add_filter('woocommerce_default_address_fields', array($this, 'fsw_woocommerce_default_address_fields'), 999, 1);

            // Update Display Name to First Name
            add_filter('woocommerce_checkout_get_value', array($this, 'fsw_woocommerce_checkout_get_value'), 90, 2);
        }

        function fsw_woocommerce_get_country_locale($locale) {
            $locale['VN']['address_1']['priority'] = 110;

            $locale['VN']['state']['required'] = true;
            $locale['VN']['state']['priority'] = 70;

            $locale['VN']['city']['required'] = true;
            $locale['VN']['city']['priority'] = 80;
            $locale['VN']['city']['hidden'] = false;

            $locale['VN']['address_2']['required'] = true;
            $locale['VN']['address_2']['priority'] = 90;
            $locale['VN']['address_2']['hidden'] = false;

            return $locale;
        }

        function fsw_woocommerce_default_address_fields($fields) {
            if (!can_shipping_vietnam()) return $fields;

            $fields['first_name']['label'] = esc_html__('Full Name', 'friendstore-for-woocommerce');
            unset($fields['last_name']);

            $fields['state']['label'] = esc_html__('Province/City', 'friendstore-for-woocommerce');
            $fields['state']['placeholder'] = esc_html__('Select Province/City', 'friendstore-for-woocommerce');
            $fields['state']['required'] = true;
            $fields['state']['priority'] = 70;

            $fields['city']['label'] = esc_html__('District', 'friendstore-for-woocommerce');
            $fields['city']['placeholder'] = esc_html__('Select District', 'friendstore-for-woocommerce');
            $fields['city']['required'] = true;
            $fields['city']['priority'] = 80;

            $fields['address_2']['label'] = esc_html__('Commune/Ward', 'friendstore-for-woocommerce');
            $fields['address_2']['placeholder'] = esc_html__('Select Commune/Ward', 'friendstore-for-woocommerce');
            $fields['address_2']['required'] = true;
            $fields['address_2']['priority'] = 90;

            $fields['address_1']['priority'] = 110;

            return $fields;
        }

        function fsw_woocommerce_checkout_get_value($value, $input) {
            if (!can_shipping_vietnam()) return $value;

            global $current_user;

            $display_name = WC()->session->get('customer')['first_name'];
            if ($input == 'billing_first_name') return $display_name ? $display_name : $current_user->display_name;
        }
    }

    new FoW_Custom_Checkout_Fields();
}