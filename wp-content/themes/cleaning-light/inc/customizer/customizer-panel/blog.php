<?php

$wp_customize->add_section('cleaninglight_blog_template', array(
    'title'		  => esc_html__('Blog / Single Post Settings','cleaning-light'),
    'priority'	  => 65,
));

    $wp_customize->add_setting('cleaninglight_blog_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => -1,
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_blog_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_blog_template',
        'buttons' => array(
            array(
                'name' => esc_html__('Blog List', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_blogtemplate_postcat',
                    'cleaninglight_blog_template_sidebar',
                    'cleaninglight_post_heading',
                    'cleaninglight_post_column',
                    'cleaninglight_blog_post_space',
                    'cleaninglight_blogtemplate_btn',
                    'cleaninglight_post_excerpt_length',
                    'cleaninglight_post_date_options',
                    'cleaninglight_post_comments_options',
                    'cleaninglight_post_author_options',
                    'cleaninglight_post_reading_time',
                    'cleaninglight_blog_alignment'
                ),
                'active' => true,
            ),
            array(
                'name' => esc_html__('Single Blog', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_blog_single_template_sidebar',
                    'cleaninglight_blog_single_alignment',
                    'cleaninglight_single_blog_title',
                    'cleaninglight_single_post_top_elements',
                    'cleaninglight_single_post_bottom_elements'
                )
            )
        )
    )));

	$wp_customize->add_setting('cleaninglight_blog_template_sidebar', array(
		'default' => 'right',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_options',
	));
	$wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_blog_template_sidebar', array(
		'section' => 'cleaninglight_blog_template',
        'label' => esc_html__('Blog Page Sidebar', 'cleaning-light'),
		'options' => array(
			'left' => get_template_directory_uri() . '/inc/customizer/images/left-sidebar.png',
			'right' => get_template_directory_uri() . '/inc/customizer/images/right-sidebar.png',
			'no' => get_template_directory_uri() . '/inc/customizer/images/no-sidebar.png',
		)
	)));

    $wp_customize->add_setting('cleaninglight_post_column', array(
        'sanitize_callback' => 'absint',
        'default' => 2,
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_post_column', array(
        'section' => 'cleaninglight_blog_template',
        'label' => esc_html__('No of Column(s)', 'cleaning-light'),
        'input_attrs' => array(
            'min' => 1,
            'max' => 4,
            'step' => 1,
        )
    )));

    $wp_customize->add_setting('cleaninglight_blog_post_space', array(
        'sanitize_callback' => 'absint',
        'default' => 1,
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_blog_post_space', array(
        'section' => 'cleaninglight_blog_template',
        'label' => esc_html__('Block Space (rem)', 'cleaning-light'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 4,
            'step' => 1,
        )
    )));

    $wp_customize->add_setting( 'cleaninglight_blog_alignment', array(
        'default'           => 'text-center',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport'         => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Buttonset($wp_customize,'cleaninglight_blog_alignment',
        array(
            'choices'  => array(
                'text-left' => esc_html__('Left', 'cleaning-light'),
                'text-right' => esc_html__('Right', 'cleaning-light'),
                'text-center' => esc_html__('Center', 'cleaning-light'),
            ),
            'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
            'section'  => 'cleaninglight_blog_template',
            'settings' => 'cleaninglight_blog_alignment',
        )
    ));

    $wp_customize->add_setting( 'cleaninglight_blogtemplate_btn', array(
        'default'           => esc_html__( 'Read More','cleaning-light' ),
        'sanitize_callback' => 'sanitize_text_field',		
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('cleaninglight_blogtemplate_btn', array(
        'label'		  => esc_html__( 'Button Text', 'cleaning-light' ),
        'section'	  => 'cleaninglight_blog_template',
        'type' 		  => 'text',
    ));
    
    $wp_customize->add_setting( 'cleaninglight_post_excerpt_length', array(
        'default'    => 20,
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_post_excerpt_length', array(
        'section' => 'cleaninglight_blog_template',
        'label' => esc_html__('Excerpt Length (words number)', 'cleaning-light'),
        'input_attrs' => array(
            'min' => 10,
            'max' => 100,
            'step' => 5
        )
    )));
    
    $wp_customize->add_setting('cleaninglight_post_date_options', array(
        'default' => 'enable',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_post_date_options', array(
        'label' => esc_html__('Post Meta Date', 'cleaning-light'),
        'section' => 'cleaninglight_blog_template',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        ),
    )));
   
    $wp_customize->add_setting('cleaninglight_post_comments_options', array(
        'default' => 'enable',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_post_comments_options', array(
        'label' => esc_html__('Post Comments', 'cleaning-light'),
        'section' => 'cleaninglight_blog_template',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        ),
    )));
   
    $wp_customize->add_setting('cleaninglight_post_author_options', array(
        'default' => 'enable',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_post_author_options', array(
        'label' => esc_html__('Post Meta Author', 'cleaning-light'),
        'section' => 'cleaninglight_blog_template',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_post_reading_time', array(
        'default' => 'enable',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_post_reading_time', array(
        'label' => esc_html__('Reading Time', 'cleaning-light'),
        'section' => 'cleaninglight_blog_template',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        ),
    )));

	$wp_customize->add_setting('cleaninglight_blog_single_template_sidebar', array(
		'default' => 'right',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_options'
	));
	$wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_blog_single_template_sidebar', array(
		'section' => 'cleaninglight_blog_template',
        'label' => esc_html__('Blog Single Post', 'cleaning-light'),
		'options' => array(
			'left' => get_template_directory_uri() . '/inc/customizer/images/left-sidebar.png',
			'right' => get_template_directory_uri() . '/inc/customizer/images/right-sidebar.png',
			'no' => get_template_directory_uri() . '/inc/customizer/images/no-sidebar.png',
		)
	)));


    $wp_customize->add_setting('cleaninglight_blog_single_alignment',
        array(
            'default'           => 'text-left',
            'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
            'transport'         => 'postMessage',
        )
    );
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Buttonset($wp_customize,'cleaninglight_blog_single_alignment',
         array(
            'label'    => esc_html__( 'Main Content Alignment', 'cleaning-light' ),
            'section'  => 'cleaninglight_blog_template',
            'choices'  => array(
                'text-left' => esc_html__('Left', 'cleaning-light'),
                'text-right' => esc_html__('Right', 'cleaning-light'),
                'text-center' => esc_html__('Center', 'cleaning-light'),
            )
        )
    ));

    $wp_customize->add_setting('cleaninglight_single_post_top_elements', array(
        'default' => array('title', 'post_meta', 'content'),
        'sanitize_callback' => 'cleaninglight_themes_sanitize_multi_choices',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control(new Cleaninglight_Sortable_Control($wp_customize, 'cleaninglight_single_post_top_elements', array(
        'label' => esc_html__('Main Content Display & Order', 'cleaning-light'),
        'section' => 'cleaninglight_blog_template',
        'settings' => 'cleaninglight_single_post_top_elements',
        'choices' => array(
            'title' => esc_html__('Title', 'cleaning-light'),
            'post_meta' => esc_html__('Post Meta', 'cleaning-light'),
            'content' => esc_html__('Content', 'cleaning-light'),
        )
    )));
    

    $wp_customize->add_setting('cleaninglight_single_post_bottom_elements', array(
        'default' => array('pagination', 'comment', 'related_posts'),
        'sanitize_callback' => 'cleaninglight_themes_sanitize_multi_choices',
    ));
    
    $wp_customize->add_control(new Cleaninglight_Sortable_Control($wp_customize, 'cleaninglight_single_post_bottom_elements', array(
        'label' => esc_html__('Other Content Display & Order', 'cleaning-light'),
        'section' => 'cleaninglight_blog_template',
        'settings' => 'cleaninglight_single_post_bottom_elements',
        'choices' => array(
            'pagination' => esc_html__('Prev/Next Navigation', 'cleaning-light'),
            'comment' => esc_html__('Comment', 'cleaning-light'),
            'related_posts' => esc_html__('Related Posts', 'cleaning-light')
        )
    )));

    $wp_customize->selective_refresh->add_partial( 'cleaninglight_single_post_top_elements', array(
    'selector'        => '.singlearticle',
    'container_inclusive'  => false,
    'render_callback' => function() {
        get_template_part( 'template-parts/content', 'single' ); 
    }
) );