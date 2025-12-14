<?php
   
$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_top_header', array(
    'title' =>	esc_html__('Top Header','cleaning-light'),
    'panel' => 'cleaninglight_header_settings',
    'hiding_control' => 'cleaninglight_top_header_enable'
)));
$wp_customize->add_setting('cleaninglight_top_header_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_top_header_nav', array(
    'type' => 'tab',
    'section' => 'cleaninglight_top_header',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_top_header_hide_show',
                'cleaninglight_topheader_left',
                'cleaninglight_topheader_right',
                'cleaninglight_topheader_social_link',
                'cleaninglight_top_header_quick_content',
                'cleaninglight_topheader_free_hand',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_th_bg_color',
                'cleaninglight_topheader_social_color_link'
            ),
        ),
        array(
            'name' => esc_html__("Advance", 'cleaning-light'),
            'fields' => array(
            )
        )
    ),
)));

$wp_customize->add_setting( 'cleaninglight_top_header_hide_show',
    array(
        'default' => json_encode(array(
            'desktop' => 'show',
            'tablet' => 'show',
            'mobile' => 'hide'
        )),
        'sanitize_callback' => 'cleaninglight_themes_sanitize_field_responsive_buttonset',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control(new Cleaninglight_Custom_Control_Responsive_Buttonset( $wp_customize, 'cleaninglight_top_header_hide_show',
        array(
            'choices'  => array(
                'show' => esc_html__( 'Show', 'cleaning-light' ),
                'hide' => esc_html__( 'Hide', 'cleaning-light' ),
            ),
            'label'    => esc_html__( 'Top Header', 'cleaning-light' ),
            'section' => 'cleaninglight_top_header',
        )
    )
);
    
$wp_customize->add_setting('cleaninglight_topheader_left', array(
    'default' => 'free_hand',
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_select'        
));
$wp_customize->add_control('cleaninglight_topheader_left', array(
    'label' => esc_html__('Left Side Top Header', 'cleaning-light'),
    'section' => 'cleaninglight_top_header',
    'type' => 'select',
    'choices' => array(
        'none' => esc_html__('None', 'cleaning-light'),
        'quick_contact' => esc_html__('Quick Contact Information', 'cleaning-light'),
        'top_menu'  => esc_html__('Top Menu Nav', 'cleaning-light'),
        'free_hand'  => esc_html__('Free Hand', 'cleaning-light'),
    )
));

$wp_customize->add_setting('cleaninglight_topheader_right', array(
    'default' => 'social_media',
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_select'        
));
$wp_customize->add_control('cleaninglight_topheader_right', array(
    'label' => esc_html__('Right Side Top Header', 'cleaning-light'),
    'section' => 'cleaninglight_top_header',
    'type' => 'select',
    'choices' => array(
        'none' => esc_html__('None', 'cleaning-light'),
        'social_media'  => esc_html__('Social Media Links', 'cleaning-light'),
        'top_menu'  => esc_html__('Top Menu Nav', 'cleaning-light'),
    )
));

$wp_customize->selective_refresh->add_partial( 'cleaninglight_topheader_right', array (
    'settings' => array( 
        'cleaninglight_topheader_right',
        'cleaninglight_topheader_left',
        'cleaninglight_topheader_free_hand',
    ),
    'selector' => '#masthead',
    'fallback_refresh' => true,
    'render_callback' => function () {
        $layout = get_theme_mod('cleaninglight_header_layout','layout_one');
        return get_template_part('header/header', str_replace("layout_","", $layout));
    }
));

$wp_customize->add_setting('cleaninglight_topheader_social_link', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Cleaninglight_Info_Text($wp_customize, 'cleaninglight_topheader_social_link', array(
    'label' => esc_html__('Social Links', 'cleaning-light'),
    'section' => 'cleaninglight_top_header',
    'description' => sprintf(esc_html__('Add your %1$s here', 'cleaning-light'), '<a href="#" target="_blank">Social Links</a>')
)));

$wp_customize->add_setting('cleaninglight_top_header_quick_content', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',
    'default' => json_encode(array(
        array(
            'icon' => 'fa-solid fa-headset',
            'label' => '',
            'val' => '+01-555-555-5555',
            'enable' => 'enable'
        ),
        array(
            'icon' => 'fa-regular fa-envelope-open',
            'label' => esc_html('eMail :','cleaning-light'),
            'val' => 'example@example.com',
            'enable' => 'enable'
        ),
        array(
            'icon' => 'fas fa-map-marker-alt',
            'label' => esc_html('Address :','cleaning-light'),
            'val' => '123 Main Street, Springfield, USA',
            'enable' => 'enable'
        )
    ))
));
$wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control($wp_customize, 'cleaninglight_top_header_quick_content', array(
        'label' => esc_html__('Information', 'cleaning-light'),
        'section' => 'cleaninglight_top_header',
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

$wp_customize->selective_refresh->add_partial( 'cleaninglight_top_header_quick_content', array (
    'settings' => array( 
        'cleaninglight_top_header_quick_content' 
    ),
    'selector' => '.cleaninglight-quick-info',
    'container_inclusive' => true,
    'fallback_refresh' => false,
    'render_callback' => function () {
        return cleaninglight_themes_quick_contact();
    }
));

$wp_customize->add_setting('cleaninglight_topheader_free_hand', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
    'default' => esc_html__('Need Any Help: +1-555-555-5555 or example@example.com', 'cleaning-light'),
    'transport' => 'postMessage'
));
$wp_customize->add_control('cleaninglight_topheader_free_hand', array(
    'label' => esc_html__('Free hand', 'cleaning-light'),
    'section' => 'cleaninglight_top_header',
    'type' => 'textarea'
));

$wp_customize->add_setting('cleaninglight_th_bg_color', array(
    'default' => '',
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, 'cleaninglight_th_bg_color', array(
    'label' => esc_html__('Background', 'cleaning-light'),
    'section' => 'cleaninglight_top_header',
)));

$wp_customize->add_setting('cleaninglight_topheader_social_color_link', array(
    'sanitize_callback' => 'sanitize_text_field'
));
$wp_customize->add_control(new Cleaninglight_Info_Text($wp_customize, 'cleaninglight_topheader_social_color_link', array(
    'label' => esc_html__('Social Colors', 'cleaning-light'),
    'section' => 'cleaninglight_top_header',
    'description' => sprintf(esc_html__('Customize your %s here', 'cleaning-light'), '<a href="#" target="_blank">Social Colors</a>')
)));


$wp_customize->add_setting('cleaninglight_pro_top_header', array(
    'sanitize_callback' => 'cleaninglight_sanitize_text'
));
$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_top_header', array(
    'section' => 'cleaninglight_top_header',
    'label' => esc_html__('For More Settings,', 'cleaning-light'),
    'choices' => array(
        esc_html__('Advanced user friendly customizer', 'cleaning-light'),
        esc_html__('Toggle visibility in variant device', 'cleaning-light'),
        esc_html__('Background & gradient color', 'cleaning-light'),
        esc_html__('Change text and link color', 'cleaning-light'),
        esc_html__('Customize margin & padding', 'cleaning-light'),
    ),
    'priority' => 250,
)));