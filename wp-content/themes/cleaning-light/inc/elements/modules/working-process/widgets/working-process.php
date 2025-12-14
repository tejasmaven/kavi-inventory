<?php

namespace CleaningLightElements\Modules\WorkingProcess\Widgets;

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
use Elementor\Repeater;
use Elementor\Utils;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class WorkingProcess extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-working-process';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Working Process', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-flip';
    }

    public function get_keywords() {
		return [ 'working', 'process', 'step', 'how it works', 'working step' ];
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
            'working_content', [
                'label' => esc_html__('Content', 'cleaning-light'),
            ]
        );

            $this->add_control(
                'layout', [
                    'label' => esc_html__('Layout', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'style1',
                    'label_block' => true,
                    'options' => [
                        'style1' => esc_html__('Style 1', 'cleaning-light'),
                        'style2' => esc_html__('Style 2', 'cleaning-light'),
                    ],
                ]
            );

            $this->add_responsive_control(
                'working_item_count', [
                    'label' => esc_html__('Number of Column', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'step' => 1,
                            'max' => 6,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 3,
                    ],
                    'tablet_default' => [
                        'unit' => 'px',
                        'size' => 2,
                    ],
                    'mobile_default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area.style2' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                    ],
                    'condition' => ['layout' => ['style2']],
                ]
                
            );

            $this->add_responsive_control(
                'working_item_count3', [
                    'label' => esc_html__('Number of Column', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 2,
                            'step' => 1,
                            'max' => 4,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 3,
                    ],
                    'tablet_default' => [
                        'unit' => 'px',
                        'size' => 2,
                    ],
                    'mobile_default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area.style3' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                    ],
                    'condition' => ['layout' => ['style3']],
                ]
                
            );

            $this->add_responsive_control(
                'working_item_gap', [
                    'label' => esc_html__('Block Gap', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['rem','px','%'],
                    'range' => [
                        'rem' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1
                        ],
                    ],
                    'default' => [
                        'unit' => 'rem',
                        'size' => 2,
                    ],
                    'tablet_default' => [
                        'unit' => 'rem',
                        'size' => 2,
                    ],
                    'mobile_default' => [
                        'unit' => 'rem',
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area.style2, {{WRAPPER}} .working-area.style3' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => ['layout' => ['style2','style3']],
                ]
            );

            $this->add_responsive_control(
                'working_alignment', [
                    'label' => esc_html__( 'Alignment', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Start', 'cleaning-light' ),
                            'icon' => "eicon-h-align-left",
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'End', 'cleaning-light' ),
                            'icon' => "eicon-h-align-right",
                        ],
                    ],
                    'prefix_class' => 'general-align-',
                    'selectors' => [
                        '{{WRAPPER}} .working_text, {{WRAPPER}} .working_step_item2 .working_text, {{WRAPPER}} .working_step_item3 .working_text, {{WRAPPER}} .working_step_item4 .working_text' => 'text-align: {{VALUE}};',
                    ]
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'choose_element',[
                    'label' => esc_html__( 'Choose Element', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'none' => [
                            'title' => esc_html__( 'None', 'cleaning-light' ),
                            'icon' => 'eicon-ban',
                        ],
                        'process_image' => [
                            'title' => esc_html__( 'Image', 'cleaning-light' ),
                            'icon' => 'eicon-image-bold',
                        ],
                        'process_icon' => [
                            'title' => esc_html__( 'Icon', 'cleaning-light' ),
                            'icon' => 'eicon-star',
                        ],
                    ],
                    'default' => 'process_image',
                ]
            );

            $repeater->add_control(
                'process_image',[
                    'label' => esc_html__( 'Choose Image', 'cleaning-light' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'choose_element' => 'process_image',
                    ],
                ]
            );

            $repeater->add_control(
                'process_icon',[
                    'label' => esc_html__( 'Icon', 'cleaning-light' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'choose_element' => 'process_icon',
                    ],
                ]
            );

            $repeater->add_control(
                'process_title', [
                    'label' => esc_html__('Title', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Working Process Item', 'cleaning-light'),
                ]
            );

            $repeater->add_control(
                'process_description', [
                    'label' => esc_html__('Description', 'cleaning-light'),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light'),
                    'placeholder' => esc_html__('Type your description here', 'cleaning-light'),
                ]
            );

            $repeater->add_control(
                'process_button_text', [
                    'label' => esc_html__('Button Text', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => 'Read More'
                ]
            );

            $repeater->add_control(
                'process_button_link', [
                    'label' => esc_html__('Button Link', 'cleaning-light'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('Enter URL', 'cleaning-light'),
                    'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
                    'condition' => [
                        'process_button_text!' => '',
                    ],
                ]
            );

            $repeater->add_control(
                'link_icon',[
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
                        'process_button_link[url]!' => '',
                        'process_button_text!' => '',
                    ],
                ]
            );

            $this->add_control(
                'process_blocks',[
                    'label' => esc_html__( 'Working Step Item', 'cleaning-light' ),
                    'type' => Controls_Manager::REPEATER,
                    'show_label' => true,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'process_image' => Utils::get_placeholder_image_src(),
                            'process_title' => esc_html__( 'Working Process Item 1', 'cleaning-light' ),
                            'process_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light' ),
                            'process_button_text' => esc_html__( 'Read More', 'cleaning-light' ),
                            'process_button_link' => '#',
                            'link_icon' => [
                                'value' => 'fas fa-long-arrow-alt-right',
                                'library' => 'fa-solid',
                            ],
                            
                        ],
                        [
                            'process_image' => Utils::get_placeholder_image_src(),
                            'process_title' => esc_html__( 'Working Process Item 2', 'cleaning-light' ),
                            'process_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light' ),
                            'process_button_text' => esc_html__( 'Read More', 'cleaning-light' ),
                            'process_button_link' => '#',
                            'link_icon' => [
                                'value' => 'fas fa-long-arrow-alt-right',
                                'library' => 'fa-solid',
                            ],
                            
                        ],
                        [
                            'process_image' => Utils::get_placeholder_image_src(),
                            'process_title' => esc_html__( 'Working Process Item 3', 'cleaning-light' ),
                            'process_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light' ),
                            'process_button_text' => esc_html__( 'Read More', 'cleaning-light' ),
                            'process_button_link' => '#',
                            'link_icon' => [
                                'value' => 'fas fa-long-arrow-alt-right',
                                'library' => 'fa-solid',
                            ],
                            
                        ],
                    ],
                    'title_field' => '{{{ process_title }}}',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'settings_section', [
                'label' => esc_html__('Settings', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'title_html_tag', [
                    'label' => esc_html__('Title HTML Tag', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
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

        $this->end_controls_section();


        $this->start_controls_section(
            'general_styles', [
                'label' => esc_html__('General', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'general_bg_color', [
                    'label' => esc_html__('Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item .working_text, {{WRAPPER}} .working_step_item2 .working_text, {{WRAPPER}} .working_step_item3, {{WRAPPER}} .working_step_item4 .working_text' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .working_step_item .working_text:before' => 'border-left-color: {{VALUE}}',
                        '{{WRAPPER}} .working_shape' => 'background: linear-gradient(45deg, {{VALUE}}, {{VALUE}})',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),[
                    'name' => 'general_box_shadow',
                    'selector' => '{{WRAPPER}} .working_step_item .working_text, {{WRAPPER}} .working_step_item2 .working_text, {{WRAPPER}} .working_step_item3, {{WRAPPER}} .working_step_item4 .working_text',
                ]
            );

             $this->add_responsive_control(
                'general_spacing', [
                    'label' => esc_html__( 'Spacing', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
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
                    'condition' => ['layout!' => ['style2']],
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item, {{WRAPPER}} .working_step_item2 .working_text, {{WRAPPER}} .working_step_item3, {{WRAPPER}} .working_step_item4 .working_text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'general_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item .working_text, {{WRAPPER}} .working_step_item2 .working_text, {{WRAPPER}} .working_step_item3, {{WRAPPER}} .working_step_item4 .working_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'general_radius', [
                    'label' => esc_html__('Radius', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => ['{{WRAPPER}} .working_step_item .working_text, {{WRAPPER}} .working_step_item2 .working_text, {{WRAPPER}} .working_step_item3, {{WRAPPER}} .working_step_item4 .working_text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


        // Number Style
        $this->start_controls_section(
            'number_styles', [
                'label' => esc_html__('Number', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'number_line_color', [
                    'label' => esc_html__('Line Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'condition' => ['layout' => ['style1']],
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item::before, {{WRAPPER}} .working_step_item:first-child::after' => 'background-color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'number_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .working_step_item .working_number span, {{WRAPPER}} .working_step_item2 .working_number span, {{WRAPPER}} .working_step_item3 .working_number, {{WRAPPER}} .working_step_item4 .working_number',
                ]
            );

            $this->add_control(
                'number_bg_color', [
                    'label' => esc_html__('Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    //'condition' => ['layout' => ['style1', 'style2']],
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item .working_number, {{WRAPPER}} .working_step_item2 .working_number span, {{WRAPPER}} .working_step_item3 .working_number span, {{WRAPPER}} .working_step_item4 .working_number' => 'background-color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_control(
                'number_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item .working_number span, {{WRAPPER}} .working_step_item2 .working_number span, {{WRAPPER}} .working_step_item3 .working_number, {{WRAPPER}} .working_step_item4 .working_number' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'number_border',
                    'selector' => '{{WRAPPER}} .working_step_item .working_number, {{WRAPPER}} .working_step_item .working_number span, {{WRAPPER}} .working_step_item2 .working_number span, {{WRAPPER}} .working_step_item3 .working_number span, {{WRAPPER}} .working_step_item4 .working_number',
                    'default' => 'none',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),[
                    'name' => 'number_box_shadow',
                    'selector' => '{{WRAPPER}} .working_step_item .working_number, {{WRAPPER}} .working_step_item .working_number span, {{WRAPPER}} .working_step_item3 .working_number span, {{WRAPPER}} .working_step_item2 .working_number span, {{WRAPPER}} .working_step_item4 .working_number',
                ]
            );

            $this->add_responsive_control(
                'number_width',[
                    'label' => esc_html__( 'Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 20,
                            'max' => 150,
                            'step' => 5,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item .working_number span, {{WRAPPER}} .working_step_item2 .working_number span, {{WRAPPER}} .working_step_item3 .working_number span, {{WRAPPER}} .working_step_item4 .working_number' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'number_height',[
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 20,
                            'max' => 150,
                            'step' => 5,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item .working_number span, {{WRAPPER}} .working_step_item2 .working_number span, {{WRAPPER}} .working_step_item3 .working_number span, {{WRAPPER}} .working_step_item4 .working_number' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'number_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'condition' => ['layout' => ['style1']],
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item .working_number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'number_radius', [
                    'label' => esc_html__('Radius', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => ['{{WRAPPER}} .working_step_item .working_number, {{WRAPPER}} .working_step_item .working_number span, {{WRAPPER}} .working_step_item2 .working_number span, {{WRAPPER}} .working_step_item3 .working_number span, {{WRAPPER}} .working_step_item4 .working_number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


        // Icon Style
        $this->start_controls_section(
			'section_style_icon',[
				'label' => esc_html__( 'Icon', 'cleaning-light' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'icon_color',[
                    'label' => esc_html__( 'Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working-icon' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .working-area .working-icon svg' => 'fill: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_bg_color',[
                    'label' => esc_html__( 'Background Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working-wrap' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_size',[
                    'label' => esc_html__( 'Size', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 6,
                            'max' => 500,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .working-area .working-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .working-area .working-icon::after' => 'height: calc(({{SIZE}}{{UNIT}} + 65px)); width: calc(({{SIZE}}{{UNIT}} + 65px));',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'icon_border',
                    'selector' => '{{WRAPPER}} .working-area .working-wrap',
                    'default' => 'none',
                ]
            );

            $this->add_responsive_control(
                'icon_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'out_icon_border',
                    'selector' => '{{WRAPPER}} .working-area .working-icon::after',
                    'default' => 'none',
                ]
            );

            $this->add_responsive_control(
                'icon_radius',[
                    'label' => esc_html__( 'Border Radius', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working-icon, {{WRAPPER}} .working-area .working-icon::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),[
                    'name' => 'icon_box_shadow',
                    'selector' => '{{WRAPPER}} .working-area .working-icon',
                ]
            );

            $this->add_responsive_control(
                'icon_rotate',[
                    'label' => esc_html__( 'Rotate', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
                    'default' => [
                        'unit' => 'deg',
                    ],
                    'tablet_default' => [
                        'unit' => 'deg',
                    ],
                    'mobile_default' => [
                        'unit' => 'deg',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working-icon, {{WRAPPER}} .working-area .working-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
                    ],
                ]
            );

        $this->end_controls_section();

        // Image Style
        $this->start_controls_section(
			'section_style_image',[
				'label' => esc_html__( 'Image', 'cleaning-light' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                // 'condition' => [
				// 	'process_image[url]!' => '',
				// ],
			]
		);
            $this->add_responsive_control(
                'image_align',[
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
                    'prefix_class' => 'image-align-',
                    'selectors' => [
                        '{{WRAPPER}} .working_step_item .working_img' => 'text-align: {{VALUE}};',
                    ],
                    'condition' => ['layout' => ['style1']],
                ]
            );

            $this->add_responsive_control(
                'image_width',[
                    'label' => esc_html__( 'Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                    ],
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 1000,
                        ],
                        'vw' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working_img img' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .working-area .working_img::after' => 'width: calc(({{SIZE}}{{UNIT}} + 25px));',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_space',[
                    'label' => esc_html__( 'Max Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                    ],
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        '%' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                        'px' => [
                            'min' => 1,
                            'max' => 1000,
                        ],
                        'vw' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working_img img' => 'max-width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_height',[
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 500,
                        ],
                        'vh' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working_img img' => 'height: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .working-area .working_img::after' => 'height: calc(({{SIZE}}{{UNIT}} + 25px));',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_object-fit',[
                    'label' => esc_html__( 'Object Fit', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
                    'condition' => [
                        'height[size]!' => '',
                    ],
                    'options' => [
                        '' => esc_html__( 'Default', 'cleaning-light' ),
                        'fill' => esc_html__( 'Fill', 'cleaning-light' ),
                        'cover' => esc_html__( 'Cover', 'cleaning-light' ),
                        'contain' => esc_html__( 'Contain', 'cleaning-light' ),
                        'scale-down' => esc_html__( 'Scale Down', 'cleaning-light' ),
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working_img img' => 'object-fit: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'image_object-position',[
                    'label' => esc_html__( 'Object Position', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'center center' => esc_html__( 'Center Center', 'cleaning-light' ),
                        'center left' => esc_html__( 'Center Left', 'cleaning-light' ),
                        'center right' => esc_html__( 'Center Right', 'cleaning-light' ),
                        'top center' => esc_html__( 'Top Center', 'cleaning-light' ),
                        'top left' => esc_html__( 'Top Left', 'cleaning-light' ),
                        'top right' => esc_html__( 'Top Right', 'cleaning-light' ),
                        'bottom center' => esc_html__( 'Bottom Center', 'cleaning-light' ),
                        'bottom left' => esc_html__( 'Bottom Left', 'cleaning-light' ),
                        'bottom right' => esc_html__( 'Bottom Right', 'cleaning-light' ),
                    ],
                    'default' => 'center center',
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working_img img' => 'object-position: {{VALUE}};',
                    ],
                    'condition' => [
                        'height[size]!' => '',
                        'object-fit' => [ 'cover', 'contain', 'scale-down' ],
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'image_border',
                    'selector' => '{{WRAPPER}} .working-area .working_img img',
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'image_border_radius',[
                    'label' => esc_html__( 'Border Radius', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working_img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),[
                    'name' => 'image_box_shadow',
                    'exclude' => [
                        'box_shadow_position',
                    ],
                    'selector' => '{{WRAPPER}} .working-area .working_img img',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'image_out_border',
                    'selector' => '{{WRAPPER}} .working-area .working_img::after',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'separator_panel_style',[
                    'type' => Controls_Manager::DIVIDER,
                    'style' => 'thick',
                ]
            );

            $this->start_controls_tabs( 'image_effects' );

                $this->start_controls_tab( 'normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
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
                            '{{WRAPPER}} .working-area .working_img img' => 'opacity: {{SIZE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Css_Filter::get_type(), [
                        'name' => 'image_css_filters',
                        'selector' => '{{WRAPPER}} .working-area .working_img img',
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab( 'hover',[
                        'label' => esc_html__( 'Hover', 'cleaning-light' ),
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
                            '{{WRAPPER}} .working-area .working_img img:hover' => 'opacity: {{SIZE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Css_Filter::get_type(),[
                        'name' => 'image_css_filters_hover',
                        'selector' => '{{WRAPPER}} .working-area .working_img img:hover',
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();

		$this->end_controls_section();
        
        // Title Style
        $this->start_controls_section(
            'title_style', [
                'label' => esc_html__('Title', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'title_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'title_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .working-area .working-title',
                ]
            );

            $this->start_controls_tabs( 'title_color_wrap' );

                $this->start_controls_tab( 'title_normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'title_color', [
                            'label' => esc_html__('Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .working-area .working-title, {{WRAPPER}} .working-area .working-title a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab( 'title_hover',[
                        'label' => esc_html__( 'Hover', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'title_link_color', [
                            'label' => esc_html__('Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .working-area .working-title a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


        // Description Style
        $this->start_controls_section(
            'description_style', [
                'label' => esc_html__('Description', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'description_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working-desc' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'description_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .working-area .working-desc',
                ]
            );
            
            $this->add_control(
                'description_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .working-area .working-desc' => 'color: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();


        // Read More Style
        $this->start_controls_section(
			'content_button',[
				'label' => esc_html__( 'Button (Read More)', 'cleaning-light' ),
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

            $this->add_control(
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
                    'primary_normal',[
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
                    'primary_hover',[
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

        $layout = $settings['layout'];

        $process_class = array(
            'working-area',
            $layout,
        );
        $pages = $settings['process_blocks'];

        ?>
        <div class="<?php echo esc_attr(implode(' ', array_filter( $process_class ) ) ); ?>">

            <?php 
            
                if( !empty( $layout ) && $layout == 'style1' ){ 
                
                    $this->cleaninglight_workingProcess( $pages );

                }else if( !empty( $layout ) && $layout == 'style2' ){ 
                
                    $this->cleaninglight_workingProcess_Style2( $pages );

                }else{

                    $this->cleaninglight_workingProcess( $pages );
                }
            ?>

        </div>

        <?php
    }


    protected function cleaninglight_workingProcess( $steps ) {

        $settings = $this->get_settings_for_display();

            foreach($steps as $index => $step): 

            $target = $step['process_button_link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $step['process_button_link']['nofollow'] ? ' rel="nofollow"' : '';

        ?>
        <div class="working_step_item">
            <div class="working_text">
                <<?php echo $settings['title_html_tag']; ?> class="working-title">
                    <?php if (!empty( $step['process_button_link']['url'] )) { ?><a href="<?php echo esc_url( $step['process_button_link']['url'] ); ?>" <?php echo $target . $nofollow; ?>><?php } ?>
                        <?php echo esc_html( $step['process_title'] ); ?>
                    <?php if (!empty( $step['process_button_link']['url'] )) { ?></a><?php } ?>
                </<?php echo $settings['title_html_tag']; ?>>
                
                <p class="working-desc">
                    <?php echo wp_kses_post( $step['process_description'] ); ?>
                </p>

                <?php if (!empty( $step['process_button_link']['url']) && !empty( $step['process_button_text'] ) ) { ?>
                    <a class="cleaninglight-button cleaninglight-button-noborder" href="<?php echo esc_url( $step['process_button_link']['url'] ); ?>" <?php echo $target . $nofollow; ?>>
                        <?php echo esc_html( $step['process_button_text'] ); ?>
                        <span class="cleaninglight-link-icon elementor-icon">
                            <?php Icons_Manager::render_icon($step['link_icon'], ['aria-hidden' => 'true']); ?>
                        </span>
                    </a>
                <?php } ?>
            </div>
            <div class="working_number">
                <span>
                    <?php 
                        $value = str_pad(++$index,2,"0",STR_PAD_LEFT);
                        echo esc_html($value);
                    ?>
                </span>
            </div>
            <?php if( $step['choose_element'] == 'process_image' ){ ?>
                <div class="working_img">
                    <a href="<?php echo esc_url( $step['process_button_link']['url'] ); ?>" <?php echo $target . $nofollow; ?>>
                        <?php Group_Control_Image_Size::print_attachment_image_html( $step, 'process_image' ); ?>
                    </a>
                </div>
            <?php } elseif ( $step['choose_element'] === 'process_icon' ) { ?>
                <div class="working-wrap">
                    <?php if ( !empty( $step['process_icon']['value'] ) ) { ?>
                        <div class="working-icon">
                            <?php Icons_Manager::render_icon( $step['process_icon'], ['aria-hidden' => 'true'] ); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php endforeach; 
    }   

    protected function cleaninglight_workingProcess_Style2( $steps ) {

        $settings = $this->get_settings_for_display();

        foreach($steps as $index => $step): 

            $target = $step['process_button_link']['is_external'] ? ' target="_blank"' : '';
            $nofollow = $step['process_button_link']['nofollow'] ? ' rel="nofollow"' : '';

        ?>
        <div class="working_step_item2">
            <div class="working_text">
                <?php if( $step['choose_element'] == 'process_image' ){ ?>
                    <div class="working_img">
                        <a href="<?php echo esc_url( $step['process_button_link']['url'] ); ?>" <?php echo $target . $nofollow; ?>>
                            <?php Group_Control_Image_Size::print_attachment_image_html( $step, 'process_image' ); ?>
                        </a>
                    </div>
                <?php }else if ( $step['choose_element'] === 'process_icon' && !empty( $step['process_icon']['value'] ) ){ ?>
                    <div class="working-icon">
                        <?php Icons_Manager::render_icon( $step['process_icon'], ['aria-hidden' => 'true'] ); ?>
                    </div>
                <?php } ?>

                <<?php echo $settings['title_html_tag']; ?> class="working-title">
                    <?php if (!empty( $step['process_button_link']['url'] )) { ?><a href="<?php echo esc_url( $step['process_button_link']['url'] ); ?>" <?php echo $target . $nofollow; ?>><?php } ?>
                        <?php echo esc_html( $step['process_title'] ); ?>
                    <?php if (!empty( $step['process_button_link']['url'] )) { ?></a><?php } ?>
                </<?php echo $settings['title_html_tag']; ?>>
                
                <p class="working-desc">
                    <?php echo wp_kses_post( $step['process_description'] ); ?>
                </p>

                <?php if (!empty( $step['process_button_link']['url'] ) && !empty( $step['process_button_text'] ) ) { ?>
                    <a class="cleaninglight-button cleaninglight-button-noborder" href="<?php echo esc_url( $step['process_button_link']['url'] ); ?>" <?php echo $target . $nofollow; ?>>
                        <?php echo esc_html( $step['process_button_text'] ); ?>
                        <span class="cleaninglight-link-icon elementor-icon"><?php Icons_Manager::render_icon($step['link_icon'], ['aria-hidden' => 'true']); ?></span>
                    </a>
                <?php } ?>
                    
            </div>
            <div class="working_shape"></div>
            <div class="working_number">
                <span>
                    <?php 
                        $value = str_pad(++$index,2,"0",STR_PAD_LEFT);
                        echo esc_html($value);
                    ?>
                </span>
            </div>
        </div>
        <?php endforeach; 
    }

}


