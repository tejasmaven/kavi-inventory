<?php
/**
 * Testimonial Section
*/
$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_testimonial_section', array(
    'title'		=> 	esc_html__('Testimonials Section','cleaning-light'),
    'panel'		=> 'cleaninglight_frontpage_settings',
    'priority'  => cleaninglight_themes_get_section_position('cleaninglight_testimonial_section'),
    'hiding_control' => 'cleaninglight_testimonial_disable'
)));

//ENABLE/DISABLE TESTIMONIAL SECTION
$wp_customize->add_setting('cleaninglight_testimonial_disable', array(
	'default' => 'enable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_testimonial_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_testimonial_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));
    
    $wp_customize->add_setting('cleaninglight_testimonial_section_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_testimonial_section_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_testimonial_section',
        'priority' => 1,
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_testimonial_title',
                    'cleaninglight_testimonial_super_title',
                    'cleaninglight_testimonial_title_style_heading',
                    'cleaninglight_testimonial_title_style',
                    'cleaninglight_testimonial_title_align',
                    'cleaninglight_testimonial_type_heading',
                    'cleaninglight_testimonial_type',
                    'cleaninglight_testimonial_page',
                    'cleaninglight_testimonial_advance_settings',
                    'cleaninglight_testimonial_review_link',
                    'cleaninglight_testimonial_layout',
                    'cleaninglight_testimonial_display_style',
                ),
                'active' => true,
            ),
            array(
                'name' => esc_html__('Style', 'cleaning-light'),
                'fields' => array(
                ),
            ),
            array(
                'name' => esc_html__('Advanced', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_testimonial_bg_type',
                    'cleaninglight_testimonial_bg_color',
                    'cleaninglight_testimonial_bg_image',
                    'cleaninglight_testimonial_overlay_color',
                    'cleaninglight_testimonial_padding',
                    'cleaninglight_testimonial_cs_seperator',
                ),
            ),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_testimonial_super_title', array(
        'transport' => 'postMessage',
        'sanitize_callback'	=> 'sanitize_text_field'		
    ));
    $wp_customize->add_control('cleaninglight_testimonial_super_title', array(
        'label'	   => esc_html__('Super Title','cleaning-light'),
        'section'  => 'cleaninglight_testimonial_section',
        'type'	   => 'text',
    ));
   
    $wp_customize->add_setting('cleaninglight_testimonial_title', array(
        'transport' => 'postMessage',
        'sanitize_callback'	=> 'sanitize_text_field'		
    ));
    $wp_customize->add_control('cleaninglight_testimonial_title', array(
        'label'	   => esc_html__('Title','cleaning-light'),
        'section'  => 'cleaninglight_testimonial_section',
        'type'	   => 'text',
    ));

    $wp_customize->add_setting('cleaninglight_testimonial_title_align', array(
        'default' => 'text-center',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_testimonial_title_align',
            array(
                'choices'  => array(
                    'text-left' => esc_html__('Left', 'cleaning-light'),
                    'text-center' => esc_html__('Center', 'cleaning-light'),
                    'text-right' => esc_html__('Right', 'cleaning-light'),
                ),
                'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
                'section'  => 'cleaninglight_testimonial_section',
            )
        )
    );
   
    $wp_customize->add_setting('cleaninglight_testimonial_title_style_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_testimonial_title_style_heading', array(
        'section' => 'cleaninglight_testimonial_section',
        'label' => esc_html__('Section Title Style', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_testimonial_title_style', array(
        'default' => 'style1',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_testimonial_title_style', array(
        'section' => 'cleaninglight_testimonial_section',
        'type'    => 'select',
        'choices' => array(
            'style1' => esc_html__('Style 1','cleaning-light'),
            'style2' => esc_html__('Style 2','cleaning-light'),			
            'style3' => esc_html__('Style 3','cleaning-light'),		
        )
    ));

   
    $wp_customize->add_setting('cleaninglight_testimonial_type_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_testimonial_type_heading', array(
        'section' => 'cleaninglight_testimonial_section',
        'label' => esc_html__('Select Type', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_testimonial_type', array(
        'default' => 'default',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'
    ));
    $wp_customize->add_control('cleaninglight_testimonial_type', array(
        'section' => 'cleaninglight_testimonial_section',
        'type' => 'radio',
        'choices' => array(
            'default' => esc_html__('Default', 'cleaning-light'),
            'advance' => esc_html__('Advanced', 'cleaning-light')
        )
    ));

    $wp_customize->add_setting('cleaninglight_testimonial_page', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
        'default' => json_encode(array(
            array(
                'testimonial_page' => '',
                'designation'   =>'',
                'rating'    => ''
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, 'cleaninglight_testimonial_page', 
        array(
            'label' 	   => esc_html__('Default Testimonial Settings', 'cleaning-light'),
            'section' 	   => 'cleaninglight_testimonial_section',
            'settings' 	   => "cleaninglight_testimonial_page",
            'box_label' => esc_html__('Testimonial Item', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
            'limit' => 6,
        ),
        array(
            'testimonial_page' => array(
                'type' => 'select',
                'label' => esc_html__('Select Page', 'cleaning-light'),
                'options' => $pages
            ),
            'designation' => array(
                'type' => 'text',
                'label' => esc_html__('Designation', 'cleaning-light'),
                'default' => ''
            ),
            'rating' => array(
                'type' => 'number',
                'label' => esc_html__('Rating', 'cleaning-light'),
                'default' => '5'
            )
        )
    ));

    $wp_customize->add_setting("cleaninglight_testimonial_advance_settings", array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
        'default' => json_encode(array(
            array(
                'block_image'      => '',
                'block_title'      => '',
                'block_designation' => '',
                'block_text'    => '',
                'block_rating'     => '',
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, "cleaninglight_testimonial_advance_settings", 
        array(
            'label' 	   => esc_html__('Advance Testimonial Settings', 'cleaning-light'),
            'section' 	   => "cleaninglight_testimonial_section",
            'settings' 	   => "cleaninglight_testimonial_advance_settings",
            'box_label' => esc_html__('Testimonial Item', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
            'limit' => 6,
        ),
        array(
            'block_image' => array(
                'type' => 'upload',
                'label' => __("Upload Image", 'cleaning-light'),
            ),
            'block_title' => array(
                'type' => 'text',
                'label' => __("Title", 'cleaning-light'),
            ),
            'block_designation' => array(
                'type' => 'text',
                'label' => __("Designation", 'cleaning-light'),
            ),
            'block_text' => array(
                'type' => 'textarea',
                'label' => __("Text", 'cleaning-light'),
            ),
            'block_rating' => array(
                'type' => 'number',
                'label' => esc_html__('Rating', 'cleaning-light'),
                'default' => ''
            )
        )
    ));

    $wp_customize->add_setting('cleaninglight_testimonial_layout', array(
        'sanitize_callback' => 'cleaninglight_themes_sanitize_options',
        'default' => 'style1',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_testimonial_layout', array(
        'section' => 'cleaninglight_testimonial_section',
        'label' => esc_html__('Select Layout', 'cleaning-light'),
        'options' => array(
            'style1' => get_template_directory_uri() . '/inc/customizer/images/testimonial-1.webp',
            'style2' => get_template_directory_uri() . '/inc/customizer/images/testimonial-2.webp',
        )
    )));

    $wp_customize->add_setting('cleaninglight_testimonial_display_style', array(
        'default' => 'slide',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_testimonial_display_style', array(
        'section' => 'cleaninglight_testimonial_section',
        'type'    => 'select',
        'label' => esc_html__('Display Style', 'cleaning-light'),
        'choices' => array(
            'grid' => esc_html__('Grid','cleaning-light'),
            'slide' => esc_html__('Slide','cleaning-light'),			
        )
    ));

    $wp_customize->add_setting('cleaninglight_testimonial_review_link', array(
        'transport' => 'postMessage',
        'sanitize_callback'	=> 'sanitize_text_field'		
    ));
    $wp_customize->add_control('cleaninglight_testimonial_review_link', array(
        'label'	   => esc_html__('All Review Link','cleaning-light'),
        'section'  => 'cleaninglight_testimonial_section',
        'type'	   => 'text',
    ));

    $wp_customize->add_setting('cleaninglight_pro_testimonial', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_testimonial', array(
        'section' => 'cleaninglight_testimonial_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('(4+) Different Layout & Settings', 'cleaning-light'),
            esc_html__('Add Unlimited Testimonial Items', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));
    
$wp_customize->selective_refresh->add_partial( "cleaninglight_testimonial_refresh", array (
    'settings' => array( 
        'cleaninglight_testimonial_disable',
        'cleaninglight_testimonial_type',
        'cleaninglight_testimonial_layout',
        'cleaninglight_testimonial_display_style',
        'cleaninglight_testimonial_page',
        'cleaninglight_testimonial_advance_settings',
        'cleaninglight_testimonial_review_link',
    ),
    'selector' => "#testimonial-section",
    'fallback_refresh' => true,
    'container_inclusive' => true,
    'render_callback' => function () {
        return get_template_part( 'section/section-testimonial' );
    }
));