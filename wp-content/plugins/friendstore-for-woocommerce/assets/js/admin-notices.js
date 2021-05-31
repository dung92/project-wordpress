/**
 * Admin code for dismissing notifications.
 *
 */
(function( $ ) {
    'use strict';
    $( function() {
        $( document ).on( 'click', '.notice-dismiss', function( event, el ) {

            var $notice = $(this).parent('.vf-notice.is-dismissible');
            var dismiss_url = $notice.attr('data-dismiss-url');
            if ( dismiss_url ) {
                $.get( dismiss_url );
            }
        });
    } );
})( jQuery );


/**
jQuery(document).ready(function ($) {
    var xhr_fsw = null;

    // Dismiss notice
    jQuery(".vf-notice.is-dismissible").on("click", ".notice-dismiss", function () {
        var $notice = $(this).parent('.notice.is-dismissible');

        if (xhr_fsw && xhr_fsw.readyState != 4) {
            xhr_fsw.abort();
        }
        if(!$notice.attr('id')) return false;

        xhr_fsw = jQuery.ajax({
            type: 'POST',
            url: fsw_admin_params.ajax.url,
            data: {
                notice_id: $notice.attr('id'),
                action: 'fsw_dismiss_notice'
            }
        }).done(function (result) {
            console.log('123');
        });
    });
});
 */