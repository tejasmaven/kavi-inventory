<?php   
  
$wp_customize->add_section('cleaninglight_slider_section', array(
    'title'		=>	esc_html__('Home Slider','cleaning-light'),
    'priority'  => 15
));
$wp_customize->add_setting('cleaninglight_slider_nav', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'wp_kses_post',
));
$wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_slider_nav', array(
    'type' => 'tab',
    'section' => 'cleaninglight_slider_section',
    'buttons' => array(
        array(
            'name' => esc_html__('Content', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_banner_slider_section',
                'cleaninglight_slider_height',
                'cleaninglight_slider_type',
                'cleaninglight_slider_advance_settings',
                'cleaninglight_banner_sliders',
            ),
            'active' => true,
        ),
        array(
            'name' => esc_html__('Style', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_banner_overlay_color',
                'cleaninglight_caption_title_font_size',
                'cleaninglight_slider_seperator0',
                'cleaninglight_slider_section_seperator',
                'cleaninglight_slider_bottom_seperator',
                'cleaninglight_slider_bs_color',
                'cleaninglight_slider_bs_height',
                'main_slider_controls'
            ),
        ),
        array(
            'name' => esc_html__('Caption', 'cleaning-light'),
            'fields' => array(
                'cleaninglight_caption_width',
            )
        )
    ),
)));

$wp_customize->add_setting('cleaninglight_banner_slider_section', array(
    'default' => 'enable',
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',     
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_banner_slider_section', array(
    'label' => esc_html__('Enable', 'cleaning-light'),
    'section' => 'cleaninglight_slider_section',
    'switch_label' => array(
        'enable' => esc_html__('Yes', 'cleaning-light'),
        'disable' => esc_html__('No', 'cleaning-light'),
    ),
)));

$wp_customize->add_setting('cleaninglight_slider_height', array(
    'sanitize_callback' => 'absint',
    'default' => 650,
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_slider_height', array(
    'section' => 'cleaninglight_slider_section',
    'label' => esc_html__('Slider Height (px)', 'cleaning-light'),
    'input_attrs' => array(
        'min' =>400,
        'max' => 900,
        'step' => 1
    )
)));


$wp_customize->add_setting('cleaninglight_slider_type', array(
    'default' => 'default',
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_select'
));
$wp_customize->add_control('cleaninglight_slider_type', array(
    'section' => 'cleaninglight_slider_section',
    'type' => 'radio',
    'label' => esc_html__('Select Type', 'cleaning-light'),
    'choices' => array(
        'default' => esc_html__('Default', 'cleaning-light'),
        'advance' => esc_html__('Advanced', 'cleaning-light'),
    )
));

$wp_customize->add_setting('cleaninglight_banner_sliders', array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
    'default' => json_encode(array(
        array(
            'subtitile'  => '',
            'slider_page' => '',
            'button_text' => '',
            'button_url' => '',
            'button_one_text' => '',
            'button_one_url' => '',
            'alignment' => 'center',
        )
    ))
));
$wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, 'cleaninglight_banner_sliders', 
    array(
        'label' 	   => esc_html__('Default Slides Settings', 'cleaning-light'),
        'section' 	   => 'cleaninglight_slider_section',
        'box_label' => esc_html__('Default Slide Options', 'cleaning-light'),
        'add_label' => esc_html__('Add New', 'cleaning-light'),
    ),
    array(
        'subtitile' => array(
            'type' => 'text',
            'label' => __("Super Title", 'cleaning-light'),
        ),
        'slider_page' => array(
            'type' => 'select',
            'label' => esc_html__('Select Page', 'cleaning-light'),
            'options' => $pages
        ),
        'button_wrapper_start' => array(
            'type' => 'wrapper-start',
            'label' => esc_html__('First Button Settings','cleaning-light'),
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
        'button_wrapper_end' => array(
            'type' => 'wrapper-end',
        ),
        'button_wrapper_start2' => array(
            'type' => 'wrapper-start',
            'label' => esc_html__('Second Button Settings','cleaning-light'),
        ),
        'button_one_text' => array(
            'type' => 'text',
            'label' => esc_html__('Button Text', 'cleaning-light'),
            'default' => ''
        ),
        'button_one_url' => array(
            'type' => 'url',
            'label' => esc_html__('Button Url', 'cleaning-light'),
            'default' => ''
        ),
        'button_wrapper_end2' => array(
            'type' => 'wrapper-end',
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
        ),
    )
));

