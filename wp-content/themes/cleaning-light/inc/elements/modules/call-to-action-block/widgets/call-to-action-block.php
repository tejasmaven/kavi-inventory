<?php

namespace CleaningLightElements\Modules\CallToActionBlock\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class CallToActionBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-call-to-action-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Call To Action Block', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-image-rollover';
    }

    public function get_keywords() {
		return [ 'call to action', 'cta', 'button' ];
	}

    /** Category */
    public function get_categories() {
        return ['CleaningLight-elements'];
    }

    /** Controls */
    protected function register_controls() {
		
		$this->start_controls_section(
			'section_content',[
				'label' => esc_html__( 'Content', 'cleaning-light' ),
			]
		);

             $this->add_control(
                'layout_skin',[
                    'label' => esc_html__( 'Layout', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'options' => [
                        'classic' => esc_html__( 'Classic', 'cleaning-light' ),
                        'cover' => esc_html__( 'Cover', 'cleaning-light' ),
                    ],
                    'render_type' => 'template',
                    'prefix_class' => 'calltoaction-layout-skin-',
                    'default' => 'cover',
                ]
            );

            $this->add_responsive_control(
                'layout_position',[
                    'label' => esc_html__( 'Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'above',
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'above' => [
                            'title' => esc_html__( 'Above', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                        'below' => [
                            'title' => esc_html__( 'Below', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors_dictionary' => [
                        'above' => 'flex-direction: column;',
                        'below' => 'flex-direction: column-reverse;',
                        'left' => 'flex-direction: row;',
                        'right' => 'flex-direction: row-reverse;',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-wrap' => '{{VALUE}}',
                    ],
                    'condition' => [
                        'layout_skin!' => 'cover',
                    ],
                ]
            );

            $this->add_control(
                'bg_image',[
                    'label' => esc_html__( 'Choose Image', 'cleaning-light' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),[
                    'name' => 'bg_image',
                    'label' => esc_html__( 'Image Resolution', 'cleaning-light' ),
                    'default' => 'large',
                    'condition' => [
                        'bg_image[id]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'graphic_element',[
                    'label' => esc_html__( 'Graphic Element', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'separator' => 'before',
                    'options' => [
                        'none' => [
                            'title' => esc_html__( 'None', 'cleaning-light' ),
                            'icon' => 'eicon-ban',
                        ],
                        'image' => [
                            'title' => esc_html__( 'Image', 'cleaning-light' ),
                            'icon' => 'eicon-image-bold',
                        ],
                        'icon' => [
                            'title' => esc_html__( 'Icon', 'cleaning-light' ),
                            'icon' => 'eicon-star',
                        ],
                    ],
                    'default' => 'none',
                ]
            );

            $this->add_control(
                'graphic_image',[
                    'label' => esc_html__( 'Choose Image', 'cleaning-light' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'graphic_element' => 'image',
                    ],
                    'show_label' => false,
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),[
                    'name' => 'graphic_image', // Actually its `image_size`
                    'default' => 'thumbnail',
                    'condition' => [
                        'graphic_element' => 'image',
                        'graphic_image[id]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'selected_icon',[
                    'label' => esc_html__( 'Icon', 'cleaning-light' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'title',[
                    'label' => esc_html__( 'Title', 'cleaning-light' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Your CTA Heading Title', 'cleaning-light' ),
                    'placeholder' => esc_html__( 'Enter your title', 'cleaning-light' ),
                    'label_block' => true,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'title_tag',[
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
                    ],
                    'default' => 'h2',
                    'condition' => [
                        'title!' => '',
                    ],
                ]
            );

            $this->add_control(
                'description',[
                    'label' => esc_html__( 'Description', 'cleaning-light' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Try our premium themes risk-free. If you are not 100% satisfied with the features and performance of our premium themes, we will credit your original payment method without any question.', 'cleaning-light' ),
                    'placeholder' => esc_html__( 'Enter your description', 'cleaning-light' ),
                    'separator' => 'before',
                    'rows' => 5,
                ]
            );

            $this->add_control(
                'description_tag',[
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
                    ],
                    'default' => 'div',
                    'condition' => [
                        'description!' => '',
                    ],
                ]
            );

            $this->add_control(
                'button',[
                    'label' => esc_html__( 'Button Text', 'cleaning-light' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__( 'Click Here', 'cleaning-light' ),
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'link',[
                    'label' => esc_html__( 'Link', 'cleaning-light' ),
                    'type' => Controls_Manager::URL,
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
                ]
            );

            $this->add_control(
                'button_icon',[
                    'label' => esc_html__( 'Button Icon', 'cleaning-light' ),
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
                ]
            );

            $this->add_control(
                'button_one',[
                    'label' => esc_html__( 'Second Button Text', 'cleaning-light' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => '',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'link_one',[
                    'label' => esc_html__( 'Second Button Link', 'cleaning-light' ),
                    'type' => Controls_Manager::URL,
                ]
            );
            
            $this->add_control(
                'button_icon_one',[
                    'label' => esc_html__( 'Second Button Icon', 'cleaning-light' ),
                    'type' => Controls_Manager::ICONS,
                    'skin' => 'inline',
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
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon',[
				'label' => esc_html__( 'Ribbon', 'cleaning-light' ),
			]
		);

            $this->add_control(
                'ribbon_title',[
                    'label' => esc_html__( 'Title', 'cleaning-light' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'ribbon_horizontal_position',[
                    'label' => esc_html__( 'Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-right',
                        ],
                    ],
                    'condition' => [
                        'ribbon_title!' => '',
                    ],
                ]
            );

		$this->end_controls_section();


        // Style Tabs

		$this->start_controls_section(
			'box_style',[
				'label' => esc_html__( 'General Box', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_responsive_control(
                'min-height', [
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
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-content-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'alignment',[
                    'label' => esc_html__( 'Alignment', 'cleaning-light' ),
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
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-content-wrapper' => 'text-align: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'vertical_position',[
                    'label' => esc_html__( 'Vertical Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Top', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Middle', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-middle',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Bottom', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-content-wrapper' => 'justify-content: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'padding',[
                    'label' => esc_html__( 'Padding', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_control(
                'heading_bg_image_style',[
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Image', 'cleaning-light' ),
                    'condition' => [
                        'bg_image[url]!' => '',
                        'layout_skin' => 'classic',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'image_min_height',[
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'vh', 'custom' ],
                    'range' => [
                        'px' => [
                            'max' => 800,
                        ],
                        'em' => [
                            'max' => 50,
                        ],
                        'rem' => [
                            'max' => 50,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-bg-wrapper' => 'min-height: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'layout_skin' => 'classic',
                    ],
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'graphic_element_style',[
				'label' => esc_html__( 'Graphic Element', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'graphic_element!' => [
						'none',
						'',
					],
				],
			]
		);

            $this->add_responsive_control(
                'graphic_image_spacing', [
                    'label' => esc_html__('Spacing', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-image-wrap' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                        '{{WRAPPER}} .calltoaction-icon' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'graphic_image_width',[
                    'label' => esc_html__( 'Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'default' => [
                        'unit' => '%',
                    ],
                    'range' => [
                        '%' => [
                            'min' => 5,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-image-wrap img' => 'width: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'graphic_element' => 'image',
                    ],
                ]
            );

            $this->add_responsive_control(
                'graphic_image_height',[
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 900,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-image-wrap img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    ],
                    'condition' => [
                        'graphic_element' => 'image',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'graphic_image_border',
                    'selector' => '{{WRAPPER}} .calltoaction-image-wrap img',
                    'condition' => [
                        'graphic_element' => 'image',
                    ],
                ]
            );

            $this->add_responsive_control(
                'graphic_image_border_radius',[
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
                        '{{WRAPPER}} .calltoaction-image-wrap img' => 'border-radius: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'graphic_element' => 'image',
                    ],
                ]
            );

            // icon setting style

            $this->add_control(
                'icon_size',[
                    'label' => esc_html__( 'Icon Size', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 6,
                            'max' => 300,
                        ],
                        'em' => [
                            'min' => 0.6,
                            'max' => 30,
                        ],
                        'rem' => [
                            'min' => 0.6,
                            'max' => 30,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .calltoaction-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'icon_padding',[
                    'label' => esc_html__( 'Icon Padding', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-icon i, {{WRAPPER}} .calltoaction-icon svg' => 'padding: {{SIZE}}{{UNIT}};',
                    ],
                    'range' => [
                        'px' => [
                            'max' => 50,
                        ],
                        'em' => [
                            'min' => 0,
                            'max' => 5,
                        ],
                        'rem' => [
                            'min' => 0,
                            'max' => 5,
                        ],
                    ],
                    'condition' => [
                        'graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'icon_border_border',
                    'selector' => '{{WRAPPER}} .calltoaction-icon i, {{WRAPPER}} .calltoaction-icon svg',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'icon_border_radius',[
                    'label' => esc_html__( 'Border Radius', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-icon i, {{WRAPPER}} .calltoaction-icon svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'icon_bg_color',[
                    'label' => esc_html__( 'Background Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-icon i, {{WRAPPER}} .calltoaction-icon svg' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .calltoaction-icon svg' => 'stroke: {{VALUE}}',
                    ],
                    'condition' => [
                        'graphic_element' => 'icon',
                    ],
                ]
            );

            $this->add_control(
                'icon_color',[
                    'label' => esc_html__( 'Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'condition' => [
                        'graphic_element' => 'icon',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-icon i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .calltoaction-icon svg' => 'fill: {{VALUE}};',
                    ],
                ]
            );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',[
				'label' => esc_html__( 'Content', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'title',
							'operator' => '!==',
							'value' => '',
						],
						[
							'name' => 'description',
							'operator' => '!==',
							'value' => '',
						],
					],
				],
			]
		);

            $this->add_control(
                'heading_style_title',[
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Title', 'cleaning-light' ),
                    'condition' => [
                        'title!' => '',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),[
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .calltoaction-title',
                    'condition' => [
                        'title!' => '',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'text_stroke',
                    'selector' => '{{WRAPPER}} .calltoaction-title',
                ]
            );

            $this->add_responsive_control(
                'title_spacing', [
                    'label' => esc_html__('Spacing', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                    'condition' => [
                        'title!' => '',
                    ],
                ]
            );

            $this->add_control(
                'heading_style_description',[
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Description', 'cleaning-light' ),
                    'separator' => 'before',
                    'condition' => [
                        'description!' => '',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),[
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .calltoaction-description',
                    'condition' => [
                        'description!' => '',
                    ],
                ]
            );

            $this->add_responsive_control(
                'description_spacing', [
                    'label' => esc_html__('Spacing', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                    'condition' => [
                        'description!' => '',
                    ],
                ]
            );
        

            $this->add_control(
                'heading_content_colors',[
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Colors', 'cleaning-light' ),
                    'separator' => 'before',
                ]
            );

            $this->start_controls_tabs( 'color_tabs' );

                $this->start_controls_tab( 'colors_normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(), [
                            'name' => 'content_bg_color',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .calltoaction-content-wrapper',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ]
                    );

                    $this->add_control(
                        'title_color',[
                            'label' => esc_html__( 'Title Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .calltoaction-title' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'title!' => '',
                            ],
                        ]
                    );

                    $this->add_control(
                        'description_color',[
                            'label' => esc_html__( 'Description Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .calltoaction-description' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'description!' => '',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'colors_hover',[
                        'label' => esc_html__( 'Hover', 'cleaning-light' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(), [
                            'name' => 'content_bg_color_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .calltoaction-wrap:hover .calltoaction-content-wrapper',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ]
                    );

                    $this->add_control(
                        'title_color_hover',[
                            'label' => esc_html__( 'Title Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .calltoaction-wrap:hover .calltoaction-title' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'title!' => '',
                            ],
                        ]
                    );

                    $this->add_control(
                        'description_color_hover',[
                            'label' => esc_html__( 'Description Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .calltoaction-wrap:hover .calltoaction-description' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'description!' => '',
                            ],
                        ]
                    );

                $this->end_controls_tab();

		    $this->end_controls_tabs();

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
                    'primary_normal',[
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
                    'primary_hover',[
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
                                '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-border, {{WRAPPER}} .cleaninglight-button.cleaninglight-button-border .cleaninglight-link-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),[
                            'name' => 'secondary_background',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-border',
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
                            'selector' => '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-border',
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
                                '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-border:hover, {{WRAPPER}} .cleaninglight-button.cleaninglight-button-border:hover .cleaninglight-link-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),[
                            'name' => 'secondary_hover_background',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-border::before',
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
                            'selector' => '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-border:hover',
                            'default' => 'none',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon_style',[
				'label' => esc_html__( 'Ribbon', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'ribbon_title!' => '',
				],
			]
		);

            $this->add_control(
                'ribbon_bg_color',[
                    'label' => esc_html__( 'Background Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-ribbon-inner' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'ribbon_text_color',[
                    'label' => esc_html__( 'Text Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-ribbon-inner' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

            $this->add_responsive_control(
                'ribbon_distance',[
                    'label' => esc_html__( 'Distance', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'max' => 60,
                        ],
                        'em' => [
                            'max' => 5,
                        ],
                        'em' => [
                            'max' => 5,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .calltoaction-ribbon-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),[
                    'name' => 'ribbon_typography',
                    'selector' => '{{WRAPPER}} .calltoaction-ribbon-inner',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),[
                    'name' => 'box_shadow',
                    'selector' => '{{WRAPPER}} .calltoaction-ribbon-inner',
                ]
            );

		$this->end_controls_section();

        // Hover Effects Design
		$this->start_controls_section(
			'hover_effects',[
				'label' => esc_html__( 'Hover Effects', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
            	'transformation',[
            		'label' => esc_html__( 'Hover Animation', 'cleaning-light' ),
            		'type' => Controls_Manager::SELECT,
                    'label_block' => true,
            		'options' => [
            			'' => 'None',
            			'zoom-in' => 'Zoom In',
            			'zoom-out' => 'Zoom Out',
            			'move-left' => 'Move Left',
            			'move-right' => 'Move Right',
            			'move-up' => 'Move Up',
            			'move-down' => 'Move Down',
            		],
            		'default' => 'zoom-in',
            		'prefix_class' => 'cleaninglight-bg-transform cleaninglight-bg-transform-',
            	]
            );

            $this->add_control(
            	'content_hover_heading',[
            		'type' => Controls_Manager::HEADING,
            		'label' => esc_html__( 'Content', 'cleaning-light' ),
            		'condition' => [
            			'layout_skin' => 'cover',
            		],
            	]
            );

            $this->add_control(
            	'content_animation',[
            		'label' => esc_html__( 'Hover Animation', 'cleaning-light' ),
            		'type' => Controls_Manager::SELECT,
                    'label_block' => true,
            		'groups' => [
            			[
            				'label' => esc_html__( 'None', 'cleaning-light' ),
            				'options' => [
            					'' => esc_html__( 'None', 'cleaning-light' ),
            				],
            			],
            			[
            				'label' => esc_html__( 'Entrance', 'cleaning-light' ),
            				'options' => [
            					'enter-from-right' => 'Slide In Right',
            					'enter-from-left' => 'Slide In Left',
            					'enter-from-top' => 'Slide In Up',
            					'enter-from-bottom' => 'Slide In Down',
            					'enter-zoom-in' => 'Zoom In',
            					'enter-zoom-out' => 'Zoom Out',
            					'fade-in' => 'Fade In',
            				],
            			],
            			[
            				'label' => esc_html__( 'Reaction', 'cleaning-light' ),
            				'options' => [
            					'grow' => 'Grow',
            					'shrink' => 'Shrink',
            					'move-right' => 'Move Right',
            					'move-left' => 'Move Left',
            					'move-up' => 'Move Up',
            					'move-down' => 'Move Down',
            				],
            			],
            			[
            				'label' => esc_html__( 'Exit', 'cleaning-light' ),
            				'options' => [
            					'exit-to-right' => 'Slide Out Right',
            					'exit-to-left' => 'Slide Out Left',
            					'exit-to-top' => 'Slide Out Up',
            					'exit-to-bottom' => 'Slide Out Down',
            					'exit-zoom-in' => 'Zoom In',
            					'exit-zoom-out' => 'Zoom Out',
            					'fade-out' => 'Fade Out',
            				],
            			],
            		],
            		'default' => 'grow',
            		'condition' => [
            			'layout_skin' => 'cover',
            		],
            	]
            );

            /*
             * Add class 'elementor-animated-content' to widget when assigned content animation
             */
            $this->add_control(
            	'animation_class',[
            		'label' => esc_html__( 'Animation', 'cleaning-light' ),
            		'type' => Controls_Manager::HIDDEN,
            		'default' => 'animated-content',
            		'prefix_class' => 'calltoaction-',
            		'condition' => [
            			'content_animation!' => '',
            		],
            	]
            );

            $this->add_control(
            	'content_animation_duration',[
            		'label' => esc_html__( 'Animation Duration', 'cleaning-light' ) . ' (ms)',
            		'type' => Controls_Manager::SLIDER,
            		'render_type' => 'template',
            		'default' => [
            			'size' => 1000,
            		],
            		'range' => [
            			'px' => [
            				'min' => 0,
            				'max' => 3000,
            				'step' => 100,
            			],
            		],
            		'selectors' => [
            			'{{WRAPPER}} .calltoaction-content-item' => 'transition-duration: {{SIZE}}ms',
                        '{{WRAPPER}}.calltoaction-sequenced-animation .calltoaction-content-item:nth-child(2)' => 'transition-delay: calc( {{SIZE}}ms / 3 )',
                        '{{WRAPPER}}.calltoaction-sequenced-animation .calltoaction-content-item:nth-child(3)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 2 )',
                        '{{WRAPPER}}.calltoaction-sequenced-animation .calltoaction-content-item:nth-child(4)' => 'transition-delay: calc( ( {{SIZE}}ms / 3 ) * 3 )',
            		],
            		'condition' => [
            			'content_animation!' => '',
            			'layout_skin' => 'cover',
            		],
            	]
            );

            $this->add_control(
            	'sequenced_animation',[
            		'label' => esc_html__( 'Sequenced Animation', 'cleaning-light' ),
            		'type' => Controls_Manager::SWITCHER,
            		'label_on' => esc_html__( 'On', 'cleaning-light' ),
            		'label_off' => esc_html__( 'Off', 'cleaning-light' ),
            		'return_value' => 'calltoaction-sequenced-animation',
            		'prefix_class' => '',
            		'condition' => [
            			'content_animation!' => '',
            			'layout_skin' => 'cover',
            		],
            	]
            );

            $this->add_control(
            	'background_hover_heading',[
            		'type' => Controls_Manager::HEADING,
            		'label' => esc_html__( 'Background', 'cleaning-light' ),
            		'separator' => 'before',
            		'condition' => [
            			'layout_skin' => 'cover',
            		],
            	]
            );


            $this->start_controls_tabs( 'bg_effects_tabs' );

                $this->start_controls_tab( 'normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'overlay_color',[
                            'label' => esc_html__( 'Overlay Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .calltoaction-wrap:not(:hover) .calltoaction-bg-image-overlay' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Css_Filter::get_type(),[
                            'name' => 'bg_filters',
                            'selector' => '{{WRAPPER}} .calltoaction-bg-image ',
                        ]
                    );

                    $this->add_control(
                        'overlay_blend_mode',[
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
                            'selectors' => [
                                '{{WRAPPER}} .calltoaction-bg-image-overlay' => 'mix-blend-mode: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab( 'hover',[
                        'label' => esc_html__( 'Hover', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'overlay_color_hover',[
                            'label' => esc_html__( 'Overlay Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .calltoaction-wrap:hover .calltoaction-bg-image-overlay' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Css_Filter::get_type(),[
                            'name' => 'bg_filters_hover',
                            'selector' => '{{WRAPPER}} .calltoaction-wrap:hover .calltoaction-bg-image',
                        ]
                    );

                    $this->add_control(
                        'effect_duration',[
                            'label' => esc_html__( 'Transition Duration', 'cleaning-light' ) . ' (ms)',
                            'type' => Controls_Manager::SLIDER,
                            'render_type' => 'template',
                            'default' => [
                                'size' => 1500,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                    'step' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .calltoaction-wrap .calltoaction-bg-image , {{WRAPPER}} .calltoaction-wrap .calltoaction-bg-image-overlay' => 'transition-duration: {{SIZE}}ms',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

	    $this->end_controls_section();
	}

	protected function render() {
        
		$settings = $this->get_settings_for_display();
		$wrapper_tag = 'div';
		$button_tag = 'a';
		$title_tag = Utils::validate_html_tag( $settings['title_tag'] );
		$description_tag = Utils::validate_html_tag( $settings['description_tag'] );
		$bg_image = '';
		$content_animation = $settings['content_animation'];
		$animation_class = '';
		$print_bg = true;
		$print_content = true;

		if ( ! empty( $settings['bg_image']['id'] ) ) {

			$bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['bg_image']['id'], 'bg_image', $settings );

		} elseif ( ! empty( $settings['bg_image']['url'] ) ) {

			$bg_image = $settings['bg_image']['url'];
		}

		if ( empty( $bg_image ) && 'classic' == $settings['layout_skin'] ) {
			$print_bg = false;
		}

		if ( empty( $settings['title'] ) && empty( $settings['description'] ) && empty( $settings['button'] ) && 'none' == $settings['graphic_element'] ) {
			$print_content = false;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'calltoaction-wrap' );

		$this->add_render_attribute(
			'background_image',[
				'style' => 'background-image: url(' . esc_url( $bg_image ) . ');',
				'role' => 'img',
			]
		);

		$this->add_render_attribute( 'title', 'class', ['calltoaction-title','calltoaction-content-item'] );

		$this->add_render_attribute( 'description', 'class', ['calltoaction-description','calltoaction-content-item'] );

        $this->add_render_attribute( 'buttonwrapper', 'class', ['cleaninglight-button-wrapper'] );

        $this->add_link_attributes( 'button', $settings['link'] );
		$this->add_render_attribute( 'button', 'class', ['cleaninglight-button','cleaninglight-button-primary'] );

        $this->add_link_attributes( 'button_one', $settings['link_one'] );
		$this->add_render_attribute( 'button_one', 'class', ['cleaninglight-button','cleaninglight-button-border'] );
        

		if ( 'icon' === $settings['graphic_element'] ) {
			if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
				$settings['icon'] = 'fa fa-star';
			}
			if ( ! empty( $settings['icon'] ) ) {
				$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
			}
		} elseif ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) {
			$this->add_render_attribute( 'graphic_element', 'class', 'calltoaction-image-wrap' );
		}

		if ( ! empty( $content_animation ) && 'cover' == $settings['layout_skin'] ) {

			$animation_class = 'calltoaction-animated-item--' . $content_animation;

			$this->add_render_attribute( 'title', 'class', $animation_class );

			$this->add_render_attribute( 'graphic_element', 'class', $animation_class );

			$this->add_render_attribute( 'description', 'class', $animation_class );

		}

		$this->add_inline_editing_attributes( 'title' );
		$this->add_inline_editing_attributes( 'description' );
		$this->add_inline_editing_attributes( 'button' );
        $this->add_inline_editing_attributes( 'button_one' );

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		?>
		<<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

            <?php if ( $print_bg ) : ?>
                <div class="calltoaction-bg-wrapper">
                    <div class="calltoaction-bg-image cleaninglight-bg" <?php $this->print_render_attribute_string( 'background_image' ); ?>></div>
                    <div class="calltoaction-bg-image-overlay"></div>
                </div>
            <?php endif; ?>

            <?php if ( $print_content ) : ?>
                <div class="calltoaction-content-wrapper">
                    <?php if ( 'image' === $settings['graphic_element'] && ! empty( $settings['graphic_image']['url'] ) ) : ?>
                        <div <?php $this->print_render_attribute_string( 'graphic_element' ); ?>>
                            <?php Group_Control_Image_Size::print_attachment_image_html( $settings, 'graphic_image' ); ?>
                        </div>
                    <?php elseif ( 'icon' === $settings['graphic_element'] && ( ! empty( $settings['icon'] ) || ! empty( $settings['selected_icon'] ) ) ) : ?>
                        <div class="calltoaction-icon calltoaction-content-item <?php echo esc_attr( $animation_class ); ?>">
                            <?php if ( $is_new || $migrated ) :
                                Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                            else : ?>
                                <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['title'] ) ) : ?>
                        <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                            <?php $this->print_unescaped_setting( 'title' ); ?>
                        </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['description'] ) ) : ?>
                        <<?php Utils::print_validated_html_tag( $description_tag ); ?> <?php $this->print_render_attribute_string( 'description' ); ?>>
                            <?php $this->print_unescaped_setting( 'description' ); ?>
                        </<?php Utils::print_validated_html_tag( $description_tag ); ?>>
                    <?php endif; ?>
                    
                    <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'buttonwrapper' ); ?>>
                        <?php if ( ! empty( $settings['button'] ) ) : ?>
                            <div class="calltoaction-button-wrapper calltoaction-content-item <?php echo esc_attr( $animation_class ); ?>">
                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
                                    <?php $this->print_unescaped_setting( 'button' ); ?>
                                    <span class="cleaninglight-link-icon elementor-icon">
                                        <?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                                    </span>
                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                            </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['button_one'] ) ) : ?>
                            <div class="calltoaction-button-wrapper calltoaction-content-item <?php echo esc_attr( $animation_class ); ?>">
                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button_one' ); ?>>
                                    <?php $this->print_unescaped_setting( 'button_one' ); ?>
                                    <span class="cleaninglight-link-icon elementor-icon">
                                        <?php Icons_Manager::render_icon($settings['button_icon_one'], ['aria-hidden' => 'true']); ?>
                                    </span>
                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                            </div>
                        <?php endif; ?>
                    </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>

                </div>
            <?php endif; ?>
		    
            <?php
                if ( ! empty( $settings['ribbon_title'] ) ) :
                    $this->add_render_attribute( 'ribbon-wrapper', 'class', 'calltoaction-ribbon' );

                if ( ! empty( $settings['ribbon_horizontal_position'] ) ) {
                    $this->add_render_attribute( 'ribbon-wrapper', 'class', 'calltoaction-ribbon-' . $settings['ribbon_horizontal_position'] );
                }
			?>
                <div <?php $this->print_render_attribute_string( 'ribbon-wrapper' ); ?>>
                    <div class="calltoaction-ribbon-inner"><?php $this->print_unescaped_setting( 'ribbon_title' ); ?></div>
                </div>
		    <?php endif; ?>

		</<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
		<?php
	}
}