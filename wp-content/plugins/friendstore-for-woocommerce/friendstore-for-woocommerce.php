<?php
/**
 * Copyright (c) VietFriend, Inc. and its affiliates. All Rights Reserved
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 *
 * Plugin Name: FriendStore for WooCommerce
 * Description: Is an extension of WooCommerce that support customizing addresses in Vietnam.
 * Version: 1.4.2
 * Author: VietFriend team
 * Author URI: http://team.vietfriend.info
 * Plugin URI: https://code.vietfriend.info/product/friendstore-for-woocommerce/
 * License: GNU General Public License v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * Requires at least: 4.4
 * Tested up to: 5.4
 * Text Domain: friendstore-for-woocommerce
 * Domain Path: /languages
 *
 * WC requires at least: 3.0
 * WC tested up to: 4.3
 *
 * @package FriendStore for WooCommerce
 */

defined('ABSPATH') || exit;

if (!defined('FSW_PLUGIN_FILE')) {
    define('FSW_PLUGIN_FILE', __FILE__);
}

if (!defined('FSW_PLUGIN_FILE_BASE')) {
    define('FSW_PLUGIN_FILE_BASE', plugin_basename(__FILE__));
}

/**
 * If we are activating a version, while having another present and activated.
 * Leave in the Pro version, if it is available.
 */
//Deactivate the .org version, if pro version is active
add_action( 'admin_init', 'activate_fsw_pro' );
if ( ! function_exists( 'activate_fsw_pro' ) ) {
    function activate_fsw_pro() {
	    if (defined('FSW_PRO_FILE_BASE')) {
		    deactivate_plugins(plugin_basename(__FILE__));

		    // Notify the user when the plugin is deactivated.
		    add_action('pre_current_active_plugins', 'deactivate_fsw_org_notice');

		    return; // Return to avoid errors with free-dashboard module.
	    } else {
		    $pro_installed = false;
		    $pro_base = 'friendstore-for-woocommerce-pro/friendstore-for-woocommerce.php';

		    if (file_exists(WP_PLUGIN_DIR . '/' . $pro_base)) {
			    $pro_installed = true;
		    }

		    if ($pro_installed && is_plugin_active($pro_base)) {
			    deactivate_plugins(plugin_basename(__FILE__));

			    // Notify the user when the plugin is deactivated.
			    add_action('pre_current_active_plugins', 'deactivate_fsw_org_notice');

			    return; // Return to avoid errors with free-dashboard module.
		    }
	    }
    }
}

if ( ! function_exists( 'deactivate_fsw_org_notice' ) ) {
    function deactivate_fsw_org_notice() {
        ?>
        <style type="text/css">#message {display: none;}</style>
        <div class="updated">
            <p>
                <?php
                printf(
                    esc_html__( '%s was auto deactivated. You have %s active!', 'friendstore-for-woocommerce' ),
                    '<strong>'. esc_html__('FriendStore for WooCommerce', 'friendstore-for-woocommerce') .'</strong>',
                    '<strong>'. esc_html__('FriendStore for WooCommerce Pro', 'friendstore-for-woocommerce') .'</strong>'
                ); ?>
            </p>
        </div>
        <?php
    }
}

// Include the main WooCommerce class.
if (!class_exists('FriendStore_Woocommerce', false)) {
    include_once dirname(__FILE__) . '/includes/class.friendstore-woocommerce.php';
}

if (!function_exists('FoW')) {
    function FoW() {
        return FriendStore_Woocommerce::instance();
    }

    function fsw_plugins_loaded() {
        $GLOBALS['fsw'] = FoW();
    }

    add_action('plugins_loaded', 'fsw_plugins_loaded');
}