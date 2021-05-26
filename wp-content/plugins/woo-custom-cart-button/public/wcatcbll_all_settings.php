<?php
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
?>