<?php
//Custom ATC button on archive page.
if (!function_exists('catcbll_woo_template_loop_custom_button')) {
    function catcbll_woo_template_loop_custom_button()
    {
        global $product;
        /*button styling settings */
        $catcbll_settings = get_option('_woo_catcbll_all_settings');
        extract($catcbll_settings);

        //button display setting
        if (isset($catcbll_both_btn)) {
            $both  = $catcbll_both_btn;
        } else {
            $both = '';
        }
        if (isset($catcbll_add2_cart)) {
            $add2cart = $catcbll_add2_cart;
        } else {
            $add2cart = '';
        }
        if (isset($catcbll_custom)) {
            $custom = $catcbll_custom;
        } else {
            $custom  = '';
        }
        // open new tab
        if (isset($catcbll_btn_open_new_tab)) {
            $btn_opnt_new_tab  = $catcbll_btn_open_new_tab;
        } else {
            $btn_opnt_new_tab = '';
        }

        /*Button Margin*/
        $btn_margin = $catcbll_margin_top . 'px ' . $catcbll_margin_right . 'px ' . $catcbll_margin_bottom . 'px ' . $catcbll_margin_left . 'px';

        /* Get product label and url in database */
        $pid = $product->get_id();
        $prd_lbl = get_post_meta($pid, '_catcbll_btn_label', true); //button post meta
        $prd_url = get_post_meta($pid, '_catcbll_btn_link', true); //button post meta   

        //count button values               
        if (is_array($prd_lbl)) {
            $atxtcnt = count($prd_lbl);
        } else {
            $atxtcnt = '';
        }

        if ($btn_opnt_new_tab == "1") {
            $trgtblnk = "target='_blank'";
        } else {
            $trgtblnk = "";
        }

        /*Both button or not*/
        if (($custom == "custom") || ($add2cart == "add2cart")) {
            if (!empty($prd_lbl[0]) && ($custom == "custom")) { ?>
                <style>
                    <?php
                    if ((isset($catcbll_hide_btn_bghvr) && !empty($catcbll_hide_btn_bghvr)) || (isset($catcbll_btn_hvrclr) && !empty($catcbll_btn_hvrclr))) {
                        $btn_class = 'btn';
                        $imp = '';
                    } else {
                        $btn_class = 'button';
                        $imp = '!important';
                    }

                    echo '.catcbll_preview_button{text-align:'.$catcbll_custom_btn_alignment.';margin:' . $btn_margin . '}';
                    echo '.catcbll_preview_button .fa{font-family:FontAwesome '. $imp.'}';
                    echo '.' . $catcbll_hide_btn_bghvr . ':before{border-radius:' . $catcbll_btn_radius . 'px '. $imp.';background:' . $catcbll_btn_hvrclr . ' '. $imp.';color:#fff '. $imp.';}';
                    echo '.catcbll_preview_button .catcbll{color:' . $catcbll_btn_fclr . ' '. $imp.';font-size:' . $catcbll_btn_fsize . 'px '. $imp.';padding:' . $catcbll_padding_top_bottom . 'px ' . $catcbll_padding_left_right . 'px '. $imp.';border:' . $catcbll_border_size . 'px solid ' . $catcbll_btn_border_clr . ' '. $imp.';border-radius:' . $catcbll_btn_radius . 'px '. $imp.';background:' . $catcbll_btn_bg . ' '. $imp.';}';
                    echo '.catcbll_preview_button a{text-decoration: none '. $imp.';}';
                    if (empty($catcbll_hide_btn_bghvr)) {
                        echo '.catcbll:hover{border-radius:' . $catcbll_btn_radius . 'px '. $imp.';background:' . $catcbll_btn_hvrclr . ' '. $imp.';color:#fff '. $imp.';}';
                    }
                    ?>
                </style><?php
                        if ($catcbll_custom_btn_position == 'down') {
                            if (($both == "both") && ($add2cart == "add2cart")) {
                                woocommerce_template_loop_add_to_cart();
                            }
                        }
                        //Show multiple button using loop
                        for ($y = 0; $y < $atxtcnt; $y++) {
                            if (!empty($prd_url[$y])) {
                                $aurl = $prd_url[$y];
                            } else {
                                $aurl = site_url() . '/?add-to-cart=' . $pid;
                            }
                            $prd_btn = '';
                            if ($catcbll_btn_icon_psn == 'right') {
                                if (!empty($prd_lbl[$y])) {
                                    $prd_btn = '<div class="catcbll_preview_button"><a href="' . $aurl . '" class="'.$btn_class.' addtocartbutton btn-lg catcbll ' . $catcbll_hide_btn_bghvr . ' ' . $catcbll_hide_2d_trans . '" ' . $trgtblnk . '>' . $prd_lbl[$y] . ' <i class="fa ' . $catcbll_btn_icon_cls . '"></i></a></div>';
                                }
                            } else {
                                //Checking label field .It is empty or not
                                if (!empty($prd_lbl[$y])) {
                                    $prd_btn = '<div class="catcbll_preview_button"><a href="' . $aurl . '" class="'.$btn_class.' addtocartbutton btn-lg catcbll ' . $catcbll_hide_btn_bghvr . ' ' . $catcbll_hide_2d_trans . ' " ' . $trgtblnk . '><i class="fa ' . $catcbll_btn_icon_cls . '"></i> ' . $prd_lbl[$y] . ' </a></div>';
                                }
                            }
                            echo $prd_btn;
                        } //end for each
                        if ($catcbll_custom_btn_position == 'up') {
                            if (($both == "both") && ($add2cart == "add2cart")) {
                                woocommerce_template_loop_add_to_cart();
                            }
                        }
                    } else {
                        woocommerce_template_loop_add_to_cart();
                    }
                }
            }
        }
        add_action('woocommerce_after_shop_loop_item', 'catcbll_woo_template_loop_custom_button', 10);
                        ?>