<?php
//Custom ATC button on archive page.
if (!function_exists('catcbll_woo_template_loop_custom_button')){
    function catcbll_woo_template_loop_custom_button(){
        $astra_active_or_not = get_option('template');
        include(WCATCBLL_CART_PUBLIC .'wcatcbll_all_settings.php');  
        
        /*Both button or not*/  
        if (!empty($prd_lbl[0]) && $custom == "custom"){?>
            <style>            
                <?php
                    if( $catcbll_custom_btn_position == 'left' || $catcbll_custom_btn_position == 'right' ){
                        $display = 'inline-flex';
                    }else{
                        $display = 'block';
                    }
                    
                    if((isset($catcbll_hide_btn_bghvr) && !empty($catcbll_hide_btn_bghvr)) || (isset($catcbll_btn_hvrclr) && !empty($catcbll_btn_hvrclr))){
                        $btn_class = 'btn';
                        $imp = '';
                    }else{
                        $btn_class = 'button';
                        $imp = '!important';
                    }
                    if (isset($astra_active_or_not) && $astra_active_or_not == 'Avada') {
                        $avada_style = 'display: inline-block;float: none !important;';
                        $avada_hover = 'margin-left: 0px !important;';
                    }else{
                        $avada_style = '';
                        $avada_hover = '';
                    }
                    echo '.catcbll_preview_button{text-align:'.$catcbll_custom_btn_alignment.';margin:'.$btn_margin.';display:'.$display.'}';
                    echo '.catcbll_preview_button .fa{font-family:FontAwesome '. $imp.'}';
                    echo '.' . $catcbll_hide_btn_bghvr.':before{border-radius:'.$catcbll_btn_radius.'px '. $imp.';background:'.$catcbll_btn_hvrclr.' '. $imp.';color:#fff '. $imp.';'.$avada_hover.'}'; 
                    echo '.catcbll_preview_button .catcbll{'.$avada_style.'max-width:100%;color:'.$catcbll_btn_fclr.' '. $imp.';font-size:'.$catcbll_btn_fsize.'px '. $imp.';padding:'.$catcbll_padding_top_bottom.'px '.$catcbll_padding_left_right.'px '. $imp.';border:'.$catcbll_border_size.'px solid '.$catcbll_btn_border_clr.' '. $imp.';border-radius:'.$catcbll_btn_radius.'px '. $imp.';background-color:'.$catcbll_btn_bg.' '. $imp.';}';
                    echo '.catcbll_preview_button a{text-decoration: none '. $imp.';}';
                    if(empty($catcbll_hide_btn_bghvr)){
                        echo '.catcbll:hover{border-radius:'.$catcbll_btn_radius.' '. $imp.';background-color:'.$catcbll_btn_hvrclr.' '. $imp.';color:#fff '. $imp.';}';
                    }
                ?> 
            </style><?php 
            if( $catcbll_custom_btn_position == 'down' || $catcbll_custom_btn_position == 'right' ){
                if (($both == "both") && ($add2cart == "add2cart")){woocommerce_template_loop_add_to_cart();}
            }
            //Show multiple button using loop
            for ($y = 0;$y < $atxtcnt;$y++){                   
                if (!empty($prd_url[$y])){
                    $aurl = $prd_url[$y];
                }else{
                    $aurl = site_url() . '/?add-to-cart=' . $pid;
                }       
                $prd_btn = '';             
                if ($catcbll_btn_icon_psn == 'right'){                        
                    if (!empty($prd_lbl[$y])){                          
                        $prd_btn = '<div class="catcbll_preview_button"><a href="' . $aurl . '" class="'.$btn_class.' btn-lg catcbll '.$catcbll_hide_btn_bghvr.' '.$catcbll_hide_2d_trans.'" ' . $trgtblnk . '>' . $prd_lbl[$y] . ' <i class="fa ' . $catcbll_btn_icon_cls .'"></i></a></div>';                           
                    }
                }else{
                    //Checking label field .It is empty or not
                    if (!empty($prd_lbl[$y])){
                        $prd_btn = '<div class="catcbll_preview_button"><a href="' . $aurl . '" class="'.$btn_class.' btn-lg catcbll '.$catcbll_hide_btn_bghvr.' '.$catcbll_hide_2d_trans.' " ' . $trgtblnk . '><i class="fa ' . $catcbll_btn_icon_cls .'"></i> ' . $prd_lbl[$y] . ' </a></div>';                           
                    }
                }
                echo $prd_btn;
            }//end for each
            if( $catcbll_custom_btn_position == 'up' || $catcbll_custom_btn_position == 'left' ){
                if (($both == "both") && ($add2cart == "add2cart")){woocommerce_template_loop_add_to_cart();}
            }
        }else{ woocommerce_template_loop_add_to_cart();}       
    }
}
$astra_active_or_not = get_option('template');
if (isset($astra_active_or_not) && $astra_active_or_not == 'Avada') {
    /* Remove Avada default add to cart button */
    add_action( 'after_setup_theme', 'remove_woo_commerce_hooks' );
    function remove_woo_commerce_hooks() {
        global $avada_woocommerce;
        remove_action( 'woocommerce_after_shop_loop_item', array( $avada_woocommerce, 'template_loop_add_to_cart' ), 10 );
        remove_action( 'woocommerce_after_shop_loop_item', array( $avada_woocommerce, 'show_details_button' ), 15);
        add_action('woocommerce_after_shop_loop_item', 'catcbll_woo_template_loop_custom_button', 10);
    }             
}else{
    add_action('woocommerce_after_shop_loop_item', 'catcbll_woo_template_loop_custom_button', 10);
} 

?>