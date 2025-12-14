<?php
$section_array = array('titlebar', 'aboutus', 'calltoaction', 'promoservice', 'video_calltoaction', 'service', 'counter', 'recentwork', 'testimonial', 'team', 'client', 'contact', 'blog', 'customa' );

$super_title_exclude_array = [ 'calltoaction' ];

$exculde_section_array = $section_array;

foreach ($section_array as $id) {
    
    $wp_customize->add_setting("cleaninglight_{$id}_bg_type", array(
        'default' => 'none',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control("cleaninglight_{$id}_bg_type", array(
        'section' => "cleaninglight_{$id}_section",
        'type' => 'select',
        'label' => esc_html__('Background Type', 'cleaning-light'),
        'choices' => array(
            'none' => esc_html__('Default', 'cleaning-light'),
            'color-bg' => esc_html__('Color Background', 'cleaning-light'),
            'image-bg' => esc_html__('Image Background', 'cleaning-light'),
        ),
        'priority' => 15
    ));
    $wp_customize->add_setting("cleaninglight_{$id}_bg_color", array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_{$id}_bg_color", array(
        'section' => "cleaninglight_{$id}_section",
        'label' => esc_html__('Background Color', 'cleaning-light'),
        'priority' => 20
    )));

    $wp_customize->add_setting("cleaninglight_{$id}_bg_image_url", array(
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Background_Control($wp_customize, "cleaninglight_{$id}_bg_image", array(
        'label' => esc_html__('Background Image', 'cleaning-light'),
        'section' => "cleaninglight_{$id}_section",
        'settings' => array(
            'image_url' => "cleaninglight_{$id}_bg_image_url",
        ),
        'priority' => 30
    )));
    
    $wp_customize->add_setting("cleaninglight_{$id}_overlay_color", array(
        'default' => 'rgba(255,255,255,0)',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_{$id}_overlay_color", array(
        'label' => esc_html__('Background Overlay Color', 'cleaning-light'),
        'section' => "cleaninglight_{$id}_section",
        'priority' => 45
    )));

    $wp_customize->add_setting("cleaninglight_{$id}_cs_seperator", array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control(new Cleaninglight_Separator_Control($wp_customize, "cleaninglight_{$id}_cs_seperator", array(
        'section' => "cleaninglight_{$id}_section",
        'priority' => 80
    )));
   
    $wp_customize->add_setting( "cleaninglight_{$id}_padding",
        array(
            'transport' => 'postMessage',
            'sanitize_callback' => 'cleaninglight_themes_sanitize_field_default_css_box'
        )
    );
    $wp_customize->add_control( new Cleaninglight_Themes_Custom_Control_Cssbox( $wp_customize, "cleaninglight_{$id}_padding",
        array(
            'label'    => esc_html__( 'Padding', 'cleaning-light' ),
            'section' => "cleaninglight_{$id}_section",
            'priority' => 80
        ),
        array(),
        array()
    ));
}