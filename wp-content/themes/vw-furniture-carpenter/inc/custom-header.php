<?php
/**
 * @package VW Furniture Carpenter
 * Setup the WordPress core custom header feature.
 *
 * @uses vw_furniture_carpenter_header_style()
*/
function vw_furniture_carpenter_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'vw_furniture_carpenter_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 72,
		'flex-width'             => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'vw_furniture_carpenter_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'vw_furniture_carpenter_custom_header_setup' );

if ( ! function_exists( 'vw_furniture_carpenter_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see vw_furniture_carpenter_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'vw_furniture_carpenter_header_style' );
function vw_furniture_carpenter_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$custom_css = "
        .home-page-header,.page-template-custom-home-page .inner-header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'vw-furniture-carpenter-basic-style', $custom_css );
	endif;
}
endif;