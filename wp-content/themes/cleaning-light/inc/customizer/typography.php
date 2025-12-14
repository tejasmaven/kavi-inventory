<?php
/**
 * Typography Section
*/
function cleaninglight_customize_register_for_typography( $wp_customize ) {
   
    // Add the body typography section.
    $wp_customize->add_section('typography_settings', array(
        'priority' => 5,
        'title' => esc_html__('Typography Settings', 'cleaning-light')
    ));

    $wp_customize->add_setting('cleaninglight_body_font_family', array(
        'default' => 'Sora',
        'sanitize_callback' => 'sanitize_text_field',
        
    ));
    $wp_customize->add_control('cleaninglight_body_font_family', array(
        'label' => esc_html__('Body Font Family', 'cleaning-light'),
        'section' => 'typography_settings',
        'type' => 'select',
        'choices' => array(
            'Poppins'    => esc_html__("Poppins", 'cleaning-light'),
            'Roboto'     => esc_html__("Roboto", 'cleaning-light'),
            'Sora'     => esc_html__("Sora", 'cleaning-light'),
            'Raleway'    => esc_html__("Raleway", 'cleaning-light'),
            'Marcellus'     => esc_html__("Marcellus", 'cleaning-light'),
            'Montserrat' => esc_html__("Montserrat", 'cleaning-light'),
            'Arizonia'   => esc_html__("Arizonia", 'cleaning-light'),
            ''           => esc_html__("More in pro", 'cleaning-light'),
        )
    ));

    $wp_customize->add_setting('cleaninglight_heading_font_family', array(
        'default' => 'Marcellus',
        'sanitize_callback' => 'sanitize_text_field',
        
    ));
    $wp_customize->add_control('cleaninglight_heading_font_family', array(
        'label' => esc_html__('Heading (h1 to h6)', 'cleaning-light'),
        'section' => 'typography_settings',
        'type' => 'select',
        'choices' => array(
            'Poppins'    => esc_html__("Poppins", 'cleaning-light'),
            'Roboto'     => esc_html__("Roboto", 'cleaning-light'),
            'Sora'     => esc_html__("Sora", 'cleaning-light'),
            'Raleway'    => esc_html__("Raleway", 'cleaning-light'),
            'Marcellus'     => esc_html__("Marcellus", 'cleaning-light'),
            'Montserrat' => esc_html__("Montserrat", 'cleaning-light'),
            'Arizonia'   => esc_html__("Arizonia", 'cleaning-light'),
            '' => esc_html__("More in pro", 'cleaning-light'),
        )
    ));


    $wp_customize->add_setting('cleaninglight_pro_typography', array(
        'sanitize_callback' => 'cleaninglight_sanitize_text'
    ));
    $wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_typography', array(
        'section' => 'typography_settings',
        'label' => esc_html__('For More Settings,', 'cleaning-light'),
        'choices' => array(
            esc_html__('250+ Google Fonts Family', 'cleaning-light'),
            esc_html__('Configure H1, H2, H3, H4, H5, H6 individually or all at once', 'cleaning-light'),
            esc_html__('Seperate Typography Settings for Menu, Title( H1/H2/H3/H4/H5/H6 ), Page Title, Block Title, Widget Title and others', 'cleaning-light'),
            esc_html__('More Advanced Typography Options like font weight, text transform, text decoration, font size, line height, letter spacing', 'cleaning-light'),
        ),
        'priority' => 251,
    )));
}
add_action( 'customize_register', 'cleaninglight_customize_register_for_typography' );