$id = "slider";
$wp_customize->add_setting("cleaninglight_{$id}_advance_settings", array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',		
    'default' => json_encode(array(
        array(
            'block_image'      => '',
            'block_subtitile'  => '',
            'block_title'      => '',
            'block_desc'       => '',
            'button_text'       => '',
            'button_url'        => '',
            'button_one_text'   => '',
            'button_one_url'    => '',
            'alignment'         => 'center',
        )
    ))
));
$wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control( $wp_customize, "cleaninglight_{$id}_advance_settings", 
    array(
        'label' 	   => esc_html__('Advanced Slides Settings', 'cleaning-light'),
        'section' 	   => "cleaninglight_{$id}_section",
        'box_label' => esc_html__('Advanced Slide Settings', 'cleaning-light'),
        'add_label' => esc_html__('Add New Slide', 'cleaning-light'),
    ),
    array(
        'block_image' => array(
            'type' => 'upload',
            'label' => __("Upload Image", 'cleaning-light'),
        ),
        'block_subtitile' => array(
            'type' => 'text',
            'label' => __("Super Title", 'cleaning-light'),
        ),
        'block_title' => array(
            'type' => 'text',
            'label' => __("Title", 'cleaning-light'),
        ),
        'block_desc' => array(
            'type' => 'textarea',
            'label' => __("Short Description", 'cleaning-light'),
        ),
        'button_wrapper_start' => array(
            'type' => 'wrapper-start',
            'label' => esc_html__('First Button Settings','cleaning-light'),
        ),
        'button_text' => array(
            'type' => 'text',
            'label' => esc_html__('First Button Text', 'cleaning-light'),
            'default' => ''
        ),
        'button_url' => array(
            'type' => 'url',
            'label' => esc_html__('First Button Url', 'cleaning-light'),
            'default' => ''
        ),
        'button_wrapper_end' => array(
            'type' => 'wrapper-end',
        ),
        'button_wrapper_start2' => array(
            'type' => 'wrapper-start',
            'label' => esc_html__('Second Button Settings','cleaning-light'),
        ),
        'button_one_text' => array(
            'type' => 'text',
            'label' => esc_html__('Second Button Text', 'cleaning-light'),
            'default' => ''
        ),
        'button_one_url' => array(
            'type' => 'url',
            'label' => esc_html__('Second Button Url', 'cleaning-light'),
            'default' => ''
        ),
        'button_wrapper_end2' => array(
            'type' => 'wrapper-end',
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
        ),
    )
));

$wp_customize->add_setting('cleaninglight_banner_overlay_color', array(
    'default' => 'rgba(0, 0, 0, 0.35)',
    'transport' => 'postMessage',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, 'cleaninglight_banner_overlay_color', array(
    'label' => esc_html__('Background Overlay Color', 'cleaning-light'),
    'section' => 'cleaninglight_slider_section'
)));

$wp_customize->add_setting('cleaninglight_caption_title_font_size', array(
    'sanitize_callback' => 'absint',
    'default' => 45,
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_caption_title_font_size', array(
    'section' => 'cleaninglight_slider_section',
    'label' => esc_html__('Title Font Size', 'cleaning-light'),
    'input_attrs' => array(
        'min' =>20,
        'max' => 80,
        'step' => 1
    )
)));

