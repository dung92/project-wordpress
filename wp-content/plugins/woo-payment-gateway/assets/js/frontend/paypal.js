(function ($, wc_braintree) {

    /**
     * @constructor
     */
    function PayPal() {
        wc_braintree.PayPal.call(this);
    }

    /**
     *
     */
    PayPal.prototype = $.extend({}, wc_braintree.PayPal.prototype,
        wc_braintree.CheckoutGateway.prototype, {
            params: wc_braintree_paypal_params
        });

    /**
     *
     */
    PayPal.prototype.initialize = function () {
        wc_braintree.CheckoutGateway.call(this);
    }

    /**
     *
     */
    PayPal.prototype.create_instance = function () {
        return wc_braintree.PayPal.prototype.create_instance.apply(this, arguments).then(function () {
            if (this.banner_enabled && $(this.banner_container).length) {
                $('.wc-braintree-paypal-top-container').remove();
                $(this.banner_container).prepend('<div class="wc-braintree-paypal-top-container"></div>');
                var render_options = this.render_options();
                paypal.Buttons($.extend({}, this.render_options(paypal.FUNDING.PAYPAL), {
                    onClick: function () {
                        this.set_payment_method(this.gateway_id);
                        this.set_use_nonce_option(true);
                        this.processingBannerCheckout = true;
                        render_options.onClick.apply(this, arguments);
                    }.bind(this),
                    onCancel: function () {
                        this.processingBannerCheckout = false;
                    }.bind(this)
                })).render('.wc-braintree-paypal-top-container');
            }
            $('.wc_braintree_banner_gateways').addClass('paypal-active');
            $(document.body).on('wc_braintree_payment_method_selected', this.payment_gateway_changed.bind(this));
            $(document.body).on('wc_braintree_display_saved_methods', this.display_saved_methods.bind(this));
            $(document.body).on('wc_braintree_display_new_payment_method', this.display_new_payment_method_container.bind(this));
            setTimeout(this.create_button.bind(this), 5000);
            setInterval(wc_braintree.PayPal.prototype.create_button.bind(this), 5000);
        }.bind(this)).catch(function (error) {
            throw error;
        }.bind(this));
    }

    /**
     *
     */
    PayPal.prototype.create_button = function () {
        wc_braintree.PayPal.prototype.create_button.call(this).then(function () {
            this.payment_gateway_changed(null, this.get_selected_gateway());
            this.create_bnpl_msg('checkout', 'form.checkout .shop_table');
        }.bind(this))
    }

    /**
     *
     */
    PayPal.prototype.render_options = function () {
        var render_options = wc_braintree.PayPal.prototype.render_options.apply(this, arguments);
        var options = $.extend({}, render_options, {
            onClick: function () {
                this.processingBannerCheckout = false;
                render_options.onClick.apply(this, arguments);
            }.bind(this)
        });
        return options;
    }

    PayPal.prototype.handle_tokenize_response = function (response) {
        if (this.needs_shipping()) {
            // set nonce and other data just in case other plugins prevent updated_checkout from firing
            this.tokenize_response = response;
            this.set_nonce(response.nonce);
            this.set_device_data();
            this.payment_method_received = true;
            $(document.body).one('updated_checkout', function () {
                this.on_payment_method_received.call(this, response);
            }.bind(this));
            this.update_addresses(response.details);
            this.maybe_set_ship_to_different();
            this.fields.toFormFields({update_shipping_method: false});
            $(document.body).trigger('update_checkout', {update_shipping_method: false});
        } else {
            wc_braintree.PayPal.prototype.handle_tokenize_response.call(this, response);
        }
    }

    /**
     * Return allowed and disallowed payment methods for the PayPal button.
     */
    PayPal.prototype.get_funding = function () {
        var funding = [];
        if (this.params.card_icons === "1") {
            funding.push(paypal.FUNDING.CARD);
        }
        if (this.is_credit_enabled('checkout')) {
            funding.push(paypal.FUNDING.PAYLATER);
            funding.push(paypal.FUNDING.CREDIT);
        }
        return funding.concat(wc_braintree.PayPal.prototype.get_funding.apply(this, arguments));
    }

    PayPal.prototype.on_payment_method_received = function () {
        wc_braintree.CheckoutGateway.prototype.on_payment_method_received.apply(this, arguments);
        if (this.validate_checkout_fields()) {
            if (!this.needs_shipping()) {
                this.get_form().submit();
            } else {
                var address = this.get_address_object(this.get_shipping_prefix());
                if ($('[name^="shipping_method"]').length < 2 || JSON.stringify(this.shipping_address) == JSON.stringify(address)) {
                    this.get_form().submit();
                } else {
                    if (this.processingBannerCheckout) {
                        this.scroll_to_place_order();
                    }
                }
            }
        }
    }

    PayPal.prototype.scroll_to_place_order = function () {
        $('html, body').animate({
            scrollTop: $('#place_order').offset().top - 100
        }, 1000);
    }

    wc_braintree.register(PayPal);

}(jQuery, wc_braintree))