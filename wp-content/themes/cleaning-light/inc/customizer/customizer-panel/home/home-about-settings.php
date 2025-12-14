<?php
/**
 * About Us Section 
*/
$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_aboutus_section', array(
	'title'		=>	esc_html__('About Us Section','cleaning-light'),
	'panel'		=> 'cleaninglight_frontpage_settings',
	'priority'  => cleaninglight_themes_get_section_position('cleaninglight_aboutus_section'),
	'hiding_control' => 'cleaninglight_aboutus_disable'
)));

//ENABLE/DISABLE ABOUT US SECTION
$wp_customize->add_setting('cleaninglight_aboutus_disable', array(
	'default' => 'enable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_aboutus_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_aboutus_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

$wp_customize->add_setting('cleaninglight_about_nav', array(
	'transport' => 'postMessage',
	'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_about_nav', array(
	'type' => 'tab',
	'section' => 'cleaninglight_aboutus_section',
	'priority' => 1,
	'buttons' => array(
		array(
			'name' => esc_html__('Content', 'cleaning-light'),
			'fields' => array(
				'cleaninglight_aboutus_layout_design',
				'cleaninglight_aboutus_super_title',
				'cleaninglight_about',
				'cleaninglight_about_image',
				'cleaninglight_about_video_link',
				'cleaninglight_progressbar_heading',
				'cleaninglight_progress',
				'cleaninglight_progressbar_item',
				'cleaninglight_aboutus_button_text',
				'cleaninglight_about_readmore_link',
				'cleaninglight_more_about_us',
				'cleaninglight_aboutus_content_length',
				'cleaninglight_aboutus_profile_name',
				'cleaninglight_aboutus_profile_role',
				'cleaninglight_aboutus_profile_image',
				'cleaninglight_aboutus_signature',
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
				'cleaninglight_aboutus_bg_type',
				'cleaninglight_aboutus_bg_color',
				'cleaninglight_aboutus_bg_image',
				'cleaninglight_aboutus_overlay_color',
				'cleaninglight_aboutus_padding',
				'cleaninglight_aboutus_cs_seperator',
			),
		),
	),
)));

	$wp_customize->add_setting( 'cleaninglight_aboutus_super_title', array(
		'sanitize_callback' => 'sanitize_text_field', 	 
		'transport' => 'postMessage'
	));

	$wp_customize->add_control('cleaninglight_aboutus_super_title', array(
		'label'		=> esc_html__( 'Super Title', 'cleaning-light' ),
		'section'	=> 'cleaninglight_aboutus_section',
		'type'      => 'text',
	));

	$wp_customize->add_setting( 'cleaninglight_about', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint'			
	) );
	$wp_customize->add_control( 'cleaninglight_about', array(
		'label'    => esc_html__( 'Select Page ', 'cleaning-light' ),
		'section'  => 'cleaninglight_aboutus_section',
		'type'     => 'dropdown-pages'
	));
	
	$wp_customize->add_setting('cleaninglight_about_image', array(
		'transport' => 'postMessage',
		'sanitize_callback'	=> 'esc_url_raw'		
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cleaninglight_about_image', array(
		'label'	   => esc_html__('Upload Feature Image','cleaning-light'),
		'section'  => 'cleaninglight_aboutus_section',
	)));

	$wp_customize->add_setting( 'cleaninglight_aboutus_button_text', array(
		'default'           => esc_html__( 'More About Us','cleaning-light' ),
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field'			
	) );
	$wp_customize->add_control( 'cleaninglight_aboutus_button_text', array(
		'label'    => esc_html__( 'Button Text', 'cleaning-light' ),
		'section'  => 'cleaninglight_aboutus_section',
		'type'     => 'text',
	));

	$wp_customize->add_setting('cleaninglight_about_readmore_link', array(
		'transport' => 'postMessage',
		'sanitize_callback'	=> 'esc_url_raw'		
	));
	$wp_customize->add_control('cleaninglight_about_readmore_link', array(
		'label'	   => esc_html__('Read More Link','cleaning-light'),
		'section'  => 'cleaninglight_aboutus_section',
		'type'	   => 'url',
	));

	$wp_customize->add_setting('cleaninglight_about_video_link', array(
		'transport' => 'postMessage',
		'sanitize_callback'	=> 'esc_url_raw'		
	));
	$wp_customize->add_control('cleaninglight_about_video_link', array(
		'label'	   => esc_html__('Youtube Video Link','cleaning-light'),
		'section'  => 'cleaninglight_aboutus_section',
		'type'	   => 'url',
	));

	$wp_customize->add_setting('cleaninglight_aboutus_layout_design', array(
		'default' => 'layouttwo',
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_options'
	));
	$wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_aboutus_layout_design', array(
		'section' => 'cleaninglight_aboutus_section',
		'label' => esc_html__('Select Layout', 'cleaning-light'),
		'options' => array(
			'layoutone' => get_template_directory_uri() . '/inc/customizer/images/cover-image-left.webp',
			'layouttwo' => get_template_directory_uri() . '/inc/customizer/images/cover-image-right.webp',
			'layoutthree' => get_template_directory_uri() . '/inc/customizer/images/cover-image-center.webp',
		)
	)));

	/** Progress Bar */
	$wp_customize->add_setting('cleaninglight_progressbar_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_progressbar_heading', array(
        'section' => 'cleaninglight_aboutus_section',
        'label' => esc_html__('Progress Bar Settings', 'cleaning-light')
    )));

	$wp_customize->add_setting('cleaninglight_progress', array(
		'default' => 'disable',
		'transport' => 'postMessage',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',     
	));
	$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_progress', array(
		'label' => esc_html__('Progress Bar', 'cleaning-light'),
		'section' => 'cleaninglight_aboutus_section',
		'switch_label' => array(
			'enable' => esc_html__('Show', 'cleaning-light'),
			'disable' => esc_html__('Hide', 'cleaning-light'),
		),
	)));

	$wp_customize->add_setting('cleaninglight_progressbar_item', array(
		'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
		'transport' => 'postMessage',
		'default' => json_encode(array(
			array(
				'progressbar_title'  =>'',
				'progressbar_number'  =>'',
				'progressbar_color'  =>'',       
			)
		))
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control($wp_customize, 'cleaninglight_progressbar_item', 
		array(
			'label' 	   => esc_html__('Progress Bar Item', 'cleaning-light'),
			'section' 	   => 'cleaninglight_aboutus_section',
			'box_label' => esc_html__('Progress Item', 'cleaning-light'),
			'add_label' => esc_html__('Add New', 'cleaning-light'),
			'limit' => 3,
		),
		array(
			'progressbar_title' => array(
				'type' => 'text',
				'label' => esc_html__('Title', 'cleaning-light'),
				'default' => ''
			),
			'progressbar_number' => array(
				'type' => 'number',
				'label' => esc_html__('Number(%)', 'cleaning-light'),
				'default' => ''
			),
			'progressbar_color' => array(
				'type' => 'colorpicker',
				'label' => esc_html__('Background Color', 'cleaning-light'),
				'default' => ''
			),
		)
	));

	$wp_customize->add_setting('cleaninglight_more_about_us', array(
		'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
		'transport' => 'postMessage',
		'default' => json_encode(array(
			array(
				'aboutus_icon' => '',
				'aboutus_title'  =>'',
				'aboutus_desc'  =>''          
			)
		))
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control($wp_customize, 'cleaninglight_more_about_us', 
		array(
			'label' 	   => esc_html__('More About Us Item', 'cleaning-light'),
			'section' 	   => 'cleaninglight_aboutus_section',
			'box_label' => esc_html__('About Item', 'cleaning-light'),
			'add_label' => esc_html__('Add New', 'cleaning-light'),
			'limit' => 4,
		),
		array(
			'aboutus_icon' => array(
				'type' => 'icon',
				'label' => esc_html__('Icon', 'cleaning-light'),
				'default' => ''
			),
			'aboutus_title' => array(
				'type' => 'text',
				'label' => esc_html__('Title', 'cleaning-light'),
				'default' => ''
			),
			'aboutus_desc' => array(
				'type' => 'text',
				'label' => esc_html__('Description', 'cleaning-light'),
				'default' => ''
			)
		)
	));





	$wp_customize->add_setting( 'cleaninglight_aboutus_profile_image', array(
		'sanitize_callback' => 'sanitize_text_field', 	 
		'transport' => 'postMessage'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cleaninglight_aboutus_profile_image', array(
		'label'	   => esc_html__('Upload Profile Image','cleaning-light'),
		'section'  => 'cleaninglight_aboutus_section',
	)));

	$wp_customize->add_setting( 'cleaninglight_aboutus_profile_name', array(
		'sanitize_callback' => 'sanitize_text_field', 	 
		'transport' => 'postMessage'
	));
	$wp_customize->add_control('cleaninglight_aboutus_profile_name', array(
		'label'		=> esc_html__( 'Profile Name', 'cleaning-light' ),
		'section'	=> 'cleaninglight_aboutus_section',
		'type'      => 'text',
		'priority' => 10
	));
	
	$wp_customize->add_setting( 'cleaninglight_aboutus_profile_role', array(
		'sanitize_callback' => 'sanitize_text_field', 	
		'transport' => 'postMessage'
	));
	$wp_customize->add_control('cleaninglight_aboutus_profile_role', array(
		'label'		=> esc_html__( 'Designation', 'cleaning-light' ),
		'section'	=> 'cleaninglight_aboutus_section',
		'type'      => 'text',
		'priority' => 10
	));

	$wp_customize->add_setting('cleaninglight_aboutus_signature', array(
		'transport' => 'postMessage',
		'priority' => 10,
		'sanitize_callback'	=> 'esc_url_raw'		
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cleaninglight_aboutus_signature', array(
		'label'	   => esc_html__('Signature Image','cleaning-light'),
		'section'  => 'cleaninglight_aboutus_section',
	)));

	$wp_customize->add_setting('cleaninglight_pro_aboutus', array(
		'sanitize_callback' => 'cleaninglight_sanitize_text'
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_aboutus', array(
		'section' => 'cleaninglight_aboutus_section',
		'label' => esc_html__('For More Settings,', 'cleaning-light'),
		'choices' => array(
			esc_html__('More Settings and Layouts', 'cleaning-light'),
			esc_html__('Text Alignment Options', 'cleaning-light'),
			esc_html__('Progress Bar Layout & Settings', 'cleaning-light'),
			esc_html__('Achievement Layout & Settings', 'cleaning-light'),
			esc_html__('Video Link & button settings', 'cleaning-light'),
			esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
		),
		'priority' => 250,
	)));

	$wp_customize->selective_refresh->add_partial( "cleaninglight_aboutus_settings", array (
		'settings' => array( 
			'cleaninglight_aboutus_disable',
			'cleaninglight_about',
			'cleaninglight_about_image',
			'cleaninglight_about_readmore_link',
			'cleaninglight_about_video_link',
			'cleaninglight_progress',
			'cleaninglight_progressbar_item',
			'cleaninglight_aboutus_super_title',
			'cleaninglight_more_about_us',
			'cleaninglight_aboutus_profile_image',
			'cleaninglight_aboutus_profile_name',
			'cleaninglight_aboutus_profile_role',
			'cleaninglight_aboutus_signature',
		),
		'selector' => "#aboutus-section",
		'fallback_refresh' => true,
		'container_inclusive' => true,
		'render_callback' => function () {
			return get_template_part( 'section/section-aboutus' );
		}
	));