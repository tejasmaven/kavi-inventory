<?php
/**
 * Custom A Section
*/
$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_customa_section', array(
    'title' => esc_html__('Custom Section A', 'cleaning-light'),
    'panel' => 'cleaninglight_frontpage_settings',
    'priority' => cleaninglight_themes_get_section_position('cleaninglight_customa_section'),
    'hiding_control' => 'cleaninglight_customa_disable'
)));

//ENABLE/DISABLE CUSTOM A SECTION
$wp_customize->add_setting('cleaninglight_customa_disable', array(
	'default' => 'disable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_customa_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_customa_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

    $wp_customize->add_setting('cleaninglight_customa_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_customa_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_customa_section',
        'priority' => 1,
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_customa_title_heading',
                    'cleaninglight_customa_super_title',
                    'cleaninglight_customa_title',
                    'cleaninglight_customa_title_align',
                    'cleaninglight_customa_title_style',
                    'cleaninglight_customa_title_style_heading',
                    'cleaninglight_customa_page_settings'
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
                    'cleaninglight_customa_bg_type',
                    'cleaninglight_customa_bg_color',
                    'cleaninglight_customa_bg_image',
                    'cleaninglight_customa_overlay_color',
                    'cleaninglight_customa_padding',
                    'cleaninglight_customa_cs_seperator',
                ),
            ),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_customa_super_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('cleaninglight_customa_super_title', array(
        'section' => 'cleaninglight_customa_section',
        'type' => 'text',
        'label' => esc_html__('Super Title', 'cleaning-light')
    ));

    $wp_customize->add_setting('cleaninglight_customa_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('cleaninglight_customa_title', array(
        'section' => 'cleaninglight_customa_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'cleaning-light')
    ));

    $wp_customize->add_setting('cleaninglight_customa_title_align', array(
        'default' => 'text-center',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Buttonset($wp_customize,'cleaninglight_customa_title_align',
        array(
            'choices'  => array(
                'text-left' => esc_html__('Left', 'cleaning-light'),
                'text-right' => esc_html__('Right', 'cleaning-light'),
                'text-center' => esc_html__('Center', 'cleaning-light'),
            ),
            'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
            'section'  => 'cleaninglight_customa_section',
            'settings' => 'cleaninglight_customa_title_align',
        ))
    );


    $wp_customize->add_setting('cleaninglight_customa_title_style_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_customa_title_style_heading', array(
        'section' => 'cleaninglight_customa_section',
        'label' => esc_html__('Section Title Style', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_customa_title_style', array(
        'default' => 'style1',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_customa_title_style', array(
        'section' => 'cleaninglight_customa_section',
        'type'    => 'select',
        'choices' => array(
            'style1' => esc_html__('Style 1','cleaning-light'),
            'style2' => esc_html__('Style 2','cleaning-light'),			
            'style3' => esc_html__('Style 3','cleaning-light'),			
        )
    ));

   
    $wp_customize->add_setting('cleaninglight_customa_title_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_customa_title_heading', array(
        'section' => 'cleaninglight_customa_section',
        'label' => esc_html__('Select Section Custom Page', 'cleaning-light')
    )));

    $id = "customa";
    $wp_customize->add_setting("cleaninglight_{$id}_page_settings", array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'absint',		
    ));
    $wp_customize->add_control( "cleaninglight_{$id}_page_settings", array(
        'type'     => 'dropdown-pages',
        'section' 	=> "cleaninglight_{$id}_section",
        'description' => esc_html__('Create a custom layout with the selected page using patterns or elementor.', 'cleaning-light')
    ));

    $wp_customize->add_setting('cleaninglight_pro_customa', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_customa', array(
        'section' => 'cleaninglight_customa_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( 'cleaninglight_customa_refresh', array (
    'settings' => array( 
        'cleaninglight_customa_disable',
        'cleaninglight_customa_page_settings',
     ),
    'selector' => '#customa-section',
    'fallback_refresh' => true,
    'container_inclusive' => true,
    'render_callback' => function () {
        return get_template_part( 'section/section', 'customa' );
    }
));