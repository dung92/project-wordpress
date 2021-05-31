<?php
/*
*
* Plugin Name: Shipping & checkout – Localized for Vietnam
* Plugin URI: https://bluecoral.vn/plugin/woocommerce-localized-for-Vietnam
* Description: Support Vietnam administrative structure (municipality/province, district/county,ward/commune), for international checkout (Paypal), also customize checkout page to suit business model.
* Author: Blue Coral
* Author URI: https://bluecoral.vn
* Contributors: bluecoral, diancom1202, nguyenrom
* Version: 1.0.1
* Text Domain: shipping-checkout-localized-for-vietnam
*
*/

if (!defined('ABSPATH')) exit; 

if (!class_exists('WLFVN_ShippingCheckout')) {
	class WLFVN_ShippingCheckout {
		
		const WC_CHECKOUT_FIELD_STATUS_DEFAULT = 0;
		const WC_CHECKOUT_FIELD_STATUS_REQUIRED = 1;
		const WC_CHECKOUT_FIELD_STATUS_OPTIONAL = 2;
		const WC_CHECKOUT_FIELD_STATUS_HIDDEN = 3;
		
		public $domain = 'shipping-checkout-localized-for-vietnam';
		
		/**
		* Class Construct
		*/
		public function __construct() {		
			$this->option_key = 'lwc_options';
			$this->currency = 'VND';
			
			add_action('admin_init', array($this, 'lwc_plugin_required'));
			add_action('plugins_loaded', array($this, 'lwc_load_plugin_textdomain'));
			add_action('init', array($this, 'localized'));
			
			// functions
			$this->options = $this->lwc_get_options();
			$this->helper_classes();	
			$this->settings_page();
		}
		
		function get_plugin_data($type = '') {
			$plugin_data = get_plugin_data(__FILE__);
			
			if (empty($type)) return $plugin_data;
			if (isset($plugin_data[$type])) return $plugin_data[$type];
			return '';
		}
		
		function helper_classes() {
			$files = glob(dirname(__FILE__).'/libraries/*.php');
			
			foreach ($files as $file) {		
				require_once $file;
			}
		}
		
		function array_insert(&$array, $position, $insert) {
			if (is_int($position)) {
				array_splice($array, $position, 0, $insert);
			} else {
				$pos = array_search($position, array_keys($array));
				$array = array_merge(
					array_slice($array, 0, $pos),
					$insert,
					array_slice($array, $pos)
				);
			}
		}
		
		
		/**
		* Require Woocommerce
		*/	
		function lwc_plugin_required() {
			if (is_admin() && current_user_can('activate_plugins') && !in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
				add_action('admin_notices', array($this, 'lwc_plugin_required_message'));
				
				deactivate_plugins(plugin_basename(__FILE__)); 
				
				if (isset($_GET['activate'])) unset($_GET['activate']);
			} else {
				if (!$this->is_dependency_ward()) {
					add_action('admin_notices', array($this, 'lwc_plugin_notice_message'));
				}
				
				add_filter('plugin_action_links_'.plugin_basename(__FILE__), array($this, 'lwc_render_plugin_action_links'), 10, 1);
				
				$this->submit_settings_data();
			}
		}
		
		function lwc_plugin_required_message() { 
			echo '<div class="notice notice-error" style="margin-top: 2em;margin-left: 0;"><p><span>'.sprintf(
				__('Sorry, but <strong>%s</strong> requires <a href="%s" style="color: #0073aa;text-decoration: none;">Woocommerce</a> to be installed and active.', $this->domain),
				$this->get_plugin_data('Name'),
				'https://wordpress.org/plugins/states-cities-and-places-for-woocommerce/'
			).'</span></p></div>';
		}
		
		function lwc_plugin_notice_message() { 
			if (@$this->options['enabled_vn_ward'] == 0) return;
			
			echo '<div class="notice notice-warning" style="margin-top: 2em;margin-left: 0;"><p><span>'.sprintf(
				__('Sorry, but <strong>%s</strong> recommends <a href="%s" style="color: #0073aa;text-decoration: none;">States, Cities, and Places for WooCommerce</a> to be installed and active.', $this->domain),
				$this->get_plugin_data('Name'),
				admin_url('plugin-install.php?s=chitezh&tab=search&type=author')
			).'</span></p></div>';
		}
		
		function lwc_render_plugin_action_links($links = array()) {
			array_unshift($links, '<a href="'.admin_url('admin.php?page='.$this->domain).'">'.__('Settings').'</a>');
			
			return $links;
		}
		
		function lwc_load_plugin_textdomain() {
			load_plugin_textdomain($this->domain, false, $this->domain.'/languages');
		}
		
		
		/**
		* Localized
		*/		
		function localized() {
			if (!function_exists('wc')) return;
			
			if ($this->is_symbol()) {
				add_filter('woocommerce_currency_symbol', array($this, 'wc_currency_symbol'), 10, 2);
			}
			
			if ($this->is_rates()) {
				add_filter('woocommerce_paypal_args', array($this, 'wc_paypal_args'), 10, 1);
				add_filter('woocommerce_paypal_supported_currencies', array($this, 'wc_paypal_supported_currencies'), 10, 1);
				add_action('woocommerce_api_wc_gateway_paypal', array($this, 'wc_api_wc_gateway_paypal'), 5);
			}
			
			if ($this->is_ward()) {
				add_filter('woocommerce_admin_billing_fields', array($this, 'wc_admin_fields'), 10, 1);
				add_filter('woocommerce_admin_shipping_fields', array($this, 'wc_admin_fields'), 10, 1);
				add_filter('woocommerce_my_account_my_address_formatted_address', array($this, 'wc_my_account_my_address_formatted_address'), 10, 3);
				add_filter('woocommerce_localisation_address_formats', array($this, 'wc_localisation_address_formats'), 10, 1);
				add_filter('woocommerce_formatted_address_replacements', array($this, 'wc_formatted_address_replacements'), 10, 2);
				add_filter('woocommerce_get_order_address', array($this, 'wc_get_order_address'), 10, 3);			
				add_filter('woocommerce_billing_fields', array($this, 'wc_billing_fields'), 10, 2);
				add_filter('woocommerce_shipping_fields', array($this, 'wc_shipping_fields'), 10, 2);
				add_filter('woocommerce_form_field', array($this, 'wc_form_field_ward'), 10, 4);
				add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts_ward'));				
			}
			
			add_filter('woocommerce_checkout_fields', array($this, 'wc_checkout_fields'), 10, 1);
			add_filter('woocommerce_default_address_fields', array($this, 'wc_default_address_fields'), 10, 1);
		}
		
		function get_wc_fields() {
			return array(
				'first_name' => __('First name', 'woocommerce'),
				'last_name' => __('Last name', 'woocommerce'),
				'company' => __('Company name', 'woocommerce'),
				'address_1' => __('Address', 'woocommerce'). ' 1',
				'address_2' => __('Address', 'woocommerce'). ' 2',
				'postcode' => __('Postcode / ZIP', 'woocommerce'),
				'country' => __('Country / Region', 'woocommerce'),
				'state' => __('State / County', 'woocommerce'),
				'city' => __('Town / City', 'woocommerce'),
				'ward' => __('Ward/commune', $this->domain),
				'email' => __('Email address', 'woocommerce'),
				'phone' => __('Phone', 'woocommerce'),
			);
		}
		
		function get_wc_ward_countries_support() {
			return array(
				'VN',
			);
		}
		
		public function get_wards($district = '') {
			if (!class_exists('WLFVN_Geo_Wards')) return array();
			
			$wards = WLFVN_Geo_Wards::wards();
			
			if ($district === 'all') return $wards;
			if (!empty($district) && isset($wards[$district])) return $wards[$district];			
			return array();
		}
		
		public function is_symbol() {
			return (@$this->options['enabled_symbol'] == 1 && !empty(@$this->options['symbol_text']));
		}
		
		public function is_rates() {
			return (@$this->options['enabled_rate'] == 1 && (float) @$this->options['rate_value'] > 0 
				&& class_exists('WC_Gateway_Paypal') && get_woocommerce_currency() === 'VND');
		}
		
		public function is_dependency_ward() {
			return class_exists('WC_States_Places');
		}
		
		public function is_ward() {
			return (@$this->options['enabled_vn_ward'] == 1 
				&& @$this->options['country_status'] != self::WC_CHECKOUT_FIELD_STATUS_HIDDEN 
				&& @$this->options['city_status'] != self::WC_CHECKOUT_FIELD_STATUS_HIDDEN 
				&& @$this->options['state_status'] != self::WC_CHECKOUT_FIELD_STATUS_HIDDEN 
				&& $this->is_dependency_ward());
		}
		
		function wc_currency_symbol($currency_symbol = '', $currency = '') {
			if ($currency === $this->currency) {
				return $this->options['symbol_text'];
			}
			
			return $currency_symbol;
		}
		
		function wc_paypal_args($args = array()) {
			if ($args['currency_code'] == $this->currency) {
				$i = 1;
				$args['currency_code'] = 'USD';
				
				while (isset($args['amount_' . $i])) {
					$args['amount_' . $i] = round($args['amount_' . $i] / $this->options['rate_value'], 2);
					++ $i;
				}
				
					
				if ($args['shipping_1'] > 0) {
					$args['shipping_1'] = round($args['shipping_1'] / $this->options['rate_value'], 2);
				}

				if ($args['discount_amount_cart'] > 0) {
					$args['discount_amount_cart'] = round($args['discount_amount_cart'] / $this->options['rate_value'], 2);
				}
				
				if ( $args['tax_cart'] > 0 ) {
					$args['tax_cart'] = round($args['tax_cart'] / $this->options['rate_value'], 2);
				}
			}
			
			return $args;
		}
		
		function wc_paypal_supported_currencies($currencies = array()) {
			if (!in_array($this->currency, $currencies)) $currencies[] = $this->currency;
			return $currencies;
		}
		
		function wc_api_wc_gateway_paypal() {
			remove_all_filters('woocommerce_api_wc_gateway_paypal', 10);
			remove_all_filters('valid-paypal-standard-ipn-request', 10);
			
			$paypal_options = get_option('woocommerce_paypal_settings');
			$testmode = 'yes' === $paypal_options['testmode'];
			$receiver_email = is_null($paypal_options['receiver_email']) ? $paypal_options['email'] : $paypal_options['receiver_email'];
			$handler = new WLFVN_Gateway_Paypal_IPN_Handler($testmode, $receiver_email);
			$handler->check_response();
		}
		
		function wc_default_address_fields($fields = array()) {
			if (isset($fields['state'])) $fields['state']['priority'] = 50;
			if (isset($fields['city'])) $fields['city']['priority'] = 60;
			if (isset($fields['address_1'])) $fields['address_1']['priority'] = 70;
			if (isset($fields['address_2'])) $fields['address_2']['priority'] = 80;
			if ($this->is_ward()) {
				$fields['ward'] = array(
					'priority' => 61,
					'label' => __('Ward/commune', $this->domain),
				);
			}
			
			foreach ($this->get_wc_fields() as $key => $field) {
				$opt_text = $key.'_text';
				
				if (!empty($this->options[$opt_text]) && isset($fields[$key])) {
					$fields[$key]['label'] = trim($this->options[$opt_text]);
				}
			}
			
			return $fields;
		}
		
		function wc_checkout_fields($fields = array()) {
			$groups = array('billing', 'shipping');
			
			foreach ($groups as $group) {
				// input label 
				$keys = array('phone', 'email');
				foreach ($keys as $key) {
					$opt_text = $key.'_text';
					
					if (!empty($this->options[$opt_text]) && isset($fields[$group][$group.'_'.$key])) {
						$fields[$group][$group.'_'.$key]['label'] = trim($this->options[$opt_text]);
					}					
				}
				
				// input status
				foreach ($this->get_wc_fields() as $key => $field) {
					$opt_status = $key.'_status';
					
					// input status
					switch ($this->options[$opt_status]) {
						case self::WC_CHECKOUT_FIELD_STATUS_HIDDEN:
							if (isset($fields[$group][$group.'_'.$key]))
								unset($fields[$group][$group.'_'.$key]);
							break;
							
						case self::WC_CHECKOUT_FIELD_STATUS_REQUIRED:
							if (isset($fields[$group][$group.'_'.$key]))
								$fields[$group][$group.'_'.$key]['required'] = true;
							break;
							
						case self::WC_CHECKOUT_FIELD_STATUS_OPTIONAL:
							if (isset($fields[$group][$group.'_'.$key]))
								$fields[$group][$group.'_'.$key]['required'] = false;
							break;
							
						default: 
							// WC_CHECKOUT_FIELD_STATUS_DEFAULT do nothing
					}
				}
			}
			
			return $fields;
		}
		
		function wc_form_field_ward($field = '', $key = '', $args = array(), $value = '') {
			if (strpos($key, '_ward') !== false) {
				$key_country = ($key === 'billing_ward') ? 'billing_country' : 'shipping_country';
				$key_city = ($key === 'billing_ward') ? 'billing_city' : 'shipping_city';
			} else {
				return $field;
			}
			
			$after = ((!empty( $args['clear']))) ? '<div class="clear"></div>' : '';
			
			// Required markup
            if ($args['required']) {
                $args['class'][] = 'validate-required';
                $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
            } else {
                $required = '';
            }

            // Custom attribute handling
            $custom_attributes = array();

            if (!empty($args['custom_attributes']) && is_array($args['custom_attributes'])) {
                foreach ($args['custom_attributes'] as $attribute => $attribute_value) {
                    $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr($attribute_value) . '"';
                }
            }

            // Validate classes
            if (!empty( $args['validate'])) {
                foreach($args['validate'] as $validate) {
                    $args['class'][] = 'validate-' . $validate;
                }
            }
			
			//get data
			$current_country = WC()->checkout->get_value($key_country);
			$current_city = WC()->checkout->get_value($key_city);
			$current_ward = WC()->checkout->get_value($key);
			$wrapper_style = 'style="' . (!in_array($current_country, $this->get_wc_ward_countries_support()) ? 'display: none;' : '') .'"';			

            // field p and label
            $field = '<p class="form-row ' . esc_attr(implode(' ', $args['class'])) .'" id="' . esc_attr($args['id']) . '_field" ' . $wrapper_style . '>';
            if ($args['label']) {
                $field .= '<label for="' . esc_attr($args['id']) . '" class="' . esc_attr(implode(' ', $args['label_class'])) .'">' . $args['label']. $required . '</label>';
            }
			 
			// get ward places
            $wards = $this->get_wards($current_city);
			
			if (is_array($wards)) {
				$field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="city_select ' . esc_attr(implode(' ', $args['input_class'])) .'" ' . implode(' ', $custom_attributes) . ' placeholder="' . esc_attr($args['placeholder']) . '">';
				
				$field .= '<option value="">'. __('Select an option&hellip;', 'woocommerce') .'</option>';
				
				if ($current_ward && array_key_exists($current_ward, $wards)) {
                    $dropdown_places = $wards[$current_ward];
                } else if (is_array($wards) && isset($wards[0])) {
                    $dropdown_places = $wards;
                    sort($dropdown_places);
                } else {
                    $dropdown_places = $wards;
                }
				
				foreach ($dropdown_places as $ward) {
                    if(!is_array($ward)) {
                        $field .= '<option value="' . esc_attr($ward) . '" '.selected($value, $ward, false) . '>' . $ward .'</option>';
                    }
                }
				
				$field .= '</select>';
			
            } else {
                $field .= '<input type="text" class="input-text ' . esc_attr(implode( ' ', $args['input_class'])) .'" value="' . esc_attr($value) . '"  placeholder="' . esc_attr($args['placeholder']) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" ' . implode(' ', $custom_attributes) . ' />';
            }

            // field description and close wrapper
            if ($args['description']) {
                $field .= '<span class="description">' . esc_attr($args['description']) . '</span>';
            }

            $field .= '</p>' . $after;
			
			return $field;
		}
		
		function wp_enqueue_scripts_ward() {
			if (is_cart() || is_checkout() || is_wc_endpoint_url('edit-address')) {
				wp_enqueue_script('lwc-ward', plugins_url($this->domain.'/assets/js/script.wards.js'), array('jquery', 'woocommerce', 'wc-city-select'), true);
				$wards = json_encode($this->get_wards('all'));
				wp_localize_script(
					'lwc-ward',
					'lwc_ward',
					array(
						'wards' => $wards,
						'countries' => $this->get_wc_ward_countries_support(),
						'i18n_select_ward_text' => esc_attr__('Select an option&hellip;', 'woocommerce'),
					)
				);
			}
		}
		
        public function wc_billing_fields($fields = array(), $country ) {
            $fields['billing_ward']['type'] = 'ward';

            return $fields;
        }
		
        public function wc_shipping_fields($fields = array(), $country ) {
            $fields['shipping_ward']['type'] = 'ward';

            return $fields;
        }
		
		function wc_get_order_address($address = array(), $type = 'billing', $order) {
			$ward = get_post_meta($order->id, '_'.$type.'_ward', true);
			$this->array_insert(
				$address, 
				'city', 
				array(
					'ward' => $ward,
				)
			);
			
			return $address;
		}
		
		function wc_formatted_address_replacements($address = array(), $args = array()) {			
			$this->array_insert(
				$address, 
				'{city}', 
				array(
					'{ward}' => $args['ward'],
				)
			);
			
			return $address;
		}
		
		function wc_my_account_my_address_formatted_address($address = array(), $user_id = 0, $type = 'billing') {
			$ward = get_user_meta($user_id, $type.'_ward', true);
			$this->array_insert(
				$address, 
				'city', 
				array(
					'ward' => $ward,
				)
			);
			
			return $address;
		}
		
		function wc_admin_fields($fields = array()) {
			if (isset($fields['city'])) $fields['city']['class'] = 'js_field-city select short';
			$this->array_insert(
				$fields, 
				'city', 
				array(
					'ward' => array(
						'label' => __('Ward/commune', $this->domain),
						'class' => 'js_field-ward select short',
						'show'  => false,
					),
				)
			);
			
			return $fields;
		}
		
		public function wc_localisation_address_formats($args) {
			return array(
				'default' => "{name}\n{company}\n{address_1}\n{address_2}\n{city}\n{state}\n{postcode}\n{country}",
				'AU'      => "{name}\n{company}\n{address_1}\n{address_2}\n{city} {state} {postcode}\n{country}",
				'AT'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'BE'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'CA'      => "{company}\n{name}\n{address_1}\n{address_2}\n{city} {state_code} {postcode}\n{country}",
				'CH'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'CL'      => "{company}\n{name}\n{address_1}\n{address_2}\n{state}\n{postcode} {city}\n{country}",
				'CN'      => "{country} {postcode}\n{state}, {city}, {address_2}, {address_1}\n{company}\n{name}",
				'CZ'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'DE'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'EE'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'FI'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'DK'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'FR'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city_upper}\n{country}",
				'HK'      => "{company}\n{first_name} {last_name_upper}\n{address_1}\n{address_2}\n{city_upper}\n{state_upper}\n{country}",
				'HU'      => "{last_name} {first_name}\n{company}\n{city}\n{address_1}\n{address_2}\n{postcode}\n{country}",
				'IN'      => "{company}\n{name}\n{address_1}\n{address_2}\n{city} {postcode}\n{state}, {country}",
				'IS'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'IT'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode}\n{city}\n{state_upper}\n{country}",
				'JM'      => "{name}\n{company}\n{address_1}\n{address_2}\n{city}\n{state}\n{postcode_upper}\n{country}",
				'JP'      => "{postcode}\n{state} {city} {address_1}\n{address_2}\n{company}\n{last_name} {first_name}\n{country}",
				'TW'      => "{company}\n{last_name} {first_name}\n{address_1}\n{address_2}\n{state}, {city} {postcode}\n{country}",
				'LI'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'NL'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'NZ'      => "{name}\n{company}\n{address_1}\n{address_2}\n{city} {postcode}\n{country}",
				'NO'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'PL'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'PR'      => "{company}\n{name}\n{address_1} {address_2}\n{city} \n{country} {postcode}",
				'PT'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'SK'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'RS'      => "{name}\n{company}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'SI'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'ES'      => "{name}\n{company}\n{address_1}\n{address_2}\n{postcode} {city}\n{state}\n{country}",
				'SE'      => "{company}\n{name}\n{address_1}\n{address_2}\n{postcode} {city}\n{country}",
				'TR'      => "{name}\n{company}\n{address_1}\n{address_2}\n{postcode} {city} {state}\n{country}",
				'UG'      => "{name}\n{company}\n{address_1}\n{address_2}\n{city}\n{state}, {country}",
				'US'      => "{name}\n{company}\n{address_1}\n{address_2}\n{city}, {state_code} {postcode}\n{country}",
				'VN'      => "{name}\n{company}\n{address_1}\n{ward}\n{city}\n{state}\n{country}",
			);
		}
		
		
		/**
		* Setting data
		*/		
		function lwc_get_options() {
			return wp_parse_args(
				get_option($this->option_key, array()),
				$this->lwc_get_default_options()
			);
		}
		
		function lwc_get_default_options() {
			return array(
				'enabled_symbol' => 0,
				'symbol_text' => 'vnđ',
				'enabled_rate' => 0,
				'rate_value' => 23500,
				'enabled_vn_ward' => 1,
				'first_name_status' => 0,
				'last_name_status' => 0,
				'company_status' => 0,
				'address_1_status' => 0,
				'address_2_status' => 1,
				'postcode_status' => 0,
				'country_status' => 0,
				'city_status' => 0,
				'state_status' => 0,
			);
		}
		
		function lwc_update_options($values) {
			return update_option($this->option_key, $values);
		}
		
		
		/**
		* Setting page
		*/
		function settings_page() {
			add_action('admin_menu', array($this, 'register_settings_pages'), 10);			
		}
		
		function settings_page_menu() {
			return array(
				$this->domain => __('General Settings', $this->domain),
			);
		}	
		
		function register_settings_pages() {			
			add_submenu_page('woocommerce', $this->get_plugin_data('Name').' settings', __('Localized for Vietnam', $this->domain), 'manage_options', $this->domain, array($this, 'render_settings_page'), 100);
		}
		
		function render_settings_page() {			
			$this->render_settings_page_header();
			$this->render_view('options');		
			$this->render_settings_page_footer();			
		}
		
		function render_view($file_name = '', $once = true) {
			$file = trailingslashit(plugin_dir_path( __FILE__ )).'views/'.$file_name.'.php';
			
			if (file_exists($file)) {
				if ($once) require_once($file);
				else require($file);
			}
		}
		
		function render_settings_page_header() {
			global $lwc_options;
			$lwc_options = $this->options;
			
			// css
			wp_enqueue_style('bootstrap', plugins_url($this->domain.'/assets/css/bootstrap.min.css'), array(), null, 'all');
			wp_enqueue_style('admin-lwc', plugins_url($this->domain.'/assets/css/admin.css'), array(), null, 'all');	
			
			// js
			wp_enqueue_script('bootstrap', plugins_url($this->domain.'/assets/js/bootstrap.bundle.min.js'), array('jquery'), true);
			wp_enqueue_script('admin-lwc', plugins_url($this->domain.'/assets/js/admin.js'), array('jquery'), true);
		}
		
		function render_settings_page_footer() {			
		}
		
		function submit_settings_data() {	
			global $lwc_options;
			
			if (!is_admin()) return;			
			
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if (isset($_POST['submit_lwc'])) {
					$post_data = array();				
					$this->options = apply_filters(
						'lwc_post_data', 
						$this->retrieve_submit_settings_data($post_data), 
						$this->options
					);
					$this->lwc_update_options($this->options);
					$cbb_options = $this->options;
					
					wp_redirect(admin_url('admin.php?page='.$this->domain));
					exit;
				}
			}					
		}
		
		function retrieve_submit_settings_data(array &$post_data = array()) {
			if (empty($_POST)) return $post_data;
			
			unset($_POST['submit_lwc']);
			
			foreach ($_POST as $key => $value) {
				if (is_int($value)) $post_data[$key] = (int) $value;
				if (is_array($value)) $post_data[$key] = $this->sanitize_array((array) $value);
				if (strpos($key, '_textarea') !== false) $post_data[$key] = sanitize_textarea_field($value);
				else $post_data[$key] = sanitize_text_field($value);
			}
			
			return $post_data;			
		}

		function sanitize_array($args = array()) {
			foreach ($args as $key => $value) {
				if (is_array($value)) {
					$value = $this->sanitize_array($value);
				} else {
					$value = sanitize_text_field($value);
				}
			}

			return $args;
		}
		
	}
	
	new WLFVN_ShippingCheckout();
}
