<?php
/**
 * process section
 *
 * @package business-insights
 */
$default = business_insights_get_default_theme_options();
/*process section*/
// our process Main Section.
$wp_customize->add_section( 'process_section_settings',
	array(
		'title'      => esc_html__( 'Process Section', 'business-insights' ),
		'priority'   => 65,
		'capability' => 'edit_theme_options',
		'panel'      => 'front_page_option_panel',
	)
);

// Setting - show-work-process-section.
$wp_customize->add_setting( 'show_our_process_section',
	array(
		'default'           => $default['show_our_process_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_our_process_section',
	array(
		'label'    => esc_html__( 'Enable Process Section', 'business-insights' ),
		'section'  => 'process_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - title_process_section.
$wp_customize->add_setting( 'title_process_section',
	array(
		'default'           => $default['title_process_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'title_process_section',
	array(
		'label'    => __( 'Section Title', 'business-insights' ),
		'section'  => 'process_section_settings',
		'type'     => 'text',
		'priority' => 104,
	)
);

/*content excerpt in process*/
$wp_customize->add_setting( 'number_of_content_home_process',
	array(
		'default'           => $default['number_of_content_home_process'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'business_insights_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'number_of_content_home_process',
	array(
		'label'    => esc_html__( 'Select No Words Of Process', 'business-insights' ),
		'section'  => 'process_section_settings',
		'type'     => 'number',
		'priority' => 180,
		'input_attrs'     => array( 'min' => 1, 'max' => 200, 'style' => 'width: 150px;' ),

	)
);

/*process from page*/
for ( $i=1; $i <=  6 ; $i++ ) {
		$wp_customize->add_setting( 'number_of_home_process_icon_'. $i , array(
		    'capability'        => 'edit_theme_options',
		    'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'number_of_home_process_icon_'. $i, array(
		    'input_attrs'       => array(
		        'style'           => 'width: 250px;'
		        ),
		    'label'             => esc_html__( 'Font Icon', 'business-insights' ) . ' - ' . $i ,
			'description'     => sprintf( __( 'Use elegant icon Eg:  icon_search. %1$s See more here %2$s', 'business-insights' ), '<a href="'.esc_url('https://www.themeinwp.com/theme-icons').'" target="_blank">','</a>' ),
		    'priority'          =>  '120' . $i,
		    'section'           => 'process_section_settings',
		    'type'        		=> 'text',
		    'priority'    		=> 180,
		    )
		);

        $wp_customize->add_setting( 'select_page_for_process_'. $i, array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'business_insights_sanitize_dropdown_pages',
        ) );

        $wp_customize->add_control( 'select_page_for_process_'. $i, array(
            'input_attrs'       => array(
                'style'           => 'width: 50px;'
                ),
            'label'             => __( 'Process From Page', 'business-insights' ) . ' - ' . $i ,
            'priority'          =>  '120' . $i,
            'section'           => 'process_section_settings',
            'type'        		=> 'dropdown-pages',
            'priority'    		=> 180,
            )
        );
    }