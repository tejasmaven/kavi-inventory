<?php

$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_counter_section', array(
    'title'		=> 	esc_html__('Counter Section','cleaning-light'),
    'panel'		=> 'cleaninglight_frontpage_settings',
    'priority'  => cleaninglight_themes_get_section_position('cleaninglight_counter_section'),
    'hiding_control' => 'cleaninglight_counter_disable'
)));

//ENABLE/DISABLE COUNTER SECTION
$wp_customize->add_setting('cleaninglight_counter_disable', array(
	'default' => 'disable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_counter_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_counter_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

    $wp_customize->add_setting('cleaninglight_counter_section_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_counter_section_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_counter_section',
        'priority' => 1,
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_counter_super_title',
                    'cleaninglight_counter_title',
                    'cleaninglight_counter_title_style_heading',
                    'cleaninglight_counter_title_style',
                    'cleaninglight_counter_title_align',
                    'cleaninglight_counter',
                    'cleaninglight_counter_style',
                    'cleaninglight_counter_display_style',
                    'cleaninglight_counter_icon_disable',
                    'cleaninglight_counter_col',
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
                    'cleaninglight_counter_bg_type',
                    'cleaninglight_counter_bg_color',
                    'cleaninglight_counter_bg_image',
                    'cleaninglight_counter_overlay_color',
                    'cleaninglight_counter_padding',
                	'cleaninglight_counter_cs_seperator',
                ),
            ),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_counter_super_title', array(
        'transport' => 'postMessage',
        'sanitize_callback'	=> 'sanitize_text_field'		
    ));
    $wp_customize->add_control('cleaninglight_counter_super_title', array(
        'label'	   => esc_html__('Super Title','cleaning-light'),
        'section'  => 'cleaninglight_counter_section',
        'type'	   => 'text',
    ));

    $wp_customize->add_setting('cleaninglight_counter_title', array(
        'transport' => 'postMessage',
        'sanitize_callback'	=> 'sanitize_text_field'		
    ));
    $wp_customize->add_control('cleaninglight_counter_title', array(
        'label'	   => esc_html__('Title','cleaning-light'),
        'section'  => 'cleaninglight_counter_section',
        'type'	   => 'text',
    ));
    
    $wp_customize->add_setting('cleaninglight_counter_title_align', array(
        'default' => 'text-center',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_counter_title_align',
            array(
                'choices'  => array(
                    'text-left' => esc_html__('Left', 'cleaning-light'),
                    'text-center' => esc_html__('Center', 'cleaning-light'),
                    'text-right' => esc_html__('Right', 'cleaning-light'),
                ),
                'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
                'section'  => 'cleaninglight_counter_section',
                'settings' => 'cleaninglight_counter_title_align',
            )
        )
    );

    $wp_customize->add_setting('cleaninglight_counter_title_style_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_counter_title_style_heading', array(
        'section' => 'cleaninglight_counter_section',
        'label' => esc_html__('Section Title Style', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_counter_title_style', array(
        'default' => 'style1',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_counter_title_style', array(
        'section' => 'cleaninglight_counter_section',
        'type'    => 'select',
        'choices' => array(
            'style1' => esc_html__('Style 1','cleaning-light'),
            'style2' => esc_html__('Style 2','cleaning-light'),			
            'style3' => esc_html__('Style 3','cleaning-light'),			
        )
    ));
    
    $wp_customize->add_setting('cleaninglight_counter', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',	
        'default' => json_encode(array(
            array(
                'counter_icon'  =>'',
                'counter_title'  =>'',
                'counter_number'  =>'',	          
                'counter_suffix' => ''
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, 
        'cleaninglight_counter', 
        array(
            'label' 	   => esc_html__('Counter Settings', 'cleaning-light'),
            'section' 	   => 'cleaninglight_counter_section',
            'settings' 	   => 'cleaninglight_counter',
            'box_label' => esc_html__('Counter Item', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
             'limit' => 6,
        ),
        array(
            'counter_icon' => array(
                'type' => 'icon',
                'label' => esc_html__('Choose Icon', 'cleaning-light'),
                'default' => 'fa fa-cogs'
            ),
            'counter_title' => array(
                'type' => 'text',
                'label' => esc_html__('Title', 'cleaning-light'),
                'default' => ''
            ),
            'counter_number' => array(
                'type' => 'number',
                'label' => esc_html__('Ending Number', 'cleaning-light'),
                'default' => ''
            ),
            'counter_suffix' => array(
                'type' => 'text',
                'label' => esc_html__('Suffix', 'cleaning-light'),
                'default' => ''
            ),
        )
    ));

    $wp_customize->add_setting('cleaninglight_counter_style', array(
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',     
        'default' => 'style2',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('cleaninglight_counter_style', array(
        'label' => esc_html__('Select Layout', 'cleaning-light'),
        'section' => 'cleaninglight_counter_section',
        'type' => 'select',
        'choices' => array(
            'style1' => esc_html__('Layout One' , 'cleaning-light'),
            'style2' => esc_html__('Layout Two' ,'cleaning-light'),
            'style3' => esc_html__('Layout Three' ,'cleaning-light'),
        )
    ));

    $wp_customize->add_setting('cleaninglight_counter_display_style', array(
        'default' => 'above',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_counter_display_style',
            array(
                'choices'  => array(
                    'left' => esc_html__('Left', 'cleaning-light'),
                    'right' => esc_html__('Right', 'cleaning-light'),
                    'above' => esc_html__('Top', 'cleaning-light'),
                    'below' => esc_html__('Below', 'cleaning-light'),
                ),
                'label'    => esc_html__( 'Display Position', 'cleaning-light' ),
                'section'  => 'cleaninglight_counter_section',
            )
        )
    );

    $wp_customize->add_setting('cleaninglight_counter_icon_disable', array(
        'default' => 'enable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',     
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_counter_icon_disable', array(
        'label' => esc_html__('Counter Icon', 'cleaning-light'),
        'section' => 'cleaninglight_counter_section',
        'switch_label' => array(
            'enable' => esc_html__('Enable', 'cleaning-light'),
            'disable' => esc_html__('Disable', 'cleaning-light'),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_counter_col', array(
        'sanitize_callback' => 'absint',
        'default' => 3,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_counter_col', array(
        'section' => 'cleaninglight_counter_section',
        'label' => esc_html__('No of Column(s)', 'cleaning-light'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 6,
            'step' => 1,
        )
    )));

    $wp_customize->add_setting('cleaninglight_pro_counter', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_counter', array(
        'section' => 'cleaninglight_counter_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('Different Layout & Settings', 'cleaning-light'),
            esc_html__('Add Unlimited Counter Items', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Advanced Counter Items Settings', 'cleaning-light'),
            esc_html__('Counter Display Different Position', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( "cleaninglight_counter_section_refresh", array (
    'settings' => array(
        'cleaninglight_counter_disable',
        'cleaninglight_counter',
        'cleaninglight_counter_style',
        'cleaninglight_counter_col',
    ),
    'selector' => "#counter-section",
    'fallback_refresh' => true,
    'container_inclusive' => true,
    'render_callback' => function () {
        return get_template_part( 'section/section-counter' );
    }
));