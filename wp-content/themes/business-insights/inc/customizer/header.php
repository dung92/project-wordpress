<?php
/**
 * Header section
 *
 * @package Business Insights
 */

$default = business_insights_get_default_theme_options();

// Header Main Section.
$wp_customize->add_section('header_section_settings',
	array(
		'title'      => esc_html__('Header Options', 'business-insights'),
		'priority'   => 5,
		'capability' => 'edit_theme_options',
		'panel'      => 'front_page_option_panel',
	)
);

// Setting - move_logo_to_center.
$wp_customize->add_setting('move_logo_to_center',
	array(
		'default'           => $default['move_logo_to_center'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control('move_logo_to_center',
	array(
		'label'    => esc_html__('Move Logo To Center', 'business-insights'),
		'section'  => 'header_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - top_header_telephone.
$wp_customize->add_setting( 'top_header_telephone',
	array(
		'default'           => $default['top_header_telephone'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'top_header_telephone',
	array(
		'label'    => esc_html__( 'Contact Number', 'business-insights' ),
		'section'  => 'header_section_settings',
		'type'     => 'text',
		'priority' => 110,

	)
);

// Setting - top_header_email.
$wp_customize->add_setting( 'top_header_email',
	array(
		'default'           => $default['top_header_email'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_email',
	)
);
$wp_customize->add_control( 'top_header_email',
	array(
		'label'    => esc_html__( 'Email Address', 'business-insights' ),
		'section'  => 'header_section_settings',
		'type'     => 'text',
		'priority' => 120,

	)
);

// Setting - top_header_location.
$wp_customize->add_setting( 'top_header_location',
	array(
		'default'           => $default['top_header_location'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'top_header_location',
	array(
		'label'    => esc_html__( 'Location', 'business-insights' ),
		'section'  => 'header_section_settings',
		'type'     => 'text',
		'priority' => 130,

	)
);


// Setting - show-header-enable_search_option.
$wp_customize->add_setting( 'enable_search_option',
	array(
		'default'           => $default['enable_search_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_search_option',
	array(
		'label'    => __( 'Enable Search on Menu', 'business-insights' ),
		'section'  => 'header_section_settings',
		'type'     => 'checkbox',
		'priority' => 190,
	)
);

/*Hheader Layout*/
$wp_customize->add_setting('enable_overlay_option',
	array(
		'default'           => $default['enable_overlay_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_overlay_option',
	array(
		'label'    => esc_html__('Enable Inner Header Banner Overlay', 'business-insights'),
		'section'  => 'header_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);