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

if (!function_exists('wcl10n__')) {
	function wcl10n__($string, $textdomain = '', $esc = false) {
		if($esc && in_array($esc, array('html','url', 'attr', 'js', 'textarea', 'sql'))) {
			$esc_function = "esc_{$esc}__";
			return $textdomain ? $esc_function($string, $textdomain) : $esc_function($string);
		} else {
			return $textdomain ? __($string, $textdomain) : __($string);
		}
	}
}
if (!function_exists('wcl10n_e')) {
	function wcl10n_e($string, $textdomain = '', $esc = false) {
		if($esc && in_array($esc, array('html','url', 'attr', 'js', 'textarea', 'sql'))) {
			$esc_function = "esc_{$esc}__";
			echo $textdomain ? $esc_function($string, $textdomain) : $esc_function($string);
		} else {
			echo $textdomain ? __($string, $textdomain) : __($string);
		}
	}
}
if (!function_exists('wcl10n_n')) {
	function wcl10n_n($single, $plural, $number, $textdomain = '') {
		return $textdomain ? _n($single, $plural, $number, $textdomain) : _n($single, $plural, $number);
	}
}

if (!function_exists('is_woocommerce_activated')) {
	function is_woocommerce_activated() {
		return in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins', array()))) ||
			(is_multisite() && array_key_exists('woocommerce/woocommerce.php', get_site_option('active_sitewide_plugins', array())));
	}
}

if (!function_exists('can_shipping_vietnam')) {
	function can_shipping_vietnam() {
		$countries = WC()->countries->get_shipping_countries();
		return is_woocommerce_activated() && isset($countries['VN']);
	}
}

if (!function_exists('is_shipping_vietnam')) {
	function is_shipping_vietnam() {
		$countries = WC()->countries->get_shipping_countries();
		return is_woocommerce_activated() && isset($countries['VN']);
	}
}

if (!function_exists('the_array_search')) {
	function the_array_search($find, $items) {
		foreach ($items as $key => $value) {
			$current_key = $key;
			if (
				$find === $value
				OR (
					is_array($value)
					&& the_array_search($find, $value) !== false
				)
			) {
				return $current_key;
			}
		}
		return false;
	}
}

