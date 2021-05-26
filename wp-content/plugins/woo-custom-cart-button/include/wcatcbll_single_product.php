<?php
//Custom ATC button on single product page.
if (!function_exists('catcbll_woo_single_temp_custom_act_btn')){
    function catcbll_woo_single_temp_custom_act_btn(){
        global $product;
         /*button styling settings */
         $catcbll_settings = get_option('_woo_catcbll_all_settings');
         extract($catcbll_settings);
 
         //button display setting
         if(isset($catcbll_both_btn)){$both  = $catcbll_both_btn;}else{$both = '';}
         if(isset($catcbll_add2_cart)){$add2cart = $catcbll_add2_cart;}else{$add2cart= '';}
         if(isset($catcbll_custom)){$custom = $catcbll_custom;}else{$custom  = '';}
         // open new tab
         if(isset($catcbll_btn_open_new_tab)){$btn_opnt_new_tab  = $catcbll_btn_open_new_tab;}else{$btn_opnt_new_tab = '';} 
         
         /*Button Margin*/
         $btn_margin = $catcbll_margin_top.'px '.$catcbll_margin_right.'px '.$catcbll_margin_bottom.'px '.$catcbll_margin_left.'px';
 
         /* Get product label and url in database */
         $pid = $product->get_id();
         $prd_lbl = get_post_meta($pid, '_catcbll_btn_label', true); //button post meta
         $prd_url = get_post_meta($pid, '_catcbll_btn_link', true); //button post meta   
 
         //count button values               
         if(is_array($prd_lbl)){$atxtcnt = count($prd_lbl);}else{$atxtcnt = '';}     
      
         if ($btn_opnt_new_tab == "1"){$trgtblnk = "target='_blank'";}else{$trgtblnk = "";}        

         if(isset($catcbll_hide_btn_bghvr) && !empty($catcbll_hide_btn_bghvr) || isset($catcbll_btn_hvrclr) && !empty($catcbll_btn_hvrclr)){
            $btn_class = 'btn';
            $imp = '';
        }else{
            $btn_class = 'button';
            $imp = '!important';
        }
        ?>
        <style>         
        <?php
            echo '.single-product .catcbll_preview_button{text-align:'.$catcbll_custom_btn_alignment.';margin:'.$btn_margin.'}';
            echo '.single-product .catcbll_preview_button .fa{font-family:FontAwesome '. $imp.'}';
            echo '.single-product .' . $catcbll_hide_btn_bghvr.':before{border-radius:'.$catcbll_btn_radius.'px '. $imp.';background:'.$catcbll_btn_hvrclr.' '. $imp.';color:#fff '. $imp.';}'; 
            echo '.single-product .catcbll_preview_button .catcbll{color:'.$catcbll_btn_fclr.' '. $imp.';font-size:'.$catcbll_btn_fsize.'px '. $imp.';padding:'.$catcbll_padding_top_bottom.'px '.$catcbll_padding_left_right.'px '. $imp.';border:'.$catcbll_border_size.'px solid '.$catcbll_btn_border_clr.' '. $imp.';border-radius:'.$catcbll_btn_radius.'px '. $imp.';background:'.$catcbll_btn_bg.' '. $imp.';}';
            echo '.single-product .catcbll_preview_button a{text-decoration: none '. $imp.';}';
            if(empty($catcbll_hide_btn_bghvr)){
                echo '.single-product .catcbll:hover{border-radius:'.$catcbll_btn_radius.'px '. $imp.';background:'.$catcbll_btn_hvrclr.' '. $imp.';color:#fff '. $imp.';}';
            }
        ?> 
        </style>
        <?php 
        // if custom setting is on
        if (!empty($prd_lbl[0]) && ($custom == "custom")){
            if ($both == "both" && $add2cart == "add2cart" && $catcbll_custom_btn_position == 'down'){                       
               if ($product->is_type('variable')){
                   woocommerce_single_variation_add_to_cart_button();
                }else{
                    woocommerce_template_single_add_to_cart(); //Default                        
                }
            }
            //Show multiple button using loop
            for ($y = 0; $y < $atxtcnt; $y++){
                $prd_btn = '';
                if ($catcbll_btn_icon_psn == 'right'){                        
                    if (!empty($prd_lbl[$y])){                          
                        $prd_btn = '<div class="catcbll_preview_button"><a href="' . $prd_url[$y] . '" class="'.$btn_class.' addtocartbutton btn-lg catcbll '.$catcbll_hide_btn_bghvr.' '.$catcbll_hide_2d_trans.'" ' . $trgtblnk . '>' . $prd_lbl[$y] . ' <i class="fa ' . $catcbll_btn_icon_cls .'"></i></a></div>';  
                    }
                }else{
                    //Checking label field .It is empty or not
                    if (!empty($prd_lbl[$y])){
                        $prd_btn = '<div class="catcbll_preview_button"><a href="' . $prd_url[$y] . '" class="'.$btn_class.' addtocartbutton btn-lg catcbll '.$catcbll_hide_btn_bghvr.' '.$catcbll_hide_2d_trans.' " ' . $trgtblnk . '><i class="fa ' . $catcbll_btn_icon_cls .'"></i> ' . $prd_lbl[$y] . ' </a></div>'; 
                    }
                }
                echo $prd_btn;
            } //end for
            if ($both == "both" && $add2cart == "add2cart" && $catcbll_custom_btn_position == 'up'){
                if ($product->is_type('variable')){
                   woocommerce_single_variation_add_to_cart_button();
                }else{
                    woocommerce_template_single_add_to_cart(); //Default                        
                }
            }
        }else{                    
            if ($product->is_type('variable'))
			{
				woocommerce_single_variation_add_to_cart_button();
			}
			else
			{
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