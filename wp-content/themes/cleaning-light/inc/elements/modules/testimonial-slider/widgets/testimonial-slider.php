<?php

namespace CleaningLightElements\Modules\TestimonialSlider\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Utils;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class TestimonialSlider extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-testimonial-slider';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Testimonial Slider', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_keywords() {
		return [ 'testimonial', 'slider', 'client', 'review', 'feedback' ];
	}

	public function get_script_depends() {
		return [ 'imagesloaded' ];
	}

    /** Category */
    public function get_categories() {
        return ['CleaningLight-elements'];
    }

    /** Controls */
    protected function register_controls() {

        $this->start_controls_section(
            'section_content', [
                'label' => esc_html__('Content', 'cleaning-light'),
            ]
        );

            $this->add_responsive_control(
                'wrapper_width',[
                    'label' => esc_html__( 'Testimonial Wrapper Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '70',
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                        'size' => 70,
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'range' => [
                        '%' => [
                            'min' => 40,
                            'max' => 100,
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-slider' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'image', [
                    'label' => esc_html__('Choose Photo', 'cleaning-light'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_control(
                'name', [
                    'label' => esc_html__('Name', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Alina Lora', 'cleaning-light'),
                ]
            );

            $repeater->add_control(
                'designation', [
                    'label' => esc_html__('Designation', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Support Engineer', 'cleaning-light'),
                ]
            );

            $repeater->add_control(
                'content', [
                    'label' => esc_html__('Testimonial', 'cleaning-light'),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 6,
                    'default' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light'),
                ]
            );

            $this->add_control(
                'testimonial_block_items', [
                    'label' => esc_html__('Testimonial Item', 'cleaning-light'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'name' => esc_html__('Alina Lora', 'cleaning-light'),
                            'designation' => esc_html__('Developer', 'cleaning-light'),
                            'content' => esc_html__('Yes! Pay once and avail for a lifetime. We offer unlimited domain usage for a one-time purchase. Buy our premium themes once and use them on as many websites as you want. Zero restriction with our unlimited site license.', 'cleaning-light'),
                        ],
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'name' => esc_html__('John Doe', 'cleaning-light'),
                            'designation' => esc_html__('Support Engineer', 'cleaning-light'),
                            'content' => esc_html__('Yes! Pay once and avail for a lifetime. We offer unlimited domain usage for a one-time purchase. Buy our premium themes once and use them on as many websites as you want. Zero restriction with our unlimited site license.', 'cleaning-light'),
                        ],
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'name' => esc_html__('Umar Jaiswal', 'cleaning-light'),
                            'designation' => esc_html__('Web Designer', 'cleaning-light'),
                            'content' => esc_html__('Yes! Pay once and avail for a lifetime. We offer unlimited domain usage for a one-time purchase. Buy our premium themes once and use them on as many websites as you want. Zero restriction with our unlimited site license.', 'cleaning-light'),
                        ],
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'name' => esc_html__('Manish Khanal', 'cleaning-light'),
                            'designation' => esc_html__('Web Developer', 'cleaning-light'),
                            'content' => esc_html__('Yes! Pay once and avail for a lifetime. We offer unlimited domain usage for a one-time purchase. Buy our premium themes once and use them on as many websites as you want. Zero restriction with our unlimited site license.', 'cleaning-light'),
                        ],
                    ],
                    'title_field' => '{{{ name }}}',
                ]
            );

            // $this->add_control(
            //     'rating_star',[
            //         'label' => esc_html__( 'Display Rating Star', 'cleaning-light' ),
            //         'type' => Controls_Manager::SWITCHER,
            //         'label_on' => esc_html__( 'Show', 'cleaning-light' ),
            //         'label_off' => esc_html__( 'Hide', 'cleaning-light' ),
            //         'return_value' => 'yes',
            //         'default' => 'yes',
            //     ]
            // );

            // $this->add_control(
            //     'rating', [
            //         'label' => esc_html__('Number of Star', 'cleaning-light'),
            //         'type' => Controls_Manager::SLIDER,
            //         'size_units' => ['star'],
            //         'range' => [
            //             'star' => [
            //                 'min' => 1,
            //                 'max' => 5,
            //                 'step' => 1
            //             ],
            //         ],
            //         'default' => [
            //             'unit' => 'star',
            //             'size' => 5,
            //         ],
            //         'condition' => [
            //             'rating_star' => 'yes',
            //         ]
            //     ]
            // );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings', [
                'label' => esc_html__('Settings', 'cleaning-light'),
            ]
        );

            $this->add_control(
                'title_html_tag', [
                    'label' => esc_html__('Title HTML Tag', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'h3',
                    'label_block' => true,
                    'options' => [
                        'h1' => esc_html__('H1', 'cleaning-light'),
                        'h2' => esc_html__('H2', 'cleaning-light'),
                        'h3' => esc_html__('H3', 'cleaning-light'),
                        'h4' => esc_html__('H4', 'cleaning-light'),
                        'h5' => esc_html__('H5', 'cleaning-light'),
                        'h6' => esc_html__('H6', 'cleaning-light'),
                        'div' => esc_html__('div', 'cleaning-light'),
                        'span' => esc_html__('span', 'cleaning-light'),
                        'p' => esc_html__('p', 'cleaning-light')
                    ],
                ]
            );

        $this->end_controls_section();

        
        $this->start_controls_section(
            'carousel_settings', [
                'label' => esc_html__('Carousel Settings', 'cleaning-light'),
            ]
        );

            $this->add_control(
                'autoplay', [
                    'label' => esc_html__('Autoplay', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'cleaning-light'),
                    'label_off' => esc_html__('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'pause_on_hover', [
                    'label' => esc_html__('Pause on Hover', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'cleaning-light'),
                    'label_off' => esc_html__('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'autoplay' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'infinite', [
                    'label' => esc_html__('Infinite Loop', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'cleaning-light'),
                    'label_off' => esc_html__('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'autoplay_speed', [
                    'label' => esc_html__('Autoplay Speed (in Seconds)', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['s'],
                    'range' => [
                        's' => [
                            'min' => 1,
                            'max' => 15,
                            'step' => 1
                        ],
                    ],
                    'default' => [
                        'size' => 5,
                        'unit' => 's',
                    ],
                    'condition' => [
                        'autoplay' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'speed', [
                    'label' => esc_html__('Animation Speed', 'cleaning-light'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 500,
                ]
            );

            $this->add_control(
                'nav', [
                    'label' => esc_html__('Navigation Arrows', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'cleaning-light'),
                    'label_off' => esc_html__('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'dots', [
                    'label' => esc_html__('Dots', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'cleaning-light'),
                    'label_off' => esc_html__('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

        $this->end_controls_section();
        

        $this->start_controls_section(
            'item_settings', [
                'label' => esc_html__('General Style', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'layout_position',[
                    'label' => esc_html__( 'Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'below',
                    'options' => [
                        'above' => [
                            'title' => esc_html__( 'Above', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'below' => [
                            'title' => esc_html__( 'Below', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors_dictionary' => [
                        'above' => 'column',
                        'below' => 'column-reverse',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-slider-wrap' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'text_align',[
                    'label' => esc_html__( 'Alignment', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    //'default' => 'center',
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', 'cleaning-light' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'cleaning-light' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'cleaning-light' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-slider-wrap, {{WRAPPER}} .cleaninglight-testimonial-buttom-content' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_space',[
                    'label' => esc_html__( 'Content Spacing', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                        'rem' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-slider-wrap' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_position',[
                    'label' => esc_html__( 'Image Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'above',
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                        'above' => [
                            'title' => esc_html__( 'Above', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'below' => [
                            'title' => esc_html__( 'Below', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors_dictionary' => [
                        'left'  => 'row',
                        'right' => 'row-reverse',
                        'above' => 'column',
                        'below' => 'column-reverse',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-slider-wrap .cleaninglight-testimonial-top-content' => 'flex-direction: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(

            'name_style', [
                'label' => esc_html__('Name', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'name_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-title' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'name_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-testimonial-title',
                ]
            );

            $this->add_responsive_control(
                'name_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'text_stroke',
                    'selector' => '{{WRAPPER}} .cleaninglight-testimonial-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'title_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-testimonial-title',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'designation_style', [
                'label' => esc_html__('Designation', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'designation_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-designation' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'designation_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-testimonial-designation',
                ]
            );

            $this->add_responsive_control(
                'designation_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-designation' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'designation_stroke',
                    'selector' => '{{WRAPPER}} .cleaninglight-testimonial-designation',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style', [
                'label' => esc_html__('Content', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'content_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-description' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'content_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-testimonial-description',
                ]
            );

            $this->add_responsive_control(
                'content_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style', [
                'label' => esc_html__('Image', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'image_width', [
                    'label' => esc_html__( 'Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 800,
                        ],
                        'vw' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-slider-wrap .cleaninglight-testimonial-img img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'image_height', [
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 800,
                        ],
                        'vw' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-slider-wrap .cleaninglight-testimonial-img img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'image_border',
                    'selector' => '{{WRAPPER}} .cleaninglight-testimonial-slider-wrap .cleaninglight-testimonial-img img',
                    'default' => 'none',
                ]
            );

            $this->add_responsive_control(
                'image_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-slider-wrap .cleaninglight-testimonial-img img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_radius', [
                    'label' => esc_html__('Radius', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-testimonial-slider-wrap .cleaninglight-testimonial-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $wrapper_tag = 'div';
        $title_tag = Utils::validate_html_tag( $settings['title_html_tag'] );

        $this->add_render_attribute('wrapper', 'class', [
                'cleaninglight-testimonial-slider-wrap'
            ]
        );
        $this->add_render_attribute( 'top_content', 'class', ['cleaninglight-testimonial-top-content'] );
        $this->add_render_attribute( 'buttom_content', 'class', ['cleaninglight-testimonial-buttom-content'] );
        $this->add_render_attribute( 'image_wrap', 'class', ['cleaninglight-testimonial-img'] );
        $this->add_render_attribute( 'title', 'class', ['cleaninglight-testimonial-title'] );
        $this->add_render_attribute( 'designation', 'class', ['cleaninglight-testimonial-designation'] );
        $this->add_render_attribute( 'description', 'class', ['cleaninglight-testimonial-description'] );
        $this->add_render_attribute( 'rating', 'class', ['cleaninglight-testimonial-rating'] );

        $params = array(
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'loop' => $settings['infinite'] == 'yes' ? true : false,
            'speed' => (int) $settings['speed'],
            'dots' => $settings['dots'] == 'yes' ? true : false,
            'nav' => $settings['nav'] == 'yes' ? true : false
        );
        if($settings['autoplay'] == 'yes'){
            $params['pause'] = (int) $settings['autoplay_speed']['size'] * 1000;
        }

        $params = json_encode($params);

        ?>
        <div class="cleaninglight-testimonial-slider owl-carousel carouseldots" data-params='<?php echo $params; ?>'>
            <?php foreach( $settings['testimonial_block_items'] as $testimonialindex => $testimonialitem ): ?>
                <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
                    <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'top_content' ); ?>>
                        <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'image_wrap' ); ?>>
                            <?php Group_Control_Image_Size::print_attachment_image_html($testimonialitem, 'image'); ?>
                        </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
                        <div class="cleaninglight-testimonial-title-wrap">
                            <?php if ( ! empty( $testimonialitem['name'] ) ) : ?>
                                <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                                    <?php $this->print_unescaped_setting( 'name', 'testimonial_block_items', $testimonialindex ); ?>
                                </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                            <?php endif; ?>

                            <?php if ( ! empty( $testimonialitem['designation'] ) ) : ?>
                                <div <?php $this->print_render_attribute_string( 'designation' ); ?>>
                                    <?php $this->print_unescaped_setting( 'designation', 'testimonial_block_items', $testimonialindex ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>

                    <div <?php $this->print_render_attribute_string( 'buttom_content' ); ?>>
                        
                        <?php if ( ! empty( $testimonialitem['content'] ) ) : ?>
                            <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                                <?php $this->print_unescaped_setting( 'content', 'testimonial_block_items', $testimonialindex ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
            <?php endforeach; ?>
        </div>
        <?php
    }
   

}
