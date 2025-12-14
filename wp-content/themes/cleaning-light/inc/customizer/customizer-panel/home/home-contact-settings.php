<?php

$wp_customize->add_section(new Cleaninglight_Toggle_Section($wp_customize, 'cleaninglight_contact_section', array(
    'title' => esc_html__('Contact Section', 'cleaning-light'),
    'panel' => 'cleaninglight_frontpage_settings',
    'priority' => cleaninglight_themes_get_section_position('cleaninglight_contact_section'),
    'hiding_control' => 'cleaninglight_contact_disable'
)));

//ENABLE/DISABLE CONTACT US SECTION
$wp_customize->add_setting('cleaninglight_contact_disable', array(
    'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',
    'transport' => 'postMessage',
    'default' => 'enable'
));
$wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_contact_disable', array(
    'section' => 'cleaninglight_contact_section',
    'label' => esc_html__('Enable', 'cleaning-light'),
    'switch_label' => array(
        'enable' => esc_html__('Enable', 'cleaning-light'),
        'disable' => esc_html__('Disable', 'cleaning-light'),
    ),
    'class' => 'switch-section',
    'priority' => -1,
)));

    $wp_customize->add_setting('cleaninglight_contact_nav', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post'
    ));
    $wp_customize->add_control(new Cleaninglight_Custom_Control_Tab($wp_customize, 'cleaninglight_contact_nav', array(
        'type' => 'tab',
        'section' => 'cleaninglight_contact_section',
        'priority' => 1,
        'buttons' => array(
            array(
                'name' => esc_html__('Content', 'cleaning-light'),
                'fields' => array(
                    'cleaninglight_google_map_heading',
                    'cleaninglight_latitude',
                    'cleaninglight_longitude',
                    'cleaninglight_contact_map_address',
                    'cleaninglight_contact_detail',
                    'cleaninglight_contact_details_heading',
                    'cleaninglight_show_contact_detail',
                    'cleaninglight_contact_title', 
                    'cleaninglight_contact_shortcode',
                    'cleaninglight_contact_details_heading_right',
                    'cleaninglight_contact_detail_item',
                    'cleaninglight_contact_details'
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
                    'cleaninglight_contact_bg_type',
                    'cleaninglight_contact_bg_color',
                    'cleaninglight_contact_bg_image',
                    'cleaninglight_contact_overlay_color',
                    'cleaninglight_contact_padding',
                    'cleaninglight_contact_cs_seperator'
                ),
            ),
            array(
                'name' => esc_html__('Hidden', 'cleaning-light'),
                'class' => 'customizer-hidden',
                'fields' => array(
                    'cleaninglight_contact_super_title_color',
                ),
            ),
        ),
    )));


    $wp_customize->add_setting('cleaninglight_contact_details_heading_right', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_contact_details_heading_right', array(
        'section' => 'cleaninglight_contact_section',
        'label' => esc_html__('Contact Information Details', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_contact_detail_item', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'enable',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_contact_detail_item', array(
        'section' => 'cleaninglight_contact_section',
        'label' => esc_html__('Contact Detail', 'cleaning-light'),
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_contact_details', array(
        'transport' => 'postMessage',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_repeater',
        'default' => json_encode(array(
            array(
                'icon' => '',
                'label' => '',
                'description' => '',
            )
        ))
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Repeater_Control($wp_customize, 'cleaninglight_contact_details', array(
            'label' => esc_html__('Contact Info Items', 'cleaning-light'),
            'section' => 'cleaninglight_contact_section',
            'box_label' => esc_html__('Contact Info Item', 'cleaning-light'),
            'add_label' => esc_html__('Add New', 'cleaning-light'),
            'limit' => 3,
        ), 
        array(
            'icon' => array(
                'type' => 'icon',
                'label' => esc_html__('Choose Icon', 'cleaning-light'),
                'default' => ''
            ),
            'label' => array(
                'type' => 'text',
                'label' => esc_html__('Label', 'cleaning-light'),
                'default' => ''
            ),
            'description' => array(
                'type' => 'text',
                'label' => esc_html__('Content', 'cleaning-light'),
                'default' => ''
            )
        )
    ));


    $wp_customize->add_setting('cleaninglight_show_contact_detail', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'enable',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_show_contact_detail', array(
        'section' => 'cleaninglight_contact_section',
        'label' => esc_html__('Map & Contact Details', 'cleaning-light'),
        'switch_label' => array(
            'enable' => esc_html__('Yes', 'cleaning-light'),
            'disable' => esc_html__('No', 'cleaning-light'),
        ),
    )));

    $wp_customize->add_setting('cleaninglight_google_map_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_google_map_heading', array(
        'section' => 'cleaninglight_contact_section',
        'label' => esc_html__('Google Map', 'cleaning-light'),
        'description' => sprintf(esc_html__('Get the Longitude and Latitude value of the location from %s', 'cleaning-light'), '<a target="_blank" href="https://www.latlong.net/">here</a>')
    )));

    $wp_customize->add_setting('cleaninglight_latitude', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '24.691943',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('cleaninglight_latitude', array(
        'section' => 'cleaninglight_contact_section',
        'type' => 'text',
        'label' => esc_html__('Latitude', 'cleaning-light')
    ));

    $wp_customize->add_setting('cleaninglight_longitude', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '78.403931',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('cleaninglight_longitude', array(
        'section' => 'cleaninglight_contact_section',
        'type' => 'text',
        'label' => esc_html__('Longitude', 'cleaning-light')
    ));
    
    $wp_customize->add_setting('cleaninglight_contact_map_address', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('cleaninglight_contact_map_address', array(
        'section' => 'cleaninglight_contact_section',
        'type' => 'text',
        'label' => esc_html__('Map Address', 'cleaning-light')
    ));

    $wp_customize->add_setting('cleaninglight_contact_details_heading', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new Cleaninglight_Customize_Heading($wp_customize, 'cleaninglight_contact_details_heading', array(
        'section' => 'cleaninglight_contact_section',
        'label' => esc_html__('Contact Details', 'cleaning-light')
    )));

    $wp_customize->add_setting('cleaninglight_contact_title', array(
        'sanitize_callback' => 'sanitize_text_field',
        'default' => esc_html__('Quick Get In Touch', 'cleaning-light'),
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('cleaninglight_contact_title', array(
        'section' => 'cleaninglight_contact_section',
        'type' => 'text',
        'label' => esc_html__('Title', 'cleaning-light')
    ));

    $wp_customize->add_setting('cleaninglight_contact_shortcode', array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage'
    ));
    $wp_customize->add_control('cleaninglight_contact_shortcode', array(
        'section' => 'cleaninglight_contact_section',
        'type' => 'text',
        'label' => esc_html__('Contact Form Shortcode', 'cleaning-light'),
        'description' => sprintf(esc_html__('Install %s plugin to get the shortcode', 'cleaning-light'), '<a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>')
    ));


    $wp_customize->add_setting('cleaninglight_pro_contact', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_contact', array(
        'section' => 'cleaninglight_contact_section',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('Different Layout & Settings', 'cleaning-light'),
            esc_html__('(5+) Different Section Title Style', 'cleaning-light'),
            esc_html__('Advanced Contact Items Settings', 'cleaning-light'),
            esc_html__('Title, sub title & text color options', 'cleaning-light'),
			esc_html__('4+ Different Background Options( Color/Video/Gradient/Image ) ', 'cleaning-light'),
			esc_html__('More Than 35+ Top & Bottom Separator Shape Illustrator with Color & Height Option', 'cleaning-light'),
        ),
        'priority' => 250,
    )));


$wp_customize->selective_refresh->add_partial( 'cleaninglight_contact_refresh', array (
    'settings' => array( 
        'cleaninglight_contact_disable',
        'cleaninglight_latitude',
        'cleaninglight_longitude',
        'cleaninglight_contact_map_address',
        'cleaninglight_contact_details',
        'cleaninglight_contact_detail_item',
        'cleaninglight_show_contact_detail',
        'cleaninglight_contact_shortcode',
    ),
    'selector' => '#contact-section',
    'fallback_refresh' => true,
    'container_inclusive' => true,
    'render_callback' => function () {
        return get_template_part( 'section/section-contact' );
    }
));