$wp_customize->add_setting('cleaninglight_caption_width', array(
    'sanitize_callback' => 'absint',
    'default' => 70,
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Themes_Range_Control($wp_customize, 'cleaninglight_caption_width', array(
    'section' => 'cleaninglight_slider_section',
    'label' => esc_html__('Caption Width (%)', 'cleaning-light'),
    'input_attrs' => array(
        'min' =>50,
        'max' => 100,
        'step' => 1
    )
)));

$wp_customize->add_setting('main_slider_controls',
    array(
        'sanitize_callback' => 'cleaninglight_themes_sanitize_field_background',
        'transport' => 'postMessage',
        'default'           => json_encode(array(
            'navtype'       => 'both',
            'navstyle'      => 'imagestyle',
            'dotstyle'      => 'numberstyle',
            'loop'          => 1,
            'autoplay'      => 1,
            'easing'        => 'fadeOut',
            'drag'          => 1,
            'speed'         => 500,
            'pause'         => 5000
        )),
    )
);
$wp_customize->add_control(new Cleaninglight_Themes_Custom_Control_Group( $wp_customize, 'main_slider_controls',
        array(
            'label'    => esc_html__( 'Slider Controls', 'cleaning-light' ),
            'section'  => 'cleaninglight_slider_section',
        ),
        array(
            'navtype'      => array(
                'type'  => 'select',
                'label' => esc_html__( 'Navigation', 'cleaning-light' ),
                'options' => array(
                    'both' => esc_html__("Arrows and Dots", 'cleaning-light'),
                    'arrows' => esc_html__("Arrows", 'cleaning-light'),
                    'dots' => esc_html__("Dots", 'cleaning-light'),
                    'none' => esc_html__("None", 'cleaning-light'),
                )
            ),
            'navstyle'      => array(
                'type'  => 'select',
                'label' => esc_html__( 'Nav Style', 'cleaning-light' ),
                'options' => array(
                    'imagestyle' => esc_html__("Images", 'cleaning-light'),
                    'arrowstyle' => esc_html__("Arrows", 'cleaning-light'),
                )
            ),
            'dotstyle'      => array(
                'type'  => 'select',
                'label' => esc_html__( 'Dots Style', 'cleaning-light' ),
                'options' => array(
                    'numberstyle' => esc_html__("Number", 'cleaning-light'),
                    'dotstyle' => esc_html__("Dots", 'cleaning-light'),
                )
            ),
            'loop'      => array(
                'type'  => 'checkbox',
                'label' => esc_html__( 'Loop', 'cleaning-light' ),
            ),
            'autoplay' => array(
                'type'  => 'checkbox',
                'label' => esc_html__( 'Auto Play', 'cleaning-light' ),
            ),
            'drag' => array(
                'type'  => 'checkbox',
                'label' => esc_html__( 'Drag', 'cleaning-light' ),
            ),
            'easing'      => array(
                'type'  => 'select',
                'label' => esc_html__( 'Easing', 'cleaning-light' ),
                'options' => array(
                    'fadeOut' => __("fadeOut", 'cleaning-light'),
                    'fadeIn' => __("fadeIn", 'cleaning-light'),
                    'slide' => __("Slide", 'cleaning-light'),
                )
            ),
            'speed'      => array(
                'type'  => 'number',
                'label' => esc_html__( 'Transition Speed (ms)', 'cleaning-light' ),
            ),
            'pause'      => array(
                'type'  => 'number',
                'label' => esc_html__( 'Autoplay Speed', 'cleaning-light' ),
            )
        )
    )
);


$wp_customize->add_setting("cleaninglight_slider_seperator0", array(
    'sanitize_callback' => 'sanitize_text_field',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Separator_Control($wp_customize, "cleaninglight_slider_seperator0", array(
    'section' => "cleaninglight_slider_section",
)));

$wp_customize->add_setting("cleaninglight_slider_section_seperator", array(
    'transport' => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'no',
));
$wp_customize->add_control("cleaninglight_slider_section_seperator", array(
    'section' => "cleaninglight_slider_section",
    'type' => 'select',
    'label' => esc_html__('Select Separator', 'cleaning-light'),
    'choices' => array(
        'no' => esc_html__('Disable', 'cleaning-light'),
        'bottom' => esc_html__('Bottom Separator', 'cleaning-light'),
    )
));

$wp_customize->add_setting("cleaninglight_slider_bottom_seperator", array(
    'sanitize_callback' => 'sanitize_text_field',
    'default' => 'curv-8',
    'transport' => 'postMessage'
));
$wp_customize->add_control("cleaninglight_slider_bottom_seperator", array(
    'section' => "cleaninglight_slider_section",
    'type' => 'select',
    'label' => esc_html__('Bottom Separator', 'cleaning-light'),
    'choices' => cleaninglight_themes_svg_seperator(),
));

$wp_customize->add_setting("cleaninglight_slider_bs_color", array(
    'default' => '',
    'sanitize_callback' => 'cleaninglight_themes_sanitize_color_alpha',
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Alpha_Color_Control($wp_customize, "cleaninglight_slider_bs_color", array(
    'section' => "cleaninglight_slider_section",
    'label' => esc_html__('Bottom Separator Color', 'cleaning-light'),
)));


$wp_customize->add_setting("cleaninglight_slider_bs_height", array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_number_blank',
    'default' => 60,
    'transport' => 'postMessage'
));
$wp_customize->add_setting("cleaninglight_slider_bs_height_tablet", array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_number_blank',
    'default' => 40,
    'transport' => 'postMessage'
));
$wp_customize->add_setting("cleaninglight_slider_bs_height_mobile", array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_number_blank',
    'default' => 20,
    'transport' => 'postMessage'
));
$wp_customize->add_control(new Cleaninglight_Range_Slider_Control($wp_customize, "cleaninglight_slider_bs_height", array(
    'section' => "cleaninglight_slider_section",
    'transport' => 'postMessage',
    'label' => esc_html__('Bottom Separator Height', 'cleaning-light'),
    'input_attrs' => array(
        'min' => 20,
        'max' => 400,
        'step' => 1,
    ),
    'settings' => array(
        'desktop' => "cleaninglight_slider_bs_height",
        'tablet' => "cleaninglight_slider_bs_height_tablet",
        'mobile' => "cleaninglight_slider_bs_height_mobile",
    )
)));


