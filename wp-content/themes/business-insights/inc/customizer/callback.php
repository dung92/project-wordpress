<?php
/**
 * callback section
 *
 * @package business-insights
 */

$default = business_insights_get_default_theme_options();
/*callback section*/
// our callback Main Section.
$wp_customize->add_section( 'callback_section_settings',
	array(
		'title'      => esc_html__( 'Callback Section', 'business-insights' ),
		'priority'   => 70,
		'capability' => 'edit_theme_options',
		'panel'      => 'front_page_option_panel',
	)
);

// Setting - .
$wp_customize->add_setting( 'show_our_callback_section',
	array(
		'default'           => $default['show_our_callback_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_our_callback_section',
	array(
		'label'    => esc_html__( 'Enable Callback Section', 'business-insights' ),
		'section'  => 'callback_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting('enable_calback_overlay',
	array(
		'default'           => $default['enable_calback_overlay'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_calback_overlay',
	array(
		'label'    => esc_html__('Enable Calback Overlay', 'business-insights'),
		'section'  => 'callback_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);
/*Home Page Layout*/
$wp_customize->add_setting('calback_layout_option',
	array(
		'default'           => $default['calback_layout_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_select',
	)
);
$wp_customize->add_control('calback_layout_option',
	array(
		'label'       => esc_html__('Select Text Alignment', 'business-insights'),
		'section'     => 'callback_section_settings',
		'choices'     => array(
			'center' => esc_html__('Center', 'business-insights'),
			'left'      => esc_html__('Left', 'business-insights'),
			'right'      => esc_html__('Right', 'business-insights'),
		),
		'type'     => 'select',
		'priority' => 160,
	)
);
// Setting - show-callback-section.
$wp_customize->add_setting( 'select_callback_page',
	array(
		'default'           => $default['select_callback_page'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_dropdown_pages',
	)
);
$wp_customize->add_control( 'select_callback_page',
	array(
		'label'    => esc_html__( 'Select Callback Page', 'business-insights' ),
		'section'  => 'callback_section_settings',
		'type'     => 'dropdown-pages',
		'priority' => 130,
	)
);

/*content excerpt in callback*/
$wp_customize->add_setting( 'number_of_content_home_callback',
	array(
		'default'           => $default['number_of_content_home_callback'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_content_home_callback',
	array(
		'label'    => __( 'Select no words of Callback', 'business-insights' ),
		'section'  => 'callback_section_settings',
		'type'     => 'number',
		'priority' => 130,
		'input_attrs'     => array( 'min' => 1, 'max' => 500, 'style' => 'width: 150px;' ),

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
		'section'  => 'callback_section_settings',
		'type'     => 'checkbox',
		'priority' => 140,
	)
);



/*button text*/
$wp_customize->add_setting( 'callback_button_text',
	array(
		'default'           => $default['callback_button_text'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'callback_button_text',
	array(
		'label'    		=> __( 'Callback Button Text', 'business-insights' ),
		'description'	=> __( 'Removing the text from this section will disable the custom button on callback section', 'business-insights' ),
		'section'  		=> 'callback_section_settings',
		'type'     		=> 'text',
		'priority' 		=> 150,
	)
);

/*button url*/
$wp_customize->add_setting( 'callback_button_link',
	array(
		'default'           => $default['callback_button_link'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control( 'callback_button_link',
	array(
		'label'    		=> __( 'URL Link', 'business-insights' ),
		'section'  		=> 'callback_section_settings',
		'type'     		=> 'text',
		'priority' 		=> 160,
	)
);