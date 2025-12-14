<?php
    $wp_customize->remove_control('header_image');
   
	$wp_customize->add_section('cleaninglight_header', array(
		'title'		=>	esc_html__('Header Layout','cleaning-light'),
		'panel'		=> 'cleaninglight_header_settings',
	));
    $wp_customize->add_setting('cleaninglight_header_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
        'priority' => -1,
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_header_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_header',
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_header_layout',
                    'cleaninglight_menu_sidebar',
                    'cleaninglight_enable_search',
                ),
                'active' => true,
            ),
            array(
                'name' => esc_html__('Style', 'cleaning-light'),
                'fields' => array(
                ),
            ),
            array(
                'name' => esc_html__('Menu Style', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_header_full_nav_bg_color',
                    'cleaninglight_menu_seperator',
                    'cleaninglight_menu_item_color',
                    'cleaninglight_menu_item_link_color',
                    'cleaninglight_menu_bg_color',
                    'cleaninglight_submenu_seperator',
                    'cleaninglight_submenu_bg_color',
                    'cleaninglight_submenu_item_color',
                    'cleaninglight_submenu_item_link_color',
                    'cleaninglight_submenu_item_bg_color',
                )
            )
        ),
    )));
		
    $wp_customize->add_setting('cleaninglight_header_layout', array(
        'default' => 'layout_one',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'       
    ));
    $wp_customize->add_control('cleaninglight_header_layout', array(
        'label' => esc_html__('Header Layout', 'cleaning-light'),
        'section' => 'cleaninglight_header',
        'type' => 'select',
        'choices' => array(
            'layout_one' => esc_html__('Layout One' , 'cleaning-light'),
            'layout_two' => esc_html__('Layout Two' ,'cleaning-light'),
            'layout_three' => esc_html__('Layout Three (Transparent)' ,'cleaning-light'),
        )
    ));

    $wp_customize->add_setting('cleaninglight_enable_search', array(
        'default' => 'enable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_enable_search', array(
        'label' => esc_html__('Header Search', 'cleaning-light'),
        'section' => 'cleaninglight_header',
        'switch_label' => array(
            'enable' => esc_html__('Enable', 'cleaning-light'),
            'disable' => esc_html__('Disable', 'cleaning-light'),
        ),
    )));


    /** Menu Style */
    $wp_customize->add_setting("cleaninglight_header_full_nav_bg_color", array(
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage',
        'default' => ''
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, 
        "cleaninglight_header_full_nav_bg_color", 
        array(
            'section' => 'cleaninglight_header',
            'label' => esc_html__('Full Menu Background', 'cleaning-light')
        )
    ));

    $wp_customize->add_setting('cleaninglight_menu_seperator', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Separator_Control( $wp_customize, 
        'cleaninglight_menu_seperator', array(
        'section' => 'cleaninglight_header'
    )));
    
    $wp_customize->add_setting('cleaninglight_menu_item_color', array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control( $wp_customize, 
        'cleaninglight_menu_item_color', 
        array(
            'section' => 'cleaninglight_header',
            'label' => esc_html__('Menu Link Color', 'cleaning-light')
        )
    ));
    
    $wp_customize->add_setting('cleaninglight_menu_item_link_color', array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control( $wp_customize, 
        'cleaninglight_menu_item_link_color', 
        array(
            'section' => 'cleaninglight_header',
            'label' => esc_html__('Menu Link Color - Hover', 'cleaning-light')
        )
    ));
    
    $wp_customize->add_setting('cleaninglight_menu_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control( $wp_customize, 
        'cleaninglight_menu_bg_color', 
        array(
            'section' => 'cleaninglight_header',
            'label' => esc_html__('Background Color - Hover', 'cleaning-light')
        )
    ));
    
    $wp_customize->add_setting('cleaninglight_submenu_seperator', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Separator_Control( $wp_customize, 
        'cleaninglight_submenu_seperator', array(
        'section' => 'cleaninglight_header'
    )));

    $wp_customize->add_setting('cleaninglight_submenu_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control( $wp_customize, 
        'cleaninglight_submenu_bg_color', 
        array(
            'section' => 'cleaninglight_header',
            'label' => esc_html__('Submenu Background Color', 'cleaning-light')
        )
    ));

    $wp_customize->add_setting('cleaninglight_submenu_item_color', array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control( $wp_customize, 
        'cleaninglight_submenu_item_color', 
        array(
            'section' => 'cleaninglight_header',
            'label' => esc_html__('SubMenu Link Color', 'cleaning-light')
        )
    ));
    
    $wp_customize->add_setting('cleaninglight_submenu_item_link_color', array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control( $wp_customize, 
        'cleaninglight_submenu_item_link_color', 
        array(
            'section' => 'cleaninglight_header',
            'label' => esc_html__('SubMenu Link Color - Hover', 'cleaning-light')
        )
    ));
    
    $wp_customize->add_setting('cleaninglight_submenu_item_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control( $wp_customize, 
        'cleaninglight_submenu_item_bg_color', 
        array(
            'section' => 'cleaninglight_header',
            'label' => esc_html__('SubMenu Item BG Color - Hover', 'cleaning-light')
        )
    ));

    $wp_customize->selective_refresh->add_partial( 'cleaninglight_header_layout', array (
        'settings' => array( 
            'cleaninglight_enable_search',
            'cleaninglight_header_bg_type',
        ),
        'selector' => '#masthead',
        'container_inclusive' => true,
        'render_callback' => function () {
            $layout = get_theme_mod('cleaninglight_header_layout','layout_one');
            return get_template_part('header/header', str_replace("layout_","", $layout));
        }
    ));


$wp_customize->add_setting('cleaninglight_pro_main_header', array(
    'sanitize_callback' => 'cleaninglight_sanitize_text'
));
$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_main_header', array(
    'section' => 'cleaninglight_header',
    'label' => esc_html__('For More Settings,', 'cleaning-light'),
    'choices' => array(
        esc_html__('Six(6) different header layouts', 'cleaning-light'),
        esc_html__('Advanced user friendly customizer', 'cleaning-light'),
        esc_html__('Select background options ( color / gradient / image )', 'cleaning-light'),
        esc_html__('Show/Hide sticky menu', 'cleaning-light'),
        esc_html__('Change title & info color', 'cleaning-light'),
        esc_html__('Change Menu Wrapper color', 'cleaning-light'),
        esc_html__('Change Menu Hover/Active Color', 'cleaning-light'),
        esc_html__('Seven(7) Menu Hover Styles', 'cleaning-light'),
    ),
    'priority' => 250,
)));