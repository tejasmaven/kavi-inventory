<?php

$wp_customize->add_section('cleaninglight_footer_section', array(
    'title'		  => esc_html__('Footer Settings','cleaning-light'),
    'priority'	  => 66,
));

$wp_customize->add_setting('cleaninglight_footer_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
    'priority' => -1,
));
$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_footer_nav', array(
    'type' => 'tab',
    'section' => 'cleaninglight_footer_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Settings', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_footer_column',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'cleaning-light'),
            'fields' => array(
            )
        ),
        array(
            'name' => esc_html__('Advanced', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_footer_bg_heading',
                'cleaninglight_footer_bg_type',
                'cleaninglight_footer_bg_color',
                'cleaninglight_footer_background_image',
                'cleaninglight_footer_bg_image',
                'cleaninglight_footer_overlay_color',
                'cleaninglight_footer_padding',
                'cleaninglight_footer_bottom_seperator',
                'cleaninglight_footer_seperator0',
                'cleaninglight_footer_section_seperator',
                'cleaninglight_footer_top_seperator',
                'cleaninglight_footer_ts_color',
                'cleaninglight_footer_ts_height',
            )
        )
    )
)));

$wp_customize->add_setting('cleaninglight_footer_column', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_text',
    'default' => 'd-grid-column-3',
    'transport' => 'postMessage',
));
$imagepath =  get_template_directory_uri() . '/inc/customizer/images/';
$wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_footer_column', array(
    'section' => 'cleaninglight_footer_section',
    'label' => esc_html__('Choose Layout', 'cleaning-light'),
    'options' => array(
        'd-grid-column-1' => $imagepath . 'footer-style1.webp',
        'd-grid-column-2' => $imagepath . 'footer-style2.webp',
        'd-grid-column-3' => $imagepath . 'footer-style3.webp',
        'd-grid-column-4' => $imagepath . 'footer-style6.webp'
    )
)));

    $id = "footer";
    $wp_customize->add_setting("cleaninglight_{$id}_bg_type", array(
        'default' => 'none',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_select',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control("cleaninglight_{$id}_bg_type", array(
        'section' => "cleaninglight_{$id}_section",
        'type' => 'select',
        'label' => esc_html__('Background Type', 'cleaning-light'),
        'choices' => array(
            'none'      => esc_html__('Default', 'cleaning-light'),
            'color-bg'  => esc_html__('Color Background', 'cleaning-light'),
            'image-bg' => esc_html__('Image Background', 'cleaning-light'),
        )
    ));

    $wp_customize->add_setting("cleaninglight_{$id}_bg_color", array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_{$id}_bg_color", array(
        'section' => "cleaninglight_{$id}_section",
        'label' => esc_html__('Background Color', 'cleaning-light'),
    )));

    $wp_customize->add_setting("cleaninglight_{$id}_bg_image_url", array(
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Background_Control($wp_customize, "cleaninglight_{$id}_bg_image", array(
        'label' => esc_html__('Background Image', 'cleaning-light'),
        'section' => "cleaninglight_{$id}_section",
        'settings' => array(
            'image_url' => "cleaninglight_{$id}_bg_image_url",
        )
    )));

    $wp_customize->add_setting('cleaninglight_footer_overlay_color', array(
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage',
        'default' => ''
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_footer_overlay_color", array(
        'section' => "cleaninglight_{$id}_section",
        'label' => esc_html__('Overlay Color', 'cleaning-light'),
    )));

    $wp_customize->add_setting(
        "cleaninglight_{$id}_padding",
        array(
            'transport' => 'postMessage',
            'sanitize_callback' => 'cleaninglight_themes_sanitize_field_default_css_box'
        )
    );
    $wp_customize->add_control(
        new Cleaninglight_Themes_Custom_Control_Cssbox(
            $wp_customize,
            "cleaninglight_{$id}_padding",
            array(
                'label'    => esc_html__( 'Padding', 'cleaning-light' ),
                'section' => "cleaninglight_{$id}_section",
            ),
            array(),
            array()
        )
    );


    $wp_customize->add_setting("cleaninglight_{$id}_seperator0", array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control(new Cleaninglight_Separator_Control($wp_customize, "cleaninglight_{$id}_seperator0", array(
        'section' => "cleaninglight_{$id}_section",
    )));

    $wp_customize->add_setting("cleaninglight_{$id}_section_seperator", array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'no',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control("cleaninglight_{$id}_section_seperator", array(
        'section' => "cleaninglight_{$id}_section",
        'type' => 'select',
        'label' => esc_html__('Choose Separator', 'cleaning-light'),
        'choices' => array(
            'no' => esc_html__('Disable', 'cleaning-light'),
            'top' => esc_html__('Top Separator', 'cleaning-light'),
        )
    ));

    $wp_customize->add_setting("cleaninglight_{$id}_top_seperator", array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'curv-9',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control("cleaninglight_{$id}_top_seperator", array(
        'section' => "cleaninglight_{$id}_section",
        'type' => 'select',
        'label' => esc_html__('Top Separator', 'cleaning-light'),
        'choices' => cleaninglight_themes_svg_seperator(),
    ));

    $wp_customize->add_setting("cleaninglight_{$id}_ts_color", array(
        'default' => '',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_{$id}_ts_color", array(
        'section' => "cleaninglight_{$id}_section",
        'label' => esc_html__('Top Separator Color', 'cleaning-light'),
    )));

    $wp_customize->add_setting("cleaninglight_{$id}_ts_height_desktop", array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 60,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting("cleaninglight_{$id}_ts_height_tablet", array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 40,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_setting("cleaninglight_{$id}_ts_height_mobile", array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 20,
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Range_Slider_Control($wp_customize, "cleaninglight_{$id}_ts_height", array(
        'section' => "cleaninglight_{$id}_section",
        'label' => esc_html__('Top Separator Height', 'cleaning-light'),
        'settings' => array(
            'desktop' => "cleaninglight_{$id}_ts_height_desktop",
            'tablet' => "cleaninglight_{$id}_ts_height_tablet",
            'mobile' => "cleaninglight_{$id}_ts_height_mobile",
        ),
        'input_attrs' => array(
            'min' => 20,
            'max' => 500,
            'step' => 1,
        )
    )));

    $wp_customize->add_setting('cleaninglight_pro_footer', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_footer', array(
        'section' => 'cleaninglight_footer_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('Different footer styles', 'cleaning-light'),
            esc_html__('Enable/Disable Footer & Sub Footer', 'cleaning-light'),
            esc_html__('Set custom footer columns & width', 'cleaning-light'),
            esc_html__('Remove footer credit text', 'cleaning-light'),
            esc_html__('Change title & link, hover Color', 'cleaning-light'),
            esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
            esc_html__('More Than 35+ Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));

$wp_customize->selective_refresh->add_partial( 'cleaninglight_footer_bg_video', array(
    'selector'        => '#footer-section',
    'container_inclusive'  => true,
    'render_callback' => function() {
        do_action( 'cleaninglight_themes_top_footer_content' );
    }
) );

$wp_customize->selective_refresh->add_partial( 'cleaninglight_footer_section', array(
    'settings'        => [ 'cleaninglight_footer_top_seperator', 'cleaninglight_footer_section_seperator' ],
    'selector'        => '.footer-seprator',
    'container_inclusive'  => false,
    'render_callback' => function() {
        cleaninglight_themes_add_footer_seperator();
    }
) );


