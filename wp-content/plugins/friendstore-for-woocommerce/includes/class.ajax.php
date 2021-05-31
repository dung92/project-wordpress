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

if (!class_exists('FoW_Ajax')) {
	class FoW_Ajax {

		function __construct() {
			self::add_ajax_events();
		}

		public static function add_ajax_events() {
			add_action( 'init', array(__CLASS__, 'update_district_ajax') );
			add_action( 'init', array(__CLASS__, 'update_ward_ajax') );
			add_action( 'wp_loaded', array(__CLASS__, 'product_shipping_calculator_ajax') );
		}


		public static function update_district_ajax() {
			if ( ! isset( $_GET['fsw-ajax'] ) || 'update_district' !== $_GET['fsw-ajax'] ) return;

			if (isset($_POST['city_id'])) {
				$city_id = sanitize_text_field($_POST['city_id']);
				FoW_Ultility::show_districts_option_by_city_id($city_id);
			}
			die();
		}

		public static function update_ward_ajax() {
			if ( ! isset( $_GET['fsw-ajax'] ) || 'update_ward' !== $_GET['fsw-ajax'] ) return;

			if (isset($_POST['district_id'])) {
				$district_id = sanitize_text_field($_POST['district_id']);
				FoW_Ultility::show_wards_option_by_district_id($district_id);
			}
			die();
		}

		public static function product_shipping_calculator_ajax() {
			if ( ! isset( $_GET['fsw-ajax'] ) || 'product_shipping_calculator' !== $_GET['fsw-ajax'] ) return;

			try {
				$address = array(
                    'country' => '',
                    'state' => '',
                    'city' => '',
                    'address_2' => '',
                );
				if(isset( $_POST['calc_shipping_country'] )) $address['country'] =  wc_clean( wp_unslash( $_POST['calc_shipping_country'] ) );
				if(isset( $_POST['calc_shipping_state'] )) $address['state'] = wc_clean( wp_unslash( $_POST['calc_shipping_state'] ) );
				if(isset( $_POST['calc_shipping_city'] )) $address['city'] = wc_clean( wp_unslash( $_POST['calc_shipping_city'] ) );
				if(isset( $_POST['calc_shipping_address_2'] )) $address['address_2'] = wc_clean( wp_unslash( $_POST['calc_shipping_address_2'] ) );
				$address = apply_filters( 'fsw_product_calculate_shipping_address', $address );

				if ( ! WC()->customer->get_billing_first_name() ) {
					WC()->customer->set_billing_country($address['country']);
					WC()->customer->set_billing_state($address['state']);
					WC()->customer->set_billing_city($address['city']);
					WC()->customer->set_billing_address_2($address['address_2']);
				}
				WC()->customer->set_shipping_country($address['country']);
				WC()->customer->set_shipping_state($address['state']);
				WC()->customer->set_shipping_city($address['city']);
				WC()->customer->set_shipping_address_2($address['address_2']);

				$args = array();
				$products = array();
				if(isset( $_POST['product_id'] )) {
					$args['product_id'] = wc_clean( wp_unslash( $_POST['product_id'] ) );
					if(isset( $_POST['product_type'] )) $args['product_type'] = wc_clean( wp_unslash( $_POST['product_type'] ) );
					if( isset($_POST['quantity']) && isset( $_POST['product_type'] ) && $_POST['product_type'] === 'grouped' ) {
						$items = (array) $_POST['quantity'];
						if(count($items)>0){
							foreach($items as $k => $v){
								$item = array();
								$item['product_id'] = absint($k);
								$item['quantity'] = absint($v);
								$products[] = $item;
							}
						}
					} else {
						$item = array();
						$item['product_id'] = wc_clean( wp_unslash( $_POST['product_id'] ) );
						if(isset( $_POST['variation_id'] )) $item['variation_id'] = wc_clean( wp_unslash( $_POST['variation_id'] ) );
						if(isset( $_POST['quantity'] )) $item['quantity'] = wc_clean( wp_unslash( $_POST['quantity'] ) );
						$products[] = $item;
					}
				}
				$args['products'] = $products;

				fsw_product_shipping_html($args);
				WC()->customer->save();

				do_action( 'fsw_product_calculated_shipping' );
			} catch ( Exception $e ) {
				if ( ! empty( $e ) ) {
					wc_add_notice( $e->getMessage(), 'error' );
				}
			}
			die();
		}
	}

	new FoW_Ajax();
}