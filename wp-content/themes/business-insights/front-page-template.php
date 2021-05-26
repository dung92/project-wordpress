<?php
/**
* Template Name: Home Page Template
*
* @package themeinwp
* @subpackage Business_Insights
* @since Business Insights 1.0.1
*/   

get_header();
	do_action('business_insights_action_slider_post');
	do_action('business_insights_action_front_page_intro');
	do_action('business_insights_action_front_page_testimonial');
	do_action('business_insights_action_process_Section');
	do_action('business_insights_action_front_page_callback');
	do_action('business_insights_action_front_page_blog');
	do_action('business_insights_action_front_page_contact');

get_footer();

	