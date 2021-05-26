<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_furniture_carpenter_first_color = get_theme_mod('vw_furniture_carpenter_first_color');

	$vw_furniture_carpenter_custom_css = '';

	if($vw_furniture_carpenter_first_color != false){
		$vw_furniture_carpenter_custom_css .='.search-box i, #slider .view-more:hover, .view-more:hover, span.cart-value, .contact-butn, input[type="submit"], .scrollup i, #footer .tagcloud a:hover, #sidebar .custom-social-icons i, #footer .custom-social-icons i, #footer-2, .home-page-header, .logo, .pagination .current, .pagination a:hover, #sidebar .tagcloud a:hover, #comments input[type="submit"], nav.woocommerce-MyAccount-navigation ul li, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, #slider, .header-fixed, #comments a.comment-reply-link, .toggle-nav i, #sidebar .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_price_filter .ui-slider .ui-slider-handle, #sidebar .woocommerce-product-search button, #footer .widget_price_filter .ui-slider .ui-slider-range, #footer .widget_price_filter .ui-slider .ui-slider-handle, #footer .woocommerce-product-search button, #footer a.custom_read_more i, #sidebar a.custom_read_more:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .nav-previous a:hover, .nav-next a:hover, .wp-block-button .wp-block-button__link:hover{';
			$vw_furniture_carpenter_custom_css .='background-color: '.esc_attr($vw_furniture_carpenter_first_color).';';
		$vw_furniture_carpenter_custom_css .='}';
	}
	if($vw_furniture_carpenter_first_color != false){
		$vw_furniture_carpenter_custom_css .='a, .styling-box i, .service-inner:hover a, #footer .custom-social-icons i:hover, #footer li a:hover, #sidebar ul li a:hover, .post-main-box:hover h2, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, .main-navigation ul.sub-menu a:hover, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, .page-template-custom-home-page #header .main-navigation a:hover, #footer a.custom_read_more, .post-main-box:hover h2 a, .post-main-box:hover .post-info a, .single-post .post-info:hover a, .page-template-custom-home-page .logo .site-title a:hover{';
			$vw_furniture_carpenter_custom_css .='color: '.esc_attr($vw_furniture_carpenter_first_color).';';
		$vw_furniture_carpenter_custom_css .='}';
	}
	if($vw_furniture_carpenter_first_color != false){
		$vw_furniture_carpenter_custom_css .='#slider .view-more:hover, .view-more:hover, #footer a.custom_read_more, #sidebar a.custom_read_more:hover, .wp-block-button .wp-block-button__link:hover{';
			$vw_furniture_carpenter_custom_css .='border-color: '.esc_attr($vw_furniture_carpenter_first_color).';';
		$vw_furniture_carpenter_custom_css .='}';
	}
	if($vw_furniture_carpenter_first_color != false){
		$vw_furniture_carpenter_custom_css .='#serv-section hr, .main-navigation ul ul{';
			$vw_furniture_carpenter_custom_css .='border-top-color: '.esc_attr($vw_furniture_carpenter_first_color).';';
		$vw_furniture_carpenter_custom_css .='}';
	}
	if($vw_furniture_carpenter_first_color != false){
		$vw_furniture_carpenter_custom_css .='#footer h3:after, .main-navigation ul ul, .page-template-custom-home-page .header-fixed{';
			$vw_furniture_carpenter_custom_css .='border-bottom-color: '.esc_attr($vw_furniture_carpenter_first_color).';';
		$vw_furniture_carpenter_custom_css .='}';
	}
	if($vw_furniture_carpenter_first_color != false){
		$vw_furniture_carpenter_custom_css .='.post-main-box, #sidebar .widget{
		box-shadow: 0px 15px 10px -15px '.esc_attr($vw_furniture_carpenter_first_color).';
		}';
	}

	/*---------------------------Width Layout -------------------*/

	$vw_furniture_carpenter_theme_lay = get_theme_mod( 'vw_furniture_carpenter_width_option','Full Width');
    if($vw_furniture_carpenter_theme_lay == 'Boxed'){
		$vw_furniture_carpenter_custom_css .='body{';
			$vw_furniture_carpenter_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.page-template-custom-home-page .main-header{';
			$vw_furniture_carpenter_custom_css .='width: 97%;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='#slider .carousel-control-prev, #slider .carousel-control-next{';
			$vw_furniture_carpenter_custom_css .='bottom: 1em;';
		$vw_furniture_carpenter_custom_css .='}';
	}else if($vw_furniture_carpenter_theme_lay == 'Wide Width'){
		$vw_furniture_carpenter_custom_css .='body{';
			$vw_furniture_carpenter_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.page-template-custom-home-page .main-header{';
			$vw_furniture_carpenter_custom_css .='width: 97%;';
		$vw_furniture_carpenter_custom_css .='}';
	}else if($vw_furniture_carpenter_theme_lay == 'Full Width'){
		$vw_furniture_carpenter_custom_css .='body{';
			$vw_furniture_carpenter_custom_css .='max-width: 100%;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$vw_furniture_carpenter_theme_lay = get_theme_mod( 'vw_furniture_carpenter_slider_opacity_color','0.5');
	if($vw_furniture_carpenter_theme_lay == '0'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0';
		$vw_furniture_carpenter_custom_css .='}';
		}else if($vw_furniture_carpenter_theme_lay == '0.1'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0.1';
		$vw_furniture_carpenter_custom_css .='}';
		}else if($vw_furniture_carpenter_theme_lay == '0.2'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0.2';
		$vw_furniture_carpenter_custom_css .='}';
		}else if($vw_furniture_carpenter_theme_lay == '0.3'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0.3';
		$vw_furniture_carpenter_custom_css .='}';
		}else if($vw_furniture_carpenter_theme_lay == '0.4'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0.4';
		$vw_furniture_carpenter_custom_css .='}';
		}else if($vw_furniture_carpenter_theme_lay == '0.5'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0.5';
		$vw_furniture_carpenter_custom_css .='}';
		}else if($vw_furniture_carpenter_theme_lay == '0.6'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0.6';
		$vw_furniture_carpenter_custom_css .='}';
		}else if($vw_furniture_carpenter_theme_lay == '0.7'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0.7';
		$vw_furniture_carpenter_custom_css .='}';
		}else if($vw_furniture_carpenter_theme_lay == '0.8'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0.8';
		$vw_furniture_carpenter_custom_css .='}';
		}else if($vw_furniture_carpenter_theme_lay == '0.9'){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='opacity:0.9';
		$vw_furniture_carpenter_custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$vw_furniture_carpenter_theme_lay = get_theme_mod( 'vw_furniture_carpenter_slider_content_option','Left');
    if($vw_furniture_carpenter_theme_lay == 'Left'){
		$vw_furniture_carpenter_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_furniture_carpenter_custom_css .='text-align:left; left:10%; right:40%;';
		$vw_furniture_carpenter_custom_css .='}';
	}else if($vw_furniture_carpenter_theme_lay == 'Center'){
		$vw_furniture_carpenter_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_furniture_carpenter_custom_css .='text-align:center; left:20%; right:20%;';
		$vw_furniture_carpenter_custom_css .='}';
	}else if($vw_furniture_carpenter_theme_lay == 'Right'){
		$vw_furniture_carpenter_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_furniture_carpenter_custom_css .='text-align:right; left:40%; right:10%;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$vw_furniture_carpenter_slider_height = get_theme_mod('vw_furniture_carpenter_slider_height');
	if($vw_furniture_carpenter_slider_height != false){
		$vw_furniture_carpenter_custom_css .='#slider img{';
			$vw_furniture_carpenter_custom_css .='height: '.esc_attr($vw_furniture_carpenter_slider_height).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*--------------------------- Slider -------------------*/

	$vw_furniture_carpenter_slider = get_theme_mod('vw_furniture_carpenter_slider_hide_show');
	if($vw_furniture_carpenter_slider == false){
		$vw_furniture_carpenter_custom_css .='.page-template-custom-home-page .main-header{';
			$vw_furniture_carpenter_custom_css .='position: static;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.page-template-custom-home-page .inner-header, .page-template-custom-home-page .logo{';
			$vw_furniture_carpenter_custom_css .='background: #c28851;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.page-template-custom-home-page .logo p.site-title a, .page-template-custom-home-page p.site-description, .page-template-custom-home-page #header .main-navigation a{';
			$vw_furniture_carpenter_custom_css .='color: #fff;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.page-template-custom-home-page #header .main-navigation a:hover, .page-template-custom-home-page #header .main-navigation ul ul a{';
			$vw_furniture_carpenter_custom_css .='color: #252525;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.page-template-custom-home-page #header .main-navigation ul.sub-menu a:hover{';
			$vw_furniture_carpenter_custom_css .='color: #c28851;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='#contact-sec{';
			$vw_furniture_carpenter_custom_css .='margin-top: 40px;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_furniture_carpenter_theme_lay = get_theme_mod( 'vw_furniture_carpenter_blog_layout_option','Default');
    if($vw_furniture_carpenter_theme_lay == 'Default'){
		$vw_furniture_carpenter_custom_css .='.post-main-box{';
			$vw_furniture_carpenter_custom_css .='';
		$vw_furniture_carpenter_custom_css .='}';
	}else if($vw_furniture_carpenter_theme_lay == 'Center'){
		$vw_furniture_carpenter_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn{';
			$vw_furniture_carpenter_custom_css .='text-align:center;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.post-info{';
			$vw_furniture_carpenter_custom_css .='margin-top:10px;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.post-info hr{';
			$vw_furniture_carpenter_custom_css .='margin:15px auto;';
		$vw_furniture_carpenter_custom_css .='}';
	}else if($vw_furniture_carpenter_theme_lay == 'Left'){
		$vw_furniture_carpenter_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn, #our-services p{';
			$vw_furniture_carpenter_custom_css .='text-align:Left;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.post-info hr{';
			$vw_furniture_carpenter_custom_css .='margin-bottom:10px;';
		$vw_furniture_carpenter_custom_css .='}';
		$vw_furniture_carpenter_custom_css .='.post-main-box h2{';
			$vw_furniture_carpenter_custom_css .='margin-top:10px;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*------------------------------Responsive Media -----------------------*/

	$vw_furniture_carpenter_resp_stickyheader = get_theme_mod( 'vw_furniture_carpenter_stickyheader_hide_show',false);
	if($vw_furniture_carpenter_resp_stickyheader == true && get_theme_mod( 'vw_furniture_carpenter_sticky_header',false) != true){
    	$vw_furniture_carpenter_custom_css .='.header-fixed{';
			$vw_furniture_carpenter_custom_css .='position:static !important;';
		$vw_furniture_carpenter_custom_css .='} ';
	}
    if($vw_furniture_carpenter_resp_stickyheader == true){
    	$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px) {';
		$vw_furniture_carpenter_custom_css .='.header-fixed{';
			$vw_furniture_carpenter_custom_css .='position:fixed !important;';
		$vw_furniture_carpenter_custom_css .='} }';
	}else if($vw_furniture_carpenter_resp_stickyheader == false){
		$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px){';
		$vw_furniture_carpenter_custom_css .='.header-fixed{';
			$vw_furniture_carpenter_custom_css .='position:static !important;';
		$vw_furniture_carpenter_custom_css .='} }';
	}

	$vw_furniture_carpenter_resp_slider = get_theme_mod( 'vw_furniture_carpenter_resp_slider_hide_show',false);
	if($vw_furniture_carpenter_resp_slider == true && get_theme_mod( 'vw_furniture_carpenter_slider_hide_show', false) == false){
    	$vw_furniture_carpenter_custom_css .='#slider{';
			$vw_furniture_carpenter_custom_css .='display:none;';
		$vw_furniture_carpenter_custom_css .='} ';
	}
    if($vw_furniture_carpenter_resp_slider == true){
    	$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px) {';
		$vw_furniture_carpenter_custom_css .='#slider{';
			$vw_furniture_carpenter_custom_css .='display:block;';
		$vw_furniture_carpenter_custom_css .='} }';
	}else if($vw_furniture_carpenter_resp_slider == false){
		$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px) {';
		$vw_furniture_carpenter_custom_css .='#slider{';
			$vw_furniture_carpenter_custom_css .='display:none;';
		$vw_furniture_carpenter_custom_css .='} }';
	}

	$vw_furniture_carpenter_resp_metabox = get_theme_mod( 'vw_furniture_carpenter_metabox_hide_show',true);
    if($vw_furniture_carpenter_resp_metabox == true){
    	$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px) {';
		$vw_furniture_carpenter_custom_css .='.post-info{';
			$vw_furniture_carpenter_custom_css .='display:block;';
		$vw_furniture_carpenter_custom_css .='} }';
	}else if($vw_furniture_carpenter_resp_metabox == false){
		$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px) {';
		$vw_furniture_carpenter_custom_css .='.post-info{';
			$vw_furniture_carpenter_custom_css .='display:none;';
		$vw_furniture_carpenter_custom_css .='} }';
	}

	$vw_furniture_carpenter_resp_sidebar = get_theme_mod( 'vw_furniture_carpenter_sidebar_hide_show',true);
    if($vw_furniture_carpenter_resp_sidebar == true){
    	$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px) {';
		$vw_furniture_carpenter_custom_css .='#sidebar{';
			$vw_furniture_carpenter_custom_css .='display:block;';
		$vw_furniture_carpenter_custom_css .='} }';
	}else if($vw_furniture_carpenter_resp_sidebar == false){
		$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px) {';
		$vw_furniture_carpenter_custom_css .='#sidebar{';
			$vw_furniture_carpenter_custom_css .='display:none;';
		$vw_furniture_carpenter_custom_css .='} }';
	}

	$vw_furniture_carpenter_resp_scroll_top = get_theme_mod( 'vw_furniture_carpenter_resp_scroll_top_hide_show',true);
	if($vw_furniture_carpenter_resp_scroll_top == true && get_theme_mod( 'vw_furniture_carpenter_hide_show_scroll',true) != true){
    	$vw_furniture_carpenter_custom_css .='.scrollup i{';
			$vw_furniture_carpenter_custom_css .='visibility:hidden !important;';
		$vw_furniture_carpenter_custom_css .='} ';
	}
    if($vw_furniture_carpenter_resp_scroll_top == true){
    	$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px) {';
		$vw_furniture_carpenter_custom_css .='.scrollup i{';
			$vw_furniture_carpenter_custom_css .='visibility:visible !important;';
		$vw_furniture_carpenter_custom_css .='} }';
	}else if($vw_furniture_carpenter_resp_scroll_top == false){
		$vw_furniture_carpenter_custom_css .='@media screen and (max-width:575px){';
		$vw_furniture_carpenter_custom_css .='.scrollup i{';
			$vw_furniture_carpenter_custom_css .='visibility:hidden !important;';
		$vw_furniture_carpenter_custom_css .='} }';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$vw_furniture_carpenter_sticky_header_padding = get_theme_mod('vw_furniture_carpenter_sticky_header_padding');
	if($vw_furniture_carpenter_sticky_header_padding != false){
		$vw_furniture_carpenter_custom_css .='.page-template-custom-home-page .header-fixed, .header-fixed{';
			$vw_furniture_carpenter_custom_css .='padding: '.esc_attr($vw_furniture_carpenter_sticky_header_padding).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*------------------ Search Settings -----------------*/
	
	$vw_furniture_carpenter_search_padding_top_bottom = get_theme_mod('vw_furniture_carpenter_search_padding_top_bottom');
	$vw_furniture_carpenter_search_padding_left_right = get_theme_mod('vw_furniture_carpenter_search_padding_left_right');
	$vw_furniture_carpenter_search_font_size = get_theme_mod('vw_furniture_carpenter_search_font_size');
	$vw_furniture_carpenter_search_border_radius = get_theme_mod('vw_furniture_carpenter_search_border_radius');
	if($vw_furniture_carpenter_search_padding_top_bottom != false || $vw_furniture_carpenter_search_padding_left_right != false || $vw_furniture_carpenter_search_font_size != false || $vw_furniture_carpenter_search_border_radius != false){
		$vw_furniture_carpenter_custom_css .='.search-box i{';
			$vw_furniture_carpenter_custom_css .='padding-top: '.esc_attr($vw_furniture_carpenter_search_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_furniture_carpenter_search_padding_top_bottom).';padding-left: '.esc_attr($vw_furniture_carpenter_search_padding_left_right).';padding-right: '.esc_attr($vw_furniture_carpenter_search_padding_left_right).';font-size: '.esc_attr($vw_furniture_carpenter_search_font_size).';border-radius: '.esc_attr($vw_furniture_carpenter_search_border_radius).'px;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_furniture_carpenter_button_padding_top_bottom = get_theme_mod('vw_furniture_carpenter_button_padding_top_bottom');
	$vw_furniture_carpenter_button_padding_left_right = get_theme_mod('vw_furniture_carpenter_button_padding_left_right');
	if($vw_furniture_carpenter_button_padding_top_bottom != false || $vw_furniture_carpenter_button_padding_left_right != false){
		$vw_furniture_carpenter_custom_css .='.post-main-box .view-more{';
			$vw_furniture_carpenter_custom_css .='padding-top: '.esc_attr($vw_furniture_carpenter_button_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_furniture_carpenter_button_padding_top_bottom).';padding-left: '.esc_attr($vw_furniture_carpenter_button_padding_left_right).';padding-right: '.esc_attr($vw_furniture_carpenter_button_padding_left_right).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_button_border_radius = get_theme_mod('vw_furniture_carpenter_button_border_radius');
	if($vw_furniture_carpenter_button_border_radius != false){
		$vw_furniture_carpenter_custom_css .='.post-main-box .view-more,.view-more i{';
			$vw_furniture_carpenter_custom_css .='border-radius: '.esc_attr($vw_furniture_carpenter_button_border_radius).'px;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*------------- Single Blog Page------------------*/

	$vw_furniture_carpenter_single_blog_post_navigation_show_hide = get_theme_mod('vw_furniture_carpenter_single_blog_post_navigation_show_hide',true);
	if($vw_furniture_carpenter_single_blog_post_navigation_show_hide != true){
		$vw_furniture_carpenter_custom_css .='.post-navigation{';
			$vw_furniture_carpenter_custom_css .='display: none;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_furniture_carpenter_copyright_alingment = get_theme_mod('vw_furniture_carpenter_copyright_alingment');
	if($vw_furniture_carpenter_copyright_alingment != false){
		$vw_furniture_carpenter_custom_css .='.copyright p{';
			$vw_furniture_carpenter_custom_css .='text-align: '.esc_attr($vw_furniture_carpenter_copyright_alingment).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_copyright_padding_top_bottom = get_theme_mod('vw_furniture_carpenter_copyright_padding_top_bottom');
	if($vw_furniture_carpenter_copyright_padding_top_bottom != false){
		$vw_furniture_carpenter_custom_css .='#footer-2{';
			$vw_furniture_carpenter_custom_css .='padding-top: '.esc_attr($vw_furniture_carpenter_copyright_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_furniture_carpenter_copyright_padding_top_bottom).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*----------------Sroll to top Settings ------------------*/

	$vw_furniture_carpenter_scroll_to_top_font_size = get_theme_mod('vw_furniture_carpenter_scroll_to_top_font_size');
	if($vw_furniture_carpenter_scroll_to_top_font_size != false){
		$vw_furniture_carpenter_custom_css .='.scrollup i{';
			$vw_furniture_carpenter_custom_css .='font-size: '.esc_attr($vw_furniture_carpenter_scroll_to_top_font_size).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_scroll_to_top_padding = get_theme_mod('vw_furniture_carpenter_scroll_to_top_padding');
	$vw_furniture_carpenter_scroll_to_top_padding = get_theme_mod('vw_furniture_carpenter_scroll_to_top_padding');
	if($vw_furniture_carpenter_scroll_to_top_padding != false){
		$vw_furniture_carpenter_custom_css .='.scrollup i{';
			$vw_furniture_carpenter_custom_css .='padding-top: '.esc_attr($vw_furniture_carpenter_scroll_to_top_padding).';padding-bottom: '.esc_attr($vw_furniture_carpenter_scroll_to_top_padding).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_scroll_to_top_width = get_theme_mod('vw_furniture_carpenter_scroll_to_top_width');
	if($vw_furniture_carpenter_scroll_to_top_width != false){
		$vw_furniture_carpenter_custom_css .='.scrollup i{';
			$vw_furniture_carpenter_custom_css .='width: '.esc_attr($vw_furniture_carpenter_scroll_to_top_width).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_scroll_to_top_height = get_theme_mod('vw_furniture_carpenter_scroll_to_top_height');
	if($vw_furniture_carpenter_scroll_to_top_height != false){
		$vw_furniture_carpenter_custom_css .='.scrollup i{';
			$vw_furniture_carpenter_custom_css .='height: '.esc_attr($vw_furniture_carpenter_scroll_to_top_height).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_scroll_to_top_border_radius = get_theme_mod('vw_furniture_carpenter_scroll_to_top_border_radius');
	if($vw_furniture_carpenter_scroll_to_top_border_radius != false){
		$vw_furniture_carpenter_custom_css .='.scrollup i{';
			$vw_furniture_carpenter_custom_css .='border-radius: '.esc_attr($vw_furniture_carpenter_scroll_to_top_border_radius).'px;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$vw_furniture_carpenter_social_icon_font_size = get_theme_mod('vw_furniture_carpenter_social_icon_font_size');
	if($vw_furniture_carpenter_social_icon_font_size != false){
		$vw_furniture_carpenter_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_furniture_carpenter_custom_css .='font-size: '.esc_attr($vw_furniture_carpenter_social_icon_font_size).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_social_icon_padding = get_theme_mod('vw_furniture_carpenter_social_icon_padding');
	if($vw_furniture_carpenter_social_icon_padding != false){
		$vw_furniture_carpenter_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_furniture_carpenter_custom_css .='padding: '.esc_attr($vw_furniture_carpenter_social_icon_padding).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_social_icon_width = get_theme_mod('vw_furniture_carpenter_social_icon_width');
	if($vw_furniture_carpenter_social_icon_width != false){
		$vw_furniture_carpenter_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_furniture_carpenter_custom_css .='width: '.esc_attr($vw_furniture_carpenter_social_icon_width).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_social_icon_height = get_theme_mod('vw_furniture_carpenter_social_icon_height');
	if($vw_furniture_carpenter_social_icon_height != false){
		$vw_furniture_carpenter_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_furniture_carpenter_custom_css .='height: '.esc_attr($vw_furniture_carpenter_social_icon_height).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_social_icon_border_radius = get_theme_mod('vw_furniture_carpenter_social_icon_border_radius');
	if($vw_furniture_carpenter_social_icon_border_radius != false){
		$vw_furniture_carpenter_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_furniture_carpenter_custom_css .='border-radius: '.esc_attr($vw_furniture_carpenter_social_icon_border_radius).'px;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$vw_furniture_carpenter_products_padding_top_bottom = get_theme_mod('vw_furniture_carpenter_products_padding_top_bottom');
	if($vw_furniture_carpenter_products_padding_top_bottom != false){
		$vw_furniture_carpenter_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_furniture_carpenter_custom_css .='padding-top: '.esc_attr($vw_furniture_carpenter_products_padding_top_bottom).'!important; padding-bottom: '.esc_attr($vw_furniture_carpenter_products_padding_top_bottom).'!important;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_products_padding_left_right = get_theme_mod('vw_furniture_carpenter_products_padding_left_right');
	if($vw_furniture_carpenter_products_padding_left_right != false){
		$vw_furniture_carpenter_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_furniture_carpenter_custom_css .='padding-left: '.esc_attr($vw_furniture_carpenter_products_padding_left_right).'!important; padding-right: '.esc_attr($vw_furniture_carpenter_products_padding_left_right).'!important;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_products_box_shadow = get_theme_mod('vw_furniture_carpenter_products_box_shadow');
	if($vw_furniture_carpenter_products_box_shadow != false){
		$vw_furniture_carpenter_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$vw_furniture_carpenter_custom_css .='box-shadow: '.esc_attr($vw_furniture_carpenter_products_box_shadow).'px '.esc_attr($vw_furniture_carpenter_products_box_shadow).'px '.esc_attr($vw_furniture_carpenter_products_box_shadow).'px #ddd;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_products_border_radius = get_theme_mod('vw_furniture_carpenter_products_border_radius');
	if($vw_furniture_carpenter_products_border_radius != false){
		$vw_furniture_carpenter_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_furniture_carpenter_custom_css .='border-radius: '.esc_attr($vw_furniture_carpenter_products_border_radius).'px;';
		$vw_furniture_carpenter_custom_css .='}';
	}

	/*------------------ Preloader Background Color  -------------------*/

	$vw_furniture_carpenter_preloader_bg_color = get_theme_mod('vw_furniture_carpenter_preloader_bg_color');
	if($vw_furniture_carpenter_preloader_bg_color != false){
		$vw_furniture_carpenter_custom_css .='#preloader{';
			$vw_furniture_carpenter_custom_css .='background-color: '.esc_attr($vw_furniture_carpenter_preloader_bg_color).';';
		$vw_furniture_carpenter_custom_css .='}';
	}

	$vw_furniture_carpenter_preloader_border_color = get_theme_mod('vw_furniture_carpenter_preloader_border_color');
	if($vw_furniture_carpenter_preloader_border_color != false){
		$vw_furniture_carpenter_custom_css .='.loader-line{';
			$vw_furniture_carpenter_custom_css .='border-color: '.esc_attr($vw_furniture_carpenter_preloader_border_color).'!important;';
		$vw_furniture_carpenter_custom_css .='}';
	}