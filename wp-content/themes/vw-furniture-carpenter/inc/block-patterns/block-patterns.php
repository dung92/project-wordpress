<?php
/**
 * Vw Furniture Carpenter: Block Patterns
 *
 * @package Vw Furniture Carpenter
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'vw-furniture-carpenter',
		array( 'label' => __( 'Vw Furniture Carpenter', 'vw-furniture-carpenter' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'vw-furniture-carpenter/banner-section',
		array(
			'title'      => __( 'Silder Section', 'vw-furniture-carpenter' ),
			'categories' => array( 'vw-furniture-carpenter' ),
			'content'    => "<!-- wp:cover {\"url\":\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/slider.png\",\"id\":1237,\"dimRatio\":10,\"align\":\"full\",\"className\":\"sliderbox\"} -->\n<div class=\"wp-block-cover alignfull has-background-dim-10 has-background-dim sliderbox\" style=\"background-image:url(" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/slider.png)\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"full\"} -->\n<div class=\"wp-block-columns alignfull\"><!-- wp:column {\"className\":\"sliderbox-content m-0\"} -->\n<div class=\"wp-block-column sliderbox-content m-0\"><!-- wp:heading {\"textAlign\":\"left\",\"level\":1,\"textColor\":\"white\",\"style\":{\"typography\":{\"fontSize\":45}}} -->\n<h1 class=\"has-text-align-left has-white-color has-text-color\" style=\"font-size:45px\">LOREM IPSUM IS SIMPLY DUMMY TEXT 1</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"fontSize\":\"normal\"} -->\n<p class=\"has-normal-font-size\">Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons {\"align\":\"left\"} -->\n<div class=\"wp-block-buttons alignleft\"><!-- wp:button {\"borderRadius\":30,\"textColor\":\"white\",\"className\":\"is-style-fill\"} -->\n<div class=\"wp-block-button is-style-fill\"><a class=\"wp-block-button__link has-white-color has-text-color\" style=\"border-radius:30px\">Read More</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'vw-furniture-carpenter/contact-section',
		array(
			'title'      => __( 'Contact Section', 'vw-furniture-carpenter' ),
			'categories' => array( 'vw-furniture-carpenter' ),
			'content'    => "<!-- wp:cover {\"overlayColor\":\"white\",\"minHeight\":20,\"align\":\"full\",\"className\":\"contact-details m-0 p-0\"} -->\n<div class=\"wp-block-cover alignfull has-white-background-color has-background-dim contact-details m-0 p-0\" style=\"min-height:20px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"full\",\"className\":\"mb-0 mx-2\"} -->\n<div class=\"wp-block-columns alignfull mb-0 mx-2\"><!-- wp:column {\"className\":\"services-col mb-0\"} -->\n<div class=\"wp-block-column services-col mb-0\"><!-- wp:columns {\"className\":\"mb-0\"} -->\n<div class=\"wp-block-columns mb-0\"><!-- wp:column {\"className\":\"styling-box mb-0\"} -->\n<div class=\"wp-block-column styling-box mb-0\"><!-- wp:columns {\"className\":\"mb-0\"} -->\n<div class=\"wp-block-columns mb-0\"><!-- wp:column {\"width\":\"33.33%\",\"className\":\"mb-0\"} -->\n<div class=\"wp-block-column mb-0\" style=\"flex-basis:33.33%\"><!-- wp:image {\"align\":\"center\",\"id\":858,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"mt-3 mb-0\"} -->\n<div class=\"wp-block-image mt-3 mb-0\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/phone.png\" alt=\"\" class=\"wp-image-858\"/></figure></div>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":\"66.66%\",\"className\":\"ml-0 mb-0\"} -->\n<div class=\"wp-block-column ml-0 mb-0\" style=\"flex-basis:66.66%\"><!-- wp:heading {\"className\":\"mt-3 mb-1\",\"textColor\":\"black\",\"style\":{\"typography\":{\"fontSize\":15}}} -->\n<h2 class=\"mt-3 mb-1 has-black-color has-text-color\" style=\"font-size:15px\">Phone</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"className\":\"mb-0\",\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#a7a9ac\"}}} -->\n<p class=\"mb-0 has-text-color\" style=\"color:#a7a9ac;font-size:14px\">123456789</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"styling-box mb-0\"} -->\n<div class=\"wp-block-column styling-box mb-0\"><!-- wp:columns {\"className\":\"mb-0\"} -->\n<div class=\"wp-block-columns mb-0\"><!-- wp:column {\"width\":\"33.33%\",\"className\":\"mb-0\"} -->\n<div class=\"wp-block-column mb-0\" style=\"flex-basis:33.33%\"><!-- wp:image {\"align\":\"center\",\"id\":865,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"mt-3 mb-0\"} -->\n<div class=\"wp-block-image mt-3 mb-0\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/envelope.png\" alt=\"\" class=\"wp-image-865\"/></figure></div>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":\"66.66%\",\"className\":\"ml-0 mb-0\"} -->\n<div class=\"wp-block-column ml-0 mb-0\" style=\"flex-basis:66.66%\"><!-- wp:heading {\"className\":\"mt-3 mb-1\",\"textColor\":\"black\",\"style\":{\"typography\":{\"fontSize\":15}}} -->\n<h2 class=\"mt-3 mb-1 has-black-color has-text-color\" style=\"font-size:15px\">Email Address</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"className\":\"mb-0\",\"style\":{\"typography\":{\"fontSize\":14},\"color\":{\"text\":\"#a7a9ac\"}}} -->\n<p class=\"mb-0 has-text-color\" style=\"color:#a7a9ac;font-size:14px\">xyz@gmail.com</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"services-col mb-0\"} -->\n<div class=\"wp-block-column services-col mb-0\"><!-- wp:columns {\"className\":\"mb-0\"} -->\n<div class=\"wp-block-columns mb-0\"><!-- wp:column {\"width\":\"33.33%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"align\":\"center\",\"id\":882,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"mt-3 mb-0\"} -->\n<div class=\"wp-block-image mt-3 mb-0\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/shopping-basket.png\" alt=\"\" class=\"wp-image-882\"/></figure></div>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":\"66.66%\"} -->\n<div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:cover {\"customOverlayColor\":\"#c28851\",\"minHeight\":70,\"className\":\"p-0\"} -->\n<div class=\"wp-block-cover has-background-dim p-0\" style=\"background-color:#c28851;min-height:70px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:paragraph {\"align\":\"center\",\"className\":\"text-center m-0\",\"fontSize\":\"normal\"} -->\n<p class=\"has-text-align-center text-center m-0 has-normal-font-size\"><strong>GET A QUOTE</strong></p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'vw-furniture-carpenter/services-section',
		array(
			'title'      => __( 'Services Section', 'vw-furniture-carpenter' ),
			'categories' => array( 'vw-furniture-carpenter' ),
			'content'    => "<!-- wp:cover {\"customOverlayColor\":\"#f2f3f4\",\"minHeight\":100,\"align\":\"full\",\"className\":\"services-section mb-3\"} -->\n<div class=\"wp-block-cover alignfull has-background-dim services-section mb-3\" style=\"background-color:#f2f3f4;min-height:100px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:group {\"align\":\"wide\",\"className\":\"services-content\"} -->\n<div class=\"wp-block-group alignwide services-content\"><div class=\"wp-block-group__inner-container\"><!-- wp:group {\"align\":\"wide\",\"className\":\"services-content\"} -->\n<div class=\"wp-block-group alignwide services-content\"><div class=\"wp-block-group__inner-container\"><!-- wp:group {\"align\":\"wide\",\"className\":\"services-content m-0\"} -->\n<div class=\"wp-block-group alignwide services-content m-0\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"textAlign\":\"left\",\"align\":\"wide\",\"className\":\"mb-5 ml-md-5 pl-md-5 ml-2 pl-2\",\"textColor\":\"black\"} -->\n<h2 class=\"alignwide has-text-align-left mb-5 ml-md-5 pl-md-5 ml-2 pl-2 has-black-color has-text-color\">WHAT WE DO</h2>\n<!-- /wp:heading -->\n\n<!-- wp:columns {\"align\":\"wide\",\"className\":\"mt-5 mx-md-5 px-md-5 mx-0 px-0\"} -->\n<div class=\"wp-block-columns alignwide mt-5 mx-md-5 px-md-5 mx-0 px-0\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"overlayColor\":\"white\",\"minHeight\":50,\"className\":\"services-box my-3\"} -->\n<div class=\"wp-block-cover has-white-background-color has-background-dim services-box my-3\" style=\"min-height:50px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":955,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"services-img\"} -->\n<div class=\"wp-block-image services-img\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/servicesicon1.png\" alt=\"\" class=\"wp-image-955\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"className\":\"mb-2\",\"textColor\":\"black\",\"fontSize\":\"normal\"} -->\n<h4 class=\"has-text-align-center mb-2 has-black-color has-text-color has-normal-font-size\"><strong>SERVICES TITLE</strong></h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"className\":\"text-center\",\"style\":{\"color\":{\"text\":\"#a7a9ac\"},\"typography\":{\"fontSize\":14}}} -->\n<p class=\"has-text-align-center text-center has-text-color\" id=\"services-box\" style=\"color:#a7a9ac;font-size:14px\">Lorem Ipsum&nbsp;is simply dummy text of the printing</p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"overlayColor\":\"white\",\"minHeight\":50,\"className\":\"services-box my-3\"} -->\n<div class=\"wp-block-cover has-white-background-color has-background-dim services-box my-3\" style=\"min-height:50px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":1014,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"services-img\"} -->\n<div class=\"wp-block-image services-img\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/servicesicon2.png\" alt=\"\" class=\"wp-image-1014\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"className\":\"mb-2\",\"textColor\":\"black\",\"fontSize\":\"normal\"} -->\n<h4 class=\"has-text-align-center mb-2 has-black-color has-text-color has-normal-font-size\"><strong>SERVICES TITLE</strong></h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"className\":\"text-center\",\"style\":{\"color\":{\"text\":\"#a7a9ac\"},\"typography\":{\"fontSize\":14}}} -->\n<p class=\"has-text-align-center text-center has-text-color\" id=\"services-box\" style=\"color:#a7a9ac;font-size:14px\">Lorem Ipsum&nbsp;is simply dummy text of the printing  </p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"overlayColor\":\"white\",\"minHeight\":50,\"className\":\"services-box my-3\"} -->\n<div class=\"wp-block-cover has-white-background-color has-background-dim services-box my-3\" style=\"min-height:50px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":1016,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"services-img\"} -->\n<div class=\"wp-block-image services-img\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/servicesicon3.png\" alt=\"\" class=\"wp-image-1016\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"className\":\"mb-2\",\"textColor\":\"black\",\"fontSize\":\"normal\"} -->\n<h4 class=\"has-text-align-center mb-2 has-black-color has-text-color has-normal-font-size\"><strong>SERVICES TITLE</strong></h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"className\":\"text-center\",\"style\":{\"color\":{\"text\":\"#a7a9ac\"},\"typography\":{\"fontSize\":14}}} -->\n<p class=\"has-text-align-center text-center has-text-color\" id=\"services-box\" style=\"color:#a7a9ac;font-size:14px\">Lorem Ipsum&nbsp;is simply dummy text of the printing  </p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:cover {\"overlayColor\":\"white\",\"minHeight\":50,\"className\":\"services-box my-3\"} -->\n<div class=\"wp-block-cover has-white-background-color has-background-dim services-box my-3\" style=\"min-height:50px\"><div class=\"wp-block-cover__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":1018,\"sizeSlug\":\"large\",\"linkDestination\":\"none\",\"className\":\"services-img\"} -->\n<div class=\"wp-block-image services-img\"><figure class=\"aligncenter size-large\"><img src=\"" . esc_url(get_template_directory_uri()) . "/inc/block-patterns/images/servicesicon4.png\" alt=\"\" class=\"wp-image-1018\"/></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"textAlign\":\"center\",\"level\":4,\"className\":\"mb-2\",\"textColor\":\"black\",\"fontSize\":\"normal\"} -->\n<h4 class=\"has-text-align-center mb-2 has-black-color has-text-color has-normal-font-size\"><strong>SERVICES TITLE</strong></h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"className\":\"text-center\",\"style\":{\"color\":{\"text\":\"#a7a9ac\"},\"typography\":{\"fontSize\":14}}} -->\n<p class=\"has-text-align-center text-center has-text-color\" id=\"services-box\" style=\"color:#a7a9ac;font-size:14px\">Lorem Ipsum&nbsp;is simply dummy text of the printing  </p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:cover --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:paragraph -->\n<p></p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group --></div></div>\n<!-- /wp:group --></div></div>\n<!-- /wp:group --></div></div>\n<!-- /wp:cover -->",
		)
	);
}