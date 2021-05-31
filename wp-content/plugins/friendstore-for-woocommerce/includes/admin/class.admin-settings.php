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

class FoW_AdminSettings {

    public function __construct() {
        add_filter('woocommerce_general_settings', array($this, 'custom_store_address'));
    }

    function custom_store_address($settings) {
        $new_settings = array();
        $store_city = isset($_POST['woocommerce_store_city']) ? $_POST['woocommerce_store_city'] : get_option('woocommerce_store_city');
        $store_district = isset($_POST['woocommerce_store_district']) ? $_POST['woocommerce_store_district'] : get_option('woocommerce_store_district');

        $store_settings = array(
            array(
                'title' => wcl10n__('Store Address', 'woocommerce', 'html'),
                'type'  => 'title',
                'desc'  => wcl10n__('This is where your business is located. Tax rates and shipping rates will use this address.', 'woocommerce', 'html'),
                'id'    => 'store_address',
            ),
            array(
                'title'    => esc_html__('Full Name', 'friendstore-for-woocommerce'),
                'id'       => 'woocommerce_store_name',
                'default'  => '',
                'type'     => 'text',
                'desc_tip' => true,
            ),
            array(
                'title'    => wcl10n__('Phone', 'woocommerce', 'html'),
                'id'       => 'woocommerce_store_phone',
                'default'  => '',
                'type'     => 'text',
                'desc_tip' => true,
            ),

            array(
                'title'    => esc_html__('Province/City', 'friendstore-for-woocommerce'),
                'desc'     => wcl10n__('The city in which your business is located.', 'woocommerce', 'html'),
                'id'       => 'woocommerce_store_city',
                'default'  => '',
                'type'     => 'select',
                'class'    => '__fsw_city',
                'options'  => FoW_Ultility::get_cities_array(),
                'desc_tip' => true,
            ),

            array(
                'title'    => esc_html__('District', 'friendstore-for-woocommerce'),
                'desc'     => esc_html__('The District in which your business is located.', 'friendstore-for-woocommerce'),
                'id'       => 'woocommerce_store_district',
                'default'  => '',
                'type'     => 'select',
                'class'    => '__fsw_district',
                'options'  => (array)FoW_Ultility::get_districts_array_by_city_id($store_city),
                'desc_tip' => true,
            ),

            array(
                'title'    => esc_html__('Commune/Ward', 'friendstore-for-woocommerce'),
                'desc'     => esc_html__('The Commune/Ward in which your business is located.', 'friendstore-for-woocommerce'),
                'id'       => 'woocommerce_store_ward',
                'default'  => '',
                'type'     => 'select',
                'class'    => '__fsw_ward',
                'options'  => (array)FoW_Ultility::get_wards_array_by_district_id($store_district),
                'desc_tip' => true,
            ),

            array(
                'title'    => wcl10n__('Address', 'woocommerce', 'html'),
                'desc'     => wcl10n__('The street address for your business location.', 'woocommerce', 'html'),
                'id'       => 'woocommerce_store_address',
                'default'  => '',
                'type'     => 'text',
                'desc_tip' => true,
            ),
        );
        $is_store_address = false;

        foreach ($settings as $setting) {
            // at the bottom of the General Options section
            if (isset($setting['id'])) {
                if ($setting['id'] == 'store_address' && $setting['type'] == 'title') {
                    $is_store_address = true;
                }
                if ($setting['id'] == 'store_address' && $setting['type'] == 'sectionend') {
                    $is_store_address = false;
                    $new_settings += $store_settings;
                }
                if ($is_store_address) continue;
            }
            $new_settings[] = $setting;
        }

        return $new_settings;
    }
}

new FoW_AdminSettings;