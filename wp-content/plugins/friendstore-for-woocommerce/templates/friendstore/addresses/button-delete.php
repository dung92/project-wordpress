<a href="<?php echo $remove_link;?>" style="display:none" class="button delete-address-button" aria-label="<?php esc_attr_e( 'Delete address', 'friendstore-for-woocommerce' );?>">
    <?php esc_html_e( 'Delete address', 'friendstore-for-woocommerce' );?>
</a>
<script type="application/javascript">
    (function( $ ) {
        jQuery(document).ready(function($) {
            var btn_delete = $('.delete-address-button').detach();
            $('button[name="save_address"]').after(btn_delete.css({'display':'inline-block'}));
        });
    })( jQuery );
</script>