jQuery(document).ready(function($) {
    var xhr_fsw = null;

    function toggle_shipping( el ) {
        if( !el ) return;
        let fsw_calculator = el.closest('.__fsw_product_shipping_calculator');

        fsw_calculator.find( 'form.fsw-shipping-calculator' ).slideToggle();
        $( document.body ).trigger( 'toggle_product_shipping' ); // Trigger select2 to load.
        return false;
    }
    function shipping_calculator_submit( el = 'all', validate = false ) {
        let shipping_form = $('form.fsw-shipping-calculator');

        if (el !== 'all') {
            shipping_form = el;
        }
        let fsw_calculator = shipping_form.closest('.__fsw_product_shipping_calculator');

        if( validate === true && (!fsw_calculator.find('.__fsw_city').val() || fsw_calculator.find('.__fsw_city').val() === 'Loading ...'
            || !fsw_calculator.find('.__fsw_district').val() || fsw_calculator.find('.__fsw_district').val() === 'Loading ...'
            || !fsw_calculator.find('.__fsw_ward').val() || fsw_calculator.find('.__fsw_ward').val() === 'Loading ...') ) {
            alert(fsw.l10n.address_is_not_valid + '. ' + fsw.l10n.try_again);
            return;
        }

        let data_form = shipping_form.serialize();

        if ($('form.cart').length > 0) {
            data_form += '&' + jQuery('form.cart').serialize();
        }

        shipping_form.hide();
        fsw_calculator.block({
            message: null,
            overlayCSS: {
                background: '#fff',
                opacity: 0.6
            }
        });

        if (xhr_fsw && xhr_fsw.readyState != 4) {
            xhr_fsw.abort();
        }

        xhr_fsw = jQuery.ajax({
            type: 'POST',
            url: '?fsw-ajax=product_shipping_calculator',
            data: data_form,
        }).done(function (result) {
            fsw_calculator.html(result);
            $( document.body ).trigger( 'updated_product_shipping' );
        }).complete(function() {
            fsw_calculator.unblock();
        });
    }

    if ($('form.fsw-shipping-calculator').length > 0 && fsw && fsw.options.product_shipping_calculator_auto) {
        $('form.fsw-shipping-calculator').each( function(){
            if( $(this).find('.country_select').val() && $(this).find('.__fsw_city').val()
                && $(this).find('.__fsw_district').val() && $(this).find('.__fsw_ward').val() ) {
                shipping_calculator_submit($(this));
            }
        });
    }

    $( document ).on( 'click', '.fsw-shipping-calculator-button', function(evt){
        evt.preventDefault();
        toggle_shipping($(this));
    });

    $( document ).on( 'submit', 'form.fsw-shipping-calculator', function(evt){
        evt.preventDefault();
        shipping_calculator_submit($(this), true);
    });
});