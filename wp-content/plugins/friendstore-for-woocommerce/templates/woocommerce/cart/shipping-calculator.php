<?php
/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/shipping-calculator.php.
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

$city_id = WC()->customer->get_shipping_state();
$district_id = WC()->customer->get_shipping_city();
$ward_id = WC()->customer->get_shipping_address_2();

$cities = FoW_Ultility::get_cities_array();
$districts = FoW_Ultility::get_districts_array_by_city_id($city_id);
$wards = FoW_Ultility::get_wards_array_by_district_id($district_id);

do_action('woocommerce_before_shipping_calculator'); ?>

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

    <?php printf('<a href="#" class="shipping-calculator-button">%s</a>', esc_html(!empty($button_text) ? $button_text : wcl10n__('Calculate shipping', 'woocommerce'))); ?>

    <section class="shipping-calculator-form" style="display:none;">

        <p class="form-row form-row-wide" id="calc_shipping_country_field" style="display: none;">
            <select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select"
                    rel="calc_shipping_state">
                <option value=""><?php wcl10n_e('Select a country&hellip;', 'woocommerce', 'html'); ?></option>
                <?php
                foreach (WC()->countries->get_shipping_countries() as $key => $value) {
                    echo '<option value="' . esc_attr($key) . '"' . selected(WC()->customer->get_shipping_country(), esc_attr($key), false) . '>' . esc_html($value) . '</option>';
                }
                ?>
            </select>
        </p>

        <p class="form-row form-row-wide " id="calc_shipping_state_field">
            <select name="calc_shipping_state" class="select wc-enhanced-select __fsw_city" id="calc_shipping_state"
                    data-placeholder="<?php esc_attr_e('Province/City', 'friendstore-for-woocommerce'); ?>"
                    style="width:100%">
                <option value=""><?php wcl10n_e('Select an option&hellip;', 'woocommerce', 'html'); ?></option>
                <?php
                foreach ($cities as $ckey => $cvalue) {
                    echo '<option value="' . esc_attr($ckey) . '" ' . selected($city_id, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
                }
                ?>
            </select>
        </p>

        <p class="form-row form-row-wide " id="calc_shipping_city_field">
            <select name="calc_shipping_city" class="select wc-enhanced-select __fsw_district"
                    id="calc_shipping_district"
                    data-placeholder="<?php esc_attr_e('District', 'friendstore-for-woocommerce'); ?>" style="width:100%">
                <option value=""><?php wcl10n_e('Select an option&hellip;', 'woocommerce', 'html'); ?></option>
                <?php
                foreach ($districts as $ckey => $cvalue) {
                    echo '<option value="' . esc_attr($ckey) . '" ' . selected($district_id, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
                }
                ?>
            </select>
        </p>

        <p class="form-row form-row-wide " id="calc_shipping_address_2_field">
            <select name="calc_shipping_address_2" class="select wc-enhanced-select __fsw_ward"
                    id="calc_shipping_address_2"
                    data-placeholder="<?php esc_attr_e('Commune/Ward', 'friendstore-for-woocommerce'); ?>"
                    style="width:100%">
                <option value=""><?php wcl10n_e('Select an option&hellip;', 'woocommerce', 'html'); ?></option>
                <?php
                foreach ($wards as $ckey => $cvalue) {
                    echo '<option value="' . esc_attr($ckey) . '" ' . selected($ward_id, $ckey, false) . '>' . esc_html($cvalue) . '</option>';
                }
                ?>
            </select>
        </p>

        <p>
            <button type="submit" name="calc_shipping" value="1"
                    class="button"><?php wcl10n_e('Update', 'woocommerce', 'html'); ?></button>
        </p>
        <?php wp_nonce_field('woocommerce-shipping-calculator', 'woocommerce-shipping-calculator-nonce'); ?>
    </section>
</form>

<?php do_action('woocommerce_after_shipping_calculator'); ?>
