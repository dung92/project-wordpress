<?php
/**
 * testimonial section
 *
 * @package business-insights
 */

$default = business_insights_get_default_theme_options();

// testimonial Main Section.
$wp_customize->add_section( 'testimonial_section_settings',
	array(
		'title'      => __( 'Testimonial Section', 'business-insights' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'front_page_option_panel',
	)
);


// Setting - show-section-testimonial.
$wp_customize->add_setting( 'show_testimonial_section',
	array(
		'default'           => $default['show_testimonial_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_testimonial_section',
	array(
		'label'    => __( 'Enable Testimonial', 'business-insights' ),
		'section'  => 'testimonial_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting('enable_testimonial_overlay',
	array(
		'default'           => $default['enable_testimonial_overlay'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_testimonial_overlay',
	array(
		'label'    => esc_html__('Enable Testimonial Overlay', 'business-insights'),
		'section'  => 'testimonial_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - title_testimonial_section.
$wp_customize->add_setting( 'title_testimonial_section',
	array(
		'default'           => $default['title_testimonial_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'title_testimonial_section',
	array(
		'label'    => __( 'Section Title', 'business-insights' ),
		'section'  => 'testimonial_section_settings',
		'type'     => 'text',
		'priority' => 104,
	)
);


// Setting testimonial_section_background_image.
$wp_customize->add_setting( 'testimonial_section_background_image',
	array(
	'default'           => $default['testimonial_section_background_image'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'business_insights_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control( $wp_customize, 'testimonial_section_background_image',
		array(
		'label'           => __( 'Testimonial Section Background Image.', 'business-insights' ),
		'description'	  => sprintf( __( 'Recommended Size %1$d X %2$d', 'business-insights' ), 1400, 335 ),
		'section'         => 'testimonial_section_settings',
		'priority'        => 104,

		)
	)
);


/*No of testimonial*/
$wp_customize->add_setting( 'number_of_home_testimonial',
	array(
		'default'           => $default['number_of_home_testimonial'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_select',
	)
);
$wp_customize->add_control( 'number_of_home_testimonial',
	array(
		'label'    => __( 'Select no of testimonial', 'business-insights' ),
        'description'     => __( 'If you are using selection "from page" option please refresh to get actual no of page', 'business-insights' ),
		'section'  => 'testimonial_section_settings',
		'choices'               => array(
		    '1' => __( '1', 'business-insights' ),
		    '2' => __( '2', 'business-insights' ),
		    '3' => __( '3', 'business-insights' ),
		    ),
		'type'     => 'select',
		'priority' => 105,
	)
);

/*content excerpt in testimonial*/
$wp_customize->add_setting( 'number_of_content_home_testimonial',
	array(
		'default'           => $default['number_of_content_home_testimonial'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_content_home_testimonial',
	array(
		'label'    => __( 'Select no words for testimonial', 'business-insights' ),
		'section'  => 'testimonial_section_settings',
		'type'     => 'number',
		'priority' => 110,
		'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),

	)
);

// Setting - select_testimonial_from.
$wp_customize->add_setting( 'select_testimonial_from',
	array(
		'default'           => $default['select_testimonial_from'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_select',
	)
);
$wp_customize->add_control( 'select_testimonial_from',
	array(
		'label'       => __( 'Select testimonial From', 'business-insights' ),
		'section'     => 'testimonial_section_settings',
		'type'        => 'select',
		'choices'               => array(
		    'from-page' => __( 'Page', 'business-insights' ),
		    'from-category' => __( 'Category', 'business-insights' )
		    ),
		'priority'    => 110,
	)
);

for ( $i=1; $i <=  business_insights_get_option( 'number_of_home_testimonial' ) ; $i++ ) {
        $wp_customize->add_setting( 'select_page_for_testimonial_'. $i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'business_insights_sanitize_dropdown_pages',
            
        ) );

        $wp_customize->add_control( 'select_page_for_testimonial_'. $i, array(
            'input_attrs'       => array(
                'style'           => 'width: 50px;'
                ),
            'label'             => __( 'Testimonial From Page', 'business-insights' ) . ' - ' . $i ,
            'priority'          =>  '120' . $i,
            'section'           => 'testimonial_section_settings',
            'type'        		=> 'dropdown-pages',
            'priority'    		=> 120,
            'active_callback' 	=> 'business_insights_is_select_page_testimonial',
            )
        );
    }

// Setting - drop down category for testimonial.
$wp_customize->add_setting( 'select_category_for_testimonial',
	array(
		'default'           => $default['select_category_for_testimonial'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Business_Insights_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_testimonial',
	array(
        'label'           => __( 'Category for Testimonial ', 'business-insights' ),
        'description'     => __( 'Select category to be shown on tab ', 'business-insights' ),
        'section'         => 'testimonial_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
		'active_callback' => 'business_insights_is_select_cat_testimonial',

    ) ) );
