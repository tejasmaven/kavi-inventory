<?php

$wp_customize->add_section('cleaninglight_header_button_section', array(
    'title' => esc_html__('Header Button', 'cleaning-light'),
    'panel' => 'cleaninglight_header_settings'
));

$wp_customize->add_setting('cleaninglight_header_button_enable', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
    'default' => 'enable',
    'transport' => 'postMessage',
    'priority' => -1,
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_header_button_enable', array(
    'section' => 'cleaninglight_header_button_section',
    'label' => esc_html__('Enable', 'cleaning-light'),
    'switch_label' => array(
        'enable' => esc_html__('Yes', 'cleaning-light'),
        'disable' => esc_html__('No', 'cleaning-light')
    ),
    'class' => 'switch-section'
)));


$wp_customize->add_setting('cleaninglight_header_button_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
    'priority' => -1,
));
$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_header_button_nav', array(
    'type' => 'tab',
    'section' => 'cleaninglight_header_button_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_button_style',
                'cleaninglight_hb_icon',
                'cleaninglight_hb_title',
                'cleaninglight_hb_text',
                'cleaninglight_hb_link',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_header_button_bg_color',
                'cleaninglight_header_button_color'
            ),
        )
    ),
)));


$wp_customize->add_setting('cleaninglight_button_style', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
    'default' => 'disable',
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_button_style', array(
    'section' => 'cleaninglight_header_button_section',
    'label' => esc_html__('Button Style', 'cleaning-light'),
    'switch_label' => array(
        'enable' => esc_html__('Style 1', 'cleaning-light'),
        'disable' => esc_html__('Style 2', 'cleaning-light')
    ),
    'class' => 'button-style'
)));

$wp_customize->add_setting('cleaninglight_hb_icon', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
    'default' => 'fa-solid fa-headset',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Fontawesome_Icon_Chooser($wp_customize, 'cleaninglight_hb_icon', array(
    'section' => 'cleaninglight_header_button_section',
    'label' => esc_html__('Icon', 'cleaning-light')
)));


$wp_customize->add_setting('cleaninglight_hb_title', array(
    'default' => esc_html__('Book Now', 'cleaning-light'),
    'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
    'transport' => 'postMessage'
));
$wp_customize->add_control('cleaninglight_hb_title', array(
    'section' => 'cleaninglight_header_button_section',
    'type' => 'text',
    'label' => esc_html__('Title', 'cleaning-light')
));

$wp_customize->add_setting('cleaninglight_hb_text', array(
    'default' => '(5593)-236-8009',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
    'transport' => 'postMessage'
));
$wp_customize->add_control('cleaninglight_hb_text', array(
    'section' => 'cleaninglight_header_button_section',
    'type' => 'text',
    'label' => esc_html__('Text', 'cleaning-light')
));

$wp_customize->add_setting('cleaninglight_hb_link', array(
    'default' => '#',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
    'transport' => 'postMessage'
));
$wp_customize->add_control('cleaninglight_hb_link', array(
    'section' => 'cleaninglight_header_button_section',
    'type' => 'text',
    'label' => esc_html__('Link', 'cleaning-light')
));


$wp_customize->add_setting('cleaninglight_header_button_bg_color', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_header_button_bg_color", array(
    'section' => "cleaninglight_header_button_section",
    'label' => esc_html__('Background', 'cleaning-light')
)));

$wp_customize->add_setting('cleaninglight_header_button_color', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_header_button_color", array(
    'section' => "cleaninglight_header_button_section",
    'label' => esc_html__('Color', 'cleaning-light')
)));

$wp_customize->selective_refresh->add_partial( 'cleaninglight_header_button_refresh', array (
    'settings' => array( 
        'cleaninglight_header_button_enable',
        'cleaninglight_button_style',
        'cleaninglight_hb_icon',
     ),
     'selector' => '#masthead',
     'container_inclusive' => true,
     'render_callback' => function () {
         $layout = get_theme_mod('cleaninglight_header_layout','layout_one');
         return get_template_part('header/header', str_replace("layout_","", $layout));
     }
));