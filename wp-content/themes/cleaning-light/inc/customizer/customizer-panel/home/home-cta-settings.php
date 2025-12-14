<?php
/**
 * Call To Action Section
*/
$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_calltoaction_section', array(
	'title'		=> 	esc_html__('Call To Action Section','cleaning-light'),
	'panel'		=> 'cleaninglight_frontpage_settings',
	'priority'  => cleaninglight_themes_get_section_position('cleaninglight_calltoaction_section'),
	'hiding_control' => 'cleaninglight_cta_disable'
)));

//ENABLE/DISABLE CALL TO ACTION SECTION
$wp_customize->add_setting('cleaninglight_cta_disable', array(
	'default' => 'enable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_cta_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_calltoaction_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

	$wp_customize->add_setting('cleaninglight_calltoaction_section_nav', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	));
	$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_calltoaction_section_nav', array(
		'type' => 'tab',
		'section' => 'cleaninglight_calltoaction_section',
		'priority' => 1,
		'buttons' => array(
			array(
				'name' => esc_html__('Content', 'cleaning-light'),
				'fields' => array(
					'cleaninglight_cta_style',
					'cleaninglight_cta_width',
					'cleaninglight_cta_layout',
					'cleaninglight_cta_alignment',
					'cleaninglight_calltoaction_image',
					'cleaninglight_calltoaction_icon',
					'cleaninglight_call_to_action_title',
					'cleaninglight_call_to_action_subtitle',
					'cleaninglight_call_to_action_button',
					'cleaninglight_call_to_action_link',
					'cleaninglight_call_to_action_button_one',
					'cleaninglight_call_to_action_link_one',
					'cleaninglight_calltoaction_height',
				),
				'active' => true,
			),
			array(
				'name' => esc_html__('Style', 'cleaning-light'),
				'fields' => array(
					'cleaninglight_cta_title_font_size',
					'cleaninglight_cta_desc_font_size',
					'cleaninglight_calltoaction_cs_heading',
					'cleaninglight_calltoaction_box_bg_color',
					'cleaninglight_calltoaction_title_color',
					'cleaninglight_calltoaction_text_color',
				)
			),
			array(
				'name' => esc_html__('Advanced', 'cleaning-light'),
				'fields' => array(
					'cleaninglight_calltoaction_bg_type',
					'cleaninglight_calltoaction_bg_color',
					'cleaninglight_calltoaction_bg_image',
					'cleaninglight_calltoaction_overlay_color',
					'cleaninglight_calltoaction_padding',
					'cleaninglight_calltoaction_margin',
					'cleaninglight_calltoaction_radius',
					'cleaninglight_calltoaction_cs_seperator',
				),
			),
		),
	)));

	$wp_customize->add_setting('cleaninglight_cta_style', array(
		'default' => 'cover',
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_select'       
	));
	$wp_customize->add_control('cleaninglight_cta_style', array(
		'label' => esc_html__('Layout', 'cleaning-light'),
		'section' => 'cleaninglight_calltoaction_section',
		'type' => 'select',
		'choices' => array(
			'classic' => esc_html__('Classic' , 'cleaning-light'),
			'cover' => esc_html__('Cover' ,'cleaning-light'),
		)
	));

	$wp_customize->add_setting('cleaninglight_cta_width', array(
		'default' => 'container',
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_select'       
	));
	$wp_customize->add_control('cleaninglight_cta_width', array(
		'label' => esc_html__('Width', 'cleaning-light'),
		'section' => 'cleaninglight_calltoaction_section',
		'type' => 'select',
		'choices' => array(
			'container' => esc_html__('Container' ,'cleaning-light'),
			'full' => esc_html__('Full' , 'cleaning-light'),
		)
	));

	$wp_customize->add_setting('cleaninglight_calltoaction_image', array(
		'transport' => 'postMessage',
		'sanitize_callback'	=> 'esc_url_raw',
		'default' => get_template_directory_uri() . '/assets/images/bg.jpg',	
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cleaninglight_calltoaction_image', array(
		'label'	   => esc_html__('Background Image','cleaning-light'),
		'section'  => 'cleaninglight_calltoaction_section'
	)));

	$wp_customize->add_setting('cleaninglight_cta_layout', array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
		'default' => 'cta-above'
	));
	$wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_cta_layout', array(
		'section' => 'cleaninglight_calltoaction_section',
		'label' => esc_html__('Select Layout', 'cleaning-light'),
		'options' => array(
			'cta-above' => get_template_directory_uri() . '/inc/customizer/images/cta-image-top.webp',
			'cta-left' => get_template_directory_uri() . '/inc/customizer/images/cta-image-left.webp',
			'cta-right' => get_template_directory_uri() . '/inc/customizer/images/cta-image-right.webp',
			'cta-below' => get_template_directory_uri() . '/inc/customizer/images/cta-image-bottom.webp',
		)
	)));

	$wp_customize->add_setting('cleaninglight_calltoaction_height', array(
		'sanitize_callback' => 'absint',
		'default' => 450,
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_calltoaction_height', array(
		'section' => 'cleaninglight_calltoaction_section',
		'label' => esc_html__('Call To Action Height (px)', 'cleaning-light'),
		'input_attrs' => array(
			'min' => 300,
			'max' => 900,
			'step' => 1
		)
	)));

	$wp_customize->add_setting( 'cleaninglight_cta_alignment', array(
		'default'           => 'center',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_cta_alignment', array(
		'choices'  => array(
			'start' => esc_html__('Left', 'cleaning-light'),
			'center' => esc_html__('Center', 'cleaning-light'),
			'end' => esc_html__('Right', 'cleaning-light'),
		),
		'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
		'section'  => 'cleaninglight_calltoaction_section',
	)));

	$wp_customize->add_setting('cleaninglight_calltoaction_icon', array(
		'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
		'default' => 'fa-solid fa-headset',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(new Cleaninglight_Fontawesome_Icon_Chooser($wp_customize, 'cleaninglight_calltoaction_icon', array(
		'section' => 'cleaninglight_calltoaction_section',
		'label' => esc_html__('Icon', 'cleaning-light')
	)));

	$wp_customize->add_setting('cleaninglight_call_to_action_title', array(
		'transport' => 'postMessage',
		'default' => esc_html__('Welcome to our Cleaning WordPress Themes!', 'cleaning-light'),
		'sanitize_callback'	=> 'sanitize_text_field'		
	));
	$wp_customize->add_control('cleaninglight_call_to_action_title', array(
		'label'	   => esc_html__('Title','cleaning-light'),
		'section'  => 'cleaninglight_calltoaction_section',
		'type'	   => 'text',
	));

	$wp_customize->add_setting('cleaninglight_call_to_action_subtitle', array(
		'transport' => 'postMessage',
		'default' => esc_html__('Try our premium themes risk-free. If you are not 100% satisfied with the features and performance of our premium themes, we will credit your original payment method without any question.', 'cleaning-light'),
		'sanitize_callback'	=> 'cleaninglight_themes_sanitize_text'		
	));
	$wp_customize->add_control('cleaninglight_call_to_action_subtitle', array(
		'label'	   => esc_html__('Description','cleaning-light'),
		'section'  => 'cleaninglight_calltoaction_section',
		'type'	   => 'textarea',
	));
	
	$wp_customize->add_setting('cleaninglight_call_to_action_button', array(
		'transport' => 'postMessage',
		'default' => esc_html__('WordPress Themes', 'cleaning-light'),
		'sanitize_callback'	=> 'sanitize_text_field'		
	));
	$wp_customize->add_control('cleaninglight_call_to_action_button', array(
		'label'	   => esc_html__('Button One Text','cleaning-light'),
		'section'  => 'cleaninglight_calltoaction_section',
		'type'	   => 'text',
	));
	$wp_customize->add_setting('cleaninglight_call_to_action_link', array(
		'transport' => 'postMessage',
		'sanitize_callback'	=> 'esc_url_raw'		
	));
	$wp_customize->add_control('cleaninglight_call_to_action_link', array(
		'label'	   => esc_html__('Button One Link','cleaning-light'),
		'section'  => 'cleaninglight_calltoaction_section',
		'type'	   => 'url',
	));

	$wp_customize->add_setting('cleaninglight_call_to_action_button_one', array(
		'transport' => 'postMessage',
		'default' => esc_html__('Buy Now', 'cleaning-light'),
		'sanitize_callback'	=> 'sanitize_text_field'		
	));
	$wp_customize->add_control('cleaninglight_call_to_action_button_one', array(
		'label'	   => esc_html__('Button Two Text','cleaning-light'),
		'section'  => 'cleaninglight_calltoaction_section',
		'type'	   => 'text',
	));
	$wp_customize->add_setting('cleaninglight_call_to_action_link_one', array(
		'transport' => 'postMessage',
		'sanitize_callback'	=> 'esc_url_raw'		
	));
	$wp_customize->add_control('cleaninglight_call_to_action_link_one', array(
		'label'	   => esc_html__('Button Two Link','cleaning-light'),
		'section'  => 'cleaninglight_calltoaction_section',
		'type'	   => 'url',
	));


	$wp_customize->add_setting("cleaninglight_cta_title_font_size", array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_number_blank',
		'default' => 28
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, "cleaninglight_cta_title_font_size", array(
		'section' => "cleaninglight_calltoaction_section",
		'label' => esc_html__('Title Font Size', 'cleaning-light'),
		'input_attrs' => array(
			'min' => 10,
			'max' => 200,
			'step' => 1,
		)
	)));
	$wp_customize->add_setting("cleaninglight_cta_desc_font_size", array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_number_blank',
		'default' => 18,
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, "cleaninglight_cta_desc_font_size", array(
		'section' => "cleaninglight_calltoaction_section",
		'label' => esc_html__('Description Font Size', 'cleaning-light'),
		'input_attrs' => array(
			'min' => 10,
			'max' => 200,
			'step' => 1,
		)
	)));

	$wp_customize->add_setting("cleaninglight_calltoaction_box_bg_color", array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_calltoaction_box_bg_color", array(
        'section' => "cleaninglight_calltoaction_section",
        'label' => esc_html__('Background Color', 'cleaning-light'),
        'priority' => 54
    )));

	$wp_customize->add_setting('cleaninglight_pro_calltoaction', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_calltoaction', array(
        'section' => 'cleaninglight_calltoaction_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('(5+) Different Layout & Settings', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( "cleaninglight_calltoaction_refresh", array (
	'settings' => array(
		'cleaninglight_cta_disable',
		'cleaninglight_cta_width',
		'cleaninglight_calltoaction_image',
		'cleaninglight_calltoaction_icon',
	),
	'selector' => "#calltoaction-section",
	'fallback_refresh' => true,
	'container_inclusive' => true,
	'render_callback' => function () {
		return get_template_part( 'section/section-calltoaction' );
	}
));