<?php
/**
 * Gallery Section
*/
$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_recentwork_section', array(
	'title'		=> 	esc_html__('Gallery Section','cleaning-light'),
	'panel'		=> 'cleaninglight_frontpage_settings',
	'priority'  => cleaninglight_themes_get_section_position('cleaninglight_recentwork_section'),
	'hiding_control' => 'cleaninglight_portfolio_disable'
)));

//ENABLE/DISABLE GALLERY SECTION
$wp_customize->add_setting('cleaninglight_portfolio_disable', array(
	'default' => 'enable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_portfolio_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_recentwork_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

	$wp_customize->add_setting('cleaninglight_recentwork_nav', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	));
	$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_recentwork_nav', array(
		'type' => 'tab',
		'section' => 'cleaninglight_recentwork_section',
		'priority' => 1,
		'buttons' => array(
			array(
				'name' => esc_html__('Content', 'cleaning-light'),
				'fields' => array(
					'cleaninglight_recentwork_title_align',
					'cleaninglight_recentwork_super_title',
					'cleaninglight_recentwork_title',
					'cleaninglight_recentwork_title_style_heading',
					'cleaninglight_recentwork_title_style',
					'cleaninglight_recentwork_gallery',
					'cleaninglight_gallery_default_text',
					'cleaninglight_gallery_tab_align',
					'cleaninglight_gallery_display_layout',
					'cleaninglight_gallery_caption_disable',
					'cleaninglight_gallery_zoom_icon_disable',
					'cleaninglight_recentwork_block_space',
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
					'cleaninglight_recentwork_bg_type',
					'cleaninglight_recentwork_bg_color',
					'cleaninglight_recentwork_bg_image',
					'cleaninglight_recentwork_overlay_color',
					'cleaninglight_recentwork_padding',
					'cleaninglight_recentwork_cs_seperator',
				),
			),
		),
	)));

		
	$wp_customize->add_setting( 'cleaninglight_recentwork_super_title', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field', 	 
	));
	$wp_customize->add_control('cleaninglight_recentwork_super_title', array(
		'label'		=> esc_html__( 'Super Title', 'cleaning-light' ),
		'section'	=> 'cleaninglight_recentwork_section',
		'type'      => 'text'
	));
	
	$wp_customize->add_setting( 'cleaninglight_recentwork_title', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field', 	 
	));
	$wp_customize->add_control('cleaninglight_recentwork_title', array(
		'label'		=> esc_html__( 'Title', 'cleaning-light' ),
		'section'	=> 'cleaninglight_recentwork_section',
		'type'      => 'text'
	));
	
	$wp_customize->add_setting('cleaninglight_recentwork_title_align', array(
		'default' => 'text-center',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_recentwork_title_align',
		array(
			'choices'  => array(
				'text-left' => esc_html__('Left', 'cleaning-light'),
				'text-right' => esc_html__('Right', 'cleaning-light'),
				'text-center' => esc_html__('Center', 'cleaning-light'),
			),
			'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
			'section'  => 'cleaninglight_recentwork_section',
			'settings' => 'cleaninglight_recentwork_title_align',
		)
	));

	$wp_customize->add_setting('cleaninglight_recentwork_title_style_heading', array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_recentwork_title_style_heading', array(
		'section' => 'cleaninglight_recentwork_section',
		'label' => esc_html__('Section Title Style', 'cleaning-light')
	)));


	$wp_customize->add_setting('cleaninglight_recentwork_title_style', array(
		'default' => 'style1',
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
	));
	$wp_customize->add_control('cleaninglight_recentwork_title_style', array(
		'section' => 'cleaninglight_recentwork_section',
		'type'    => 'select',
		'choices' => array(
			'style1' => esc_html__('Style 1','cleaning-light'),
			'style2' => esc_html__('Style 2','cleaning-light'),			
			'style3' => esc_html__('Style 3','cleaning-light'),			
		)
	));

	/** Advance */
	$wp_customize->add_setting('cleaninglight_recentwork_gallery', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		//done
		'default' => json_encode(array(
			array(
				'title'      => '',
				'gallery'    => '',
			)
		))
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize,'cleaninglight_recentwork_gallery', 
		array(
			'label' 	   => esc_html__('Advance Gallery Image', 'cleaning-light'),
			'section' 	   => 'cleaninglight_recentwork_section',
			'settings' 	   => 'cleaninglight_recentwork_gallery',
			'box_label' => esc_html__('Gallery Item', 'cleaning-light'),
			'add_label' => esc_html__('Add New', 'cleaning-light'),
			'limit' => 5,
		),
		array(
			'title' => array(
				'type' => 'text',
				'label' => __("Title", 'cleaning-light'),
			),
			'gallery' => array(
				'type' => 'gallery',
				'label' => __("Upload Image", 'cleaning-light'),
			),
		)
	));

	$wp_customize->add_setting( 'cleaninglight_gallery_default_text', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field', 
		'default' => '',	 
	));
	$wp_customize->add_control('cleaninglight_gallery_default_text', array(
		'label'		=> esc_html__( 'Default Text', 'cleaning-light' ),
		'section'	=> 'cleaninglight_recentwork_section',
		'type'      => 'text'
	));

	$wp_customize->add_setting('cleaninglight_gallery_tab_align', array(
		'default' => 'center',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control( new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_gallery_tab_align',
		array(
			'choices'  => array(
				'start' => esc_html__('Left', 'cleaning-light'),
				'center' => esc_html__('Center', 'cleaning-light'),
				'end' => esc_html__('Right', 'cleaning-light'),
			),
			'label'    => esc_html__( 'Tab Alignment', 'cleaning-light' ),
			'section'  => 'cleaninglight_recentwork_section',
		)
	));

	$wp_customize->add_setting('cleaninglight_gallery_display_layout', 
		array( 
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'style6',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_gallery_display_layout', array(
		'section' => 'cleaninglight_recentwork_section',
		'label' => esc_html__('Gallery Display Layout', 'cleaning-light'),
		'options' => array(
			'style1' => get_template_directory_uri() . '/inc/customizer/images/gallery-style1.webp',
			'style2' => get_template_directory_uri() . '/inc/customizer/images/gallery-style2.webp',
			'style3' => get_template_directory_uri() . '/inc/customizer/images/gallery-style3.webp',
			'style6' => get_template_directory_uri() . '/inc/customizer/images/gallery-style6.webp',
		)
	)));

	$wp_customize->add_setting('cleaninglight_gallery_caption_disable', array(
		'default' => 'enable',
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
	));
	$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_gallery_caption_disable', array(
		'label' => esc_html__('Gallery Caption', 'cleaning-light'),
		'section' => 'cleaninglight_recentwork_section',
		'switch_label' => array(
			'enable' => esc_html__('Enable', 'cleaning-light'),
			'disable' => esc_html__('Disable', 'cleaning-light'),
		)
	)));

	$wp_customize->add_setting('cleaninglight_gallery_zoom_icon_disable', array(
		'default' => 'enable',
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
	));
	$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_gallery_zoom_icon_disable', array(
		'label' => esc_html__('Zoom Button', 'cleaning-light'),
		'section' => 'cleaninglight_recentwork_section',
		'switch_label' => array(
			'enable' => esc_html__('Enable', 'cleaning-light'),
			'disable' => esc_html__('Disable', 'cleaning-light'),
		)
	)));

	$wp_customize->add_setting('cleaninglight_recentwork_block_space', array(
		'sanitize_callback' => 'absint',
		'default' => 1,
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_recentwork_block_space', array(
		'section' => 'cleaninglight_recentwork_section',
		'label' => esc_html__('Block Space', 'cleaning-light'),
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'step' => 1,
		)
	)));

	$wp_customize->add_setting('cleaninglight_pro_recentwork', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_recentwork', array(
        'section' => 'cleaninglight_recentwork_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('(4+) Different Layout ( Tabs Included )', 'cleaning-light'),
            esc_html__('Add Unlimited Gallery Items', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Advanced Gallery Layout & Settings', 'cleaning-light'),
            esc_html__('Able to specify Gallery Description', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('(4+) Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));
	
$wp_customize->selective_refresh->add_partial( "cleaninglight_portfolio_section_refresh", array (
	'settings' => array( 
		'cleaninglight_portfolio_disable',
		'cleaninglight_gallery_default_text',
		'cleaninglight_recentwork_gallery',
		'cleaninglight_gallery_display_layout',
		'cleaninglight_recentwork_block_space',
	),
	'selector' => "#recentwork-section",
	'fallback_refresh' => true,
	'container_inclusive' => true,
	'render_callback' => function () {
		return get_template_part( 'section/section-recentwork' );
	}
));