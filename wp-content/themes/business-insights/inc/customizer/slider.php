<?php
/**
 * slider section
 *
 * @package Business Insights
 */

$default = business_insights_get_default_theme_options();

// Add Theme Options Panel.
$wp_customize->add_panel('front_page_option_panel',
	array(
		'title'      => esc_html__('Front Page Options', 'business-insights'),
		'priority'   => 190,
		'capability' => 'edit_theme_options',
	)
);

// Slider Main Section.
$wp_customize->add_section('slider_section_settings',
	array(
		'title'      => esc_html__('Slider Options', 'business-insights'),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
		'panel'      => 'front_page_option_panel',
	)
);

// Setting - show_slider_section.
$wp_customize->add_setting('show_slider_section',
	array(
		'default'           => $default['show_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control('show_slider_section',
	array(
		'label'    => esc_html__('Enable Slider', 'business-insights'),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting('enable_slider_overlay',
	array(
		'default'           => $default['enable_slider_overlay'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_slider_overlay',
	array(
		'label'    => esc_html__('Enable Slider Overlay', 'business-insights'),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);
/*No of Slider*/
$wp_customize->add_setting('number_of_home_slider',
	array(
		'default'           => $default['number_of_home_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_select',
	)
);
$wp_customize->add_control('number_of_home_slider',
	array(
		'label'       => esc_html__('Select no of slider', 'business-insights'),
		'description' => esc_html__('If you are using selection "from page" option please refresh to get actual no of page', 'business-insights'),
		'section'     => 'slider_section_settings',
		'choices'     => array(
			'1'          => esc_html__('1', 'business-insights'),
			'2'          => esc_html__('2', 'business-insights'),
			'3'          => esc_html__('3', 'business-insights'),
			'4'          => esc_html__('4', 'business-insights'),
		),
		'type'     => 'select',
		'priority' => 105,
	)
);


/*content excerpt in Slider*/
$wp_customize->add_setting('number_of_content_home_slider',
	array(
		'default'           => $default['number_of_content_home_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control('number_of_content_home_slider',
	array(
		'label'       => esc_html__('Select no words of slider', 'business-insights'),
		'section'     => 'slider_section_settings',
		'type'        => 'number',
		'priority'    => 105,
		'input_attrs' => array('min' => 0, 'max' => 200, 'style' => 'width: 150px;'),

	)
);

// Setting - select_slider_from.
$wp_customize->add_setting( 'select_slider_from',
	array(
		'default'           => $default['select_slider_from'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_select',
	)
);
$wp_customize->add_control( 'select_slider_from',
	array(
		'label'       => __( 'Select Slider From', 'business-insights' ),
		'section'     => 'slider_section_settings',
		'type'        => 'select',
		'choices'               => array(
		    'from-page' => __( 'Page', 'business-insights' ),
		    'from-category' => __( 'Category', 'business-insights' )
		    ),
		'priority'    => 105,
	)
);


// Setting - drop down category for slider.
$wp_customize->add_setting('select_category_for_slider',
	array(
		'default'           => $default['select_category_for_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control(new Business_Insights_Dropdown_Taxonomies_Control($wp_customize, 'select_category_for_slider',
		array(
			'label'           => esc_html__('Category for slider', 'business-insights'),
			'description'     => esc_html__('Select category to be shown on tab ', 'business-insights'),
			'section'         => 'slider_section_settings',
			'type'            => 'dropdown-taxonomies',
			'taxonomy'        => 'category',
			'priority'        => 120,
			'active_callback' => 'business_insights_is_select_cat_slider',
		)));

for ( $i=1; $i <=  business_insights_get_option( 'number_of_home_slider' ) ; $i++ ) {
        $wp_customize->add_setting( 'select_page_for_slider_'. $i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'business_insights_sanitize_dropdown_pages',
        ) );

        $wp_customize->add_control( 'select_page_for_slider_'. $i, array(
            'input_attrs'       => array(
                'style'           => 'width: 50px;'
                ),
            'label'             => __( 'Slider From Page', 'business-insights' ) . ' - ' . $i ,
            'priority'          =>  '120' . $i,
            'section'           => 'slider_section_settings',
            'type'        		=> 'dropdown-pages',
            'priority'    		=> 120,
            'active_callback' 	=> 'business_insights_is_select_page_slider',
            )
        );
    }

/*settings for Section property*/
/*Button Text*/
$wp_customize->add_setting('button_text_on_slider',
	array(
		'default'           => $default['button_text_on_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control('button_text_on_slider',
	array(
		'label'       => esc_html__('Read More Text', 'business-insights'),
		'description' => esc_html__('Removing text will disable read more on the slider', 'business-insights'),
		'section'     => 'slider_section_settings',
		'type'        => 'text',
		'priority'    => 170,
	)
);
