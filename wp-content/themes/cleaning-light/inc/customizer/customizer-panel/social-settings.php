<?php

$wp_customize->add_section('cleaninglight_social_section', array(
    'title' => esc_html__('Social Media', 'cleaning-light'),
    'panel' => 'cleaninglight_header_settings',
    'priority' => 201,
));
$wp_customize->add_setting('cleaninglight_social_section_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
    
));

$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_social_section_nav', array(
    'type' => 'tab',
    'section' => 'cleaninglight_social_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_topheader_social',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'cleaning-light'),
            'fields' => array(
               'cleaninglight_social_icon_color',
               'cleaninglight_social_icon_bg_color',
               'cleaninglight_social_icon_hover_color',
               'cleaninglight_social_icon_hover_bg_color'
            ),
        ),
    ),
)));

$wp_customize->add_setting('cleaninglight_topheader_social', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'icon' => 'fab fa-facebook',
            'link' => '#',
        ),
        array(
            'icon' => 'fa-brands fa-x-twitter',
            'link' => '#',
        ),
        array(
            'icon' => 'fab fa-linkedin',
            'link' => '#',
        ),
        array(
            'icon' => 'fab fa-pinterest',
            'link' => '#',
        ),
        array(
            'icon' => 'fab fa-instagram',
            'link' => '#',
        ),
        array(
            'icon' => 'fab fa-youtube',
            'link' => '#',
        )
    ))
));
$wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control($wp_customize, 'cleaninglight_topheader_social', array(
        'label' => esc_html__('Social Links', 'cleaning-light'),
        'section' => 'cleaninglight_social_section',
        'box_label' => esc_html__('Social Link', 'cleaning-light'),
        'add_label' => esc_html__('Add New', 'cleaning-light'),
        'limit' => 6,
    ), 
    array(
        'icon' => array(
            'type' => 'social-icon',
            'label' => esc_html__('Select Icon', 'cleaning-light'),
            'default' => 'icofont-facebook'
        ),
        'link' => array(
            'type' => 'url',
            'label' => esc_html__('Link', 'cleaning-light'),
            'default' => ''
        ),
    )
));

$wp_customize->selective_refresh->add_partial( 'cleaninglight_topheader_social', array (
    'settings' => array( 'cleaninglight_topheader_social' ),
    'selector' => '.top-bar-menu .cleaninglight-socialicon',
    'container_inclusive' => true,
    'render_callback' => function () {
        return cleaninglight_themes_topheader_social();
    }
));

$wp_customize->add_setting('cleaninglight_social_icon_color', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
    'default' => '',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, 'cleaninglight_social_icon_color', array(
    'section' => 'cleaninglight_social_section',
    'label' => esc_html__('Color', 'cleaning-light')
)));

$wp_customize->add_setting('cleaninglight_social_icon_bg_color', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
    'default' => '',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, 'cleaninglight_social_icon_bg_color', array(
    'section' => 'cleaninglight_social_section',
    'label' => esc_html__('Background Color', 'cleaning-light')
)));

$wp_customize->add_setting('cleaninglight_social_icon_hover_color', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
    'default' => '',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, 'cleaninglight_social_icon_hover_color', array(
    'section' => 'cleaninglight_social_section',
    'label' => esc_html__('Hover Color', 'cleaning-light')
)));

$wp_customize->add_setting('cleaninglight_social_icon_hover_bg_color', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
    'default' => '',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, 'cleaninglight_social_icon_hover_bg_color', array(
    'section' => 'cleaninglight_social_section',
    'label' => esc_html__('Hover Background Color', 'cleaning-light')
)));