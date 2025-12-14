<?php

$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_client_section', array(
    'title'		=> 	esc_html__('Clients Section','cleaning-light'),
    'panel'		=> 'cleaninglight_frontpage_settings',
    'priority'  => cleaninglight_themes_get_section_position('cleaninglight_client_section'),
    'hiding_control' => 'cleaninglight_client_disable'
)));

//ENABLE/DISABLE CLINET/LOGO SECTION
$wp_customize->add_setting('cleaninglight_client_disable', array(
	'default' => 'disable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_client_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_client_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

    $wp_customize->add_setting('cleaninglight_client_section_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_client_section_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_client_section',
        'priority' => 1,
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_client_super_title',
                    'cleaninglight_client_title',
                    'cleaninglight_client_title_style_heading',
                    'cleaninglight_client_title_style',
                    'cleaninglight_client_title_align',
                    'cleaninglight_client',
                    'cleaninglight_logo_style',
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
                    'cleaninglight_client_bg_type',
                    'cleaninglight_client_bg_color',
                    'cleaninglight_client_bg_image',
                    'cleaninglight_client_overlay_color',
                    'cleaninglight_client_padding',
                    'cleaninglight_client_cs_seperator',
                ),
            ),
        ),
    )));
    

    $wp_customize->add_setting( 'cleaninglight_client_super_title', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'			
    ) );
    $wp_customize->add_control( 'cleaninglight_client_super_title', array(
        'label'    => esc_html__( 'Super Title', 'cleaning-light' ),
        'section'  => 'cleaninglight_client_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting( 'cleaninglight_client_title', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'			
    ) );
    $wp_customize->add_control( 'cleaninglight_client_title', array(
        'label'    => esc_html__( 'Title', 'cleaning-light' ),
        'section'  => 'cleaninglight_client_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('cleaninglight_client_title_align', array(
        'default' => 'text-center',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new Cleaninglight_Custom_Control_Buttonset(
            $wp_customize,
            'cleaninglight_client_title_align',
            array(
                'choices'  => array(
                    'text-left' => esc_html__('Left', 'cleaning-light'),
                    'text-center' => esc_html__('Center', 'cleaning-light'),
                    'text-right' => esc_html__('Right', 'cleaning-light'),
                ),
                'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
                'section'  => 'cleaninglight_client_section',
                'settings' => 'cleaninglight_client_title_align',
            )
        )
    );

    $wp_customize->add_setting('cleaninglight_client_title_style_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_client_title_style_heading', array(
        'section' => 'cleaninglight_client_section',
        'label' => esc_html__('Section Title Style', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_client_title_style', array(
        'default' => 'style1',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_client_title_style', array(
        'section' => 'cleaninglight_client_section',
        'type'    => 'select',
        'choices' => array(
            'style1' => esc_html__('Style 1','cleaning-light'),
            'style2' => esc_html__('Style 2','cleaning-light'),			
            'style3' => esc_html__('Style 3','cleaning-light'),			
        )
    ));

    $wp_customize->add_setting('cleaninglight_client', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
        'default' => json_encode(array(
            array(
                'client_image' => '',
                'client_link'  => '',
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, 
        'cleaninglight_client',
        array(
            'label' 	   => esc_html__('Client Logos', 'cleaning-light'),
            'section' 	   => 'cleaninglight_client_section',
            'settings' 	   => 'cleaninglight_client',
            'box_label' => esc_html__('Logo', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
        ),
        array(
            'client_image' => array(
                'type' => 'upload',
                'label' => esc_html__('Upload Logo', 'cleaning-light'),
            ),
            'client_link' => array(
                'type'      => 'text',
                'label'     => esc_html__( 'Link', 'cleaning-light' ),
                'default'   => ''
            ), 
        )
    ));

    $wp_customize->add_setting('cleaninglight_logo_style', array(
        'sanitize_callback' => 'cleaninglight_themes_sanitize_options',
        'default' => 'style1',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_logo_style', array(
        'section' => 'cleaninglight_client_section',
        'label' => esc_html__('Choose Style', 'cleaning-light'),
        'class' => 'one-second-width',
        'options' => array(
            'style1' => get_template_directory_uri() . '/inc/customizer/images/logo-style1.webp',
            'style2' => get_template_directory_uri() . '/inc/customizer/images/logo-style2.webp',
        )
    )));

    $wp_customize->add_setting('cleaninglight_pro_client', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_client', array(
        'section' => 'cleaninglight_client_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('Different Layout & Settings', 'cleaning-light'),
            esc_html__('Add Unlimited Logo Items', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Advanced Logo Items Settings', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( "cleaninglight_client_refresh", array (
    'settings' => array( 
        'cleaninglight_client_disable',
        'cleaninglight_client',
        'cleaninglight_logo_style',
    ),
    'selector' => "#client-section",
    'fallback_refresh' => true,
    'container_inclusive' => true,
    'render_callback' => function () {
        return get_template_part( 'section/section-client' );
    }
));