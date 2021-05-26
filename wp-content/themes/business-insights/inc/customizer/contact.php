<?php
/**
 * contact section
 *
 * @package business-insights
 */

$default = business_insights_get_default_theme_options();

// Contact Main Section.
$wp_customize->add_section( 'contact_section_settings',
	array(
		'title'      => esc_html__( 'Contact Section', 'business-insights' ),
		'priority'   => 80,
		'capability' => 'edit_theme_options',
		'panel'      => 'front_page_option_panel',
	)
);


// Setting - show_contact_section.
$wp_customize->add_setting( 'show_contact_section',
	array(
		'default'           => $default['show_contact_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_contact_section',
	array(
		'label'    => esc_html__( 'Enable Contact', 'business-insights' ),
		'section'  => 'contact_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);


// Setting - show_top_contact_details.
$wp_customize->add_setting( 'show_top_contact_details',
	array(
		'default'           => $default['show_top_contact_details'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_contact_details',
	array(
		'label'    => esc_html__( 'Enable Contact Details', 'business-insights' ),
		'description'     => esc_html__( 'Show the contact details form the top header section', 'business-insights'),
		'section'  => 'contact_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);


// Setting - show_social_nav.
$wp_customize->add_setting( 'show_social_nav',
	array(
		'default'           => $default['show_social_nav'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_social_nav',
	array(
		'label'    => esc_html__( 'Enable Social Link', 'business-insights' ),
		'description'     => esc_html__( 'Show the social menu as like on top header', 'business-insights'),
		'section'  => 'contact_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);



// Setting - contact_page_select.
$wp_customize->add_setting( 'contact_page_select',
	array(
		'default'           => $default['contact_page_select'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_dropdown_pages',
	)
);
$wp_customize->add_control( 'contact_page_select',
	array(
		'label'    => esc_html__( 'Contact Section Page', 'business-insights' ),
		'section'  => 'contact_section_settings',
		'type'     => 'dropdown-pages',
		'priority' => 110,
	)
);


// Setting - contact_form_shortcode.
$wp_customize->add_setting( 'contact_form_shortcode',
	array(
		'default'           => $default['contact_form_shortcode'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'contact_form_shortcode',
	array(
		'label'    => esc_html__( 'Contact Form Shortcode', 'business-insights' ),
		'description'     => esc_html__( 'We Recomend you to use Contact Form 7', 'business-insights'),
		'section'  => 'contact_section_settings',
		'type'     => 'textarea',
		'priority' => 110,
	)
);

