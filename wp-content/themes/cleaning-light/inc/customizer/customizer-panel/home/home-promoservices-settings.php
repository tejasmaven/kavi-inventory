<?php
/**
 * Promo (Feautes Services) Section
*/
$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_promoservice_section', array(
    'title' => esc_html__('Feature Services Section', 'cleaning-light'),
    'panel' => 'cleaninglight_frontpage_settings',
    'priority' => cleaninglight_themes_get_section_position('cleaninglight_promoservice_section'),
    'hiding_control' => 'cleaninglight_promoservice_disable'
)));

//ENABLE/DISABLE FEATURES SERVIVE SECTION
$wp_customize->add_setting('cleaninglight_promoservice_disable', array(
	'default' => 'enable',
	'transport' => 'postMessage',
	'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',    
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_promoservice_disable', array(
	'label' => esc_html__('Section', 'cleaning-light'),
	'section' => 'cleaninglight_promoservice_section',
	'switch_label' => array(
		'enable' => esc_html__('Enable', 'cleaning-light'),
		'disable' => esc_html__('Disable', 'cleaning-light'),
	),
	'class' => 'switch-section',
    'priority' => -1,
)));

    $wp_customize->add_setting('cleaninglight_promoservice_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_promoservice_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_promoservice_section',
        'priority' => 1,
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_promoservice_super_title',
                    'cleaninglight_promoservice_title',
                    'cleaninglight_promoservice_title_align',
                    'cleaninglight_promoservice_title_style',
                    'cleaninglight_promoservice_style',
                    'cleaninglight_promoservice_type_heading',
                    'cleaninglight_promoservice_show_image',
                    'cleaninglight_promoservice_show_icon',
                    'cleaninglight_promoservice',
                    'cleaninglight_promo_service_icon',
                    'cleaninglight_promoservice_type',
                    'cleaninglight_promoservice_advance_settings'
                ),
                'active' => true,
            ),
            array(
                'name' => esc_html__('Style', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_promoservice_icon_style',
                ),
            ),
            array(
                'name' => esc_html__('Advanced', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_promoservice_bg_type',
                    'cleaninglight_promoservice_bg_color',
                    'cleaninglight_promoservice_bg_image',
                    'cleaninglight_promoservice_overlay_color',
                    'cleaninglight_promoservice_padding',
                    'cleaninglight_promoservice_cs_seperator',
                ),
            ),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_promoservice_super_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('cleaninglight_promoservice_super_title', array(
        'section' => 'cleaninglight_promoservice_section',
        'type' => 'text',
        'label' => esc_html__('Super Title', 'cleaning-light')
    ));

    $wp_customize->add_setting('cleaninglight_promoservice_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('cleaninglight_promoservice_title', array(
        'section' => 'cleaninglight_promoservice_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'cleaning-light')
    ));

    $wp_customize->add_setting('cleaninglight_promoservice_title_align', array(
        'default' => 'text-center',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Buttonset($wp_customize,'cleaninglight_promoservice_title_align',
        array(
            'choices'  => array(
                'text-left' => esc_html__('Left', 'cleaning-light'),
                'text-right' => esc_html__('Right', 'cleaning-light'),
                'text-center' => esc_html__('Center', 'cleaning-light'),
            ),
            'label'    => esc_html__( 'Alignment', 'cleaning-light' ),
            'section'  => 'cleaninglight_promoservice_section',
            'settings' => 'cleaninglight_promoservice_title_align',
        ))
    );

    $wp_customize->add_setting('cleaninglight_promoservice_title_style', array(
        'default' => 'style1',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'         
    ));
    $wp_customize->add_control('cleaninglight_promoservice_title_style', array(
        'section' => 'cleaninglight_promoservice_section',
        'label'    => esc_html__( 'Section Title Style', 'cleaning-light' ),
        'type'    => 'select',
        'choices' => array(
            'style1' => esc_html__('Style 1','cleaning-light'),
            'style2' => esc_html__('Style 2','cleaning-light'),			
            'style3' => esc_html__('Style 3','cleaning-light'),			
        )
    ));


    $wp_customize->add_setting('cleaninglight_promoservice_type_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_promoservice_type_heading', array(
        'section' => 'cleaninglight_promoservice_section',
        'label' => esc_html__('Select Feature Services Type', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_promoservice_type', array(
        'default' => 'default',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select'
    ));
    $wp_customize->add_control('cleaninglight_promoservice_type', array(
        'section' => 'cleaninglight_promoservice_section',
        'type' => 'radio',
        'choices' => array(
            'default' => esc_html__('Default', 'cleaning-light'),
            'advance' => esc_html__('Advanced', 'cleaning-light')
        )
    ));

    $wp_customize->add_setting('cleaninglight_promoservice', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
        'default' => json_encode(array(
            array(
                'service_page' => '',
                'service_icon' =>'fa-solid fa-bezier-curve',
                'bg_color' => '',
                'color' => '',
                'alignment' => 'center',

            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, 
        'cleaninglight_promoservice', 
        array(
            'label' 	   => esc_html__('Default Services Settings', 'cleaning-light'),
            'section' 	   => 'cleaninglight_promoservice_section',
            'settings' 	   => 'cleaninglight_promoservice',
            'box_label' => esc_html__('Service', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
            'limit' => 6,
        ),
        array(
            'service_page' => array(
                'type' => 'select',
                'label' => esc_html__('Select Page', 'cleaning-light'),
                'options' => $pages
            ),
            'service_icon' => array(
                'type' => 'icon',
                'label' => esc_html__('Choose Icon', 'cleaning-light'),
                'default' => 'fa-solid fa-bezier-curve'
            ),
            'bg_color' => array(
                'type'  => 'colorpicker',
                'label' => esc_html__( 'Background Color', 'cleaning-light' ),
            ),
            'color' => array(
                'type'  => 'colorpicker',
                'label' => esc_html__( 'Color', 'cleaning-light' ),
            ),
            'alignment' => array(
                'type' => 'select',
                'label' => esc_html__("Alignment", 'cleaning-light'),
                'default' => 'center',
                'options' => array(
                    'start' => esc_html__('Left', 'cleaning-light'),
                    'center' => esc_html__('Center', 'cleaning-light'),
                    'end' => esc_html__('Right', 'cleaning-light')
                )
            )
            
        )
    ));


    $id = "promoservice";
    $wp_customize->add_setting("cleaninglight_{$id}_advance_settings", array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
        'default' => json_encode(array(
            array(
                'block_image'      => '',
                'block_icon'       => 'fa-solid fa-bezier-curve',
                'block_title'      => '',
                'block_desc'       => '',
                'button_text'      => '',
                'button_url'       => '',
                'block_bg_color'   => '',
                'block_color'      => '',
                'block_alignment'  => 'center',
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, "cleaninglight_{$id}_advance_settings", 
        array(
            'label' 	   => esc_html__('Advance Services Settings', 'cleaning-light'),
            'section' 	   => "cleaninglight_{$id}_section",
            'settings' 	   => "cleaninglight_{$id}_advance_settings",
            'box_label' => esc_html__('Service Item', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
            'limit' => 6,
        ),
        array(
            'block_image' => array(
                'type' => 'upload',
                'label' => __("Upload Image", 'cleaning-light'),
            ),
            'block_icon' => array(
                'type' => 'icon',
                'label' => esc_html__('Choose Icon', 'cleaning-light'),
                'default' => 'fa-solid fa-bezier-curve'
            ),
            'block_title' => array(
                'type' => 'text',
                'label' => __("Title", 'cleaning-light'),
            ),
            'block_desc' => array(
                'type' => 'textarea',
                'label' => __("Short Description", 'cleaning-light'),
            ),
            'button_text' => array(
                'type' => 'text',
                'label' => esc_html__('Button Text', 'cleaning-light'),
                'default' => ''
            ),
            'button_url' => array(
                'type' => 'url',
                'label' => esc_html__('Button Url', 'cleaning-light'),
                'default' => ''
            ),
            'block_bg_color' => array(
                'type'  => 'colorpicker',
                'label' => esc_html__( 'Background Color', 'cleaning-light' ),
            ),
            'block_color' => array(
                'type'  => 'colorpicker',
                'label' => esc_html__( 'Color', 'cleaning-light' ),
            ),
            'block_alignment' => array(
                'type' => 'select',
                'label' => esc_html__("Alignment", 'cleaning-light'),
                'default' => 'center',
                'options' => array(
                    'start' => esc_html__('Left', 'cleaning-light'),
                    'center' => esc_html__('Center', 'cleaning-light'),
                    'end' => esc_html__('Right', 'cleaning-light')
                )
            ),
        )
    ));

    $wp_customize->add_setting('cleaninglight_promoservice_style', array(
        'sanitize_callback' => 'cleaninglight_themes_sanitize_options',
        'default' => 'style1',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_promoservice_style', array(
        'section' => 'cleaninglight_promoservice_section',
        'label' => esc_html__('Choose Layout', 'cleaning-light'),
        'options' => array(
            'style1' => get_template_directory_uri() . '/inc/customizer/images/fsc1.webp',
            'style2' => get_template_directory_uri() . '/inc/customizer/images/fsc2.webp',
        )
    )));

    $wp_customize->add_setting('cleaninglight_promo_service_icon', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 0,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_promo_service_icon', array(
        'section' => 'cleaninglight_promoservice_section',
        'label' => esc_html__('Margin Top', 'cleaning-light'),
        'input_attrs' => array(
            'min' => -120,
            'max' => 120,
            'step' => 1,
        ),
    )));

    $wp_customize->add_setting('cleaninglight_promoservice_show_image', array(
        'default' => 'enable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',     
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_promoservice_show_image', array(
        'label' => esc_html__('Display Image', 'cleaning-light'),
        'section' => 'cleaninglight_promoservice_section',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        )
    )));

    $wp_customize->add_setting('cleaninglight_promoservice_show_icon', array(
        'default' => 'enable',
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',     
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_promoservice_show_icon', array(
        'label' => esc_html__('Display Icon', 'cleaning-light'),
        'section' => 'cleaninglight_promoservice_section',
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        )
    )));
    
    $wp_customize->add_setting('cleaninglight_promoservice_icon_style',
        array(
            'sanitize_callback' => 'cleaninglight_themes_sanitize_field_background',
            'transport'     => 'postMessage',
            'default'       => json_encode(array(
                'padding'   => '',
                'radius'    => '',
                'borderwidth' => '',
                'bordercolor' => '',
                'iconsize' => '',
            )),
        )
    );
    $wp_customize->add_control( new Cleaninglight_Themes_Custom_Control_Group( $wp_customize, 'cleaninglight_promoservice_icon_style',
        array(
            'label'    => esc_html__( 'Item Icon Settings', 'cleaning-light' ),
            'section'  => 'cleaninglight_promoservice_section',
            'priority' => 100,
        ),
        array(
            'padding' => array(
                'type'  => 'cssbox',
                'label' => esc_html__( 'Padding', 'cleaning-light' ),
            ),
            'radius' => array(
                'type'  => 'cssbox',
                'label' => esc_html__( 'Radius', 'cleaning-light' ),
            ),
            'borderwidth' => array(
                'type'  => 'number',
                'label' => esc_html__( 'Border Width', 'cleaning-light' ),
            ),
            'bordercolor' => array(
                'type'  => 'color',
                'label' => esc_html__( 'Border Color', 'cleaning-light' ),
            ),
            'iconsize' => array(
                'type'  => 'number',
                'label' => esc_html__( 'Font Size', 'cleaning-light' ),
            ),
        ))
    );

    $wp_customize->add_setting('cleaninglight_pro_promoservice', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_promoservice', array(
        'section' => 'cleaninglight_promoservice_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('(4+) Different Layout & Settings', 'cleaning-light'),
            esc_html__('Add Unlimited Service Items', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Advanced Services Items Settings', 'cleaning-light'),
            esc_html__('More Icon Settings ( Background Color/Color/Border Color/Border Width & Padding )', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( 'cleaninglight_promoservice_refresh', array (
    'settings' => array( 
        'cleaninglight_promoservice_disable',
        'cleaninglight_promoservice',
        'cleaninglight_promoservice_style',
        'cleaninglight_promoservice_show_image',
        'cleaninglight_promoservice_type',
        'cleaninglight_promoservice_advance_settings',
     ),
    'selector' => '#promoservice-section',
    'fallback_refresh' => true,
    'container_inclusive' => true,
    'render_callback' => function () {
        return get_template_part( 'section/section', 'promoservice' );
    }
));