// get list track order status
if (!function_exists('track_order_status')) {
	function track_order_status($order_ID = 0) {
		$order_ID = (int) $order_ID;
		if ($order_ID == 0) return false;
		global $wpdb;

		$str = sprintf(wcl10n__('Order status changed from %1$s to %2$s.', 'woocommerce'), 'fsw', '123');
		$check = explode('fsw', $str);

		$notes = $wpdb->get_results("SELECT comment_ID, comment_content, comment_date FROM {$wpdb->prefix}comments 
                      WHERE comment_post_ID={$order_ID} AND comment_type='order_note' AND comment_content LIKE '%{$check[0]}%'
                      ORDER BY comment_ID DESC");

		return $notes;
	}
}

if ( ! function_exists( 'fsw_session_get' ) ) {
    function fsw_session_get($name) {
        if (isset(WC()->session)) {
            // WC 2.0
            if (isset(WC()->session->$name)) return WC()->session->$name;
        } else {
            // old style
            if (isset($_SESSION[$name])) return $_SESSION[$name];
        }

        return null;
    }
}

if ( ! function_exists( 'fsw_session_isset' ) ) {
    function fsw_session_isset($name) {
        if (isset(WC()->session)) {
            // WC 2.0
            return (isset(WC()->session->$name));
        } else {
            return (isset($_SESSION[$name]));
        }
    }
}

if ( ! function_exists( 'fsw_session_set' ) ) {
    function fsw_session_set($name, $value) {
        if (isset(WC()->session)) {
            // WC 2.0
            unset(WC()->session->$name);
            WC()->session->$name = $value;
        } else {
            // old style
            $_SESSION[$name] = $value;
        }
    }
}

if ( ! function_exists( 'fsw_session_delete' ) ) {
    function fsw_session_delete($name) {
        if (isset(WC()->session)) {
            // WC 2.0
            unset(WC()->session->$name);
        } else {
            // old style
            unset($_SESSION[$name]);
        }
    }
}

if ( ! function_exists( 'fsw_get_address' ) ) {
	function fsw_get_address($address) {
		foreach ($address as $key => $value) {
			if (strpos($key, 'shipping_') === false) {
				$address['shipping_' . $key] = $value;
			}

			$addr_key = str_replace('shipping_', '', $key);
			$address[$addr_key] = $value;
		}

		return $address;
	}
}

if ( ! function_exists( 'fsw_get_formatted_address' ) ) {
	function fsw_get_formatted_address($address) {
		$address = fsw_get_address($address);
		return apply_filters('fsw_formatted_address', WC()->countries->get_formatted_address($address), $address);
	}
}

if ( ! function_exists( 'fsw_product_shipping_html' ) ) {
	function fsw_product_shipping_html($args = array()) {
		$default_args = array(
			'button_text' => '',
			'has_calculated_shipping' => true,
			'show_shipping_calculator' => true,
			'address_2' => '',
			'city' => '',
			'state' => '',
			'postcode' => '',
			'country' => '',
			'product_id' => '',
			'product_type' => '',
			'products' => array(
				array(
					'product_id' => '',
					'variation_id' => '',
					'weight' => '',
					'quantity' => 1,
				)
			)
		);

		$args = wp_parse_args($args, $default_args);

		// if($args['product_id'] || $args['quantity']) return;

		// Get shipping address
		$shipping_product = array(
			'country' => $args['country'] == '' ? WC()->customer->get_shipping_country() : $args['country'],
			'state' => $args['state'] == '' ? WC()->customer->get_shipping_state() : $args['state'],
			'city' => $args['city'] == '' ? WC()->customer->get_shipping_city() : $args['city'],
			'address_2' => $args['address_2'] == '' ? WC()->customer->get_shipping_address_2() : $args['address_2'],
			'postcode' => $args['postcode'] == '' ? WC()->customer->get_shipping_postcode() : $args['postcode'],
		);
		$formatted_destination = WC()->countries->get_formatted_address($shipping_product, ', ');

		// List Products
		$products = array();
		if(is_array($args['products']) && count($args['products']) > 0) {
			foreach ($args['products'] as $item) {
				if ($item['product_id'] != '' && isset($item['quantity']) && intval($item['quantity']) > 0) {
					$product = array(
						'product_id' => absint($item['product_id']),
						'quantity' => absint($item['quantity']),
						'data' => wc_get_product( $item['product_id'] )
					);
					if (isset($item['variation_id']) && $item['variation_id'] != '') {
                        if ( function_exists( 'wc_get_product_object' ) ) {
                            $product['data'] = wc_get_product_object('variation', $item['variation_id']);
                        } else {
                            $product['data'] = new WC_Product_Variation( $item['variation_id'] );
                        }
					}

					$products[] = $product;
				}
			}
		}

		// Get available methods
		$available_methods = array();
		if( count($products) > 0 ) {
			$package = array(
				"contents" => $products,
				"destination" => $shipping_product,
				"contents_cost" => 0,
				"rates" => array()
			);
			foreach (WC()->shipping->load_shipping_methods($package) as $shipping_method) {
				$available_methods = $available_methods + $shipping_method->get_rates_for_package($package);
			}
		}

		fsw_get_template('shipping-calculator/shipping-calculator.php', array(
			'product_id' => $args['product_id'],
			'product_type' => $args['product_type'],
			'button_text' => $args['button_text'],
			'has_calculated_shipping' => $args['has_calculated_shipping'],
			'show_shipping_calculator' => $args['show_shipping_calculator'],
			'available_methods' => $available_methods,
			'shipping_address' => $shipping_product,
			'formatted_destination' => $formatted_destination,
		));
	}
}


/**
 * TEMPLATE
 */
if ( ! function_exists( 'fsw_locate_template' ) ) {
	function fsw_locate_template($template_name, $template_path = '', $default_path = '') {
		if (!$template_path) {
			$template_path = 'friendstore/';
		}

		if (!$default_path) {
			$default_path = FoW_PATH . 'templates/friendstore/';
		}

		// Look within passed path within the theme - this is priority.
		$template = locate_template(
			array(
				trailingslashit($template_path) . $template_name,
				$template_name,
			)
		);

		// Get default template/.
		if (!$template) {
			$template = $default_path . $template_name;
		}

		// Return what we found.
		return apply_filters('fsw_locate_template', $template, $template_name, $template_path);
	}
}

if ( ! function_exists( 'fsw_get_template_part' ) ) {
	function fsw_get_template_part( $slug, $name = '', $args = array() ) {
		$defaults = array();

		$args = wp_parse_args( $args, $defaults );

		if ( $args && is_array( $args ) ) {
			extract( $args );
		}

		$template = '';
		$template_url = 'friendstore/';
		$file_name = $name ? ($slug.'-'.$name) : $slug;

		// Look in yourtheme/slug-name.php and yourtheme/woopanel/slug-name.php
		if ( $file_name ){
			$template = locate_template(array("{$file_name}.php", "{$template_url}{$file_name}.php"));
		}

		// Get default slug-name.php
		if ( !$template && $file_name && file_exists(FoW_PATH . "templates/{$file_name}.php") )
			$template = FoW_PATH . "templates/{$file_name}.php";

		// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/friendstore/slug.php
		if ( !$template )
			$template = locate_template(array("{$file_name}.php", "{$template_url}{$file_name}.php"));

		if ( $template ) include $template;
	}
}

if ( ! function_exists( 'fsw_get_template' ) ) {
	function fsw_get_template($template_name, $args = array(), $template_path = '', $default_path = '') {
		if (!empty($args) && is_array($args)) {
			extract($args);
		}

		$located = fsw_locate_template($template_name, $template_path, $default_path);

		// Allow 3rd party plugin filter template file from their plugin.
		$located = apply_filters('fsw_get_template', $located, $template_name, $args, $template_path, $default_path);

		do_action('fsw_before_template_part', $template_name, $template_path, $located, $args);

		if ( $located ) include $located;

		do_action('fsw_after_template_part', $template_name, $template_path, $located, $args);
	}
}