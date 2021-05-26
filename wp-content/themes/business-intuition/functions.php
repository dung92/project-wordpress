<?php
/*
 * Business Intuition functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Business Intuition
*/

// Do not delete this
function business_intuition_scripts()
{
    wp_enqueue_style('business-insights', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'business_intuition_scripts', 20);


// Loads custom stylesheet and js for child. 
// This could override all stylesheets of parent theme and custom js functions
function business_intuition_custom_scripts()
{
    wp_enqueue_style('business-intuition', get_stylesheet_directory_uri() . '/assets/custom.css');

}

add_action('wp_enqueue_scripts', 'business_intuition_custom_scripts', 60);

if (!function_exists('business_insights_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function business_insights_get_default_theme_options() {

	$defaults = array();

		$defaults['site_title_font']				= 58;

		$defaults['move_logo_to_center']				= 0;
		$defaults['top_header_location']				= '';
		$defaults['top_header_telephone']				= '';
		$defaults['top_header_email']					= '';
		$defaults['enable_search_option']				= 1;
		
		// Slider Section.
		$defaults['show_slider_section']           = 1;
		$defaults['enable_slider_overlay']         = 0;
		$defaults['number_of_home_slider']         = 3;
		$defaults['align_image_intro_section']         = 'img-left';
		$defaults['number_of_content_home_slider'] = 20;
		$defaults['select_slider_from']            = 'from-category';
		$defaults['select-page-for-slider']			= 0;
		$defaults['select-page-for-slider']        = 0;
		$defaults['select_category_for_slider']    = 1;
		$defaults['slider_section_layout']         = 'twp-slider';
		$defaults['button_text_on_slider']         = esc_html__('Read More', 'business-intuition');



		/*process section*/
		$defaults['show_our_process_section']			= 0;
		$defaults['title_process_section']         = esc_html__('Our Process', 'business-intuition');
		$defaults['number_of_content_home_process']			= 20;
		$defaults['number_of_home_process_icon_1']			= '';
		$defaults['select_page_for_process__1']			= '';

		/*callback section*/
		$defaults['show_our_callback_section']			= 0;
		$defaults['calback_layout_option']			= 'center';
		$defaults['enable_calback_overlay']			= 1;
		$defaults['select_callback_page']				= 0;
		$defaults['number_of_content_home_callback']	= 30;
		$defaults['show_page_link_button']				= 1;
		$defaults['callback_button_text']				= esc_html__( 'Buy Now', 'business-intuition' );
		$defaults['callback_button_link']				= '';

		/*testimonial*/
		$defaults['show_latest_blog_section']			= 0;
		$defaults['title_latest_blog_section']			= esc_html__( 'Latest Blog', 'business-intuition' );
		$defaults['number_of_content_home_latest_blog']			= 25;
		$defaults['select_category_for_latest_blog']			= 1;



		$defaults['show_testimonial_section']			= 0;
		$defaults['enable_testimonial_overlay']			= 1;
		$defaults['testimonial_section_background_image']= '';
		$defaults['title_testimonial_section']			= esc_html__( 'What people say?', 'business-intuition' );
		$defaults['number_of_home_testimonial']			= 3;
		$defaults['number_of_content_home_testimonial']	= 30;
		$defaults['select_testimonial_from']			= 'from-category';
		$defaults['select_page_for_testimonial']		= 0;
		$defaults['select_category_for_testimonial']	= 1;

		/*contact section*/
		$defaults['show_contact_section']				= 0;
		$defaults['show_top_contact_details']			= 1;
		$defaults['show_social_nav']					= 1;
		$defaults['contact_page_select']				= 0;
		$defaults['contact_form_shortcode']				='';
		
		/*intro section*/
		$defaults['show_our_intro_section']			= 0;
		$defaults['select_intro_page']				= 0;
		$defaults['number_of_content_home_intro']	= 40;
		$defaults['show_page_link_button']				= 1;
		$defaults['intro_button_text']				= esc_html__( 'Contact US Now', 'business-intuition' );
		$defaults['intro_button_link']				= '';


        $defaults['primary_font'] = 'Montserrat:400,700';
        $defaults['secondary_font'] = 'Heebo:100,300,400,500,700,900';
        /*layout*/


		$defaults['enable_overlay_option']    = 1;
		$defaults['homepage_layout_option']   = 'full-width';
		$defaults['read_more_button_text']    = esc_html__('Continue Reading', 'business-intuition');
		$defaults['global_layout']            = 'no-sidebar';
		$defaults['excerpt_length_global']    = 50;
		$defaults['single_post_image_layout'] = 'full';
		$defaults['pagination_type']          = 'infinite_scroll_load';
		$defaults['copyright_text']           = esc_html__('Copyright All right reserved', 'business-intuition');
		$defaults['number_of_footer_widget']  = 3;
		$defaults['breadcrumb_type']          = 'simple';
		$defaults['enable_preloader']         = 0;

        // Pass through filter.
        $defaults = apply_filters('business_insights_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;
