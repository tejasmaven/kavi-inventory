<?php

$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_team_section', array(
    'title'		=> 	esc_html__('Team Section','cleaning-light'),
    'panel'		=> 'cleaninglight_frontpage_settings',
    'priority'  => cleaninglight_themes_get_section_position('cleaninglight_team_section'),
    'hiding_control' => 'cleaninglight_team_disable'
)));

//ENABLE/DISABLE TEAM MEMBER SECTION
$wp_customize->add_setting('cleaninglight_team_disable', array(
	'default' => 'enable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_team_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_team_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

    $wp_customize->add_setting('cleaninglight_team_section_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_team_section_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_team_section',
        'priority' => 1,
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_team_section',
                    'cleaninglight_team_super_title',
                    'cleaninglight_team_title',
                    'cleaninglight_team_title_style_heading',
                    'cleaninglight_team_title_style',
                    'cleaninglight_team_title_align',
                    'cleaninglight_team_type_heading',
                    'cleaninglight_team_type',
                    'cleaninglight_team',
                    'cleaninglight_team_advance',
                    'cleaninglight_team_style',
                    'cleaninglight_team_block_height',
                    'cleaninglight_team_display_style',
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
                    'cleaninglight_team_bg_type',
                    'cleaninglight_team_bg_color',
                    'cleaninglight_team_bg_image',
                    'cleaninglight_team_overlay_color',
                    'cleaninglight_team_padding',
                    'cleaninglight_team_cs_seperator',
                ),
            ),
        ),
    )));

    $wp_customize->add_setting( 'cleaninglight_team_super_title', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'			
    ) );
    $wp_customize->add_control( 'cleaninglight_team_super_title', array(
        'label'    => esc_html__( 'Super Title', 'cleaning-light' ),
        'section'  => 'cleaninglight_team_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting( 'cleaninglight_team_title', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'			
    ) );
    $wp_customize->add_control( 'cleaninglight_team_title', array(
        'label'    => esc_html__( 'Title', 'cleaning-light' ),
        'section'  => 'cleaninglight_team_section',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('cleaninglight_team_title_align', array(
        'default' => 'text-center',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(
        new Cleaninglight_Custom_Control_Buttonset( $wp_customize, 'cleaninglight_team_title_align',
            array(
                'choices'  => array(
                    'text-left' => esc_html__('Left', 'cleaning-light'),
                    'text-center' => esc_html__('Center', 'cleaning-light'),
                    'text-right' => esc_html__('Right', 'cleaning-light'),
                ),
                'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
                'section'  => 'cleaninglight_team_section',
            )
        )
    );
  
    $wp_customize->add_setting('cleaninglight_team_title_style_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_team_title_style_heading', array(
        'section' => 'cleaninglight_team_section',
        'label' => esc_html__('Section Title Style', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_team_title_style', array(
        'default' => 'style1',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_team_title_style', array(
        'section' => 'cleaninglight_team_section',
        'type'    => 'select',
        'choices' => array(
            'style1' => esc_html__('Style 1','cleaning-light'),
            'style2' => esc_html__('Style 2','cleaning-light'),			
            'style3' => esc_html__('Style 3','cleaning-light'),			
        )
    ));

    $wp_customize->add_setting('cleaninglight_team_type_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_team_type_heading', array(
        'section' => 'cleaninglight_team_section',
        'label' => esc_html__('Select Type', 'cleaning-light')
    )));
    
    $wp_customize->add_setting('cleaninglight_team_type', array(
        'default' => 'default',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'
    ));
    $wp_customize->add_control('cleaninglight_team_type', array(
        'section' => 'cleaninglight_team_section',
        'type' => 'radio',
        'choices' => array(
            'default' => esc_html__('Default', 'cleaning-light'),
            'advance' => esc_html__('Advanced', 'cleaning-light')
        )
    ));
  
    $wp_customize->add_setting('cleaninglight_team', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',	
        'default' => json_encode(array(
            array(
                'team_page'   => '',
                'teamimage'   => '',
                'designation' =>'',
                'facebook'    =>'',
                'twitter'     =>'',
                'linkedin'    =>'',
                'instagram'   => '',
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, 'cleaninglight_team', array(
            'label' 	   => esc_html__('Default Team Settings', 'cleaning-light'),
            'section' 	   => 'cleaninglight_team_section',
            'settings' 	   => 'cleaninglight_team',
            'box_label' => esc_html__('Team Item', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
            'limit' => 6,
        ),
        array(
            'team_page' => array(
                'type'    => 'select',
                'label'   => esc_html__('Select Page', 'cleaning-light'),
                'options' => $pages
            ),
            'teamimage' => array(
                'type' => 'upload',
                'label' => esc_html__("Upload Image (Only Work Style 2)", 'cleaning-light'),
            ),
            'designation' => array(
                'type'    => 'text',
                'label'   => esc_html__('Designation', 'cleaning-light'),
                'default' => ''
            ),
            'facebook'  => array(
                'type'   => 'url',
                'label'  => esc_html__('Facebook Link', 'cleaning-light'),
                'default' => ''
            ),
            'twitter' 	=> array(
                'type'    => 'url',
                'label'   => esc_html__('Twitter Link', 'cleaning-light'),
                'default' => ''
            ),
            'linkedin'   => array(
                'type'    => 'url',
                'label'   => esc_html__('Linkedin Link', 'cleaning-light'),
                'default' => ''
            ),
            'instagram' => array(
                'type'    => 'url',
                'label'   => esc_html__('Instagram Link', 'cleaning-light'),
                'default' => ''
            )
        )
    ));
   
    $wp_customize->add_setting('cleaninglight_team_advance', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',	
        'default' => json_encode(array(
            array(
                'team_image'     => '',
                'teamimage'   => '',
                'team_title'     => '',
                'team_designation' =>'',
                'team_desc'      => '',
                'team_url'       => '',
                'facebook'       =>'',
                'twitter'        =>'',
                'linkedin'       =>'',
                'instagram'      => '',
                'alignment'      => 'center',
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, 'cleaninglight_team_advance', array(
            'label' 	   => esc_html__('Advance Team Settings', 'cleaning-light'),
            'section' 	   => 'cleaninglight_team_section',
            'settings' 	   => 'cleaninglight_team_advance',
            'box_label' => esc_html__('Team Item', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
            'limit' => 6,
        ),
        array(
            'team_image' => array(
                'type' => 'upload',
                'label' => esc_html__("Upload Image", 'cleaning-light'),
            ),
            'teamimage' => array(
                'type' => 'upload',
                'label' => esc_html__("Upload Image (Only Work Style 2)", 'cleaning-light'),
            ),
            'team_title' => array(
                'type' => 'text',
                'label' => esc_html__("Title", 'cleaning-light'),
            ),
            'team_designation' => array(
                'type'    => 'text',
                'label'   => esc_html__('Designation', 'cleaning-light'),
                'default' => ''
            ),
            'team_desc' => array(
                'type' => 'textarea',
                'label' => esc_html__("Short Description", 'cleaning-light'),
            ),
            'team_url' => array(
                'type' => 'url',
                'label' => esc_html__('Details Url', 'cleaning-light'),
                'default' => ''
            ),
            'facebook'  => array(
                'type'   => 'url',
                'label'  => esc_html__('Facebook Link', 'cleaning-light'),
                'default' => ''
            ),
            'twitter' 	=> array(
                'type'    => 'url',
                'label'   => esc_html__('Twitter Link', 'cleaning-light'),
                'default' => ''
            ),
            'linkedin'   => array(
                'type'    => 'url',
                'label'   => esc_html__('Linkedin Link', 'cleaning-light'),
                'default' => ''
            ),
            'instagram' => array(
                'type'    => 'url',
                'label'   => esc_html__('Instagram Link', 'cleaning-light'),
                'default' => ''
            ),
            'alignment' => array(
                'type' => 'select',
                'default' => 'center',
                'label' => esc_html__('Alignment', 'cleaning-light'),
                'options' => array(
                    'start' => esc_html__('Left', 'cleaning-light'),
                    'center' => esc_html__('Center', 'cleaning-light'),
                    'end' => esc_html__('Right', 'cleaning-light')
                )
            ),
        )
    ));
   
    $wp_customize->add_setting('cleaninglight_team_style', array(
        'sanitize_callback' => 'cleaninglight_themes_sanitize_options',
        'default' => 'style2',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_team_style', array(
        'section' => 'cleaninglight_team_section',
        'label' => esc_html__('Choose Style', 'cleaning-light'),
        'options' => array(
            'style1' => get_template_directory_uri() . '/inc/customizer/images/team-style1.webp',
            'style2' => get_template_directory_uri() . '/inc/customizer/images/team-style3.webp',
            'style3' => get_template_directory_uri() . '/inc/customizer/images/team-style5.webp',
        )
    )));

    $wp_customize->add_setting('cleaninglight_team_block_height', array(
        'sanitize_callback' => 'absint',
        'default' => 470,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_team_block_height', array(
        'section' => 'cleaninglight_team_section',
        'label' => esc_html__('Team Block Height (PX)', 'cleaning-light'),
        'input_attrs' => array(
            'min' => 300,
            'max' => 900,
            'step' => 1,
        )
    )));

    $wp_customize->add_setting('cleaninglight_team_display_style', array(
        'default' => 'grid',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_team_display_style', array(
        'section' => 'cleaninglight_team_section',
        'type'    => 'select',
        'label' => esc_html__('Display Style', 'cleaning-light'),
        'choices' => array(
            'grid' => esc_html__('Grid','cleaning-light'),
            'slide' => esc_html__('Slide','cleaning-light'),			
        )
    ));

    $wp_customize->add_setting('cleaninglight_pro_team', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_team', array(
        'section' => 'cleaninglight_team_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('(6+) Different Layout & Settings', 'cleaning-light'),
            esc_html__('Add Unlimited Team Items', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Advanced Team Items Settings', 'cleaning-light'),
            esc_html__('More Icon Settings ( Background Color/Color/Border Color/Border Width & Padding )', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( "cleaninglight_team_options_refresh", array (
    'settings' => array(
        'cleaninglight_team_disable',
        'cleaninglight_team_type',
        'cleaninglight_team',
        'cleaninglight_team_advance',
        'cleaninglight_team_style',
        'cleaninglight_team_display_style',
    ),
    'selector' => "#team-section",
    'fallback_refresh' => true,
    'container_inclusive' => true,
    'render_callback' => function () {
        return get_template_part( 'section/section-team' );
    }
));