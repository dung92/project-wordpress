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

final class FriendStore_Woocommerce {
    public $version = '1.0.0';
    protected static $_instance = null;
    public $settings;
    public $units;
    public $store_info;
	public $address_book;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        $this->constants();
        $this->autoload();
        $this->loadTextdomain();
        $this->hooks();
    }

    public function on_plugins_loaded() {
        do_action('fsw_loaded');
    }

    private function define($name, $value) {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    private function constants() {
        $this->set_version();
        $this->set_debug();

        $this->define('FoW_VERSION', $this->version);
        $this->define('FoW_URL', plugin_dir_url(FSW_PLUGIN_FILE));
        $this->define('FoW_PATH', plugin_dir_path(FSW_PLUGIN_FILE));
        $this->define('FoW_BASENAME', basename(FoW_PATH));
    }

    private function autoload() {
        include_once FoW_PATH . 'includes/helper.php';
        include_once FoW_PATH . 'includes/class.ajax.php';
	    include_once FoW_PATH . 'includes/class.ultility.php';
        include_once FoW_PATH . 'includes/class.address-book.php';
        include_once FoW_PATH . 'includes/class.shipping-calculator.php';

	    $this->address_book = new FoW_AddressBook();

        new FoW_ShippingCalculator();

        if (is_woocommerce_activated()) {
            include_once FoW_PATH . 'includes/class.custom-fields.php';
            include_once FoW_PATH . 'includes/class.order-status.php';
        }

	    if (is_admin()) {
		    include_once FoW_PATH . 'includes/admin/class.admin-notices.php';
		    include_once FoW_PATH . 'includes/admin/class.admin-settings.php';
		    include_once FoW_PATH . 'includes/admin/class.custom-profile-fields.php';
		    include_once FoW_PATH . 'includes/admin/class.custom-order-fields.php';
	    } else {
		    include_once FoW_PATH . 'includes/frontend/class.custom-checkout-fields.php';
		    include_once FoW_PATH . 'includes/frontend/class.custom-myaddress-fields.php';
	    }
    }

    private function loadTextdomain() {
        // Set filter for plugin's languages directory
        $plugin_lang_dir = FoW_PATH . 'languages/';

        // Traditional WordPress plugin locale filter
        $locale = apply_filters('plugin_locale', get_locale(), 'friendstore-for-woocommerce');
        $mofile = sprintf('%1$s-%2$s.mo', 'friendstore-for-woocommerce', $locale);

        // Setup paths to current locale file
        $mofile_local = $plugin_lang_dir . $mofile;
        $mofile_global = WP_LANG_DIR . '/' . FoW_BASENAME . '/' . $mofile;

        if (file_exists($mofile_global)) {
            // Look in global /wp-content/languages/friendstore-for-woocommerce folder
            load_textdomain('friendstore-for-woocommerce', $mofile_global);
        } elseif (file_exists($mofile_local)) {
            // Look in local /wp-content/plugins/friendstore-for-woocommerce/languages/ folder
            load_textdomain('friendstore-for-woocommerce', $mofile_local);
        } else {
            // Load the default language files
            load_plugin_textdomain('friendstore-for-woocommerce', false, $plugin_lang_dir);
        }
    }

    private function set_version() {
        $plugin_version = get_file_data(FSW_PLUGIN_FILE, array('Version'), 'plugin');
        $this->version = $plugin_version[0];
    }

    private function set_debug() {
        $this->define('FoW_DEBUG', false);
    }

    private function hooks() {
        add_action('plugins_loaded', array($this, 'on_plugins_loaded'), -1);

        if (!is_woocommerce_activated()) {
            add_action('admin_notices', array($this, 'no_woocommerce_deactivated'), 99);
            add_action('admin_init', array($this, 'auto_deactivate'));
            return;
        }

        add_action('wp_enqueue_scripts', array($this, 'front_enqueue_script'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_script'));

        if (is_admin()) {
            update_option('woocommerce_default_country', 'VN');
            add_action( 'woocommerce_init', array( $this, 'hello_myfriend' ) );

        }

        add_filter('woocommerce_locate_template', array($this, 'woocommerce_locate_template'), 10, 3);
    }

    public function front_enqueue_script() {
        wp_enqueue_style('fsw-front', FoW_URL . 'assets/css/front.css', false, $this->version);

        if (is_product() || is_cart() || is_checkout() || is_account_page()) {
            $product_shipping_calculator_auto = apply_filters( 'fsw_product_shipping_calculator_auto', true );

            $data_json = array(
                'ajax' => array(
                    'url' => admin_url('admin-ajax.php'),
                ),
                'home_url' => home_url(),
                'l10n' => array(
                    'address_is_not_valid'    => esc_html__('Shipping address is not valid', 'friendstore-for-woocommerce'),
                    'loading'                 => esc_html__('Loading ...', 'friendstore-for-woocommerce'),
                    'processing'              => esc_html__('Processing', 'friendstore-for-woocommerce'),
                    'select_ward'             => esc_html__('Select Commune/Ward', 'friendstore-for-woocommerce'),
                    'select_district'         => esc_html__('Select District', 'friendstore-for-woocommerce'),
                    'no_results'              => wcl10n__('No results found.'),
                    'try_again'               => wcl10n__('Please try again.'),
                ),
                'options' => array(
                    'product_shipping_calculator_auto' => $product_shipping_calculator_auto
                )
            );

            wp_enqueue_script( 'selectWoo' );
            wp_enqueue_style( 'select2' );
            wp_enqueue_script('fsw-front', FoW_URL . 'assets/js/front.js', array('jquery'), $this->version, true);
            wp_localize_script('fsw-front', 'fsw', $data_json);
        }
	    if (is_product()) {
		    wp_enqueue_script('fsw-product', FoW_URL . 'assets/js/product.js', array('jquery'), $this->version, true);
	    }
    }

    public function admin_enqueue_script() {
        $screen = get_current_screen();
        $screen_id = $screen ? $screen->id : '';

        // Assets of woocommerce
        if (is_woocommerce_activated()) {
            wp_enqueue_style('woocommerce_admin_styles', WC()->plugin_url() . '/assets/css/admin.css', array(), WC_VERSION);
        }

	    wp_enqueue_style('fsw-admin', FoW_URL . 'assets/css/admin.css', false, $this->version);

	    if (in_array($screen_id, array(
		    'woocommerce_page_wc-settings',
		    'shop_order',
		    'profile',
		    'user-edit',
		    'toplevel_page_friendstore'
	    ))) {
		    wp_enqueue_script('fsw-admin', FoW_URL . 'assets/js/admin.js', array('jquery'), $this->version, true);
		    wp_localize_script('fsw-admin', 'fsw_admin_params', array(
			    'ajax' => array(
				    'url' => admin_url('admin-ajax.php'),
			    ),
			    'l10n' => array(
				    'loading' => esc_html__('Loading ...', 'friendstore-for-woocommerce'),
				    'calculating_shipping' => esc_html__('Calculating Shipping ...', 'friendstore-for-woocommerce'),
				    'creating_order' => esc_html__('Creating Order ...', 'friendstore-for-woocommerce'),
				    'processing' => esc_html__('Processing', 'friendstore-for-woocommerce'),
				    'create_order' => esc_html__('Create Order', 'friendstore-for-woocommerce'),
				    'create_order_again' => esc_html__('Create Order Again', 'friendstore-for-woocommerce'),
				    'create_order_successful' => esc_html__('Create Order successful', 'friendstore-for-woocommerce'),
				    'select_ward' => esc_html__('Select Commune/Ward', 'friendstore-for-woocommerce'),
				    'select_district' => esc_html__('Select District', 'friendstore-for-woocommerce'),
				    'no_results' => wcl10n__('No results found.'),
			    )
		    ));
	    }
	    if (in_array($screen_id, array(
		    'profile',
		    'user-edit'
	    ))) {
		    wp_enqueue_script('fsw-profile', FoW_URL . 'assets/js/admin-profile.js', array('jquery'), $this->version, true);
	    }
    }

    public function hello_myfriend() {
        $items = '';
        $args_check = array(
            'language'      => array(
                'check' => array(get_option('WPLANG') => array('vi', 'vi-VN')),
                'label' => esc_html__('Language Vietnamese', 'friendstore-for-woocommerce'),
                'edit'  => admin_url('options-general.php#default_role'),
            ),
            'can_shipping'  => array(
                'check' => array(can_shipping_vietnam() => true),
                'label' => esc_html__('Allow shipping to Vietnam', 'friendstore-for-woocommerce'),
                'edit'  => admin_url('admin.php?page=wc-settings#woocommerce_store_address'),
            ),
            'store_address' => array(
                'check' => array('city' . get_option('woocommerce_store_city')         => 'city',
                                 'district' . get_option('woocommerce_store_district') => 'district',
                                 'ward' . get_option('woocommerce_store_ward')         => 'ward'),
                'label' => esc_html__('Update your store address', 'friendstore-for-woocommerce'),
                'edit'  => admin_url('admin.php?page=wc-settings#store_address-description'),
            ),
            'currency'      => array(
                'check' => array('currency' . get_woocommerce_currency()        => 'currencyVND',
                                 'thousand' . wc_get_price_thousand_separator() => 'thousand.',
                                 'decimal' . wc_get_price_decimal_separator()   => 'decimal,'),
                'label' => esc_html__('Number format and currency of Vietnamese', 'friendstore-for-woocommerce'),
                'help'  => 'https://vi.wordpress.org/plugins/friendstore-for-woocommerce/#%C4%91%E1%BB%8Bnh%20d%E1%BA%A1ng%20s%E1%BB%91%20v%C3%A0%20%C4%91%C6%A1n%20v%E1%BB%8B%20ti%E1%BB%81n%20t%E1%BB%87%20vi%E1%BB%87t%20nam%20l%C3%A0%20g%C3%AC%3F',
                'edit'  => admin_url('admin.php?page=wc-settings#pricing_options-description'),
            ),
        );
        foreach ($args_check as $id => $check) {
            $pass = true;

            switch ($id) {
                case 'store_address':
                    foreach ($check['check'] as $key => $value) {
                        if ($key == $value) {
                            $pass = false;
                            break;
                        }
                    }
                    break;
                default:
                    foreach ($check['check'] as $key => $value) {
                        if ((is_array($value) && !in_array($key, $value)) ||
                            (!is_array($value) && $key != $value)) {
                            $pass = false;
                            break;
                        }
                    }
            }

            if (!$pass) {
                $items .= '<li id="' . $id . '">';
                $items .= $check['label'] .'.';

                if(isset($check['edit']) && $check['edit'])
                    $items .= ' <a href="' . $check['edit'] . '"><span class="dashicons dashicons-edit"></span></a>';

                if(isset($check['help']) && $check['help'])
                    $items .= ' <a href="' . $check['help'] . '" target="_blank"><span class="dashicons dashicons-editor-help"></span></a>';

                $items .= '</li>';
            }
        }

        if ($items == '') return false;

        $message_html = '<p><strong>';
        $message_html .= sprintf('%s %s',
            '<code style="color: red;">' . esc_html__('FSW', 'friendstore-for-woocommerce') . '</code>',
            esc_html__('To Extension works, please config:', 'friendstore-for-woocommerce')
        );
        $message_html .= '</strong></p>';
        $message_html .= '<ol>' . $items . '</ol>';

        $notices = VF_Admin_Notices::get_instance();
        $notices->error(
            $message_html,
            'fsw_config',
            array('woocommerce_page_wc-settings', 'toplevel_page_friendstore', 'options-general'),
            true
        );
    }

    public function no_woocommerce_keep_enabled() {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php printf(__('%s is enabled but not effective. It requires %s in order to work.', 'friendstore-for-woocommerce'),
                            '<strong>'. esc_html__('FriendStore for WooCommerce', 'friendstore-for-woocommerce') .'</strong>',
                            '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank"><strong>WooCommerce</strong></a>'); ?></p>
        </div>
        <?php
    }

    public function no_woocommerce_deactivated() {
        ?>
        <div class="vf-notice notice notice-error is-dismissible">
            <p><?php printf(__('%s was auto deactivated. It requires %s in order to work properly.', 'friendstore-for-woocommerce'),
                    '<strong>'. esc_html__('FriendStore for WooCommerce', 'friendstore-for-woocommerce') .'</strong>',
                    '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank"><strong>WooCommerce</strong></a>'); ?></p>
        </div>
        <?php
    }

    public function auto_deactivate() {
        $vf_plugin = '';
        if (is_multisite()) {
            $plugins = get_site_option('active_sitewide_plugins', array());
            $fl_array = preg_grep("/friendstore-for-woocommerce.php$/", array_keys($plugins));
            $vf_plugin = reset($fl_array);
        } else {
            $plugins = apply_filters('active_plugins', get_option('active_plugins', array()));
            $fl_array = preg_grep("/friendstore-for-woocommerce.php$/", $plugins);
            if (count($fl_array) > 0) {
                $vf_plugin = $plugins[key($fl_array)];
            }
        }
        if (!empty($vf_plugin)) {
            deactivate_plugins($vf_plugin);

            // Hide the default "Plugin activated" notice
            if (isset($_GET['activate'])) {
                unset($_GET['activate']);
            }
        }
    }

    public function woocommerce_locate_template($template, $template_name, $template_path) {
        global $woocommerce;

        $_template = $template;

        if (!$template_path) $template_path = $woocommerce->template_url;

        $plugin_path = FoW_PATH . '/templates/woocommerce/';

        // Look within passed path within the theme - this is priority
        $template = locate_template(

            array(
                $template_path . $template_name,
                $template_name
            )
        );

        // Modification: Get the template from this plugin, if it exists
        if (!$template && file_exists($plugin_path . $template_name))
            $template = $plugin_path . $template_name;

        // Use default template
        if (!$template)
            $template = $_template;

        // Return what we found
        return $template;
    }
}