<?php
/**
 * intro section
 *
 * @package business-insights
 */

$default = business_insights_get_default_theme_options();
/*intro section*/
// our intro Main Section.
$wp_customize->add_section( 'intro_section_settings',
	array(
		'title'      => esc_html__( 'Intro Section', 'business-insights' ),
		'priority'   => 50,
		'capability' => 'edit_theme_options',
		'panel'      => 'front_page_option_panel',
	)
);

// Setting - .
$wp_customize->add_setting( 'show_our_intro_section',
	array(
		'default'           => $default['show_our_intro_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_our_intro_section',
	array(
		'label'    => esc_html__( 'Enable Intro Section', 'business-insights' ),
		'section'  => 'intro_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - show-intro-section.
$wp_customize->add_setting( 'select_intro_page',
	array(
		'default'           => $default['select_intro_page'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_dropdown_pages',
	)
);
$wp_customize->add_control( 'select_intro_page',
	array(
		'label'    => esc_html__( 'Select Intro Page', 'business-insights' ),
		'section'  => 'intro_section_settings',
		'type'     => 'dropdown-pages',
		'priority' => 130,
	)
);



/*content excerpt in intro*/
$wp_customize->add_setting( 'number_of_content_home_intro',
	array(
		'default'           => $default['number_of_content_home_intro'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_content_home_intro',
	array(
		'label'    => __( 'Select no words of Intro', 'business-insights' ),
		'section'  => 'intro_section_settings',
		'type'     => 'number',
		'priority' => 130,
		'input_attrs'     => array( 'min' => 1, 'max' => 500, 'style' => 'width: 150px;' ),

	)
);


// Setting - .
$wp_customize->add_setting( 'align_image_intro_section',
	array(
		'default'           => $default['align_image_intro_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_select',
	)
);
$wp_customize->add_control( 'align_image_intro_section',
	array(
		'label'    => esc_html__( 'Switch Image Position', 'business-insights' ),
		'section'  => 'intro_section_settings',
		'type'     => 'select',
		'choices'     => array(
			'img-right'          => esc_html__('Right', 'business-insights'),
			'img-left'          => esc_html__('Left', 'business-insights'),
		),
		'priority' => 130,
	)
);


// Setting .
$wp_customize->add_setting( 'show_page_link_button',
	array(
		'default'           => $default['show_page_link_button'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_page_link_button',
	array(
		'label'    => esc_html__( 'Enable Page Link Button', 'business-insights' ),
		'section'  => 'intro_section_settings',
		'type'     => 'checkbox',
		'priority' => 140,
	)
);



/*button text*/
$wp_customize->add_setting( 'intro_button_text',
	array(
		'default'           => $default['intro_button_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'intro_button_text',
	array(
		'label'    		=> __( 'Intro Button Text', 'business-insights' ),
		'description'	=> __( 'Removing the text from this section will disable the custom button on Intro section', 'business-insights' ),
		'section'  		=> 'intro_section_settings',
		'type'     		=> 'text',
		'priority' 		=> 150,
	)
);

/*button url*/
$wp_customize->add_setting( 'intro_button_link',
	array(
		'default'           => $default['intro_button_link'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( 'intro_button_link',
	array(
		'label'    		=> __( 'URL Link', 'business-insights' ),
		'section'  		=> 'intro_section_settings',
		'type'     		=> 'text',
		'priority' 		=> 160,
	)
);