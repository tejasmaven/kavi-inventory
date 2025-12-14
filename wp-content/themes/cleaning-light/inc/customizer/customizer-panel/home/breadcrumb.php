<?php
$wp_customize->add_section('cleaninglight_titlebar_section', array(
    'title' => esc_html__('Breadcrumb Setting', 'cleaning-light'),
    'priority' => 60,
    'description' => esc_html__('This setting will apply in all posts, pages, archive and search page', 'cleaning-light'),
    'hiding_control' => 'cleaninglight_breadcrumb_option'
));

$wp_customize->add_setting('cleaninglight_breadcrumb_option', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',
    'transport' => 'postMessage',
    'default' => 'enable'
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_breadcrumb_option', array(
    'section' => 'cleaninglight_titlebar_section',
    'label' => esc_html__('Breadcrumb', 'cleaning-light'),
    'switch_label' => array(
        'enable' => esc_html__('Enable', 'cleaning-light'),
        'disable' => esc_html__('Disable', 'cleaning-light')
    ),
    'class' => 'switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('cleaninglight_enable_breadcrumbs_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_enable_breadcrumbs_nav', array(
    'type' => 'tab',
    'section' => 'cleaninglight_titlebar_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_show_title',
                'cleaninglight_breadcrumb',
                'cleaninglight_titlebar_title_align'
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_titlebar_cs_heading',
                'cleaninglight_titlebar_title_color',
                'cleaninglight_titlebar_text_color',
                'cleaninglight_titlebar_link_color',
                'cleaninglight_titlebar_link_hover_color',
            ),
        ),
        array(
            'name' => esc_html__('Advanced', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_titlebar_bg_type',
                'cleaninglight_titlebar_bg_color',
                'cleaninglight_titlebar_bg_image',
                'cleaninglight_titlebar_overlay_color',
                'cleaninglight_titlebar_padding',
                'cleaninglight_titlebar_section_seperator',
                'cleaninglight_titlebar_bottom_seperator',
                'cleaninglight_titlebar_bs_color',
                'cleaninglight_titlebar_bs_height_desktop',
                
            ),
        ),
        array(
            'name' => esc_html__('Hidden', 'cleaning-light'),
            'class' => 'customizer-hidden',
            'fields' => array(
                'cleaninglight_titlebar_super_title_color',
                'cleaninglight_titlebar_radius',
                'cleaninglight_titlebar_cs_seperator',
                'cleaninglight_titlebar_seperator0',
                'cleaninglight_titlebar_seperator1',
                'cleaninglight_titlebar_top_seperator',
                'cleaninglight_titlebar_ts_color',
                'cleaninglight_titlebar_ts_height',
            ),
        ),
    ),
)));

$wp_customize->add_setting('cleaninglight_show_title', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_checkbox',
    'transport' => 'postMessage',
    'default' => true
));
$wp_customize->add_control(new Cleaninglight_Checkbox_Control($wp_customize, 'cleaninglight_show_title', array(
    'section' => 'cleaninglight_titlebar_section',
    'label' => esc_html__('Page Title', 'cleaning-light')
)));


$wp_customize->add_setting('cleaninglight_breadcrumb', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_checkbox',
    'transport' => 'postMessage',
    'default' => true
));
$wp_customize->add_control(new Cleaninglight_Checkbox_Control($wp_customize, 'cleaninglight_breadcrumb', array(
    'section' => 'cleaninglight_titlebar_section',
    'label' => esc_html__('Menu', 'cleaning-light'),
)));

$wp_customize->add_setting( 'cleaninglight_titlebar_title_align', array(
    'default'           => 'text-left',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
    'transport'         => 'postMessage',
));
$wp_customize->add_control( new Cleaninglight_Custom_Control_Buttonset( $wp_customize,'cleaninglight_titlebar_title_align',
    array(
        'choices'  => array(
            'text-left' => esc_html__('Left', 'cleaning-light'),
            'text-right' => esc_html__('Right', 'cleaning-light'),
            'text-center' => esc_html__('Center', 'cleaning-light'),
        ),
        'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
        'section'  => 'cleaninglight_titlebar_section',
    ))
);


$wp_customize->add_setting("cleaninglight_titlebar_section_seperator", array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'bottom',
));
$wp_customize->add_control("cleaninglight_titlebar_section_seperator", array(
    'section' => "cleaninglight_titlebar_section",
    'type' => 'select',
    'label' => esc_html__('Select Separator', 'cleaning-light'),
    'choices' => array(
        'no' => esc_html__('Disable', 'cleaning-light'),
        'bottom' => esc_html__('Bottom Separator', 'cleaning-light'),
    ),
    'priority' => 95
));

$wp_customize->add_setting("cleaninglight_titlebar_bottom_seperator", array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'curv-9',
    'transport' => 'postMessage'
));
$wp_customize->add_control("cleaninglight_titlebar_bottom_seperator", array(
    'section' => "cleaninglight_titlebar_section",
    'type' => 'select',
    'label' => esc_html__('Bottom Separator', 'cleaning-light'),
    'choices' => cleaninglight_themes_svg_seperator(),
    'priority' => 105
));

$wp_customize->add_setting("cleaninglight_titlebar_bs_color", array(
    'default' => '#ffffff',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_titlebar_bs_color", array(
    'section' => "cleaninglight_titlebar_section",
    'label' => esc_html__('Bottom Separator Color', 'cleaning-light'),
    'priority' => 110
)));

$wp_customize->add_setting("cleaninglight_titlebar_bs_height_desktop", array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_number_blank',
    'default' => 40,
    'transport' => 'postMessage'
));
$wp_customize->add_setting("cleaninglight_titlebar_bs_height_tablet", array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_number_blank',
    'default' => 30,
    'transport' => 'postMessage'
));
$wp_customize->add_setting("cleaninglight_titlebar_bs_height_mobile", array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_number_blank',
    'default' => 20,
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Range_Slider_Control($wp_customize, "cleaninglight_titlebar_bs_height_desktop", array(
    'section' => "cleaninglight_titlebar_section",
    'transport' => 'postMessage',
    'label' => esc_html__('Bottom Separator Height', 'cleaning-light'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 400,
        'step' => 1,
    ),
    'settings' => array(
        'desktop' => "cleaninglight_titlebar_bs_height_desktop",
        'tablet' => "cleaninglight_titlebar_bs_height_tablet",
        'mobile' => "cleaninglight_titlebar_bs_height_mobile",
    ),
    'priority' => 120
)));


$wp_customize->add_setting('cleaninglight_pro_breadcrumb', array(
    'sanitize_callback' => 'cleaninglight_sanitize_text'
));
$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_breadcrumb', array(
    'section' => 'cleaninglight_titlebar_section',
    'label' => esc_html__('For More Settings,', 'cleaning-light'),
    'choices' => array(
        esc_html__('Text Alignment Option', 'cleaning-light'),
        esc_html__('Change Title & Menu link Color', 'cleaning-light'),
        esc_html__('4+ Different Background Option ( Color/ Video/ Gradient/ Image ) ', 'cleaning-light'),
        esc_html__('More Than 35+ Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
    ),
    'priority' => 250,
)));


$wp_customize->selective_refresh->add_partial( 'cleaninglight_breadcrumbs_settings', array (
    'settings' => array( 
        'cleaninglight_breadcrumb_option', 
        'cleaninglight_titlebar_section_seperator', 
        'cleaninglight_titlebar_bottom_seperator',
    ),
    'selector' => '.breadcrumb-section',
    'container_inclusive' => true,
    'render_callback' => function() {
        cleaninglight_themes_breadcrumbs();
    }
));