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

class FoW_Ultility {

    public static function get_cities_array() {
        include(FoW_PATH . 'assets/json/cities.php');
        ksort($cities);
        return $cities;
    }

    public static function get_district_array() {
        include(FoW_PATH . 'assets/json/districts.php');
        return $districts;
    }

    public static function get_wards_array() {
        include(FoW_PATH . 'assets/json/wards.php');
        return $wards;
    }

    public static function get_districts_array_by_city_id($city_id) {
        $city_id = sanitize_text_field($city_id);
        $array = array('' => esc_html__('Select District', 'friendstore-for-woocommerce'));
        if (isset($city_id) && $city_id) {
            $districts = isset(self::get_district_array()[$city_id]) ? self::get_district_array()[$city_id] : '';
            if ($districts) {
                ksort($districts);
                foreach ($districts as $key => $value) {
                    $array[$key] = $value;
                }
            }
        }
        return $array;
    }

    public static function show_districts_option_by_city_id($city_id) {
        $city_id = sanitize_text_field($city_id);
        echo '<option value="">' . esc_html__('Select District', 'friendstore-for-woocommerce') . '</option>';
        if (isset($city_id) && $city_id) {
            $districts = isset(self::get_district_array()[$city_id]) ? self::get_district_array()[$city_id] : '';
            if ($districts) {
                ksort($districts);
                foreach ($districts as $key => $value) {
                    echo '<option value="' . esc_attr($key) . '">' . esc_attr($value) . '</option>';
                }
            }
        }
    }

    public static function show_wards_option_by_district_id($district_id) {
        $district_id = sanitize_text_field($district_id);
        echo '<option value="">' . esc_html__('Select Commune/Ward', 'friendstore-for-woocommerce') . '</option>';
        if (isset($district_id) && $district_id) {
            $wards = isset(self::get_wards_array()[$district_id]) ? self::get_wards_array()[$district_id] : '';
            if ($wards) {
                ksort($wards);
                foreach ($wards as $key => $value) {
                    echo '<option value="' . esc_attr($key) . '">' . esc_attr($value) . '</option>';
                }
            }
        }
    }

    public static function get_wards_array_by_district_id($district_id) {
        $district_id = sanitize_text_field($district_id);
        $array = array('' => esc_html__('Select Commune/Ward', 'friendstore-for-woocommerce'));
        if (isset($district_id) && $district_id) {
            $wards = isset(self::get_wards_array()[$district_id]) ? self::get_wards_array()[$district_id] : '';
            if ($wards) {
                ksort($wards);
                foreach ($wards as $key => $value) {
                    $array[$key] = $value;
                }
            }
        }
        return $array;
    }

    public static function convert_id_to_name_city($city_id) {
        $city_id = sanitize_text_field($city_id);
        if (!empty($city_id)) {
            $cities = self::get_cities_array();
            return isset($cities[$city_id]) ? $cities[$city_id] : $city_id;
        }
        return false;
    }

    public static function convert_id_to_name_district($city_id, $district_id) {
        $city_id = sanitize_text_field($city_id);
        $district_id = sanitize_text_field($district_id);
        if (!empty($city_id) && !empty($district_id) && isset(self::get_district_array()[$city_id])) {
            $districts = self::get_district_array()[$city_id];
            return isset($districts[$district_id]) ? $districts[$district_id] : $district_id;
        }
        return false;
    }

    public static function convert_id_to_name_ward($district_id, $ward_id) {
        $district_id = sanitize_text_field($district_id);
        $ward_id = sanitize_text_field($ward_id);
        if (!empty($ward_id) && !empty($district_id) && isset(self::get_wards_array()[$district_id])) {
            $wards = self::get_wards_array()[$district_id];
            return isset($wards[$ward_id]) ? $wards[$ward_id] : $ward_id;
        }
        return false;
    }

    public static function sort_by_field(&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = isset($va[$key]) ? $va[$key] : 0;
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;
    }

