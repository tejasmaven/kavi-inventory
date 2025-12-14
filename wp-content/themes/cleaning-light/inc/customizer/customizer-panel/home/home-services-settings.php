<?php

$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_service_section', array(
    'title'		=>	esc_html__('Services Section','cleaning-light'),
    'panel'		=> 'cleaninglight_frontpage_settings',
    'priority'  => cleaninglight_themes_get_section_position('cleaninglight_service_section'),
    'hiding_control' => 'cleaninglight_service_disable'
)));

    //ENABLE/DISABLE SERVICE SECTION
    $wp_customize->add_setting('cleaninglight_service_disable', array(
        'default' => 'disable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_service_disable', array(
        'label' => esc_html__('Section', 'cleaning-light'),
        'section' => 'cleaninglight_service_section',
        'switch_label' => array(
            'enable' => esc_html__('Enable', 'cleaning-light'),
            'disable' => esc_html__('Disable', 'cleaning-light'),
        ),
        'class' => 'switch-section',
        'priority' => -1,
    )));
    
    $wp_customize->add_setting('cleaninglight_service_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_service_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_service_section',
        'priority' => 1,
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_service_super_title',
                    'cleaninglight_service_title',
                    'cleaninglight_service_title_style_heading',
                    'cleaninglight_service_title_style',
                    'cleaninglight_service_title_align',
                    'cleaninglight_service',
                    'cleaninglight_service_bg_url',
                    'cleaninglight_service_layout',
                    'cleaninglight_service_button',
                    'cleaninglight_service_type',
                    'cleaninglight_service_advance_settings'
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
                    'cleaninglight_service_bg_type',
                    'cleaninglight_service_bg_color',
                    'cleaninglight_service_bg_image',
                    'cleaninglight_service_overlay_color',
                    'cleaninglight_service_padding',
                    'cleaninglight_service_cs_seperator',
                ),
            ),
        ),
    )));
    
    $wp_customize->add_setting( 'cleaninglight_service_super_title', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'			
    ) );
    $wp_customize->add_control( 'cleaninglight_service_super_title', array(
        'label'    => esc_html__( 'Super Title', 'cleaning-light' ),
        'section'  => 'cleaninglight_service_section',
        'type'     => 'text',
    ));


    $wp_customize->add_setting( 'cleaninglight_service_title', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'			
    ) );
    $wp_customize->add_control( 'cleaninglight_service_title', array(
        'label'    => esc_html__( 'Title', 'cleaning-light' ),
        'section'  => 'cleaninglight_service_section',
        'type'     => 'text',
    ));
   
    $wp_customize->add_setting('cleaninglight_service_title_align', array(
        'default' => 'text-center',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control( new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_service_title_align',
            array(
                'choices'  => array(
                    'text-left' => esc_html__('Left', 'cleaning-light'),
                    'text-center' => esc_html__('Center', 'cleaning-light'),
                    'text-right' => esc_html__('Right', 'cleaning-light'),
                ),
                'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
                'section'  => 'cleaninglight_service_section',
                'settings' => 'cleaninglight_service_title_align',
            )
        )
    );

   
    $wp_customize->add_setting('cleaninglight_service_title_style_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_service_title_style_heading', array(
        'section' => 'cleaninglight_service_section',
        'label' => esc_html__('Section Title Style', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_service_title_style', array(
        'default' => 'style1',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_service_title_style', array(
        'section' => 'cleaninglight_service_section',
        'type'    => 'select',
        'choices' => array(
            'style1' => esc_html__('Style 1','cleaning-light'),
            'style2' => esc_html__('Style 2','cleaning-light'),			
            'style3' => esc_html__('Style 3','cleaning-light'),			
        )
    ));


    $wp_customize->add_setting('cleaninglight_service_type', array(
        'default' => 'default',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'
    ));
    $wp_customize->add_control('cleaninglight_service_type', array(
        'section' => 'cleaninglight_service_section',
        'type' => 'radio',
        'label' => esc_html__('Select Type', 'cleaning-light'),
        'choices' => array(
            'default' => esc_html__('Default', 'cleaning-light'),
            'advance' => esc_html__('Advanced', 'cleaning-light')
        )
    ));

    
    $wp_customize->add_setting('cleaninglight_service', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
        'default' => json_encode(array(
            array(
                'service_page' => '',
                'service_icon' =>'fa-solid fa-bezier-curve',
                'button_text' => '',
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize,'cleaninglight_service', 
        array(
            'label' 	   => esc_html__('Default Services Settings', 'cleaning-light'),
            'section' 	   => 'cleaninglight_service_section',
            'settings' 	   => 'cleaninglight_service',
            'box_label' => esc_html__('Service Item', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
            'limit' => 6,
        ),
        array(
            'service_page' => array(
                'type' => 'select',
                'label' => esc_html__('Select Page', 'cleaning-light'),
                'options' => $pages
            ),
            'service_icon' => array(
                'type' => 'icon',
                'label' => esc_html__('Choose Icon', 'cleaning-light')
            ),
            'button_text' => array(
                'type' => 'text',
                'label' => esc_html__('Button Text', 'cleaning-light'),
                'default' => ''
            ),
        )
    ));

   
    $id = "service";
    $wp_customize->add_setting("cleaninglight_{$id}_advance_settings", array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
        'default' => json_encode(array(
            array(
                'block_image'      => '',
                'block_icon'       => 'fa-solid fa-bezier-curve',
                'block_title'      => '',
                'block_desc'       => '',
                'button_text'      => '',
                'button_url'       => '',
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, "cleaninglight_{$id}_advance_settings", 
        array(
            'label' 	   => esc_html__('Advance Services Settings', 'cleaning-light'),
            'section' 	   => "cleaninglight_{$id}_section",
            'settings' 	   => "cleaninglight_{$id}_advance_settings",
            'box_label' => esc_html__('Service Item', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
            'limit' => 6,
        ),
        array(
            'block_image' => array(
                'type' => 'upload',
                'label' => __("Upload Image", 'cleaning-light'),
            ),
            'block_icon' => array(
                'type' => 'icon',
                'label' => esc_html__('Choose Icon', 'cleaning-light'),
                'default' => 'fa-solid fa-bezier-curve'
            ),
            'block_title' => array(
                'type' => 'text',
                'label' => esc_html__("Title", 'cleaning-light'),
            ),
            'block_desc' => array(
                'type' => 'textarea',
                'label' => esc_html__("Short Description", 'cleaning-light'),
            ),
            'button_text' => array(
                'type' => 'text',
                'label' => esc_html__('Button Text', 'cleaning-light'),
                'default' => ''
            ),
            'button_url' => array(
                'type' => 'url',
                'label' => esc_html__('Button URL', 'cleaning-light'),
                'default' => ''
            ),
        )
    ));

    $wp_customize->add_setting('cleaninglight_service_layout', array(
        'sanitize_callback' => 'cleaninglight_themes_sanitize_options',
        'default' => 'style1',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_service_layout', array(
        'section' => 'cleaninglight_service_section',
        'label' => esc_html__('Layout Settings', 'cleaning-light'),
        'options' => array(
            'style1' => get_template_directory_uri() . '/inc/customizer/images/service1.webp',
            'style2' => get_template_directory_uri() . '/inc/customizer/images/service2.webp',
        )
    )));

   
    $wp_customize->add_setting('cleaninglight_service_bg_url', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'cleaninglight_service_bg_url', array(
        'label'	   => esc_html__('Feature Image','cleaning-light'),
        'section'  => 'cleaninglight_service_section',
        'height'=>800, // cropper Height
        'width'=>420, // Cropper Width
        'flex_width'=>true, //Flexible Width
        'flex_height'=>true, // Flexible Heiht
    )));

    $wp_customize->add_setting('cleaninglight_pro_service', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_service', array(
        'section' => 'cleaninglight_service_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('Different Layout & Settings', 'cleaning-light'),
            esc_html__('Add Unlimited Service Items', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Advanced Services Items Settings', 'cleaning-light'),
            esc_html__('More Icon Settings ( Background Color/Color/Border Color/Border Width & Padding )', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( 'cleaninglight_service_settings', array(
    'settings' => array( 
        'cleaninglight_service_disable', 
        'cleaninglight_service',
        'cleaninglight_service_type',
        'cleaninglight_service_bg_url',
        'cleaninglight_service_advance_settings',
        'cleaninglight_service_layout',
    ),
    'selector' => '#service-section',
    'fallback_refresh' => true,
    'container_inclusive' => true,
    'render_callback' => function () {
        return get_template_part( 'section/section', 'service' );
    }
));