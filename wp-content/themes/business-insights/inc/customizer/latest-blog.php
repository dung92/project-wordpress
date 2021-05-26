<?php
/**
 * latest blog section
 *
 * @package business-insights
 */

$default = business_insights_get_default_theme_options();

// latest_blog Main Section.
$wp_customize->add_section( 'latest_blog_section_settings',
	array(
		'title'      => __( 'Latest Blog Section', 'business-insights' ),
		'priority'   => 75,
		'capability' => 'edit_theme_options',
		'panel'      => 'front_page_option_panel',
	)
);


// Setting - show-section-latest_blog.
$wp_customize->add_setting( 'show_latest_blog_section',
	array(
		'default'           => $default['show_latest_blog_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_latest_blog_section',
	array(
		'label'    => __( 'Enable Latest Blog', 'business-insights' ),
		'section'  => 'latest_blog_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - title_latest_blog_section.
$wp_customize->add_setting( 'title_latest_blog_section',
	array(
		'default'           => $default['title_latest_blog_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'title_latest_blog_section',
	array(
		'label'    => __( 'Section Title', 'business-insights' ),
		'section'  => 'latest_blog_section_settings',
		'type'     => 'text',
		'priority' => 104,
	)
);

/*content excerpt in latest_blog*/
$wp_customize->add_setting( 'number_of_content_home_latest_blog',
	array(
		'default'           => $default['number_of_content_home_latest_blog'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_content_home_latest_blog',
	array(
		'label'    => __( 'Select no words for latest_blog', 'business-insights' ),
		'section'  => 'latest_blog_section_settings',
		'type'     => 'number',
		'priority' => 110,
		'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),

	)
);

// Setting - drop down category for latest_blog.
$wp_customize->add_setting( 'select_category_for_latest_blog',
	array(
		'default'           => $default['select_category_for_latest_blog'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Business_Insights_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_latest_blog',
	array(
        'label'           => __( 'Category for Latest Blog ', 'business-insights' ),
        'description'     => __( 'Select category to be shown on Latest Blog', 'business-insights' ),
        'section'         => 'latest_blog_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
    ) ) );