    public static function get_address_fields($type, $fields) {
        if (!can_shipping_vietnam()) return $fields;

        if (is_checkout()) {
            $city_id = WC()->checkout()->get_value("{$type}_state");
            $district_id = WC()->checkout()->get_value("{$type}_city");
        } else {
            $city_id = get_user_meta(get_current_user_id(), "{$type}_state", true);
            $district_id = get_user_meta(get_current_user_id(), "{$type}_city", true);
        }

        $city_args = array(
            'label'       => esc_html__('Province/City', 'friendstore-for-woocommerce'),
            'type'        => 'select',
            'required'    => true,
            'options'     => FoW_Ultility::get_cities_array(),
            'input_class' => array(
                'wc-enhanced-select __fsw_city',
            ),
            'class'       => array('form-row-first'),
            'priority'    => 80,
            'default'     => '333',
        );

        $district_args = array(
            'label'       => esc_html__('District', 'friendstore-for-woocommerce'),
            'type'        => 'select',
            'required'    => true,
            'options'     => FoW_Ultility::get_districts_array_by_city_id($city_id),
            'input_class' => array(
                'wc-enhanced-select __fsw_district',
            ),
            'class'       => array('form-row-last'),
            'priority'    => 90
        );

        $ward_args = array(
            'label'       => esc_html__('Commune/Ward', 'friendstore-for-woocommerce'),
            'type'        => 'select',
            'required'    => true,
            'options'     => FoW_Ultility::get_wards_array_by_district_id($district_id),
            'input_class' => array(
                'wc-enhanced-select __fsw_ward',
            ),
            'class'       => array('form-row-wide', 'update_totals_on_change'),
            'priority'    => 100
        );

        $fields["{$type}_state"] = $city_args;
        $fields["{$type}_city"] = $district_args;
        $fields["{$type}_address_2"] = $ward_args;

        $fields["{$type}_first_name"]['class'] = array('form-row-first');
        $fields["{$type}_phone"]['class'] = array('form-row-last');
        $fields["{$type}_email"]['class'] = array('form-row-wide');
        $fields["{$type}_address_1"]['class'] = array('form-row-wide');

        $fields["{$type}_first_name"]['label'] = __('Full Name', 'friendstore-for-woocommerce');
        $fields["{$type}_phone"]['label'] = wcl10n__('Phone', 'woocommerce');
        $fields["{$type}_email"]['label'] = wcl10n__('Email', 'woocommerce');

        unset($fields["{$type}_last_name"]);
        unset($fields["{$type}_company"]);
        unset($fields["{$type}_postcode"]);

        $fields["{$type}_phone"]['priority'] = 30;
        $fields["{$type}_email"]['priority'] = 40;
        $fields["{$type}_country"]['priority'] = 50;
        $fields["{$type}_address_1"]['priority'] = 110;

        self::sort_by_field($fields, 'priority');
        return $fields;
    }

    public static function get_store_info() {
        $store_info = array();

        $store_info['name'] = get_option('woocommerce_store_name');
        $store_info['phone'] = get_option('woocommerce_store_phone');
        $store_info['city_id'] = get_option('woocommerce_store_city');
        $store_info['district_id'] = get_option('woocommerce_store_district');
        $store_info['ward_id'] = get_option('woocommerce_store_ward');
        $store_info['city'] = $store_info['city_id'] ? self::convert_id_to_name_city($store_info['city_id']) : '';
        $store_info['district'] = $store_info['city_id'] && $store_info['district_id'] ? self::convert_id_to_name_district($store_info['city_id'], $store_info['district_id']) : '';
        $store_info['ward'] = $store_info['district_id'] && $store_info['ward_id'] ? self::convert_id_to_name_ward($store_info['district_id'], $store_info['ward_id']) : '';
        $store_info['address'] = get_option('woocommerce_store_address');
        $store_info['full_address'] = implode(', ', array_filter(array($store_info['address'], $store_info['ward'], $store_info['district'], $store_info['city'])));

        return $store_info;
    }
}
