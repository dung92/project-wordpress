jQuery(document).ready(function ($) {
    var xhr_fsw = null;

    // Load select2 address
    try {
        jQuery(".__fsw_city, .__fsw_district, .__fsw_ward").attr('data-value', function(e){ return $(this).val()}).select2();
    } catch (e) {
        console.log('Select2 library not loading');
    }

    // Update District when selected Province/City
    if (jQuery('.__fsw_city').length > 0) {
        jQuery(document).on('change', '.__fsw_city', function () {
            if(jQuery(this).val() && parseInt(jQuery(this).data('value')) !== parseInt(jQuery(this).val())) {
                var new_value = jQuery(this).val();

                // Order Details
                var parent = jQuery(this).closest('.edit_address');

                // Your Profile
                if (parent.length === 0) {
                    parent = jQuery(this).closest('.form-table');
                }

                // Your Profile - AddressBook
                if (parent.length === 0) {
                    parent = jQuery(this).closest('.fsw-address-form');
                }

                if (xhr_fsw && xhr_fsw.readyState != 4) {
                    xhr_fsw.abort();
                }
                xhr_fsw = jQuery.ajax({
                    type: 'POST',
                    url: '?fsw-ajax=update_district',
                    data: {
                        city_id: new_value,
                    },
                    beforeSend: function () {
                        parent.find('.__fsw_district').addClass('loading').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                        parent.find('.__fsw_ward').html('<option>' + fsw_admin_params.l10n.loading + '</option>').attr('disabled', 'disabled');
                    }
                }).done(function (result) {
                    parent.find('.__fsw_district').html(result).select2('close').removeClass('loading').attr('data-value', '');
                });
                jQuery(this).attr('data-value', new_value);
            }
        });
    }

    // Update Commune/Ward when selected District
    if (jQuery('.__fsw_district').length > 0) {
        jQuery(document).on('change', '.__fsw_district', function () {
            if(jQuery(this).val() && parseInt(jQuery(this).data('value')) !== parseInt(jQuery(this).val())) {
                if (jQuery(this).hasClass('loading')) return false;

                var new_value = jQuery(this).val();

                // Order Details
                var parent = jQuery(this).closest('.edit_address');

                // Your Profile
                if (parent.length === 0) {
                    parent = jQuery(this).closest('.form-table');
                }

                // Your Profile - AddressBook
                if (parent.length === 0) {
                    parent = jQuery(this).closest('.fsw-address-form');
                }

                if (xhr_fsw && xhr_fsw.readyState != 4) {
                    xhr_fsw.abort();
                }
                xhr_fsw = jQuery.ajax({
                    type: 'POST',
                    url: '?fsw-ajax=update_ward',
                    data: {
                        district_id: new_value
                    },
                    beforeSend: function () {
                        parent.find('.__fsw_ward').addClass('loading').removeAttr('disabled').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                    }
                }).done(function (result) {
                    parent.find('.__fsw_ward').html(result).select2('close').removeClass('loading').attr('data-value', '');
                });
                jQuery(this).attr('data-value', new_value);
            }
        });
    }

    // Update data-value when selected ward
    if (jQuery('.__fsw_ward').length > 0) {
        jQuery(document).on('change', '.__fsw_ward', function () {
            if(jQuery(this).val() && parseInt(jQuery(this).data('value')) !== parseInt(jQuery(this).val())) {
                jQuery(this).attr('data-value', jQuery(this).val());
            }
        });
    }

    // Copy address billing to shipping in Your Profile
    jQuery(document).on('click', '.js_copy-billing', function () {
        var billing_state = jQuery('[name="billing_state"]');
        var billing_city = jQuery('[name="billing_city"]');
        var billing_address_2 = jQuery('[name="billing_address_2"');

        // Remove all XHR before
        if (xhr_fsw) xhr_fsw.abort();

        if(jQuery('[name="shipping_city"] option[value="'+ billing_city.val() +'"]').length > 0) {
            jQuery('[name="shipping_city"]').val(billing_city.val());
        } else {
            jQuery.ajax({
                type: 'POST',
                url: '?fsw-ajax=update_district',
                data: {
                    city_id: billing_state.val()
                },
                beforeSend: function () {
                    jQuery('[name="shipping_city"]').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                }
            }).done(function (result) {
                jQuery('[name="shipping_city"]').html(result).val(billing_city.val());
                jQuery('[name="shipping_city"]').attr('data-value', billing_city.val());
            });
        }

        if(jQuery('[name="shipping_address_2"] option[value="'+ billing_address_2.val() +'"]').length > 0) {
            jQuery('[name="shipping_address_2"]').val(billing_address_2.val());
        } else {
            jQuery.ajax({
                type: 'POST',
                url: '?fsw-ajax=update_ward',
                data: {
                    district_id: billing_city.val()
                },
                beforeSend: function () {
                    jQuery('[name="shipping_address_2"]').removeAttr('disabled').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                }
            }).done(function (result) {
                jQuery('[name="shipping_address_2"]').html(result).val(billing_address_2.val());
                jQuery('[name="shipping_address_2"]').attr('data-value', billing_address_2.val());
            });
        }
    });

    // Copy address billing to shipping in Order details
    jQuery("a.billing-same-as-shipping").on("click", function () {
        var billing_state = jQuery('[name="_billing_state"]');
        var billing_city = jQuery('[name="_billing_city"]');
        var billing_address_2 = jQuery('[name="_billing_address_2"');

        // Remove all XHR before
        if (xhr_fsw) xhr_fsw.abort();

        if(jQuery('[name="_shipping_city"] option[value="'+ billing_city.val() +'"]').length > 0) {
            jQuery('[name="_shipping_city"]').val(billing_city.val());
        } else {
            jQuery.ajax({
                type: 'POST',
                url: '?fsw-ajax=update_district',
                data: {
                    city_id: billing_state.val()
                },
                beforeSend: function () {
                    jQuery('[name="_shipping_city"]').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                }
            }).done(function (result) {
                jQuery('[name="_shipping_city"]').html(result).val(billing_city.val());
            });
        }

        if(jQuery('[name="_shipping_address_2"] option[value="'+ billing_address_2.val() +'"]').length > 0) {
            jQuery('[name="_shipping_address_2"]').val(billing_address_2.val());
        } else {
            jQuery.ajax({
                type: 'POST',
                url: '?fsw-ajax=update_ward',
                data: {
                    district_id: billing_city.val()
                },
                beforeSend: function () {
                    jQuery('[name="_shipping_address_2"]').removeAttr('disabled').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                }
            }).done(function (result) {
                jQuery('[name="_shipping_address_2"]').html(result).val(billing_address_2.val());
            });
        }
        jQuery('[name="_shipping_city"]').attr('data-value', billing_city.val());
        jQuery('[name="_shipping_address_2"]').attr('data-value', billing_address_2.val());
    });

    // Copy address billing from Your Profile
    jQuery("a.load_customer_billing").on("click", function () {
        var user_id = jQuery( '#customer_user' ).val();

        if ( ! user_id ) return false;

        var data = {
            user_id : user_id,
            action  : 'woocommerce_get_customer_details',
            security: woocommerce_admin_meta_boxes.get_customer_details_nonce
        };

        jQuery.ajax({
            url: fsw_admin_params.ajax.url,
            data: data,
            type: 'POST',
            success: function( response ) {
                if ( response && response.billing ) {
                    // Remove all XHR before
                    if (xhr_fsw) xhr_fsw.abort();

                    if(parseInt(response.billing.city) === 'NaN') {
                        response.billing.city = '';
                    }
                    if(parseInt(response.billing.address_2) === 'NaN') {
                        response.billing.address_2 = '';
                    }

                    if(jQuery('[name="_billing_city"] option[value="'+ response.billing.city +'"]').length > 0) {
                        jQuery('[name="_billing_city"]').val(response.billing.city);
                    } else {
                        jQuery.ajax({
                            type: 'POST',
                            url: '?fsw-ajax=update_district',
                            data: {
                                city_id: response.billing.state
                            },
                            beforeSend: function () {
                                jQuery(':input#_billing_city').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                            }
                        }).done(function (result) {
                            jQuery(':input#_billing_city').html(result).val(response.billing.city);
                        });
                    }

                    if(jQuery('[name="_billing_address_2"] option[value="'+ response.billing.address_2 +'"]').length > 0) {
                        jQuery('[name="_billing_address_2"]').val(response.billing.address_2);
                    } else {
                        jQuery.ajax({
                            type: 'POST',
                            url: '?fsw-ajax=update_ward',
                            data: {
                                district_id: response.billing.city
                            },
                            beforeSend: function () {
                                jQuery(':input#_billing_address_2').removeAttr('disabled').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                            }
                        }).done(function (result) {
                            jQuery(':input#_billing_address_2').removeAttr('disabled').html(result).val(response.billing.address_2);
                        });
                    }
                    jQuery('[name="_billing_city"]').attr('data-value', response.billing.city);
                    jQuery('[name="_billing_address_2"]').attr('data-value', response.billing.address_2);
                }
            }
        });
    });

    // Copy address shipping from Your Profile
    jQuery("a.load_customer_shipping").on("click", function () {
        var user_id = jQuery( '#customer_user' ).val();

        if ( ! user_id ) return false;

        var data = {
            user_id : user_id,
            action  : 'woocommerce_get_customer_details',
            security: woocommerce_admin_meta_boxes.get_customer_details_nonce
        };

        jQuery.ajax({
            url: fsw_admin_params.ajax.url,
            data: data,
            type: 'POST',
            success: function( response ) {
                if ( response && response.billing ) {
                    // Remove all XHR before
                    if (xhr_fsw) xhr_fsw.abort();

                    if(parseInt(response.shipping.city) === 'NaN') {
                        response.billing.city = '';
                    }
                    if(parseInt(response.shipping.address_2) === 'NaN') {
                        response.billing.address_2 = '';
                    }

                    if(jQuery('[name="_shipping_city"] option[value="'+ response.shipping.city +'"]').length > 0) {
                        jQuery('[name="_shipping_city"]').val(response.shipping.city);
                    } else {
                        jQuery.ajax({
                            type: 'POST',
                            url: '?fsw-ajax=update_district',
                            data: {
                                city_id: response.shipping.state
                            },
                            beforeSend: function () {
                                jQuery(':input#_shipping_city').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                            }
                        }).done(function (result) {
                            jQuery(':input#_shipping_city').html(result).val(response.shipping.city);
                        });
                    }

                    if(jQuery('[name="_shipping_address_2"] option[value="'+ response.shipping.address_2 +'"]').length > 0) {
                        jQuery('[name="_shipping_address_2"]').val(response.shipping.address_2);
                    } else {
                        jQuery.ajax({
                            type: 'POST',
                            url: '?fsw-ajax=update_ward',
                            data: {
                                district_id: response.shipping.city
                            },
                            beforeSend: function () {
                                jQuery(':input#_shipping_address_2').removeAttr('disabled').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                            }
                        }).done(function (result) {
                            jQuery(':input#_shipping_address_2').removeAttr('disabled').html(result).val(response.shipping.address_2);
                        });
                    }
                    jQuery('[name="_shipping_city"]').attr('data-value', response.shipping.city);
                    jQuery('[name="_shipping_address_2"]').attr('data-value', response.shipping.address_2);
                }
            }
        });
    });

    // Copy address billing/shipping when change customer in Order details
    jQuery("#customer_user").bind("change", function() {
        var user_id = jQuery( this ).val();

        if ( ! user_id ) return false;

        var data = {
            user_id : user_id,
            action  : 'woocommerce_get_customer_details',
            security: woocommerce_admin_meta_boxes.get_customer_details_nonce
        };

        jQuery.ajax({
            url: fsw_admin_params.ajax.url,
            data: data,
            type: 'POST',
            success: function( response ) {
                if ( response && response.billing ) {
                    if (parseInt(response.billing.city) === 'NaN') {
                        response.billing.city = '';
                    }
                    if (parseInt(response.billing.address_2) === 'NaN') {
                        response.billing.address_2 = '';
                    }

                    if (jQuery('[name="_billing_city"] option[value="' + response.billing.city + '"]').length > 0) {
                        jQuery('[name="_billing_city"]').val(response.billing.city);
                    } else {
                        jQuery.ajax({
                            type: 'POST',
                            url: '?fsw-ajax=update_district',
                            data: {
                                city_id: response.billing.state
                            },
                            beforeSend: function () {
                                jQuery(':input#_billing_city').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                            }
                        }).done(function (result) {
                            jQuery(':input#_billing_city').html(result).val(response.billing.city);
                        });
                    }

                    if (jQuery('[name="_billing_address_2"] option[value="' + response.billing.address_2 + '"]').length > 0) {
                        jQuery('[name="_billing_address_2"]').val(response.billing.address_2);
                    } else {
                        jQuery.ajax({
                            type: 'POST',
                            url: '?fsw-ajax=update_ward',
                            data: {
                                district_id: response.billing.city
                            },
                            beforeSend: function () {
                                jQuery(':input#_billing_address_2').removeAttr('disabled').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                            }
                        }).done(function (result) {
                            jQuery(':input#_billing_address_2').removeAttr('disabled').html(result).val(response.billing.address_2);
                        });
                    }
                    jQuery('[name="_billing_city"]').attr('data-value', response.billing.city);
                    jQuery('[name="_billing_address_2"]').attr('data-value', response.billing.address_2);
                }

                if ( response && response.shipping ) {
                    // Remove all XHR before
                    if (xhr_fsw) xhr_fsw.abort();

                    if(parseInt(response.shipping.city) === 'NaN') {
                        response.billing.city = '';
                    }
                    if(parseInt(response.shipping.address_2) === 'NaN') {
                        response.billing.address_2 = '';
                    }

                    if(jQuery('[name="_shipping_city"] option[value="'+ response.shipping.city +'"]').length > 0) {
                        jQuery('[name="_shipping_city"]').val(response.shipping.city);
                    } else {
                        jQuery.ajax({
                            type: 'POST',
                            url: '?fsw-ajax=update_district',
                            data: {
                                city_id: response.shipping.state
                            },
                            beforeSend: function () {
                                jQuery(':input#_shipping_city').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                            }
                        }).done(function (result) {
                            jQuery(':input#_shipping_city').html(result).val(response.shipping.city);
                        });
                    }

                    if(jQuery('[name="_shipping_address_2"] option[value="'+ response.shipping.address_2 +'"]').length > 0) {
                        jQuery('[name="_shipping_address_2"]').val(response.shipping.address_2);
                    } else {
                        jQuery.ajax({
                            type: 'POST',
                            url: '?fsw-ajax=update_ward',
                            data: {
                                district_id: response.shipping.city
                            },
                            beforeSend: function () {
                                jQuery(':input#_shipping_address_2').removeAttr('disabled').html('<option>' + fsw_admin_params.l10n.loading + '</option>');
                            }
                        }).done(function (result) {
                            jQuery(':input#_shipping_address_2').removeAttr('disabled').html(result).val(response.shipping.address_2);
                        });
                    }
                    jQuery('[name="_shipping_city"]').attr('data-value', response.shipping.city);
                    jQuery('[name="_shipping_address_2"]').attr('data-value', response.shipping.address_2);
                }
            }
        });
    });
});