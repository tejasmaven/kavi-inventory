<?php

$wp_customize->add_panel('cleaninglight_general_settings_panel', array(
    'title' => esc_html__('General Settings', 'cleaning-light'),
    'priority' => 2
));

$wp_customize->add_section('cleaninglight_container_section', array(
    'title' => esc_html__('Container', 'cleaning-light'),
    'panel' => 'cleaninglight_general_settings_panel'
));

$wp_customize->get_control('background_color')->section = 'colors';
$wp_customize->get_control('background_image')->section = 'cleaninglight_container_section';
$wp_customize->get_control('background_preset')->section = 'cleaninglight_container_section';
$wp_customize->get_control('background_position')->section = 'cleaninglight_container_section';
$wp_customize->get_control('background_size')->section = 'cleaninglight_container_section';
$wp_customize->get_control('background_repeat')->section = 'cleaninglight_container_section';
$wp_customize->get_control('background_attachment')->section = 'cleaninglight_container_section';

$wp_customize->get_control('background_image')->priority = 20;
$wp_customize->get_control('background_preset')->priority = 20;
$wp_customize->get_control('background_position')->priority = 20;
$wp_customize->get_control('background_size')->priority = 20;
$wp_customize->get_control('background_repeat')->priority = 20;
$wp_customize->get_control('background_attachment')->priority = 20;

$wp_customize->add_setting('cleaninglight_container_width', array(
    'sanitize_callback' => 'absint',
    'default' => 1280,
));
$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_container_width', array(
    'section' => 'cleaninglight_container_section',
    'label' => esc_html__('Container Width (px)', 'cleaning-light'),
    'input_attrs' => array(
        'min' => 1024,
        'max' => 1420,
        'step' => 1
    )
)));

$wp_customize->add_setting('cleaninglight_sidebar_width', array(
    'sanitize_callback' => 'absint',
    'default' => 360,
));
$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_sidebar_width', array(
    'section' => 'cleaninglight_container_section',
    'label' => esc_html__('Sidebar Width (px)', 'cleaning-light'),
    'input_attrs' => array(
        'min' => 300,
        'max' => 380,
        'step' => 1
    )
)));

$wp_customize->add_section('cleaninglight_backtotop_section', array(
    'title' => esc_html__('Scroll to Top', 'cleaning-light'),
    'panel' => 'cleaninglight_general_settings_panel'
));

$wp_customize->add_setting('cleaninglight_backtotop', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
    'default' => true,
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_backtotop', array(
    'section' => 'cleaninglight_backtotop_section',
    'label' => esc_html__('Enable', 'cleaning-light'),
    'switch_label' => array(
        'enable' => esc_html__('Yes', 'cleaning-light'),
        'disable' => esc_html__('No', 'cleaning-light'),
    ),
)));


$wp_customize->add_setting('cleaninglight_pro_upgrade_text', array(
    'sanitize_callback' => 'cleaninglight_sanitize_text'
));
$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_upgrade_text', array(
    'section' => 'cleaninglight_backtotop_section',
    'label' => esc_html__('For More Settings,', 'cleaning-light'),
    'choices' => array(
        esc_html__('Change differents icon', 'cleaning-light'),
        esc_html__('Adjust up arrow position ( Left corner or Right corner )', 'cleaning-light'),
        esc_html__('Change background & font color', 'cleaning-light')
    ),
    'priority' => 250,
)));