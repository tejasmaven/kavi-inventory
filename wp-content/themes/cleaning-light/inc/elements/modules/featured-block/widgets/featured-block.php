<?php

namespace CleaningLightElements\Modules\FeaturedBlock\Widgets;

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

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class FeaturedBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-featured-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Featured Service Block', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-icon-box';
    }

    public function get_keywords() {
        return [ 'service', 'features', 'image', 'photo', 'visual', 'box' ];
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
            'featured', [
                'label' => esc_html__('Featured Service Content', 'cleaning-light'),
            ]
        );

            $this->add_control(
                'graphic_element',[
                    'label' => esc_html__( 'Graphic Element', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'none' => [
                            'title' => esc_html__( 'None', 'cleaning-light' ),
                            'icon' => 'eicon-ban',
                        ],
                        'both' => [
                            'title' => esc_html__( 'Image/Icon', 'cleaning-light' ),
                            'icon' => 'eicon-image-before-after',
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
                    'default' => 'both',
                ]
            );

            $this->add_control(
                'layout', [
                    'label' => esc_html__('Layout', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'style1',
                    'label_block' => true,
                    'separator' => 'before',
                    'options' => [
                        'style1' => esc_html__('Style 1', 'cleaning-light'),
                        'style2' => esc_html__('Style 2', 'cleaning-light'),
                    ],
                    'condition' => [
                        'graphic_element' => ['both','image'],
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_height2', [
                    'label' => esc_html__('Image Height', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 320,
                            'max' => 750,
                            'step' => 10
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '400',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-imageicon-box-wrapper.style2 .cleaninglight-imageicon-box-img img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'layout' => ['style2'],
                    ],
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
                        'graphic_element' => [ 'both', 'image' ],
                    ],
                    'show_label' => false,
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),[
                    'name' => 'graphic_image', // Actually its `image_size`
                    'default' => 'full',
                    'condition' => [
                        'graphic_element' => [ 'both', 'image' ],
                        'graphic_image[id]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'graphic_icon',[
                    'label' => esc_html__( 'Icon', 'cleaning-light' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa-solid fa-bezier-curve',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'graphic_element' => [ 'both', 'icon' ],
                    ],
                ]
            );

            $this->add_control(
                'title', [
                    'label' => esc_html__('Title', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Your Service Heading Title', 'cleaning-light')
                ]
            );

            $this->add_control(
                'title_tag', [
                    'label' => esc_html__('Title HTML Tag', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default' => 'h3',
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

            $this->add_control(
                'description', [
                    'label' => esc_html__('Short Description', 'cleaning-light'),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'placeholder' => esc_html__('Type your description here', 'cleaning-light'),
                    'label_block' => true,
                    'default' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light')
                ]
            );

            $this->add_control(
                'button', [
                    'label' => esc_html__('Button Text', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Read More', 'cleaning-light')
                ]
            );

            $this->add_control(
                'link_icon',[
                    'label' => esc_html__( 'Link Icon', 'cleaning-light' ),
                    'type' => Controls_Manager::ICONS,
                    'skin' => 'inline',
                    'label_block' => false,
                    'default' => [
                        'library' => 'fa-solid',
                        'value' => 'fas fa-long-arrow-alt-right',
                    ],
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
                        'button!' => '',
                    ],
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
                'link_click',[
                    'label' => esc_html__( 'Apply Link On', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'box' => esc_html__( 'Whole Box', 'cleaning-light' ),
                        'button' => esc_html__( 'Button Only', 'cleaning-light' ),
                    ],
                    'default' => 'button',
                    'condition' => [
                        'link[url]!' => '',
                    ],
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'item_settings', [
                'label' => esc_html__('General Style', 'cleaning-light'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            
            $this->add_responsive_control(
                'layout_position',[
                    'label' => esc_html__( 'Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
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
                        '{{WRAPPER}} .cleaninglight-imageicon-box-wrapper' => '{{VALUE}}',
                    ],
                    'prefix_class' => 'cleaninglight-imageicon-layout-',
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'layout',
                                'operator' => '==',
                                'value' => 'style1',
                            ],
                            [
                                'relation' => 'or',
                                'terms' => [
                                    [
                                        'name' => 'graphic_element',
                                        'operator' => '==',
                                        'value' => 'both',
                                    ],
                                    [
                                        'name' => 'graphic_element',
                                        'operator' => '==',
                                        'value' => 'image',
                                    ],
                                    [
                                        'name' => 'graphic_element',
                                        'operator' => '==',
                                        'value' => 'icon',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_vertical_alignment',[
                    'label' => esc_html__( 'Vertical Alignment', 'cleaning-light' ),
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
                    'default' => 'middle',
                    'toggle' => false,
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-imageicon-box-wrapper' => 'align-items: {{VALUE}};',
                    ],
                    'selectors_dictionary' => [
                        'top' => 'flex-start',
                        'middle' => 'center',
                        'bottom' => 'flex-end',
                    ],
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'layout',
                                'operator' => '==',
                                'value' => 'style1',
                            ],
                            [
                                'relation' => 'or',
                                'terms' => [
                                    [
                                        'name' => 'layout_position',
                                        'operator' => '==',
                                        'value' => 'left',
                                    ],
                                    [
                                        'name' => 'layout_position',
                                        'operator' => '==',
                                        'value' => 'right',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]
            );

            $this->add_responsive_control(
                'text_align',[
                    'label' => esc_html__( 'Alignment', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'center',
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
                        '{{WRAPPER}} .cleaninglight-imageicon-box-content,
                        {{WRAPPER}} .cleaninglight-imageicon-box-wrapper.icon' => 'text-align: {{VALUE}};',
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
                        '{{WRAPPER}} .cleaninglight-imageicon-box-content' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-imageicon-box-content, {{WRAPPER}} .cleaninglight-imageicon-box-wrapper.icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_radius', [
                    'label' => esc_html__('Radius', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-imageicon-box-wrapper, {{WRAPPER}} .cleaninglight-imageicon-box-wrapper.style2 .cleaninglight-imageicon-box-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        
        // Desing (Style)
        $this->start_controls_section(
            'section_style_image',[
                'label' => esc_html__( 'Image', 'cleaning-light' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'graphic_element' => [ 'both', 'image' ],
                ],
            ]
        );

            $this->add_responsive_control(
                'image_width',[
                    'label' => esc_html__( 'Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
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
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => 5,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-image-box-img' => 'width: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_height',[
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '',
                        'unit' => 'px',
                    ],
                    'tablet_default' => [
                        'size' => '',
                        'unit' => 'px',
                    ],
                    'mobile_default' => [
                        'size' => '',
                        'unit' => 'px',
                    ],
                    'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 900,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-image-box-img img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(), [
                    'name' => 'image_border',
                    'selector' => '{{WRAPPER}} .cleaninglight-image-box-img img',
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'image_border_radius',[
                    'label' => esc_html__( 'Border Radius', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'separator' => 'after',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-image-box-img img' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'image_hover_heading',[
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Hover Effects', 'cleaning-light' ),
                ]
            );

            $this->add_control(
                'image_hover_transformation',[
                    'label' => esc_html__( 'Hover Animation', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
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
                'image_effect_duration',[
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
                        '{{WRAPPER}} .cleaninglight-image-wrap' => 'transition-duration: {{SIZE}}ms',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->start_controls_tabs( 'image_effects_tabs' );

                $this->start_controls_tab( 'image_normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Css_Filter::get_type(),[
                            'name' => 'image_bg_filters',
                            'selector' => '{{WRAPPER}} .cleaninglight-image-box-img img',
                        ]
                    );

                    $this->add_control(
                        'image_opacity',[
                            'label' => esc_html__( 'Opacity', 'cleaning-light' ),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max' => 1,
                                    'min' => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-image-box-img img' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab( 'image_hover',[
                        'label' => esc_html__( 'Hover', 'cleaning-light' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Css_Filter::get_type(),[
                            'name' => 'image_bg_filters_hover',
                            'selector' => '{{WRAPPER}}:hover .cleaninglight-image-box-img img',
                        ]
                    );

                    $this->add_control(
                        'image_opacity_hover',[
                            'label' => esc_html__( 'Opacity', 'cleaning-light' ),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max' => 1,
                                    'min' => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}}:hover .cleaninglight-image-box-img img' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'icon_style', [
                'label' => esc_html__('Icon', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'graphic_element' => [ 'both', 'icon' ],
                ],
            ]
        );

            $this->add_responsive_control(
                'icon_size', [
                    'label' => esc_html__('Icon Size', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 300,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 65,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-icon-box-icon' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-icon-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'icon_radius', [
                    'label' => esc_html__('Radius', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-icon-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->start_controls_tabs( 'icon_button_tabs' );

                $this->start_controls_tab(
                    'icon_normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'icon_color', [
                            'label' => esc_html__('Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-icon-box-icon' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .cleaninglight-icon-box-icon' => 'fill: {{VALUE}}',
                            ],
                        ]
                    );
        
                    $this->add_control(
                        'icon_bg_color', [
                            'label' => esc_html__('Background Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-icon-box-icon' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'icon_border',
                            'selector' => '{{WRAPPER}} .cleaninglight-icon-box-icon',
                            'default' => 'none',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'icon_hover',[
                        'label' => esc_html__( 'Hover', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'icon_hover_color', [
                            'label' => esc_html__('Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-icon-box-icon:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .cleaninglight-icon-box-icon:hover' => 'fill: {{VALUE}}',
                            ],
                        ]
                    );
        
                    $this->add_control(
                        'icon_hover_bg_color', [
                            'label' => esc_html__('Background Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-icon-box-icon:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'icon_hover_border',
                            'selector' => '{{WRAPPER}} .cleaninglight-icon-box-icon:hover',
                            'default' => 'none',
                        ]
                    );

                    $this->add_control(
                        'icon_hover_animation',[
                            'label' => esc_html__( 'Hover Animation', 'cleaning-light' ),
                            'type' => Controls_Manager::HOVER_ANIMATION,
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_responsive_control(
                'icon_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-icon-box-wrap' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0; z-index: 9;',
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
                        '{{WRAPPER}} .cleaninglight-box-title' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .cleaninglight-box-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'title_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-box-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'text_stroke',
                    'selector' => '{{WRAPPER}} .cleaninglight-box-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'title_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-box-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-box-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0; z-index: 9;',
                    ],
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
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-box-description' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'content_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-box-description',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'content_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-box-description',
                ]
            );

            $this->add_responsive_control(
                'content_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-box-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0; z-index: 9;',
                    ],
                ]
            );

        $this->end_controls_section();
        

        $this->start_controls_section(
            'content_button',[
                'label' => esc_html__( 'Button', 'cleaning-light' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button!' => '',
                ],
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
                        '{{WRAPPER}} .cleaninglight-button' => 'border-radius: {{SIZE}}{{UNIT}};',
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
                        'button_text_color',[
                            'label' => esc_html__( 'Text Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-button, {{WRAPPER}} .cleaninglight-button.cleaninglight-button-noborder .cleaninglight-link-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),[
                            'name' => 'button_background',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .cleaninglight-button',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'button_border_color',
                            'selector' => '{{WRAPPER}} .cleaninglight-button',
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
                        'button_hover_text_color',[
                            'label' => esc_html__( 'Text Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-button:hover, {{WRAPPER}} .cleaninglight-button.cleaninglight-button-noborder:hover .cleaninglight-link-icon svg' => 'color: {{VALUE}}; fill: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),[
                            'name' => 'button_hover_background',
                            'types' => [ 'classic', 'gradient' ],
                            'exclude' => [ 'image' ],
                            'selector' => '{{WRAPPER}} .cleaninglight-button.cleaninglight-button-noborder::before',
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),[
                            'name' => 'button_hover_border_color',
                            'selector' => '{{WRAPPER}} .cleaninglight-button:hover',
                            'default' => 'none',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /** Render Layout */
    protected function render() {   

            $settings = $this->get_settings_for_display();

            $wrapper_tag = 'div';
            $button_tag = 'a';
            $title_tag = Utils::validate_html_tag( $settings['title_tag'] );

            $this->add_render_attribute('wrapper', 'class', [
                    'cleaninglight-imageicon-box-wrapper',
                    $settings['graphic_element'],
                    $settings['layout'],
                ]
            );

            $this->add_render_attribute( 'graphic_image', 'class', ['cleaninglight-imageicon-box-img','cleaninglight-image-box-img'] );
            $this->add_render_attribute( 'image_wrap', 'class', ['cleaninglight-image-wrap','cleaninglight-bg'] );
            $this->add_render_attribute( 'graphic_icon', 'class', ['cleaninglight-icon-box-wrap', 'elementor-animation-' . $settings['icon_hover_animation']] );
            $this->add_render_attribute( 'title', 'class', ['cleaninglight-box-title'] );
            $this->add_render_attribute( 'description', 'class', ['cleaninglight-box-description'] );
            $this->add_render_attribute( 'button_wrap', 'class', ['cleaninglight-button-wrap'] );
            $this->add_render_attribute( 'button', 'class', ['cleaninglight-link'] );
            $this->add_render_attribute( 'onlybutton', 'class', ['cleaninglight-button','cleaninglight-button-noborder'] );

            if ( ! empty( $settings['link']['url'] ) ) {

                $link_element = 'button';
                $link_button = 'onlybutton';
    
                if ( 'box' === $settings['link_click'] ) {
                    $wrapper_tag = 'a';
                    $button_tag = 'div';
                    $link_element = 'wrapper';
                    $link_button = 'wrapper1';
                }
    
                $this->add_link_attributes( $link_element, $settings['link'] );
                $this->add_link_attributes( $link_button, $settings['link'] );
            }
        
        ?>

        <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <?php if( !empty( $settings['layout'] ) && $settings['layout'] == 'style2' ){ ?>
                <figure <?php $this->print_render_attribute_string( 'graphic_image' ); ?>>
                    <div <?php $this->print_render_attribute_string( 'image_wrap' ); ?>>
                        <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
                            <?php Group_Control_Image_Size::print_attachment_image_html( $settings, 'graphic_image' ); ?>
                        </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                    </div>
                </figure>
                <div class="cleaninglight-imageicon-box-content">
                    <div <?php $this->print_render_attribute_string( 'graphic_icon' ); ?>>
                        <div class="cleaninglight-icon-box-icon elementor-icon">
                            <?php Icons_Manager::render_icon($settings['graphic_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    </div>

                    <?php if ( ! empty( $settings['title'] ) ) : ?>
                        <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                            <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
                                <?php $this->print_unescaped_setting( 'title' ); ?>
                            </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                        </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['description'] ) ) : ?>
                        <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                            <?php $this->print_unescaped_setting( 'description' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['button'] ) ) : ?>
                        <div <?php $this->print_render_attribute_string( 'button_wrap' ); ?>>
                            <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'onlybutton' ); ?>>
                                <?php $this->print_unescaped_setting( 'button' ); ?>
                                <span class="cleaninglight-link-icon elementor-icon">
                                    <?php Icons_Manager::render_icon($settings['link_icon'], ['aria-hidden' => 'true']); ?>
                                </span>
                            </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                        </div>
                    <?php endif; ?>

                </div>
            <?php }else{ ?>
                <?php if ( ( 'image' === $settings['graphic_element'] || 'both' === $settings['graphic_element'] ) && ! empty( $settings['graphic_image']['url'] ) ) : ?>
                    <figure <?php $this->print_render_attribute_string( 'graphic_image' ); ?>>
                        <div <?php $this->print_render_attribute_string( 'image_wrap' ); ?>>
                            <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
                                <?php Group_Control_Image_Size::print_attachment_image_html( $settings, 'graphic_image' ); ?>
                            </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                        </div>
                    </figure>
                <?php elseif ( ( 'icon' === $settings['graphic_element'] || 'both' === $settings['graphic_element'] ) && ( ! empty( $settings['graphic_icon'] ) ) ) : ?>
                    <div <?php $this->print_render_attribute_string( 'graphic_icon' ); ?>>
                        <div class="cleaninglight-icon-box-icon elementor-icon">
                            <?php Icons_Manager::render_icon($settings['graphic_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="cleaninglight-imageicon-box-content">
                    <?php if ( 'both' === $settings['graphic_element'] && ( ! empty( $settings['graphic_icon'] ) ) ) : ?>
                        <div <?php $this->print_render_attribute_string( 'graphic_icon' ); ?>>
                            <div class="cleaninglight-icon-box-icon elementor-icon">
                                <?php Icons_Manager::render_icon($settings['graphic_icon'], ['aria-hidden' => 'true']); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['title'] ) ) : ?>
                        <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                            <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button' ); ?>>
                                <?php $this->print_unescaped_setting( 'title' ); ?>
                            </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                        </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['description'] ) ) : ?>
                        <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                            <?php $this->print_unescaped_setting( 'description' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $settings['button'] ) ) : ?>
                        <div <?php $this->print_render_attribute_string( 'button_wrap' ); ?>>
                            <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'onlybutton' ); ?>>
                                <?php $this->print_unescaped_setting( 'button' ); ?>
                                <span class="cleaninglight-link-icon elementor-icon">
                                    <?php Icons_Manager::render_icon($settings['link_icon'], ['aria-hidden' => 'true']); ?>
                                </span>
                            </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                        </div>
                    <?php endif; ?>

                </div>
            <?php } ?>
        
        </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
        
        <?php
    }

}
