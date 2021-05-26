<?php
//Custom ATC button on single product page.
if (!function_exists('catcbll_woo_single_temp_custom_act_btn')){
    function catcbll_woo_single_temp_custom_act_btn(){
        $astra_active_or_not = get_option('template');
        include(WCATCBLL_CART_PUBLIC .'wcatcbll_all_settings.php'); 
        ?>
        <style>         
            <?php
                if( $catcbll_custom_btn_position == 'left' || $catcbll_custom_btn_position == 'right' ){
                    $display = 'display:inline-flex';
                }else{
                    $display = 'display:block';
                }

                if(isset($catcbll_hide_btn_bghvr) && !empty($catcbll_hide_btn_bghvr) || isset($catcbll_btn_hvrclr) && !empty($catcbll_btn_hvrclr)){
                    $btn_class = 'btn';
                    $imp = '';
                }else{
                    $btn_class = 'button';
                    $imp = '!important';
                }

                if (isset($astra_active_or_not) && $astra_active_or_not == 'Avada') {
                    $avada_style = 'display: inline-block;';
                }else{
                    $avada_style = '';
                }
                echo 'form.cart{display:inline-block}';
                echo '.woocommerce-variation-add-to-cart{display:inline-block}';
                echo '.single-product .catcbll_preview_button{text-align:'.$catcbll_custom_btn_alignment.';margin:'.$btn_margin.';'.$display.'}';
                echo '.single-product .catcbll_preview_button .fa{font-family:FontAwesome '. $imp.'}';
                echo '.single-product .' . $catcbll_hide_btn_bghvr.':before{border-radius:'.$catcbll_btn_radius.'px '. $imp.';background:'.$catcbll_btn_hvrclr.' '. $imp.';color:#fff '. $imp.';}'; 
                echo '.single-product .catcbll_preview_button .catcbll{'.$avada_style .'color:'.$catcbll_btn_fclr.' '. $imp.';font-size:'.$catcbll_btn_fsize.'px '. $imp.';padding:'.$catcbll_padding_top_bottom.'px '.$catcbll_padding_left_right.'px '. $imp.';border:'.$catcbll_border_size.'px solid '.$catcbll_btn_border_clr.' '. $imp.';border-radius:'.$catcbll_btn_radius.'px '. $imp.';background-color:'.$catcbll_btn_bg.' '. $imp.';}';
                echo '.single-product .catcbll_preview_button a{text-decoration: none '. $imp.';}';
                if(empty($catcbll_hide_btn_bghvr)){
                    echo '.single-product .catcbll:hover{border-radius:'.$catcbll_btn_radius.' '. $imp.';background-color:'.$catcbll_btn_hvrclr.' '. $imp.';color:#fff '. $imp.';}';
                }
            ?> 
        </style>
        <?php 
        // if custom setting is on
        if (!empty($prd_lbl[0]) && ($custom == "custom")){
            if ($both == "both" && $add2cart == "add2cart" && ($catcbll_custom_btn_position == 'down' || $catcbll_custom_btn_position == 'right') ){                       
               if ($product->is_type('variable')){
                   woocommerce_single_variation_add_to_cart_button();
                }else{
                    woocommerce_template_single_add_to_cart(); //Default                        
                }
            }
            //Show multiple button using loop
            for ($y = 0; $y < $atxtcnt; $y++){
                $prd_btn ='';
                if ($catcbll_btn_icon_psn == 'right'){                        
                    if (!empty($prd_lbl[$y])){                          
                        $prd_btn = '<div class="catcbll_preview_button"><a href="' . $prd_url[$y] . '" class="'.$btn_class.' btn-lg catcbll '.$catcbll_hide_btn_bghvr.' '.$catcbll_hide_2d_trans.'" ' . $trgtblnk . '>' . $prd_lbl[$y] . ' <i class="fa ' . $catcbll_btn_icon_cls .'"></i></a></div>';  
                    }
                }else{
                    //Checking label field .It is empty or not
                    if (!empty($prd_lbl[$y])){
                        $prd_btn = '<div class="catcbll_preview_button"><a href="' . $prd_url[$y] . '" class="'.$btn_class.' btn-lg catcbll '.$catcbll_hide_btn_bghvr.' '.$catcbll_hide_2d_trans.' " ' . $trgtblnk . '><i class="fa ' . $catcbll_btn_icon_cls .'"></i> ' . $prd_lbl[$y] . ' </a></div>'; 
                    }
                }
                echo $prd_btn;
            } //end for
            if ($both == "both" && $add2cart == "add2cart" && ($catcbll_custom_btn_position == 'up' || $catcbll_custom_btn_position == 'left') ){
                if ($product->is_type('variable')){
                   woocommerce_single_variation_add_to_cart_button();
                }else{
                    woocommerce_template_single_add_to_cart(); //Default                        
                }
            }
        }else{                    
            if ($product->is_type('variable')){
				woocommerce_single_variation_add_to_cart_button();
			}
			else{
				woocommerce_template_single_add_to_cart(); //Default
			}
        } 
    }
}
// Check product type
if (!function_exists('catcbll_check_product_type')){
    function catcbll_check_product_type(){
        global $product;
        if ($product->is_type('variable')){
            add_action('woocommerce_single_variation', 'catcbll_woo_single_temp_custom_act_btn', 30);
        }else{
            add_action('woocommerce_single_product_summary', 'catcbll_woo_single_temp_custom_act_btn', 30);
        }
    }
}
add_action('woocommerce_before_single_product_summary', 'catcbll_check_product_type');
?>