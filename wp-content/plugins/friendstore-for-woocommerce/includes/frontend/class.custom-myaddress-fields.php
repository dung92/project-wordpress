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

if (!class_exists('FoW_Custom_Myaddress_Fields')) {
    class FoW_Custom_Myaddress_Fields {

        function __construct() {
            // Add thêm field ở MyAccount, sắp xếp lại thứ tự fields và ẩn một số field không sử dụng.
            add_filter('woocommerce_billing_fields', array($this, 'fsw_woocommerce_billing_fields'), 999, 1);
            add_filter('woocommerce_shipping_fields', array($this, 'fsw_woocommerce_shipping_fields'), 999, 1);
        }

        // Add thêm field ở MyAccount, sắp xếp lại thứ tự fields và ẩn một số field không sử dụng.
        function fsw_woocommerce_billing_fields($fields) {
            return FoW_Ultility::get_address_fields('billing', $fields);
        }

        function fsw_woocommerce_shipping_fields($fields) {
            return FoW_Ultility::get_address_fields('shipping', $fields);
        }
    }

    new FoW_Custom_Myaddress_Fields();
}