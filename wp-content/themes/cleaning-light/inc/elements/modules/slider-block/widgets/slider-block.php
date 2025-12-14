<?php

namespace CleaningLightElements\Modules\SliderBlock\Widgets;

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

class SliderBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-slider';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Sliders Block', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_keywords() {
		return [ 'slides', 'carousel', 'image', 'title', 'slider' ];
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
            'content_section', [
                'label' => esc_html__('Content', 'cleaning-light'),
            ]
        );

		    $repeater = new Repeater();

            $repeater->start_controls_tabs( 'slides_repeater' );

                $repeater->start_controls_tab(
                    'content',[
                        'label' => esc_html__( 'Content', 'cleaning-light' ),
                    ]
                );

                    $repeater->add_control(
                        'background_image',[
                            'label' => esc_html__( 'Background Image', 'cleaning-light' ),
                            'type' => Controls_Manager::MEDIA,
                            'default' => [
                                'url' => Utils::get_placeholder_image_src(),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slide-bg' => 'background-image: url({{URL}})',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'super_title', [
                            'label' => esc_html__('Super Title', 'cleaning-light'),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__('Super Slider Title', 'cleaning-light')
                        ]
                    );

                    $repeater->add_control(
                        'slider_title', [
                            'label' => esc_html__('Title', 'cleaning-light'),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__('Your Slider Title Text', 'cleaning-light')
                        ]
                    );

                    $repeater->add_control(
                        'slider_description', [
                            'label' => esc_html__('Short Description', 'cleaning-light'),
                            'type' => Controls_Manager::TEXTAREA,
                            'rows' => 5,
                            'placeholder' => esc_html__('Enter Slider Short Description', 'cleaning-light'),
                            'default' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. Our all themes are user-friendly and fully customizable, friendly Customer Support and regular updates.', 'cleaning-light'),
                        ]
                    );

                    $repeater->add_control(
                        'slider_button_text',[
                            'label' => esc_html__( 'First Button Text', 'cleaning-light' ),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__( 'WordPress Themes', 'cleaning-light' ),
                        ]
                    );

                    $repeater->add_control(
                        'slider_button_link', [
                            'label' => esc_html__('First Button Url', 'cleaning-light'),
                            'type' => Controls_Manager::URL,
                            'placeholder' => esc_html__('Enter Button URL', 'cleaning-light'),
                            'show_external' => true,
                            'default' => [
                                'url' => '#',
                                'is_external' => false,
                                'nofollow' => false,
                            ],
                            'condition' => [
                                'slider_button_text!' => '',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'first_link_icon',[
                            'label' => esc_html__( 'Link Icon', 'cleaning-light' ),
                            'type' => Controls_Manager::ICONS,
                            'skin' => 'inline',
                            'default' => [
                                'library' => 'fa-solid',
                                'value' => 'fas fa-long-arrow-alt-right',
                            ],
                            'label_block' => false,
                            'skin_settings' => [
                                'inline' => [
                                    'none' => [
                                        'label' => 'Default',
                                        'icon' => '',
                                    ],
                                    'icon' => [
                                        'icon' => 'eicon-long-arrow-right',
                                    ],
                                ],
                            ],
                            'recommended' => [
                                'fa-regular' => [
                                    'arrow-alt-circle-right',
                                ],
                                'fa-solid' => [
                                    'angle-double-right',
                                    'angle-right',
                                    'arrow-alt-circle-right',
                                    'arrow-circle-right',
                                    'arrow-right',
                                    'caret-right',
                                    'chevron-circle-right',
                                    'chevron-right',
                                    'long-arrow-alt-right',
                                ],
                            ],
                            'condition' => [
                                'slider_button_link[url]!' => '',
                                'slider_button_text!' => '',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'slider_button_one_text',[
                            'label' => esc_html__( 'Second Button Text', 'cleaning-light' ),
                            'type' => Controls_Manager::TEXT,
                            'label_block' => true,
                            'default' => esc_html__( 'Contact Us', 'cleaning-light' ),
                        ]
                    );

                    $repeater->add_control(
                        'slider_button_one_link', [
                            'label' => esc_html__('Second Button Url', 'cleaning-light'),
                            'type' => Controls_Manager::URL,
                            'placeholder' => esc_html__('Enter Button URL', 'cleaning-light'),
                            'show_external' => true,
                            'default' => [
                                'url' => '#',
                                'is_external' => false,
                                'nofollow' => false,
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'second_link_icon',[
                            'label' => esc_html__( 'Link Icon', 'cleaning-light' ),
                            'type' => Controls_Manager::ICONS,
                            'skin' => 'inline',
                            'default' => [
                                'library' => 'fa-solid',
                                'value' => 'fas fa-long-arrow-alt-right',
                            ],
                            'label_block' => false,
                            'skin_settings' => [
                                'inline' => [
                                    'none' => [
                                        'label' => 'Default',
                                        'icon' => '',
                                    ],
                                    'icon' => [
                                        'icon' => 'eicon-long-arrow-right',
                                    ],
                                ],
                            ],
                            'recommended' => [
                                'fa-regular' => [
                                    'arrow-alt-circle-right',
                                ],
                                'fa-solid' => [
                                    'angle-double-right',
                                    'angle-right',
                                    'arrow-alt-circle-right',
                                    'arrow-circle-right',
                                    'arrow-right',
                                    'caret-right',
                                    'chevron-circle-right',
                                    'chevron-right',
                                    'long-arrow-alt-right',
                                ],
                            ],
                            'condition' => [
                                'slider_button_one_link[url]!' => '',
                                'slider_button_one_text!' => '',
                            ],
                        ]
                    );

                $repeater->end_controls_tab();

                $repeater->start_controls_tab(
                    'background',[
                        'label' => esc_html__( 'Background', 'cleaning-light' ),
                    ]
                );

                    $repeater->add_control(
                        'background_color',[
                            'label' => esc_html__( 'Background Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#02020273',
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slide-bg' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'background_size',[
                            'label' => esc_html__( 'Image Size', 'cleaning-light' ),
                            'type' => Controls_Manager::SELECT,
                            'default' => 'cover',
                            'options' => [
                                'cover' => _x( 'Cover', 'Background Control', 'cleaning-light' ),
                                'contain' => _x( 'Contain', 'Background Control', 'cleaning-light' ),
                                'auto' => _x( 'Auto', 'Background Control', 'cleaning-light' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slide-bg' => 'background-size: {{VALUE}}',
                            ],
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'background_image[url]',
                                        'operator' => '!=',
                                        'value' => '',
                                    ],
                                ],
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'background_overlay',[
                            'label' => esc_html__( 'Background Overlay', 'cleaning-light' ),
                            'type' => Controls_Manager::SWITCHER,
                            'default' => 'yes',
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'background_image[url]',
                                        'operator' => '!=',
                                        'value' => '',
                                    ],
                                ],
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'background_overlay_color',[
                            'label' => esc_html__( 'Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => 'rgba(0,0,0,0.4)',
                            'conditions' => [
                                'relation' => 'and',
                                'terms' => [
                                    [
                                        'name' => 'background_image[url]',
                                        'operator' => '!=',
                                        'value' => '',
                                    ],
                                    [
                                        'name' => 'background_overlay',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-bg-overlay' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'background_overlay_blend_mode',[
                            'label' => esc_html__( 'Blend Mode', 'cleaning-light' ),
                            'type' => Controls_Manager::SELECT,
                            'options' => [
                                '' => esc_html__( 'Normal', 'cleaning-light' ),
                                'multiply' => 'Multiply',
                                'screen' => 'Screen',
                                'overlay' => 'Overlay',
                                'darken' => 'Darken',
                                'lighten' => 'Lighten',
                                'color-dodge' => 'Color Dodge',
                                'color-burn' => 'Color Burn',
                                'soft-light' => 'Soft Light',
                                'difference' => 'Differency',
                                'exclusion' => 'Exclusive',
                                'plus-darker' => 'Plus Darker',
                                'plus-lighter' => 'Plus Lighter',
                                'hue' => 'Hue',
                                'saturation' => 'Saturation',
                                'color' => 'Color',
                                'exclusion' => 'Exclusion',
                                'luminosity' => 'Luminosity',
                            ],
                            'conditions' => [
                                'relation' => 'and',
                                'terms' => [
                                    [
                                        'name' => 'background_image[url]',
                                        'operator' => '!=',
                                        'value' => '',
                                    ],
                                    [
                                        'name' => 'background_overlay',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-bg-overlay' => 'mix-blend-mode: {{VALUE}}',
                            ],
                        ]
                    );

                $repeater->end_controls_tab();

                $repeater->start_controls_tab(
                    'style',[
                        'label' => esc_html__( 'Style', 'cleaning-light' ),
                    ]
                );

                    $repeater->add_control(
                        'custom_style',[
                            'label' => esc_html__( 'Custom', 'cleaning-light' ),
                            'type' => Controls_Manager::SWITCHER,
                            'description' => esc_html__( 'Set custom style that will only affect this specific slide.', 'cleaning-light' ),
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(), [
                            'name' => 'current_bg_color',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-caption',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'custom_style',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                        ]
                    );
        
                    $repeater->add_responsive_control(
                        'current_padding',[
                            'label' => esc_html__( 'Padding', 'cleaning-light' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'custom_style',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                        ]
                    );
        
                    $repeater->add_responsive_control(
                        'current_radius',[
                            'label' => esc_html__( 'Radius', 'cleaning-light' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'custom_style',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                        ]
                    );

                    $repeater->add_responsive_control(
                        'horizontal_position',[
                            'label' => esc_html__( 'Horizontal Position', 'cleaning-light' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Left', 'cleaning-light' ),
                                    'icon' => 'eicon-h-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'cleaning-light' ),
                                    'icon' => 'eicon-h-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'Right', 'cleaning-light' ),
                                    'icon' => 'eicon-h-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-inner' => 'justify-content:{{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-button-wrapper' => 'justify-content: {{VALUE}}',
                            ],
                            'selectors_dictionary' => [
                                'start' => 'flex-start',
                                'center' => 'center',
                                'end' => 'flex-end',
                            ],
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'custom_style',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                        ]
                    );

                    $repeater->add_responsive_control(
                        'vertical_position',[
                            'label' => esc_html__( 'Vertical Position', 'cleaning-light' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'top' => [
                                    'title' => esc_html__( 'Top', 'cleaning-light' ),
                                    'icon' => 'eicon-v-align-top',
                                ],
                                'middle' => [
                                    'title' => esc_html__( 'Middle', 'cleaning-light' ),
                                    'icon' => 'eicon-v-align-middle',
                                ],
                                'bottom' => [
                                    'title' => esc_html__( 'Bottom', 'cleaning-light' ),
                                    'icon' => 'eicon-v-align-bottom',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-inner' => 'align-items: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-button-wrapper' => 'align-items: {{VALUE}}',
                            ],
                            'selectors_dictionary' => [
                                'top' => 'flex-start',
                                'middle' => 'center',
                                'bottom' => 'flex-end',
                            ],
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'custom_style',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                        ]
                    );

                    $repeater->add_responsive_control(
                        'text_align',[
                            'label' => esc_html__( 'Text Align', 'cleaning-light' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'cleaning-light' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'cleaning-light' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'cleaning-light' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-inner' => 'text-align: {{VALUE}}',
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-button-wrapper' => 'text-align: {{VALUE}}',
                            ],
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'custom_style',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'content_color',[
                            'label' => esc_html__( 'Content Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-inner .cleaninglight-slider-super-title, 
                                {{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-inner .cleaninglight-slider-title,
                                {{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-inner .cleaninglight-slider-description' => 'color: {{VALUE}}',
                            ],
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'custom_style',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Text_Shadow::get_type(),[
                            'name' => 'repeater_text_shadow',
                            'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-slider-inner',
                            'conditions' => [
                                'terms' => [
                                    [
                                        'name' => 'custom_style',
                                        'value' => 'yes',
                                    ],
                                ],
                            ],
                        ]
                    );

                $repeater->end_controls_tab();

            $repeater->end_controls_tabs();

            $this->add_control(
                'slider_block',[
                    'label' => esc_html__( 'Slides', 'cleaning-light' ),
                    'type' => Controls_Manager::REPEATER,
                    'show_label' => true,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'background_image' => Utils::get_placeholder_image_src(),
                            'super_title' => esc_html__( 'Super Title One 1', 'cleaning-light' ),
                            'slider_title' => esc_html__( 'Slide 1 Heading Title', 'cleaning-light' ),
                            'slider_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. Our all themes are user-friendly and fully customizable, friendly Customer Support and regular updates.', 'cleaning-light' ),
                            'slider_button_text' => esc_html__( 'WordPress Themes', 'cleaning-light' ),
                            'slider_button_link' => '#',
                            'slider_button_one_text' => esc_html__( 'Contact Us', 'cleaning-light' ),
                            'slider_button_one_link' => '#',
                            
                        ],
                        [
                            'background_image' => Utils::get_placeholder_image_src(),
                            'super_title' => esc_html__( 'Super Title Two 2', 'cleaning-light' ),
                            'slider_title' => esc_html__( 'Slide 2 Heading Title', 'cleaning-light' ),
                            'slider_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. Our all themes are user-friendly and fully customizable, friendly Customer Support and regular updates.', 'cleaning-light' ),
                            'slider_button_text' => esc_html__( 'WordPress Themes', 'cleaning-light' ),
                            'slider_button_link' => '#',
                            'slider_button_one_text' => esc_html__( 'Contact Us', 'cleaning-light' ),
                            'slider_button_one_link' => '#',
                            
                        ],
                    ],
                    'title_field' => '{{{ slider_title }}}',
                ]
            );

            $this->add_responsive_control(
                'slides_height',[
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'vh', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 100,
                            'max' => 1000,
                        ],
                        'em' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                        'rem' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                        'vh' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 650,
                    ],
                    'tablet_default' => [
                        'size' => 600,
                    ],
                    'mobile_default' => [
                        'size' => 480,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'slider_padding',[
                    'label' => esc_html__( 'Padding', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'slides_super_title_tag',[
                    'label' => esc_html__( 'Super Title HTML Tag', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                        'span' => 'span',
                        'p' => 'p',
                    ],
                    'default' => 'h4',
                ]
            );

            $this->add_control(
                'slides_title_tag',[
                    'label' => esc_html__( 'Title HTML Tag', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                        'span' => 'span',
                        'p' => 'p',
                    ],
                    'default' => 'h2',
                ]
            );

            $this->add_control(
                'slides_description_tag',[
                    'label' => esc_html__( 'Description HTML Tag', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                        'span' => 'span',
                        'p' => 'p',
                    ],
                    'default' => 'div',
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',[
				'label' => esc_html__( 'Slider Options', 'cleaning-light' ),
				'type' => Controls_Manager::SECTION,
			]
		);

            $this->add_control(
            	'navigation',[
            		'label' => esc_html__( 'Navigation', 'cleaning-light' ),
            		'type' => Controls_Manager::SELECT,
            		'default' => 'both',
            		'options' => [
            			'both' => esc_html__( 'Arrows and Dots', 'cleaning-light' ),
            			'arrows' => esc_html__( 'Arrows', 'cleaning-light' ),
            			'dots' => esc_html__( 'Dots', 'cleaning-light' ),
            			'none' => esc_html__( 'None', 'cleaning-light' ),
            		],
            	]
            );

            $this->add_control(
            	'dots_style_type',[
            		'label' => esc_html__( 'Dots Style', 'cleaning-light' ),
            		'type' => Controls_Manager::SELECT,
            		'default' => 'dots_type',
            		'options' => [
            			'dots_type' => esc_html__( 'Dots', 'cleaning-light' ),
            			'number_type' => esc_html__( 'Number', 'cleaning-light' ),
            		],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'navigation',
                                'value' => 'both',
                            ],
                            [
                                'name' => 'navigation',
                                'value' => 'dots',
                            ],
                        ],
                    ],
            	]
            );

            $this->add_control(
                'dots_type_position',[
                    'label' => esc_html__( 'Dots Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'prefix_class' => 'cleaninglight-dots-position-',
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'navigation',
                                'value' => 'both',
                            ],
                            [
                                'name' => 'navigation',
                                'value' => 'dots',
                            ],
                        ],
                    ],
                ]
            );

            $this->add_control(
            	'nav_style_type',[
            		'label' => esc_html__( 'Nav Style', 'cleaning-light' ),
            		'type' => Controls_Manager::SELECT,
            		'default' => 'nav_arrow',
            		'options' => [
            			'nav_image' => esc_html__( 'Images', 'cleaning-light' ),
            			'nav_arrow' => esc_html__( 'Arrows', 'cleaning-light' ),
            		],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'navigation',
                                'value' => 'both',
                            ],
                            [
                                'name' => 'navigation',
                                'value' => 'arrows',
                            ],
                        ],
                    ],
            	]
            );

            $this->add_control(
                'nav_type_position',[
                    'label' => esc_html__( 'Nav Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}}.cleaninglight-dots-position-left .nav_image .owl-nav, {{WRAPPER}}.cleaninglight-dots-position-right .nav_image .owl-nav' => 'justify-content:{{VALUE}}',
                        '{{WRAPPER}}.cleaninglight-dots-position-left .nav_arrow .owl-nav, {{WRAPPER}}.cleaninglight-dots-position-right .nav_arrow .owl-nav' => 'justify-content:{{VALUE}}',
                    ],
                    'selectors_dictionary' => [
                        'start' => 'flex-start',
                        'center' => 'center',
                        'end' => 'flex-end',
                    ],
                    'conditions' => [
                        'relation' => 'or',
                        'terms' => [
                            [
                                'name' => 'dots_type_position',
                                'value' => 'left',
                            ],
                            [
                                'name' => 'dots_type_position',
                                'value' => 'right',
                            ],
                        ],
                    ],
                ]
            );

            $this->add_control(
                'autoplay',[
                    'label' => esc_html__( 'Autoplay', 'cleaning-light' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'frontend_available' => true,
                ]
            );

            $this->add_control(
                'pause_on_hover',[
                    'label' => esc_html__( 'Pause on Hover', 'cleaning-light' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'render_type' => 'none',
                    'frontend_available' => true,
                    'condition' => [
                        'autoplay!' => '',
                    ],
                ]
            );

            $this->add_control(
                'pause_on_interaction',[
                    'label' => esc_html__( 'Pause on Interaction', 'cleaning-light' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'render_type' => 'none',
                    'frontend_available' => true,
                    'condition' => [
                        'autoplay!' => '',
                    ],
                ]
            );

            $this->add_control(
                'autoplay_speed',[
                    'label' => esc_html__( 'Autoplay Speed', 'cleaning-light' ),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 5000,
                    'condition' => [
                        'autoplay' => 'yes',
                    ],
                    'frontend_available' => true,
                ]
            );

            $this->add_control(
                'infinite',[
                    'label' => esc_html__( 'Infinite Loop', 'cleaning-light' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'frontend_available' => true,
                ]
            );

            $this->add_control(
                'transition',[
                    'label' => esc_html__( 'Transition', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'slide',
                    'options' => [
                        'slide' => esc_html__( 'Slide', 'cleaning-light' ),
                        'fade' => esc_html__( 'Fade', 'cleaning-light' ),
                    ],
                    'frontend_available' => true,
                ]
            );

            $this->add_control(
                'transition_speed',[
                    'label' => esc_html__( 'Transition Speed', 'cleaning-light' ) . ' (ms)',
                    'type' => Controls_Manager::NUMBER,
                    'default' => 500,
                    'frontend_available' => true,
                ]
            );

            $this->add_control(
                'entrance_animation',[
                    'label' => esc_html__( 'Caption Animation', 'cleaning-light' ),
                    'type' => \Elementor\Controls_Manager::ANIMATION,
                    'selector' => '{{WRAPPER}} .cleaninglight-slider-caption',
                    'render_type' => 'template',
                    'default' => 'fadeInUp',
                ]
            );

            $this->add_control(
            	'sequenced_animation',[
            		'label' => esc_html__( 'Sequenced Animation', 'cleaning-light' ),
            		'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'cleaninglight-sequenced-animation',
            		'default' => 'yes',
            		'condition' => [
            			'entrance_animation!' => '',
            		],
            	]
            );

            $this->add_control(
            	'content_animation_duration',[
            		'label' => esc_html__( 'Animation Duration', 'cleaning-light' ) . ' (ms)',
            		'type' => Controls_Manager::SLIDER,
            		'render_type' => 'template',
            		'default' => [
            			'size' => 300,
            		],
            		'range' => [
            			'px' => [
            				'min' => 0,
            				'max' => 2000,
            				'step' => 100,
            			],
            		],
            		'selectors' => [
            			'{{WRAPPER}}.cleaninglight-sequenced-animationyes .cleaninglight-slider-super-title' => 'animation-delay: {{SIZE}}ms',
                        '{{WRAPPER}}.cleaninglight-sequenced-animationyes .cleaninglight-slider-title:nth-child(2)' => 'animation-delay: calc({{SIZE}}ms * 2 )',
                        '{{WRAPPER}}.cleaninglight-sequenced-animationyes .cleaninglight-slider-description:nth-child(3)' => 'animation-delay: calc({{SIZE}}ms * 3 )',
                        '{{WRAPPER}}.cleaninglight-sequenced-animationyes .cleaninglight-button-wrapper:nth-child(4)' => 'animation-delay: calc({{SIZE}}ms * 4 )',
            		],
            		'condition' => [
            			'sequenced_animation!' => '',
            		],
            	]
            );


		$this->end_controls_section();

        $this->start_controls_section(
			'section_style_slides',[
				'label' => esc_html__( 'Slides Caption', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_responsive_control(
                'content_max_width',[
                    'label' => esc_html__( 'Content Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        'px' => [
                            'max' => 1000,
                        ],
                        'em' => [
                            'max' => 100,
                        ],
                        'rem' => [
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 75,
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-caption' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(), [
                    'name' => 'slides_bg_color',
                    'types' => [ 'classic', 'gradient' ],
                    'exclude' => [ 'image' ],
                    'selector' => '{{WRAPPER}} .cleaninglight-slider-caption',
                    'fields_options' => [
                        'background' => [
                            'default' => 'classic',
                        ],
                    ],
                ]
            );

            $this->add_responsive_control(
                'slides_padding',[
                    'label' => esc_html__( 'Padding', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'slides_radius',[
                    'label' => esc_html__( 'Radius', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'slides_horizontal_position',[
                    'label' => esc_html__( 'Horizontal Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-inner' => 'justify-content:{{VALUE}}',
                        '{{WRAPPER}} .cleaninglight-button-wrapper' => 'justify-content: {{VALUE}}',
                    ],
                    'selectors_dictionary' => [
                        'start' => 'flex-start',
                        'center' => 'center',
                        'end' => 'flex-end',
                    ]
                ]
            );

            $this->add_responsive_control(
                'slides_vertical_position',[
                    'label' => esc_html__( 'Vertical Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => esc_html__( 'Top', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'middle' => [
                            'title' => esc_html__( 'Middle', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'bottom' => [
                            'title' => esc_html__( 'Bottom', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-inner' => 'align-items: {{VALUE}}',
                        '{{WRAPPER}} .cleaninglight-button-wrapper' => 'align-items: {{VALUE}}',
                    ],
                    'selectors_dictionary' => [
                        'top' => 'flex-start',
                        'middle' => 'center',
                        'bottom' => 'flex-end',
                    ]
                ]
            );

            $this->add_responsive_control(
                'slides_text_align',[
                    'label' => esc_html__( 'Text Align', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'cleaning-light' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'cleaning-light' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'cleaning-light' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-inner' => 'text-align: {{VALUE}}',
                        '{{WRAPPER}} .cleaninglight-button-wrapper' => 'text-align: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'slides_text_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-slider-inner',
                ]
            );

		$this->end_controls_section();

        $this->start_controls_section(
            'super_title_style', [
                'label' => esc_html__('Super Title', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'super_title_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-super-title' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'super_title_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-slider-super-title',
                ]
            );

            $this->add_responsive_control(
                'super_title_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-super-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'title_style', [
                'label' => esc_html__('Title', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'title_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-title' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'title_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-slider-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'caption_description_style', [
                'label' => esc_html__('Short Description', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'caption_description_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-description' => 'color: {{VALUE}}'
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'caption_description_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-slider-description',
                ]
            );

            $this->add_control(
                'sub_title_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-slider-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',[
				'label' => esc_html__( 'Button', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_group_control(
                Group_Control_Typography::get_type(),[
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .cleaninglight-button',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'button_text_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-button',
                ]
            );

            $this->add_responsive_control(
                'button_padding',[
                    'label' => esc_html__( 'Padding', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_border_radius',[
                    'label' => esc_html__( 'Border Radius', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'max' => 100,
                        ],
                        'em' => [
                            'max' => 10,
                        ],
                        'rem' => [
                            'max' => 10,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-button, {{WRAPPER}} .cleaninglight-button::before' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'heading_primary_button',[
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Primary Button', 'cleaning-light' ),
                    'separator' => 'before',
                ]
            );

            $this->start_controls_tabs( 'primary_button_tabs' );

                $this->start_controls_tab(
                    'normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'primary_text_color',[
                            'label' => esc_html__( 'Text Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-primary, {{WRAPPER}} .cleaninglight-button.cleaninglight-button-primary .cleaninglight-link-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),[
                            'name' => 'primary_background',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-primary',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'primary_border_color',
                            'selector' => '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-primary',
                            'default' => 'none',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'hover',[
                        'label' => esc_html__( 'Hover', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'primary_hover_text_color',[
                            'label' => esc_html__( 'Text Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-primary:hover, {{WRAPPER}} .cleaninglight-button.cleaninglight-button-primary:hover .cleaninglight-link-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),[
                            'name' => 'primary_hover_background',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-primary::before',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'primary_hover_border_color',
                            'selector' => '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-primary:hover',
                            'default' => 'none',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();


            $this->add_control(
                'heading_secondary_button',[
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Secondary Button', 'cleaning-light' ),
                    'separator' => 'before',
                ]
            );

            $this->start_controls_tabs( 'secondary_button_tabs' );

                $this->start_controls_tab(
                    'secondary_normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'secondary_text_color',[
                            'label' => esc_html__( 'Text Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-button.style-white, {{WRAPPER}} .cleaninglight-button.style-white .cleaninglight-link-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),[
                            'name' => 'secondary_background',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .cleaninglight-button.style-white',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'secondary_border_color',
                            'selector' => '{{WRAPPER}} .cleaninglight-button.style-white',
                            'default' => 'none',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'secondary_hover',[
                        'label' => esc_html__( 'Hover', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'secondary_hover_text_color',[
                            'label' => esc_html__( 'Text Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-button.style-white:hover, {{WRAPPER}} .cleaninglight-button.style-white:hover .cleaninglight-link-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),[
                            'name' => 'secondary_hover_background',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .cleaninglight-button.style-white::before',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'secondary_hover_border_color',
                            'selector' => '{{WRAPPER}} .cleaninglight-button.style-white:hover',
                            'default' => 'none',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',[
				'label' => esc_html__( 'Navigation', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

            $this->add_control(
                'heading_style_arrows',[
                    'label' => esc_html__( 'Arrows / Image', 'cleaning-light' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'navigation' => [ 'arrows', 'both' ],
                    ],
                ]
            );

            $this->add_responsive_control(
                'arrows_width',[
                    'label' => esc_html__( 'Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 25,
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-nav button[class*="owl-"]' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'arrows_height',[
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 25,
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-nav button[class*="owl-"]' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'arrows_size',[
                    'label' => esc_html__( 'Size', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 15,
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .nav_arrow .owl-nav button.owl-next::before, {{WRAPPER}} .nav_arrow .owl-nav button.owl-prev::before' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'nav_style_type' => 'nav_arrow',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'arrows_border_border',
                    'selector' => '{{WRAPPER}} .owl-nav button[class*="owl-"]',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'arrows_bg_color',[
                    'label' => esc_html__( 'Background Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .owl-nav button[class*="owl-"]' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'arrows_color',[
                    'label' => esc_html__( 'Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'condition' => [
                        'nav_style_type' => 'nav_arrow',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .nav_arrow .owl-nav button[class*="owl-"]' => 'color: {{VALUE}};'
                    ],
                ]
            );


            $this->add_control(
                'heading_style_dots',[
                    'label' => esc_html__( 'Pagination', 'cleaning-light' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'navigation' => [ 'dots', 'both' ],
                    ],
                ]
            );

            $this->add_responsive_control(
                'dots_width',[
                    'label' => esc_html__( 'Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 2,
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-dots .owl-dot' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'dots_height',[
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 2,
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-dots .owl-dot' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'dots_size',[
                    'label' => esc_html__( 'Size', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 15,
                            'max' => 150,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .number_type .owl-dots .owl-dot' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'dots_style_type' => 'number_type',
                    ],
                ]
            );

            $this->add_control(
                'dots_border_radius',[
                    'label' => esc_html__( 'Border Radius', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'max' => 200,
                        ],
                        'em' => [
                            'max' => 20,
                        ],
                        'rem' => [
                            'max' => 20,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-dots .owl-dot' => 'border-radius: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->start_controls_tabs( 'dots_button_tabs' );

                $this->start_controls_tab(
                    'dots_normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'dots_bg_color',[
                            'label' => esc_html__( 'Background Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dots_text_color',[
                            'label' => esc_html__( 'Text Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .owl-dots .owl-dot' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'dots_border_border',
                            'selector' => '{{WRAPPER}} .owl-dots .owl-dot',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'dots_active',[
                        'label' => esc_html__( 'Active', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'dots_active_bg_color',[
                            'label' => esc_html__( 'Background Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'dots_active_text_color',[
                            'label' => esc_html__( 'Text Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .owl-dots .owl-dot.active' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'dots_active_border_border',
                            'selector' => '{{WRAPPER}} .owl-dots .owl-dot.active',
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

		$this->end_controls_section();
	}

    protected function render() {
        
		$settings = $this->get_settings_for_display();

       // echo $settings['entrance_animation'];

        $params = array(
            'autoplay'  => $settings['autoplay'] == 'yes' ? true : false,
            'loop'      => $settings['infinite'] == 'yes' ? true : false,
            'easing'    => $settings['transition'],
            'mouseDrag' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'pause'     => $settings['autoplay_speed'],
            'speed'     => $settings['transition_speed'],
            'nav'       => $settings['navigation'],
            'dots_type' => $settings['dots_style_type'],
            'animation' => $settings['entrance_animation'],
        );
        $params = json_encode($params);

        if ( empty( $settings['slider_block'] ) ) {
			return;
		}

        $wrapper_tag = 'div';
        $button_tag = 'a';
        $super_title_tag = Utils::validate_html_tag( $settings['slides_super_title_tag'] );
		$title_tag = Utils::validate_html_tag( $settings['slides_title_tag'] );
		$description_tag = Utils::validate_html_tag( $settings['slides_description_tag'] );

        $this->add_render_attribute('wrapper', 'class', ['cleaninglight-sliders', 'cleaninglight-slider-wrapper', 'owl-carousel', $settings['nav_style_type'], $settings['dots_style_type'] ] );

        $this->add_render_attribute( 'super', 'class', ['cleaninglight-slider-super-title'] );

        $this->add_render_attribute( 'title', 'class', ['cleaninglight-slider-title'] );

		$this->add_render_attribute( 'description', 'class', ['cleaninglight-slider-description'] );

        $this->add_render_attribute( 'buttonwrapper', 'class', ['cleaninglight-button-wrapper'] );

        ?>

        <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?> data-params=<?php echo $params; ?>>
            
            <?php foreach ( $settings['slider_block'] as $index => $slide ) {  $slide_html = ''; ?>

                <div class="elementor-repeater-item-<?php echo esc_attr( $slide['_id'] ); ?> cleaninglight-slider">
                    <?php
                        $bg_image_url = isset($slide['background_image']['url']) && !empty($slide['background_image']['url']) ? $slide['background_image']['url'] : Utils::get_placeholder_image_src();
                        if ( 'yes' === $slide['background_overlay'] ) {
                            $slide_html = '<div class="cleaninglight-slider-bg-overlay"></div>';
                        }
                        echo $slide_html = '<div class="cleaninglight-slide-bg cleaninglight-ken-burns cleaninglight-ken-burns--in" data-img-url="'.esc_url( $bg_image_url ).'" role="img"></div>'. $slide_html;            
                    ?>
                    <div class="cleaninglight-slider-inner">
                        <div class="cleaninglight-slider-caption">
                            <?php if ( ! empty( $slide['super_title'] ) ) : ?>
                                <<?php Utils::print_validated_html_tag( $super_title_tag ); ?> <?php $this->print_render_attribute_string( 'super' ); ?>>
                                    <?php echo esc_html($slide['super_title']); ?>
                                </<?php Utils::print_validated_html_tag( $super_title_tag ); ?>>
                            <?php endif; ?>

                            <?php if ( ! empty( $slide['slider_title'] ) ) : ?>
                                <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                                    <?php echo esc_html($slide['slider_title']); ?>
                                </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                            <?php endif; ?>

                            <?php if ( ! empty( $slide['slider_description'] ) ) : ?>
                                <<?php Utils::print_validated_html_tag( $description_tag ); ?> <?php $this->print_render_attribute_string( 'description' ); ?>>
                                    <?php echo esc_html($slide['slider_description']); ?>
                                </<?php Utils::print_validated_html_tag( $description_tag ); ?>>
                            <?php endif; ?>

                            <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'buttonwrapper' ); ?>>
                                <?php
                                    if ( ! empty( $slide['slider_button_link']['url'] ) ) {
                                        $this->add_link_attributes( "link_{$index}", $slide['slider_button_link'] );
                                        $this->add_render_attribute( "link_{$index}", 'class', ['cleaninglight-button','cleaninglight-button-primary'] );
                                ?>
                                    <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "link_{$index}" ); ?>>
                                        <?php echo esc_html($slide['slider_button_text']); ?>
                                        <span class="cleaninglight-link-icon elementor-icon">
                                            <?php Icons_Manager::render_icon($slide['first_link_icon'], ['aria-hidden' => 'true']); ?>
                                        </span>
                                    </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>

                                <?php } ?>

                                <?php
                                    if ( ! empty( $slide['slider_button_one_link']['url'] ) ) {
                                        $this->add_link_attributes( "link_one_{$index}", $slide['slider_button_one_link'] );
                                        $this->add_render_attribute( "link_one_{$index}", 'class', ['cleaninglight-button','style-white'] );
                                ?>
                                    <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "link_one_{$index}" ); ?>>
                                        <?php echo esc_html($slide['slider_button_one_text']); ?>
                                        <span class="cleaninglight-link-icon elementor-icon">
                                            <?php Icons_Manager::render_icon($slide['second_link_icon'], ['aria-hidden' => 'true']); ?>
                                        </span>
                                    </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>

                                <?php } ?>
                            </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>

		<?php
	}

}
