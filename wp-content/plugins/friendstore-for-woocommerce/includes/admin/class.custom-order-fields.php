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

if (!class_exists('FoW_Custom_Order_Fields')) {
    class FoW_Custom_Order_Fields {

        function __construct() {

            // Khai báo các fields nào được hiển thị, fields nào không và label của chúng khi xem chi tiết 1 order trong admin thông qua giá trị show
            add_filter('woocommerce_admin_billing_fields', array($this, 'fsw_woocommerce_admin_billing_fields'), 999);
            add_filter('woocommerce_admin_shipping_fields', array($this, 'fsw_woocommerce_admin_shipping_fields'), 999);

            // Gõ bỏ các fields không sử dụng.
            add_filter('woocommerce_order_formatted_billing_address', array($this, 'fsw_woocommerce_order_formatted_billing_address'), 999);
            add_filter('woocommerce_order_formatted_shipping_address', array($this, 'fsw_woocommerce_order_formatted_shipping_address'), 999);

            // Sửa link google maps
            add_filter('woocommerce_shipping_address_map_url_parts', array($this, 'fsw_woocommerce_shipping_address_map_url_parts'), 10, 1);

        }

        function fsw_woocommerce_admin_billing_fields($array) {
            unset($array['last_name']);
            unset($array['company']);
            unset($array['postcode']);

            $array['first_name']['priority'] = 10;
            $array['phone']['priority'] = 20;
            $array['email']['priority'] = 30;
            $array['country']['priority'] = 40;
            $array['address_1']['priority'] = 110;

            $array['state'] = array(
                'label'    => esc_html__('Province/City', 'friendstore-for-woocommerce'),
                'type'     => 'select',
                'options'  => FoW_Ultility::get_cities_array(),
                'class'    => 'wc-enhanced-select __fsw_city',
                'priority' => 80,
                'show'     => false,
            );

            $array['city'] = array(
                'label'    => esc_html__('District', 'friendstore-for-woocommerce'),
                'type'     => 'select',
                'options'  => FoW_Ultility::get_districts_array_by_city_id(get_post_meta(get_the_ID(), '_billing_state', true)),
                'class'    => 'wc-enhanced-select __fsw_district',
                'priority' => 90,
                'show'     => false,
            );

            $array['address_2'] = array(
                'label'    => esc_html__('Commune/Ward', 'friendstore-for-woocommerce'),
                'type'     => 'select',
                'options'  => FoW_Ultility::get_wards_array_by_district_id(get_post_meta(get_the_ID(), '_billing_city', true)),
                'class'    => 'wc-enhanced-select __fsw_ward',
                'priority' => 100,
                'show'     => false,
            );

            $array['address_1']['label'] = wcl10n__('Address', 'woocommerce', 'html');

            FoW_Ultility::sort_by_field($array, 'priority');
            foreach ($array as $k => $item) {
                $array[$k]['wrapper_class'] = 'address_VN';
            }
            return $array;
        }

        function fsw_woocommerce_admin_shipping_fields($array) {
            unset($array['last_name']);
            unset($array['company']);
            unset($array['postcode']);

            $array['first_name']['priority'] = 10;
            $array['phone']['priority'] = 30;
            $array['country']['priority'] = 40;
            $array['address_1']['priority'] = 110;

            $array['state'] = array(
                'label'    => esc_html__('Province/City', 'friendstore-for-woocommerce'),
                'type'     => 'select',
                'options'  => FoW_Ultility::get_cities_array(),
                'class'    => 'wc-enhanced-select __fsw_city',
                'priority' => 80,
                'show'     => false,
            );

            $array['city'] = array(
                'label'    => esc_html__('District', 'friendstore-for-woocommerce'),
                'type'     => 'select',
                'options'  => FoW_Ultility::get_districts_array_by_city_id(get_post_meta(get_the_ID(), '_shipping_state', true)),
                'class'    => 'wc-enhanced-select __fsw_district',
                'priority' => 90,
                'show'     => false,
            );

            $array['address_2'] = array(
                'label'    => esc_html__('Commune/Ward', 'friendstore-for-woocommerce'),
                'type'     => 'select',
                'options'  => FoW_Ultility::get_wards_array_by_district_id(get_post_meta(get_the_ID(), '_shipping_city', true)),
                'class'    => 'wc-enhanced-select __fsw_ward',
                'priority' => 100,
                'show'     => false,
            );

            $array['address_1']['label'] = wcl10n__('Address', 'woocommerce', 'html');

            $array['phone']['label'] = wcl10n__('Phone', 'woocommerce', 'html');
            $array['phone']['show'] = true;

            FoW_Ultility::sort_by_field($array, 'priority');
            foreach ($array as $k => $item) {
                $array[$k]['wrapper_class'] = 'address_VN';
            }
            return $array;
        }

        function fsw_woocommerce_order_formatted_billing_address($array) {
            if (isset($array['postcode'])) unset($array['postcode']);
            if (isset($array['country'])) unset($array['country']);
            foreach ($array as $item) {
                if ($item != '') return $array;
            }

            return $array;
        }

        function fsw_woocommerce_order_formatted_shipping_address($array) {
            if (isset($array['postcode'])) unset($array['postcode']);
            if (isset($array['country'])) unset($array['country']);

            return $array;
        }

        function fsw_woocommerce_shipping_address_map_url_parts($address) {
            $city_id = $address['state'];
            $district_id = $address['city'];
            $ward_id = $address['address_2'];

            $address['state'] = FoW_Ultility::convert_id_to_name_city($city_id);
            $address['city'] = FoW_Ultility::convert_id_to_name_district($city_id, $district_id);
            $address['address_2'] = FoW_Ultility::convert_id_to_name_ward($district_id, $ward_id);

            return $address;
        }

    }

    new FoW_Custom_Order_Fields();
}