<?php

$wp_customize->add_section('cleaninglight_quick_info', array(
    'title' => esc_html__('Quick Information', 'cleaning-light'),
	'panel' => 'cleaninglight_header_settings',
	'priority' => 200
));

$wp_customize->add_setting('cleaninglight_quick_nav', array(
	'transport' => 'postMessage',
	'sanitize_callback' => 'wp_kses_post',
	'priority' => -1,
));
$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_quick_nav', array(
	'type' => 'tab',
	'section' => 'cleaninglight_quick_info',
	'buttons' => array(
		array(
			'name' => esc_html__('Settings', 'cleaning-light'),
			'fields' => array(
				'cleaninglight_quick_content',
			),
			'active' => true,
		),
		array(
			'name' => esc_html__('Style', 'cleaning-light'),
			'fields' => array(
			)
		)
	)
)));

$wp_customize->add_setting('cleaninglight_quick_content', array(
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',
	'default' => json_encode(array(
		array(
			'icon' => 'fa-regular fa-envelope-open',
			'label' => esc_html('Quick Questions? Email Us','cleaning-light'),
			'val' => 'example@example.com',
			'enable' => 'enable'
		),
		array(
			'icon' => 'fa-solid fa-headset',
			'label' => esc_html('Talk to an Expert (Aradia)','cleaning-light'),
			'val' => '(555)-555-5555',
			'enable' => 'enable'
		),
		array(
			'icon' => 'fas fa-map-marker-alt',
			'label' => esc_html('Office Address','cleaning-light'),
			'val' => '123 Main Street, Springfield, USA',
			'enable' => 'enable'
		)
	))
));
$wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control($wp_customize, 'cleaninglight_quick_content', array(
		'label' => esc_html__('Information', 'cleaning-light'),
		'section' => 'cleaninglight_quick_info',
		'box_label' => esc_html__('Information Item', 'cleaning-light'),
		'add_label' => esc_html__('Add New', 'cleaning-light'),
		'sortable'	=> 'enable',
		'limit' => 3,
	), 
	array(
		'icon' => array(
			'type' => 'icon',
			'label' => esc_html__('Icon', 'cleaning-light'),
			'default' => ''
		),
		'label' => array(
			'type' => 'text',
			'label' => esc_html__('Label', 'cleaning-light'),
			'default' => ''
		),
		'val' => array(
			'type' => 'text',
			'label' => esc_html__('Value', 'cleaning-light'),
			'default' => ''
		),			
		'enable' => array(
			'type' => 'switch',
			'label' => esc_html__('Enable', 'cleaning-light'),
			'switch' => array(
				'enable' => esc_html__('Yes', 'cleaning-light'),
				'disable' => esc_html__('No', 'cleaning-light')
			),
			'default' => 'enable'
		)
	)
));

$wp_customize->selective_refresh->add_partial( 'cleaninglight_quick_content', array (
	'settings' => array( 
		'cleaninglight_quick_content' 
	),
	'selector' => '.cleaninglight-quick-contact',
	'container_inclusive' => true,
	'fallback_refresh' => false,
	'render_callback' => function () {
		return cleaninglight_themes_quick_contact_info_header();
	}
));


$wp_customize->add_setting('cleaninglight_pro_quick_info', array(
    'sanitize_callback' => 'cleaninglight_sanitize_text'
));
$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_quick_info', array(
    'section' => 'cleaninglight_quick_info',
    'label' => esc_html__('For More Settings,', 'cleaning-light'),
    'choices' => array(
        esc_html__('Advanced Customization ( Icon, Label/Title & Link )', 'cleaning-light'),
        esc_html__('Change Title, Text & Icon Color', 'cleaning-light'),
    ),
    'priority' => 250,
)));