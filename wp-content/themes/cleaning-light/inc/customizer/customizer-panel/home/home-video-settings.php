<?php
/**
 * Video Call To Action Section
*/
$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_video_calltoaction_section', array(
	'title'		=> 	esc_html__('Video Call To Action Section','cleaning-light'),
	'panel'		=> 'cleaninglight_frontpage_settings',
	'priority'  => cleaninglight_themes_get_section_position('cleaninglight_video_calltoaction_section'),
	'hiding_control' => 'cleaninglight_videcta_disable'
)));

//ENABLE/DISABLE VIDEO CALL TO ACTION SECTION
$wp_customize->add_setting('cleaninglight_videcta_disable', array(
	'default' => 'enable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_videcta_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_video_calltoaction_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

	$wp_customize->add_setting('cleaninglight_video_calltoaction_section_nav', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	));
	$wp_customize->add_control( new Cleaninglight_Custom_Control_Tab( $wp_customize, 'cleaninglight_video_calltoaction_section_nav', array(
		'type' => 'tab',
		'section' => 'cleaninglight_video_calltoaction_section',
		'priority' => 1,
		'buttons' => array(
			array(
				'name' => esc_html__('Content', 'cleaning-light'),
				'fields' => array(
					'cleaninglight_video_cta_layout',
					'cleaninglight_video_button_url',
					'cleaninglight_video_calltoaction_video_bg',
					'cleaninglight_appointment_contact_title',
					'cleaninglight_appointment_shortcode',
					'cleaninglight_video_calltoaction_height',
				),
				'active' => true,
			),
			array(
				'name' => esc_html__('Style', 'cleaning-light'),
				'fields' => array(
					'cleaninglight_video_calltoaction_box_bg_color'
				),
			),
			array(
				'name' => esc_html__('Advanced', 'cleaning-light'),
				'fields' => array(
					'cleaninglight_video_calltoaction_bg_type',
					'cleaninglight_video_calltoaction_bg_color',
					'cleaninglight_video_calltoaction_bg_image',
					'cleaninglight_video_calltoaction_overlay_color',
					'cleaninglight_video_calltoaction_padding',
					'cleaninglight_video_calltoaction_cs_seperator',
				),
			)
		)
	)));

	$wp_customize->add_setting('cleaninglight_video_cta_layout', array(
        'default' => 'video-cta-top',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_video_cta_layout',
            array(
                'choices'  => array(
                    'video-cta-left' => esc_html__('Left', 'cleaning-light'),
                    'video-cta-right' => esc_html__('Right', 'cleaning-light'),
                    'video-cta-top' => esc_html__('Top', 'cleaning-light'),
                    'video-cta-below' => esc_html__('Below', 'cleaning-light'),
                ),
                'label'    => esc_html__( 'Display Position', 'cleaning-light' ),
                'section'  => 'cleaninglight_video_calltoaction_section',
            )
        )
    );

	$wp_customize->add_setting('cleaninglight_video_button_url', array(
		'transport' => 'postMessage',
		'sanitize_callback'	=> 'esc_url_raw',
		'default' => 'https://www.youtube.com/watch?v=1IaZy0sDLu0',		
	));
	$wp_customize->add_control('cleaninglight_video_button_url', array(
		'label'	   => esc_html__('Youtube Video URL','cleaning-light'),
		'section'  => 'cleaninglight_video_calltoaction_section',
		'type'	   => 'url'
	));

	$wp_customize->add_setting( 'cleaninglight_video_calltoaction_video_bg', array(
		'sanitize_callback' => 'esc_url_raw', 	 	
		'transport' => 'postMessage',
		'default' => get_template_directory_uri() . '/assets/images/bg.jpg',
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cleaninglight_video_calltoaction_video_bg', array(
		'label'	   => esc_html__('Video Background Image','cleaning-light'),
		'section'  => 'cleaninglight_video_calltoaction_section',
	)));

	$wp_customize->add_setting('cleaninglight_appointment_contact_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => esc_html__('Get in Touch Quickly', 'cleaning-light'),
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('cleaninglight_appointment_contact_title', array(
        'section' => 'cleaninglight_video_calltoaction_section',
        'type' => 'text',
        'label' => esc_html__('Contact Title', 'cleaning-light')
    ));
	
	$wp_customize->add_setting('cleaninglight_appointment_shortcode', array(
		'transport' => 'postMessage',
		'sanitize_callback'	=> 'sanitize_text_field'		
	));
	$wp_customize->add_control('cleaninglight_appointment_shortcode', array(
		'label'	   => esc_html__('Shortcode','cleaning-light'),
		'description' => sprintf(esc_html__('Install %s plugin to get the shortcode or you can use any shortcode', 'cleaning-light'), '<a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>'),
		'section'  => 'cleaninglight_video_calltoaction_section',
		'type'	   => 'text',
	));

	$wp_customize->add_setting('cleaninglight_video_calltoaction_height', array(
		'sanitize_callback' => 'absint',
		'default' => 450,
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_video_calltoaction_height', array(
		'section' => 'cleaninglight_video_calltoaction_section',
		'label' => esc_html__('Video Call To Action Height (px)', 'cleaning-light'),
		'input_attrs' => array(
			'min' => 300,
			'max' => 900,
			'step' => 1
		)
	)));

	$wp_customize->add_setting("cleaninglight_video_calltoaction_box_bg_color", array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_video_calltoaction_box_bg_color", array(
        'section' => "cleaninglight_video_calltoaction_section",
        'label' => esc_html__('Background Color', 'cleaning-light'),
        'priority' => 54
    )));

	$wp_customize->add_setting('cleaninglight_pro_video_calltoaction', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_video_calltoaction', array(
        'section' => 'cleaninglight_video_calltoaction_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('Different Layout & Settings', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Advanced Services Items Settings', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( "cleaninglight_video_cta_refresh", array (
	'settings' => array(
		'cleaninglight_videcta_disable',
		'cleaninglight_video_cta_layout',
		'cleaninglight_video_button_url',
		'cleaninglight_video_calltoaction_video_bg',
		'cleaninglight_appointment_contact_title',
		'cleaninglight_appointment_shortcode',
	),
	'selector' => "#video_calltoaction-section",
	'fallback_refresh' => true,
	'container_inclusive' => true,
	'render_callback' => function () {
		return get_template_part( 'section/section-video_calltoaction' );
	}
));