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

if (!class_exists('FoW_Custom_Fields')) {
    class FoW_Custom_Fields {

        function __construct() {

            add_filter('woocommerce_states', array($this, 'fsw_woocommerce_states'));

            // Tuỳ chỉnh format thông tin thanh toán và thông tin giao hàng.
            add_filter('woocommerce_localisation_address_formats', array($this, 'fsw_woocommerce_localisation_address_formats'), 999);

            // Khai cách replace mảng và xử lý dữ liệu các fields mới vào, thay id bằng tên.
            add_filter('woocommerce_formatted_address_replacements', array($this, 'fsw_woocommerce_formatted_address_replacements'), 2, 999);

            add_filter('woocommerce_get_script_data', array($this, 'fsw_woocommerce_get_script_data'), 2, 999);

            add_filter('woocommerce_cart_calculate_shipping_address', array($this, 'fsw_woocommerce_cart_calculate_shipping_address'));

	        // Remove action country_to_state in country-select.js
            add_filter('woocommerce_form_field_country', array($this, 'fsw_form_field_country'));


	        add_action('woocommerce_calculated_shipping', array($this, 'fsw_woocommerce_calculated_shipping'));
        }

        function fsw_woocommerce_states($states) {
            $cities = FoW_Ultility::get_cities_array();
            ksort($cities);
            $states['VN'] = $cities;
            return $states;
        }

        function fsw_form_field_country($field){
        	return str_replace("country_to_state", "", $field);
        }

        function fsw_woocommerce_localisation_address_formats($array) {
            $address = "{first_name}";
            $address .= "{address_1}";
            $address .= "{address_2}";
            $address .= "{city}";
            $address .= "{state}";

            $array['default'] = $address;
            $array['VN'] = $address;
            return $array;
        }

        function fsw_woocommerce_formatted_address_replacements($array, $args) {
            $cities = FoW_Ultility::get_cities_array();
            $districts = FoW_Ultility::get_district_array();
            $wards = FoW_Ultility::get_wards_array();

            $city_id = isset($args['state']) ? $args['state'] : '';
            $district_id = isset($args['city']) ? $args['city'] : '';
            $ward_id = isset($args['address_2']) ? $args['address_2'] : '';

            $array['{first_name}'] = $args['first_name'] ? wcl10n__('Name', 'woocommerce', 'html') . ": {$args['first_name']}\n" : '';
            $array['{state}'] = $city_id;
            $array['{city}'] = $district_id;
            $array['{address_2}'] = $ward_id;
            $array['{address_1}'] = $args['address_1'] ? " {$args['address_1']}," : '';

            if (isset($cities[$city_id]) && $cities[$city_id] && $city_id) {
                $array['{state}'] = " {$cities[$city_id]},";
            }
            if (isset($districts[$city_id][$district_id]) && $districts[$city_id][$district_id]) {
                $array['{city}'] = " {$districts[$city_id][$district_id]},";
            }
            if (isset($wards[$district_id][$ward_id]) && $wards[$district_id][$ward_id]) {
                $array['{address_2}'] = " {$wards[$district_id][$ward_id]},";
            }

            return $array;
        }

        function fsw_woocommerce_get_script_data($params, $handle) {
            if ($handle == 'wc-country-select') {
                if (is_account_page()) $params['countries'] = '';
                $params['i18n_select_state_text'] = esc_html__('Select Province/City', 'friendstore-for-woocommerce');
            }
            return $params;
        }

        function fsw_woocommerce_cart_calculate_shipping_address($address) {
            $address['address_2'] = isset($_POST['calc_shipping_address_2']) ? wc_clean(wp_unslash($_POST['calc_shipping_address_2'])) : '';
            WC()->session->set('address_2', $address['address_2']);

            return $address;
        }

        function fsw_woocommerce_calculated_shipping() {
            $address['address_2'] = isset($_POST['calc_shipping_address_2']) ? wc_clean(wp_unslash($_POST['calc_shipping_address_2'])) : '';

            WC()->customer->set_billing_address_2($address['address_2']);
            WC()->customer->set_shipping_address_2($address['address_2']);
        }
    }

    new FoW_Custom_Fields();
}