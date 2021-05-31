<?php
/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/friendstore/shipping-calculator/shipping-calculator.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package FriendStore for WooCommerce
 */

defined('ABSPATH') || exit;

$city_id = $shipping_address['state'];
$district_id = $shipping_address['city'];
$ward_id = $shipping_address['address_2'];

$cities = FoW_Ultility::get_cities_array();
$districts = FoW_Ultility::get_districts_array_by_city_id($city_id);
$wards = FoW_Ultility::get_wards_array_by_district_id($district_id);

do_action('fsw_product_before_shipping_calculator'); ?>

    <div class="fsw_product_shipping_calculator"> <?php // Shipping rates ?>
        <h4 class="title"><?php esc_html_e('Expected Delivery Information', 'friendstore-for-woocommerce'); ?></h4>
        <div class="picker">
            <p class="fsw-shipping-destination">
				<?php
				if ($available_methods && $formatted_destination) :
					printf(wcl10n__('Shipping to %s.', 'woocommerce', 'html') . ' ',
						'<strong>' . esc_html($formatted_destination) . '</strong>');
					$button_text = wcl10n__('Change address', 'woocommerce', 'html');
                elseif (!$has_calculated_shipping || !$formatted_destination) :
					echo wp_kses_post(apply_filters('woocommerce_shipping_may_be_available_html',
						wcl10n__('Enter your address to view shipping options.', 'woocommerce', 'html')));
                elseif (!is_product()) :
					echo wp_kses_post(apply_filters('woocommerce_no_shipping_available_html',
						wcl10n__('There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.',
							'woocommerce', 'html')));
				else :
					echo wp_kses_post(apply_filters('woocommerce_cart_no_shipping_available_html',
						sprintf(wcl10n__('No shipping options were found for %s.', 'woocommerce', 'html') . ' ',
							'<strong>' . esc_html($formatted_destination) . '</strong>')));
					$button_text = wcl10n__('Enter a different address', 'woocommerce', 'html');
				endif;
				printf(' - <a href="#" class="fsw-shipping-calculator-button">%s</a>',
					esc_html(!empty($button_text) ? $button_text : wcl10n__('Calculate shipping', 'woocommerce')));
				?>
            </p>

            <form class="fsw-shipping-calculator" method="post" style="display:none;">
                <section class="fsw-shipping-calculator-form">
                    <p class="form-row form-row-wide" id="calc_shipping_country_field" style="display: none;">
                        <select name="calc_shipping_country" id="calc_shipping_country"
                                class="country_to_state country_select"
                                rel="calc_shipping_state">
                            <option value=""><?php wcl10n_e('Select a country&hellip;', 'woocommerce',
									'html'); ?></option>
							<?php
							foreach (WC()->countries->get_shipping_countries() as $key => $value) {
								echo '<option value="' . esc_attr($key) . '"' . selected(WC()->customer->get_shipping_country(),
										esc_attr($key), false) . '>' . esc_html($value) . '</option>';
							}
							?>
                        </select>
                    </p>

                    <p class="form-row form-row-wide " id="calc_shipping_state_field">
                        <select name="calc_shipping_state" class="select wc-enhanced-select __fsw_city"
                                id="calc_shipping_state"
                                data-placeholder="<?php esc_attr_e('Province/City', 'friendstore-for-woocommerce'); ?>"
                                style="width:100%">
                            <option value=""><?php wcl10n_e('Select an option&hellip;', 'woocommerce',
									'html'); ?></option>
							<?php
							foreach ($cities as $ckey => $cvalue) {
								echo '<option value="' . esc_attr($ckey) . '" ' . selected($city_id, $ckey,
										false) . '>' . esc_html($cvalue) . '</option>';
							}
							?>
                        </select>
                    </p>

                    <p class="form-row form-row-wide " id="calc_shipping_city_field">
                        <select name="calc_shipping_city" class="select wc-enhanced-select __fsw_district"
                                id="calc_shipping_district"
                                data-placeholder="<?php esc_attr_e('District', 'friendstore-for-woocommerce'); ?>"
                                style="width:100%">
                            <option value=""><?php wcl10n_e('Select an option&hellip;', 'woocommerce',
									'html'); ?></option>
							<?php
							foreach ($districts as $ckey => $cvalue) {
								echo '<option value="' . esc_attr($ckey) . '" ' . selected($district_id, $ckey,
										false) . '>' . esc_html($cvalue) . '</option>';
							}
							?>
                        </select>
                    </p>

                    <p class="form-row form-row-wide " id="calc_shipping_address_2_field">
                        <select name="calc_shipping_address_2" class="select wc-enhanced-select __fsw_ward"
                                id="calc_shipping_address_2"
                                data-placeholder="<?php esc_attr_e('Commune/Ward', 'friendstore-for-woocommerce'); ?>"
                                style="width:100%">
                            <option value=""><?php wcl10n_e('Select an option&hellip;', 'woocommerce',
									'html'); ?></option>
							<?php
							foreach ($wards as $ckey => $cvalue) {
								echo '<option value="' . esc_attr($ckey) . '" ' . selected($ward_id, $ckey,
										false) . '>' . esc_html($cvalue) . '</option>';
							}
							?>
                        </select>
                    </p>

                    <p>
						<?php if ($product_id) { ?>
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
						<?php } ?>
						<?php if ($product_type) { ?>
                            <input type="hidden" name="product_type" value="<?php echo $product_type; ?>">
						<?php } ?>
                        <button type="submit" name="calc_shipping" value="1"
                                class="button"><?php esc_html_e('Get rates', 'friendstore-for-woocommerce'); ?></button>
                    </p>
					<?php wp_nonce_field('woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce'); ?>
                </section>
            </form>
        </div>
		<?php if ($available_methods) : ?>
            <div class="options">
                <ul id="shipping_method" class="woocommerce-shipping-methods">
					<?php foreach ($available_methods as $id => $method) : ?>
                        <li>
                            <label for="shipping_method_<?php echo $method->method_id; ?>">
								<?php echo $method->label; ?>: <?php echo wc_price($method->cost); ?>
                            </label>
                        </li>
					<?php endforeach; ?>
                </ul>
            </div>
		<?php endif; ?>
    </div>

<?php do_action('fsw_product_after_shipping_calculator'); ?>