<?php
$wp_customize->get_section( 'colors' )->title = esc_html__('Colors Settings', 'cleaning-light');
$wp_customize->get_section( 'colors' )->priority = 4;

$wp_customize->add_setting('cleaninglight_primary_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color',
));
$wp_customize->add_control('cleaninglight_primary_color', array(
    'type' => 'color',
    'label' => esc_html__('Primary Color', 'cleaning-light'),
    'section' => 'colors',
));

$wp_customize->add_setting('content_widget_background', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "content_widget_background", array(
    'section' => "colors",
    'label' => esc_html__('Widget Background', 'cleaning-light')
)));


$wp_customize->add_setting('cleaninglight_pro_advance_color', array(
    'sanitize_callback' => 'cleaninglight_sanitize_text'
));
$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_advance_color', array(
    'section' => 'colors',
    'label' => esc_html__('For More Settings,', 'cleaning-light'),
    'choices' => array(
        esc_html__('H1 To H6 Color Options', 'cleaning-light'),
        esc_html__('Link Color', 'cleaning-light'),
        esc_html__('Link Hover Color', 'cleaning-light'),
        esc_html__('More Color Options', 'cleaning-light'),
    ),
    'priority' => 251,
)));