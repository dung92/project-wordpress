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

if (!class_exists('FoW_Custom_Profile_Fields')) {
    class FoW_Custom_Profile_Fields {

        function __construct() {
            add_filter('woocommerce_customer_meta_fields', array($this, 'fsw_woocommerce_customer_meta_fields'), 10, 1);
        }

        function fsw_woocommerce_customer_meta_fields($array) {
            if (!can_shipping_vietnam()) return $array;

            // If is current user's profile (profile.php)
            if (defined('IS_PROFILE_PAGE') && IS_PROFILE_PAGE) {
                // get user_id when show/save your profile
                $user_id = get_current_user_id();
            } elseif (!empty($_GET['user_id']) && is_numeric($_GET['user_id'])) {
                // get user_id when show user profile
                $user_id = sanitize_key($_GET['user_id']);
            } elseif (!empty($_POST['user_id']) && is_numeric($_POST['user_id'])) {
                // get user_id when save user profile
                $user_id = sanitize_key($_POST['user_id']);
            } else {
                return $array;
            }

            $types = array('billing', 'shipping');
            foreach ($types as $item) {
                unset($array[$item]['fields'][$item . '_last_name']);
                unset($array[$item]['fields'][$item . '_company']);
                unset($array[$item]['fields'][$item . '_postcode']);

                $array[$item]['fields'][$item . '_first_name']['label'] = esc_html__('Full Name', 'friendstore-for-woocommerce');
                $array[$item]['fields'][$item . '_first_name']['priority'] = 10;

                $array[$item]['fields'][$item . '_phone']['label'] = wcl10n__('Phone', 'woocommerce', 'html');
                $array[$item]['fields'][$item . '_phone']['description'] = '';
                $array[$item]['fields'][$item . '_phone']['priority'] = 20;

                $array[$item]['fields'][$item . '_email']['label'] = wcl10n__('Email', 'woocommerce', 'html');
                $array[$item]['fields'][$item . '_email']['description'] = '';
                $array[$item]['fields'][$item . '_email']['priority'] = 30;

                $array[$item]['fields'][$item . '_country']['priority'] = 40;

                $array[$item]['fields'][$item . '_state'] = array(
                    'label'       => esc_html__('Province/City', 'friendstore-for-woocommerce'),
                    'description' => '',
                    'type'        => 'select',
                    'options'     => FoW_Ultility::get_cities_array(),
                    'class'       => 'wc-enhanced-select __fsw_city',
                    'priority'    => 80,
                );

                $array[$item]['fields'][$item . '_city'] = array(
                    'label'       => esc_html__('District', 'friendstore-for-woocommerce'),
                    'description' => '',
                    'type'        => 'select',
                    'options'     => FoW_Ultility::get_districts_array_by_city_id(get_user_meta($user_id, "{$item}_state", true)),
                    'class'       => 'wc-enhanced-select __fsw_district',
                    'priority'    => 90,
                    'show'        => false,
                );

                $array[$item]['fields'][$item . '_address_2'] = array(
                    'label'       => esc_html__('Commune/Ward', 'friendstore-for-woocommerce'),
                    'description' => '',
                    'type'        => 'select',
                    'options'     => FoW_Ultility::get_wards_array_by_district_id(get_user_meta($user_id, "{$item}_city", true)),
                    'class'       => 'wc-enhanced-select __fsw_ward',
                    'priority'    => 100,
                    'show'        => false,
                );

                $array[$item]['fields'][$item . '_phone']['label'] = wcl10n__('Phone', 'woocommerce', 'html');
                $array[$item]['fields'][$item . '_email']['label'] = wcl10n__('Email', 'woocommerce', 'html');
                $array[$item]['fields'][$item . '_phone']['description'] = '';
                $array[$item]['fields'][$item . '_email']['description'] = '';
                $array[$item]['fields'][$item . '_address_1']['label'] = wcl10n__('Address', 'woocommerce', 'html');
                $array[$item]['fields'][$item . '_address_1']['priority'] = 110;

                $fields = $array[$item]['fields'];
                FoW_Ultility::sort_by_field($fields, 'priority');
                $array[$item]['fields'] = $fields;
            }
            return $array;
        }
    }

    new FoW_Custom_Profile_Fields();
}