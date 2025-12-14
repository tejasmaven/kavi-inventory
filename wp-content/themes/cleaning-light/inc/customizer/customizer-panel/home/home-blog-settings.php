<?php

$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_blog_section', array(
    'title'		=> 	esc_html__('Blog Section','cleaning-light'),
    'panel'		=> 'cleaninglight_frontpage_settings',
    'priority'  => cleaninglight_themes_get_section_position('cleaninglight_blog_section'),
    'hiding_control' => 'cleaninglight_blog_disable'
)));

//ENABLE/DISABLE BLOG SECTION
$wp_customize->add_setting('cleaninglight_blog_disable', array(
	'default' => 'enable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_blog_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_blog_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

    $wp_customize->add_setting('cleaninglight_blog_section_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_blog_section_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_blog_section',
        'priority' => 1,
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_blog_super_title',
                    'cleaninglight_blog_title',
                    'cleaninglight_blog_title_align',
                    'cleaninglight_blog_title_style_heading',
                    'cleaninglight_blog_title_style',
                    'cleaninglight_home_blog_alignment',
                    'cleaninglight_blog_display_style',
                    'cleaninglight_posts_num',
                    'cleaninglight_blog_categories',
                    'cleaninglight_home_post_author_options',
                    'cleaninglight_home_post_date_options',
                    'cleaninglight_home_post_reading_time',
                    'cleaninglight_blog_home_btn',
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
                    'cleaninglight_blog_bg_type',
                    'cleaninglight_blog_bg_color',
                    'cleaninglight_blog_bg_image',
                    'cleaninglight_blog_overlay_color',
                    'cleaninglight_blog_padding',
                    'cleaninglight_blog_cs_seperator',
                ),
            ),
        ),
    )));
    
    $wp_customize->add_setting('cleaninglight_blog_super_title', array(
        'transport' => 'postMessage',
        'sanitize_callback'	=> 'sanitize_text_field'		
    ));
    $wp_customize->add_control('cleaninglight_blog_super_title', array(
        'label'	   => esc_html__('Super Title','cleaning-light'),
        'section'  => 'cleaninglight_blog_section',
        'type'	   => 'text',
    ));

    $wp_customize->add_setting('cleaninglight_blog_title', array(
        'transport' => 'postMessage',
        'sanitize_callback'	=> 'sanitize_text_field'		
    ));
    $wp_customize->add_control('cleaninglight_blog_title', array(
        'label'	   => esc_html__('Title','cleaning-light'),
        'section'  => 'cleaninglight_blog_section',
        'type'	   => 'text',
    ));
    
    $wp_customize->add_setting('cleaninglight_blog_title_align', array(
        'default' => 'text-center',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_blog_title_align',
            array(
                'choices'  => array(
                    'text-left' => esc_html__('Left', 'cleaning-light'),
                    'text-center' => esc_html__('Center', 'cleaning-light'),
                    'text-right' => esc_html__('Right', 'cleaning-light'),
                ),
                'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
                'section'  => 'cleaninglight_blog_section',
                'settings' => 'cleaninglight_blog_title_align',
            )
        )
    );

    $wp_customize->add_setting('cleaninglight_blog_title_style_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_blog_title_style_heading', array(
        'section' => 'cleaninglight_blog_section',
        'label' => esc_html__('Section Title Style', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_blog_title_style', array(
        'default' => 'style1',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_blog_title_style', array(
        'section' => 'cleaninglight_blog_section',
        'type'    => 'select',
        'choices' => array(
            'style1' => esc_html__('Style 1','cleaning-light'),
            'style2' => esc_html__('Style 2','cleaning-light'),			
            'style3' => esc_html__('Style 3','cleaning-light'),		
        )
    ));

    $wp_customize->add_setting('cleaninglight_blog_categories', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',    
    ));
    $wp_customize->add_control(new Cleaninglight_Multiple_Check_Control($wp_customize, 'cleaninglight_blog_categories', array(
        'section'  => 'cleaninglight_blog_section',
        'choices'  => $blog_cat,
        'label' => esc_html__('Select Categories', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_home_blog_alignment',array(
        'default' => 'text-center',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Buttonset($wp_customize,'cleaninglight_home_blog_alignment', array(
        'choices'  => array(
            'text-left' => esc_html__('Left', 'cleaning-light'),
            'text-center' => esc_html__('Center', 'cleaning-light'),
            'text-right' => esc_html__('Right', 'cleaning-light'),
        ),
        'label'    => esc_html__( 'Content Alignment', 'cleaning-light' ),
        'section'  => 'cleaninglight_blog_section',
    )));

    $wp_customize->add_setting('cleaninglight_blog_display_style', array(
        'default' => 'grid',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_blog_display_style', array(
        'section' => 'cleaninglight_blog_section',
        'type'    => 'select',
        'label' => esc_html__('Display Style', 'cleaning-light'),
        'choices' => array(
            'grid' => esc_html__('Grid','cleaning-light'),
            'slide' => esc_html__('Slide','cleaning-light'),			
        )
    ));
    
    $wp_customize->add_setting('cleaninglight_posts_num', array(
        'sanitize_callback' => 'absint',
        'default' => 6,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_posts_num', array(
        'section' => 'cleaninglight_blog_section',
        'label' => esc_html__('Display Number of Item', 'cleaning-light'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 12,
            'step' => 1,
        )
    )));

    $wp_customize->add_setting('cleaninglight_home_post_date_options', array(
        'transport' => 'postMessage',
        'default' => 'enable',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',     
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_home_post_date_options', array(
        'label' => esc_html__('Post Date', 'cleaning-light'),
        'settings' => 'cleaninglight_home_post_date_options',
        'section' => 'cleaninglight_blog_section',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_home_post_author_options', array(
        'transport' => 'postMessage',
        'default' => 'enable',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_home_post_author_options', array(
        'label' => esc_html__('Author', 'cleaning-light'),
        'settings' => 'cleaninglight_home_post_author_options',
        'section' => 'cleaninglight_blog_section',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_home_post_reading_time', array(
        'transport' => 'postMessage',
        'default' => 'enable',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_home_post_reading_time', array(
        'label' => esc_html__('Reading Time', 'cleaning-light'),
        'settings' => 'cleaninglight_home_post_reading_time',
        'section' => 'cleaninglight_blog_section',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        ),
    )));

    $wp_customize->add_setting( 'cleaninglight_blog_home_btn', array(
        'transport' => 'postMessage',
        'default'  => esc_html__( 'Read More','cleaning-light' ),
        'sanitize_callback' => 'sanitize_text_field',		
    ));
    $wp_customize->add_control('cleaninglight_blog_home_btn', array(
        'label' => esc_html__( 'Button Text', 'cleaning-light' ),
        'section' => 'cleaninglight_blog_section',
        'type'  => 'text',
    ));

    $wp_customize->add_setting('cleaninglight_pro_blog', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_blog', array(
        'section' => 'cleaninglight_blog_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('(3+) Different Layout & Settings', 'cleaning-light'),
            esc_html__('Configure Column & Space(Gap)', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Control Excerpt Character', 'cleaning-light'),
            esc_html__('On/Off Date, Author & Comment', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( "cleaninglight_home_blog_section_refresh", array (
    'settings' => array( 
        'cleaninglight_blog_disable',
        'cleaninglight_blog_display_style',
        'cleaninglight_blog_categories',
        'cleaninglight_posts_num',	
    ),
    'selector' => "#blog-section",
    'fallback_refresh' => true,
    'container_inclusive' => true,
    'render_callback' => function () {
        return get_template_part( 'section/section-blog' );
    }
));