$wp_customize->add_setting('cleaninglight_pro_slider', array(
    'sanitize_callback' => 'cleaninglight_sanitize_text'
));
$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_slider', array(
    'section' => 'cleaninglight_slider_section',
    'label' => esc_html__('For More Settings,', 'cleaning-light'),
    'choices' => array(
        esc_html__('Add Unlimited slider Items', 'cleaning-light'),
        esc_html__('Advanced Level of Customization', 'cleaning-light'),
        esc_html__('Select Different Slider Types Video, Single Banner & Revolution', 'cleaning-light'),
        esc_html__('Get Options to Enter Revolution Slider Shortcode', 'cleaning-light'),
        esc_html__('Get Change SuperTitle, Title, Description & Button Color', 'cleaning-light'),
        esc_html__('Caption Background Color Options', 'cleaning-light'),
        esc_html__('Caption Text Alignment Options', 'cleaning-light'),
        esc_html__('Customize Margin & Padding', 'cleaning-light'),
        esc_html__('Adjust Slider Height & Font Size', 'cleaning-light'),
        esc_html__('Option to configure slider pause and duration', 'cleaning-light'),
    ),
    'priority' => 250,
)));

$wp_customize->selective_refresh->add_partial( 'cleaninglight_slider_refresh', array (
    'settings' => array(
        'cleaninglight_banner_slider_section',
        'cleaninglight_slider_type',
        'cleaninglight_banner_sliders',
        'cleaninglight_slider_advance_settings',
        'main_slider_controls',
        'cleaninglight_slider_section_seperator',
        'cleaninglight_slider_bottom_seperator'
    ),
    'selector' => '.cleaninglight-banner-wrapper',
    'fallback_refresh' => true,
	'container_inclusive' => true,
    'render_callback' => function () {
        if( get_theme_mod( 'cleaninglight_banner_slider_section' ) === 'enable' ) {
            return do_action('cleaninglight_themes_slider_type');
        }
    }
));