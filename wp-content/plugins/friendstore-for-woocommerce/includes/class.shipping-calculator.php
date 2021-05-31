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

if (!class_exists('FoW_Shipping_Calculator')) {

	class FoW_ShippingCalculator {
		public static $calculator_metakey = "__calculator_hide";
		public static $needs_shipping = true;

		public function __construct() {
            if ( !function_exists( 'wc_shipping_enabled' ) ) return;

            // Disable shipping + No shipping Method
            if ( ! wc_shipping_enabled() || 0 === wc_get_shipping_method_count( true ) ) {
                self::$needs_shipping = false;
            }

            add_action( 'init', array( $this, 'calculator_admin_quick_edit' ) );
            add_action( 'init', array( $this, 'calculator_admin_bulk_edit' ) );
            add_action( 'init', array( $this, 'calculator_front_single_product' ) );
            add_action( 'init', array( $this, 'calculator_front_shortcode' ) );
		}

        public function is_enabled(){
            return apply_filters( 'fsw_product_shipping_calculator_enabled', true );
        }

        public function calculator_admin_quick_edit(){
            if ( ! self::is_enabled() ) return;

            add_action('woocommerce_product_quick_edit_end', array(
                $this,
                'output_quick_shipping_fields'
            ));
            add_action('manage_product_posts_custom_column', array(
                $this,
                'output_quick_shipping_values'
            ));
            add_action('woocommerce_product_quick_edit_save', array(
                $this,
                'save_quick_shipping_fields'
            ));
        }

        public function calculator_admin_bulk_edit(){
            if ( ! self::is_enabled() ) return;

            add_action('woocommerce_product_bulk_edit_end', array(
                $this,
                'output_bulk_shipping_fields'
            ));
            add_action('woocommerce_product_bulk_edit_save', array(
                $this,
                'save_bulk_shipping_fields'
            ));
        }

        public function calculator_admin_edit_product(){
            if ( ! self::is_enabled() ) return;

            add_action('woocommerce_product_options_shipping', array(
                $this,
                'add_custom_price_box'
            ));
            add_action('woocommerce_process_product_meta', array(
                $this,
                'custom_woocommerce_process_product_meta'
            ), 2);
        }

        public function calculator_front_single_product(){

            if ( ! self::is_enabled() ) return;
            add_action('woocommerce_single_product_summary', array(
                $this,
                'display_shipping_calculator'
            ), 38 );
        }

        public function calculator_front_shortcode(){
            if ( ! self::is_enabled() ) return;

            add_shortcode("fsw-shipping-calculator", array(
                $this,
                "shortcode_shipping_calculator"
            ));
        }

		/**
		 * Update Meta in quick product edit
		 */
		public function output_quick_shipping_fields() {
			fsw_get_template('shipping-calculator/quick-settings.php', array(
				'calculator_metakey' => self::$calculator_metakey
			));
		}

		public function output_quick_shipping_values($column) {
			global $post;

			$product_id = $post->ID;
			if ($column == 'name') {
				$estMeta = get_post_meta($product_id, self::$calculator_metakey, true);
				?>
                <div class="hidden" id="fsw_shipping_inline_<?php echo $product_id; ?>">
                    <div class="_shipping_enable"><?php echo $estMeta; ?></div>
                </div>
				<?php
			}
		}

		public function save_quick_shipping_fields($product) {
			$product_id = $product->get_id();
			if ($product_id > 0) {
				$metavalue = isset($_REQUEST[self::$calculator_metakey]) ? "yes" : "no";
				update_post_meta($product_id, self::$calculator_metakey, $metavalue);
			}
		}

		/**
		 * Update Meta in bulk product edit
		 */
		public function output_bulk_shipping_fields() {
			fsw_get_template('shipping-calculator/bulk-settings.php', array(
				'calculator_metakey' => self::$calculator_metakey
			));
		}

		public function save_bulk_shipping_fields($product) {
			$product_id = $product->get_id();
			if ($product_id > 0) {
				$metavalue = isset($_REQUEST[self::$calculator_metakey]) ? "yes" : "no";
				update_post_meta($product_id, self::$calculator_metakey, $metavalue);
			}
		}

		/**
		 * Update Meta in product edit
		 */
		public function custom_woocommerce_process_product_meta($post_id) {
			$metavalue = isset($_POST[self::$calculator_metakey]) ? "yes" : "no";
			update_post_meta($post_id, self::$calculator_metakey, $metavalue);
		}

		public function add_custom_price_box() {
			$hide_calculator = "yes";
			if (isset($_GET["post"])) $hide_calculator = get_post_meta($_GET["post"], self::$calculator_metakey, true);
			woocommerce_wp_checkbox(array(
				'id' => self::$calculator_metakey,
				'value' => $hide_calculator,
				'label' => __('Hide Shipping Calculator', 'friendstore-for-woocommerce')
			));
		}

        /**
         * Add to single product
         */
        public function display_shipping_calculator() {
            global $product;

            if (!self::$needs_shipping || !$product->needs_shipping())
                return;

            if (get_post_meta($product->get_id(), self::$calculator_metakey, true) != "yes") {
                echo '<div class="__fsw_product_shipping_calculator">';
                fsw_product_shipping_html(array(
                                              'product_id' => $product->get_id(),
                                              'product_type' => $product->get_type(),
                                              'has_calculated_shipping' => false,
                                          ));
                echo '</div>';
            }
        }

        /**
         * Create Shortcode
         */
        public function shortcode_shipping_calculator() {
			global $product;
			$content = '';
			if (!self::$needs_shipping || !$product) return $content;

			if (get_post_meta($product->get_id(), self::$calculator_metakey, true) != "yes") {
				ob_start();
				$content = '<div class="__fsw_product_shipping_calculator">';
				fsw_product_shipping_html(array(
					'product_id' => $product->get_id(),
					'product_type' => $product->get_type(),
					'has_calculated_shipping' => false,
				));
				$content .= ob_get_contents();
				$content .= '</div>';
				ob_end_clean();
			}
			return $content;
		}
	}
}