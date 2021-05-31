

<?php
if ( count( $addresses ) ) :
    ?>
    <p id="fsw_<?php echo $fieldset;?>_addresses_field" class="form-row form-row-wide fsw-addresses-field">
        <label><?php esc_html_e( 'Stored Addresses', 'friendstore-for-woocommerce' ); ?></label>
        <select id="fsw_<?php echo $fieldset;?>_addresses" class="__fsw_addresses" data-fieldset="<?php echo $fieldset;?>">
            <option value=""><?php esc_html_e( 'Select an address to use&hellip;', 'friendstore-for-woocommerce' ); ?></option>
            <?php
            foreach ( $addresses as $key => $address ) {
                $formatted_address = WC()->countries->get_formatted_address(array(
                                                                                'first_name' => isset($address['shipping_first_name']) ? $address['shipping_first_name'] : '',
                                                                                'last_name'  => isset($address['shipping_last_name']) ? $address['shipping_last_name'] : '',
                                                                                'company'    => isset($address['shipping_company']) ? $address['shipping_company'] : '',
                                                                                'address_1'  => isset($address['shipping_address_1']) ? $address['shipping_address_1'] : '',
                                                                                'address_2'  => isset($address['shipping_address_2']) ? $address['shipping_address_2'] : '',
                                                                                'city'       => isset($address['shipping_city']) ? $address['shipping_city'] : '',
                                                                                'state'      => isset($address['shipping_state']) ? $address['shipping_state'] : '',
                                                                                'postcode'   => isset($address['shipping_postcode']) ? $address['shipping_postcode'] : '',
                                                                                'country'    => isset($address['shipping_country']) ? $address['shipping_country'] : '',
                                                                            ), ', ');

                echo '<option value="' . esc_attr( $key ) . '"';
                foreach ( $address as $k => $value ) {
                    if($fieldset == 'billing') $k = str_replace('shipping', 'billing', $k);
                    echo ' data-' . esc_attr( $k ) . '="' . esc_attr( $value ) . '"';
                }
                echo '>' . esc_html( $formatted_address ) . '</option>';
            }
            ?>
        </select>
    </p>

    <?php
endif;
?>