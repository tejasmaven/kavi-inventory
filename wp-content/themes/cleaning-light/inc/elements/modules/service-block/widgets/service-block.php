<?php

namespace CleaningLightElements\Modules\ServiceBlock\Widgets;

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

class ServiceBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-service-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Service Block', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_keywords() {
		return [ 'service', 'image', 'photo', 'block' ];
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
            'services_content', [
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

            $this->add_control(
                'serviceicon', [
                    'label' => esc_html__('Service Icon', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'cleaning-light'),
                    'label_off' => esc_html__('Hide', 'cleaning-light'),
                    'return_value' => 'yes',
                    'condition' => [
                        'layout' => ['style1'],
                    ],
                ]
            );

            $this->add_control(
                'serviceicon2', [
                    'label' => esc_html__('Service Icon', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'cleaning-light'),
                    'label_off' => esc_html__('Hide', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'layout' => ['style2'],
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'box_width', [
                    'label' => esc_html__('Box Width', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['%', 'px', 'em'],
                    'range' => [
                        '%' => [
                            'min' => 10,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-service-area .cleaninglight-service-detail .cleaninglight-service-box' => 'width: {{SIZE}}{{UNIT}};'
                    ],
                    'condition' => [
                        'layout' => ['style1'],
                    ],
                ]
            );

            $this->add_control(
                'custom_height', [
                    'label' => esc_html__('Custom Image Height', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'cleaning-light'),
                    'label_off' => esc_html__('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'condition' => [
                        'layout' => ['style2'],
                    ],
                ]
            );

            $this->add_control(
                'image_height', [
                    'label' => esc_html__('Image Height', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 300,
                            'max' => 700,
                            'step' => 10
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 400,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-service-area.style2 .cleaninglight-top-content img, {{WRAPPER}} .cleaninglight-service-area.style2 .cleaninglight-bottom-content' => 'min-height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'custom_height' => 'yes',
                    ],
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'service_image',[
                    'label' => esc_html__( 'Choose Image', 'cleaning-light' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ]
                ]
            );

            $repeater->add_group_control(
                Group_Control_Image_Size::get_type(),[
                    'name' => 'service_image_size', // Actually its `image_size`
                    'default' => 'full',
                    'condition' => [
                        'service_image[id]!' => '',
                    ],
                ]
            );

            $repeater->add_control(
                'service_icon',[
                    'label' => esc_html__( 'Service Icon', 'cleaning-light' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fa-solid fa-bezier-curve',
                        'library' => 'fa-solid',
                    ],
                ]
            );

            $repeater->add_control(
                'service_title', [
                    'label' => esc_html__('Title', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Your Service Heading', 'cleaning-light')
                ]
            );

            $repeater->add_control(
                'service_description', [
                    'label' => esc_html__('Short Description', 'cleaning-light'),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'placeholder' => esc_html__('Type your description here', 'cleaning-light'),
                    'label_block' => true,
                    'default' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light')
                ]
            );

            $repeater->add_control(
                'service_button_text', [
                    'label' => esc_html__('Button Text', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Read More', 'cleaning-light')
                ]
            );

            $repeater->add_control(
                'service_button_link',[
                    'label' => esc_html__( 'Link', 'cleaning-light' ),
                    'type' => Controls_Manager::URL,
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
                ]
            );

            $repeater->add_control(
                'link_click',[
                    'label' => esc_html__( 'Apply Link On', 'cleaning-light' ),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        // 'box' => esc_html__( 'Whole Box', 'cleaning-light' ),
                        'button' => esc_html__( 'Button Only', 'cleaning-light' ),
                    ],
                    'default' => 'button',
                    'condition' => [
                        'service_button_link[url]!' => '',
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
                        'service_button_link[url]!' => '',
                        'service_button_text!' => '',
                    ],
                ]
            );

            $this->add_control(
                'service_blocks',[
                    'label' => esc_html__( 'Service Items', 'cleaning-light' ),
                    'type' => Controls_Manager::REPEATER,
                    'show_label' => true,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'service_image' => Utils::get_placeholder_image_src(),
                            'service_icon' => [
                                'value' => 'fas fa-trophy',
                                'library' => 'fa-solid',
                            ],
                            'service_title' => esc_html__( 'Your Service 1 Heading', 'cleaning-light' ),
                            'service_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light' ),
                            'service_button_text' => esc_html__( 'Read More', 'cleaning-light' ),
                            'service_button_link' => '#',
                            'link_icon' => [
                                'value' => 'fas fa-long-arrow-alt-right',
                                'library' => 'fa-solid',
                            ],
                            
                        ],
                        [
                            'service_image' => Utils::get_placeholder_image_src(),
                            'service_icon' => [
                                'value' => 'fas fa-university',
                                'library' => 'fa-solid',
                            ],
                            'service_title' => esc_html__( 'Your Service 2 Heading', 'cleaning-light' ),
                            'service_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light' ),
                            'service_button_text' => esc_html__( 'Read More', 'cleaning-light' ),
                            'service_button_link' => '#',
                            'link_icon' => [
                                'value' => 'fas fa-long-arrow-alt-right',
                                'library' => 'fa-solid',
                            ],
                            
                        ],
                        [
                            'service_image' => Utils::get_placeholder_image_src(),
                            'service_icon' => [
                                'value' => 'fab fa-alipay',
                                'library' => 'fa-solid',
                            ],
                            'service_title' => esc_html__( 'Your Service 3 Heading', 'cleaning-light' ),
                            'service_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light' ),
                            'service_button_text' => esc_html__( 'Read More', 'cleaning-light' ),
                            'service_button_link' => '#',
                            'link_icon' => [
                                'value' => 'fas fa-long-arrow-alt-right',
                                'library' => 'fa-solid',
                            ],
                            
                        ],
                        [
                            'service_image' => Utils::get_placeholder_image_src(),
                            'service_icon' => [
                                'value' => 'fab fa-chrome',
                                'library' => 'fa-solid',
                            ],
                            'service_title' => esc_html__( 'Your Service 4 Heading', 'cleaning-light' ),
                            'service_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light' ),
                            'service_button_text' => esc_html__( 'Read More', 'cleaning-light' ),
                            'service_button_link' => '#',
                            'link_icon' => [
                                'value' => 'fas fa-long-arrow-alt-right',
                                'library' => 'fa-solid',
                            ],
                            
                        ],
                        [
                            'service_image' => Utils::get_placeholder_image_src(),
                            'service_icon' => [
                                'value' => 'fab fa-creative-commons-share',
                                'library' => 'fa-solid',
                            ],
                            'service_title' => esc_html__( 'Your Service 5 Heading', 'cleaning-light' ),
                            'service_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light' ),
                            'service_button_text' => esc_html__( 'Read More', 'cleaning-light' ),
                            'service_button_link' => '#',
                            'link_icon' => [
                                'value' => 'fas fa-long-arrow-alt-right',
                                'library' => 'fa-solid',
                            ],
                            
                        ],
                        [
                            'service_image' => Utils::get_placeholder_image_src(),
                            'service_icon' => [
                                'value' => 'fab fa-ello',
                                'library' => 'fa-solid',
                            ],
                            'service_title' => esc_html__( 'Your Service 6 Heading', 'cleaning-light' ),
                            'service_description' => esc_html__( 'End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light' ),
                            'service_button_text' => esc_html__( 'Read More', 'cleaning-light' ),
                            'service_button_link' => '#',
                            'link_icon' => [
                                'value' => 'fas fa-long-arrow-alt-right',
                                'library' => 'fa-solid',
                            ],
                            
                        ]
                    ],
                    'title_field' => '{{{ service_title }}}',
                ]
            );
            
            $this->add_control(
                'service_bg_url',[
                    'label' => esc_html__( 'Choose Image', 'cleaning-light' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => ['layout' => ['style1']],
                ]
            );

            $this->add_group_control(
               Group_Control_Image_Size::get_type(),[
                    'name' => 'thumbnail',
                    'exclude' => [ 'custom' ],
                    'include' => [],
                    'default' => 'full',
                    'condition' => [
                        'service_bg_url[url]!' => '',
                    ],
                    'condition' => ['layout' => ['style1']],
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

        $this->end_controls_section();

        $this->start_controls_section(
            'general_styles', [
                'label' => esc_html__('Service Style', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'item_bg_color', [
                    'label' => esc_html__('Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-service-area .cleaninglight-service-item-block, 
                        {{WRAPPER}} .cleaninglight-service-area.style2 .cleaninglight-bottom-content'=> 'background-color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_control(
                'layout_position',[
                    'label' => esc_html__( 'Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'right',
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-left',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'cleaning-light' ),
                            'icon' => 'eicon-h-align-right',
                        ]
                    ],
                    'render_type' => 'template',
                    'prefix_class' => 'cleaninglight-imageicon-layout-',
                    'condition' => [
                        'layout' => ['style1'],
                    ],
                ]
            );

            $this->add_control(
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
                        '{{WRAPPER}} .cleaninglight-service-area .cleaninglight-service-item-block' => 'align-items: {{VALUE}};',
                    ],
                    'selectors_dictionary' => [
                        'top' => 'flex-start',
                        'middle' => 'center',
                        'bottom' => 'flex-end',
                    ],
                    'condition' => [
                        'layout_position' => ['left','right'],
                        'layout' => ['style1'],
                        'serviceicon' => 'yes',
                    ],
                ]
            );

            $this->add_responsive_control(
                'servive_space',[
                    'label' => esc_html__( 'Content Spacing', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'default' => [
                        'size' => 10,
                        'unit' => 'px',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
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
                        '{{WRAPPER}} .cleaninglight-service-area .cleaninglight-service-item-block .cleaninglight-service-wrap, 
                        {{WRAPPER}} .cleaninglight-service-area.style2 .cleaninglight-bottom-content,
                        {{WRAPPER}} .cleaninglight-service-area.style3 .cleaninglight-bottom-content,
                        {{WRAPPER}} .cleaninglight-service-area.style4 .cleaninglight-bottom-content' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'text_align',[
                    'label' => esc_html__( 'Alignment', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'default',
                    'options' => [
                        'default' => [
                            'title' => esc_html__( 'Default', 'cleaning-light' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
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
                    'render_type' => 'template',
                    'prefix_class' => 'cleaninglight-service-alignment-',
                    'condition' => [
                        'layout' => ['style1','style2'],
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-service-area .cleaninglight-service-item-block, 
                        {{WRAPPER}} .cleaninglight-service-area.style2 .cleaninglight-bottom-content'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'layout' => ['style1','style2'],
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_radius', [
                    'label' => esc_html__('Radius', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-service-area .cleaninglight-service-item-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'layout' => ['style1'],
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),[
                    'name' => 'item_box_shadow',
                    'condition' => [
                        'layout' => ['style1'],
                    ],
                    'selector' => '{{WRAPPER}} .cleaninglight-service-area .cleaninglight-service-item-block',
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'icon_style', [
                'label' => esc_html__('Icon', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                            'max' => 200,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-icon-boxicon.elementor-icon, 
                        {{WRAPPER}} .cleaninglight-service-area.style2 .cleaninglight-bottom-content .cleaninglight-icon-boxicon .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_control(
                'icon_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-service-area .cleaninglight-service-item-block .cleaninglight-icon-boxicon, 
                        {{WRAPPER}} .cleaninglight-service-area.style2 .cleaninglight-bottom-content .cleaninglight-icon-boxicon .elementor-icon' => 'color: {{VALUE}}; fill: {{VALUE}};'
                    ],
                ]
            );

            $this->add_control(
                'icon_bg_color', [
                    'label' => esc_html__('Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-service-area.style2 .cleaninglight-bottom-content .cleaninglight-icon-boxicon' => 'background-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'layout' => ['style2'],
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'count_style', [
                'label' => esc_html__('Number Count', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => ['style3'],
                ],
            ]
        );

            $this->add_control(
                'count_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-service-count' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'count_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-service-count',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'count_stroke',
                    'selector' => '{{WRAPPER}} .cleaninglight-service-count',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'count_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-service-count',
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
                        '{{WRAPPER}} .cleaninglight-item-title' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .cleaninglight-item-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'title_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-item-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'text_stroke',
                    'selector' => '{{WRAPPER}} .cleaninglight-item-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'title_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-item-title',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'description_style', [
                'label' => esc_html__('Description', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'description_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-item-description' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'description_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-item-description',
                ]
            );

        $this->end_controls_section();

        
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

        // Hover Effects Design
		$this->start_controls_section(
			'hover_effects',[
				'label' => esc_html__( 'Image Hover Effects', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => ['style1','style2'],
                ],
			]
		);

            $this->add_group_control(
                Group_Control_Border::get_type(), [
                    'name' => 'image_border',
                    'selector' => '{{WRAPPER}} .cleaninglight-top-content, {{WRAPPER}} .cleaninglight-feature-service-img',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
            	'transformation',[
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
            	]
            );

            $this->start_controls_tabs( 'bg_effects_tabs' );

                $this->start_controls_tab( 'bg_normal_effect',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_group_control(
						Group_Control_Background::get_type(),[
							'name' => 'overlay_background',
							'types' => [ 'classic', 'gradient' ],
							'exclude' => [ 'image' ],
							'selector' => '{{WRAPPER}} .cleaninglight-service-area.style2 .cleaninglight-service-image::after, {{WRAPPER}} .cleaninglight-feature-image::after',
							'fields_options' => [
								'background' => [
									'default' => 'classic',
								],
								'color' => [
									'default' => 'rgba(0,0,0,0.3)',
								],
							],
						]
					);

                    $this->add_group_control(
                        Group_Control_Css_Filter::get_type(),[
                            'name' => 'bg_filters',
                            'selector' => '{{WRAPPER}} .cleaninglight-service-image, {{WRAPPER}} .cleaninglight-feature-image',
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
                                '{{WRAPPER}} .cleaninglight-service-image, {{WRAPPER}} .cleaninglight-feature-image' => 'mix-blend-mode: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab( 'bg_normal_hover_effect',[
                        'label' => esc_html__( 'Hover', 'cleaning-light' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),[
                            'name' => 'overlay_background_hover',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .cleaninglight-top-content:hover .cleaninglight-service-image::after, {{WRAPPER}} .cleaninglight-top-content:focus .cleaninglight-service-image::after,
                                            {{WRAPPER}} .cleaninglight-feature-service-img:hover .cleaninglight-feature-image::after, {{WRAPPER}} .cleaninglight-feature-service-img:focus .cleaninglight-feature-image::after',
                            'exclude' => [ 'image' ],
                            'fields_options' => [
                                'background' => [
                                    'default' => 'classic',
                                ],
                                'color' => [
                                    'default' => 'rgba(0,0,0,0.2)',
                                ],
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Css_Filter::get_type(),[
                            'name' => 'bg_filters_hover',
                            'selector' => '{{WRAPPER}} .cleaninglight-top-content:hover .cleaninglight-service-image::after, {{WRAPPER}} .cleaninglight-feature-service-img:hover .cleaninglight-feature-image::after',
                        ]
                    );

                    $this->add_control(
                        'effect_duration',[
                            'label' => esc_html__( 'Transition Duration', 'cleaning-light' ) . ' (ms)',
                            'type' => Controls_Manager::SLIDER,
                            'render_type' => 'template',
                            'default' => [
                                'size' => 1200,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                    'step' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-service-image, {{WRAPPER}} .cleaninglight-feature-image' => 'transition-duration: {{SIZE}}ms',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

	    $this->end_controls_section();

    }

    /** Render Layout */
    protected function render() {

            $wrapper_tag = 'div';

            $settings = $this->get_settings_for_display();

            $title_tag = Utils::validate_html_tag( $settings['title_html_tag'] );

            $pages = $settings['service_blocks'];

            $layout = $settings['layout'];

            $serviceicon = $settings['serviceicon'];

            $serviceicon2 = $settings['serviceicon2'];
            
            $this->add_render_attribute('wrapper', 'class', [
                    'cleaninglight-service-area',
                    $layout,
                ]
            );

            $this->add_render_attribute( 'title', 'class', ['cleaninglight-item-title'] );
            $this->add_render_attribute( 'description', 'class', ['cleaninglight-item-description'] );
            $this->add_render_attribute( 'button_wrap', 'class', ['cleaninglight-button-wrap'] );
            $this->add_render_attribute( 'button', 'class', ['cleaninglight-item-link'] );
        ?>

        <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            
            <?php if( !empty( $layout ) && $layout == 'style1' ){ 

                if (!empty($pages)) {

                    $leftArray = $rightArray = array();

                    if( $pages && is_array($pages) && count($pages) > 1 ){

                        list($leftArray, $rightArray) = array_chunk($pages, ceil(count($pages) / 2));

                    }else{

                        $leftArray = $pages;
                    }
                ?>
                    <div class="cleaninglight-service-detail">
                        <div class="cleaninglight-leftdata cleaninglight-service-box">
                            <?php 
                                foreach($leftArray as $leftindex => $leftpage): 

                                    $this->add_render_attribute('wrapper_'.$leftindex, 'class', ['cleaninglight-service-item-block']);
                                    $this->add_render_attribute( 'leftbutton_'.$leftindex, 'class', ['cleaninglight-item-link'] );
                                    $this->add_render_attribute( 'leftonlybutton_'.$leftindex, 'class', ['cleaninglight-button','cleaninglight-button-noborder'] );

                                    $wrapper_tag = 'div';
                                    $button_tag = 'a';

                                    if ( ! empty( $leftpage['service_button_link']['url'] ) ) {

                                        $link_element = 'leftbutton_'.$leftindex;
                                        $link_button = 'leftonlybutton_'.$leftindex;
                                        
                                        if ( 'box' === $leftpage['link_click'] ) {
                                            $wrapper_tag = 'a';
                                            $button_tag = 'div';
                                            $link_element = 'wrapper_'.$leftindex;
                                            $link_button = 'wrapper1_'.$leftindex;
                                        }

                                        $this->add_link_attributes( $link_element, $leftpage['service_button_link'] );
                                        $this->add_link_attributes( $link_button, $leftpage['service_button_link'] );
                                    }
                            ?>
                                <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper_'.$leftindex ); ?>>
                                    <?php if( $serviceicon == 'yes' ){ ?>
                                        <div class="cleaninglight-icon-boxicon elementor-icon">
                                            <?php Icons_Manager::render_icon( $leftpage['service_icon'], ['aria-hidden' => 'true'] ); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="cleaninglight-service-wrap">
                                        <?php if ( ! empty( $leftpage['service_title'] ) ) : ?>
                                            <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'leftbutton_'.$leftindex ); ?>>
                                                    <?php echo esc_html( $leftpage['service_title'] ); ?>
                                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                                            </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $leftpage['service_description'] ) ) : ?>
                                            <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                                                <?php echo esc_html( $leftpage['service_description'] ); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $leftpage['service_button_text'] ) ) : ?>
                                            <div <?php $this->print_render_attribute_string( 'button_wrap' ); ?>>
                                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'leftonlybutton_'.$leftindex ); ?>>
                                                    <?php echo esc_html( $leftpage['service_button_text'] ); ?>
                                                    <span class="cleaninglight-link-icon elementor-icon">
                                                        <?php Icons_Manager::render_icon($leftpage['link_icon'], ['aria-hidden' => 'true']); ?>
                                                    </span>
                                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>                                   
                            <?php endforeach; ?>
                        </div>

                        <div class="cleaninglight-feature-service-img cleaninglight-bg-transform-<?php echo esc_attr( $settings['transformation'] ); ?>">
                            <div class="cleaninglight-feature-image cleaninglight-bg">
                                <?php Group_Control_Image_Size::print_attachment_image_html( $settings, 'service_bg_url' ); ?>
                            </div>
                        </div>

                        <div class="cleaninglight-rightdata cleaninglight-service-box">
                            <?php
                                foreach($rightArray as $rightindex => $rightpage):
                                    
                                    $this->add_render_attribute('wrapper_'.$rightindex, 'class', ['cleaninglight-service-item-block']);
                                    $this->add_render_attribute( 'rightbutton_'.$rightindex, 'class', ['cleaninglight-item-link'] );
                                    $this->add_render_attribute( 'rightonlybutton_'.$rightindex, 'class', ['cleaninglight-button','cleaninglight-button-noborder'] );
                                    
                                    $wrapper_tag = 'div';
                                    $button_tag = 'a';

                                    if ( ! empty( $rightpage['service_button_link']['url'] ) ) {

                                        $link_element = 'rightbutton_'.$rightindex;
                                        $link_button = 'rightonlybutton_'.$rightindex;
                                        
                                        if ( 'box' === $rightpage['link_click'] ) {
                                            $wrapper_tag = 'a';
                                            $button_tag = 'div';
                                            $link_element = 'wrapper_'.$rightindex;
                                            $link_button = 'wrapper1_'.$rightindex;
                                        }

                                        $this->add_link_attributes( $link_element, $rightpage['service_button_link'] );
                                        $this->add_link_attributes( $link_button, $rightpage['service_button_link'] );
                                    }
                            ?>
                                <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper_'.$rightindex ); ?>>
                                    <?php if( $serviceicon == 'yes' ){ ?>
                                        <div class="cleaninglight-icon-boxicon elementor-icon">
                                            <?php Icons_Manager::render_icon( $rightpage['service_icon'], ['aria-hidden' => 'true'] ); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="cleaninglight-service-wrap">
                                        <?php if ( ! empty( $rightpage['service_title'] ) ) : ?>
                                            <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'rightbutton_'.$rightindex ); ?>>
                                                    <?php echo esc_html( $rightpage['service_title'] ); ?>
                                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                                            </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $rightpage['service_description'] ) ) : ?>
                                            <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                                                <?php echo esc_html( $rightpage['service_description'] ); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ( ! empty( $rightpage['service_button_text'] ) ) : ?>
                                            <div <?php $this->print_render_attribute_string( 'button_wrap' ); ?>>
                                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'rightonlybutton_'.$rightindex ); ?>>
                                                    <?php echo esc_html( $rightpage['service_button_text'] ); ?>
                                                    <span class="cleaninglight-link-icon elementor-icon">
                                                        <?php Icons_Manager::render_icon($rightpage['link_icon'], ['aria-hidden' => 'true']); ?>
                                                    </span>
                                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
                            <?php endforeach; ?>
                        </div>
                    </div>

            <?php } }else if( !empty( $layout ) && $layout == 'style2' ){  ?>
                <div class="cleaninglight-service-item-wrap">  
                    <?php 
                        $button_tag = 'a';
                        
                        foreach($pages as $pageindex => $page):

                            $this->add_link_attributes( "link_{$pageindex}", $page['service_button_link'] );
                            $this->add_render_attribute( "link_{$pageindex}", 
                                'class', [
                                    'cleaninglight-item-link cleaninglight-bg-transform-'.$settings['transformation']
                                ] );
                            
                            $this->add_link_attributes( "linkonlybutton_{$pageindex}", $page['service_button_link'] );
                            $this->add_render_attribute( "linkonlybutton_{$pageindex}", 'class', ['cleaninglight-button','cleaninglight-button-noborder'] );
                    ?>
                        <div class="cleaninglight-service-block">
                            <?php if (!empty( $page['service_image'] )) { ?>
                                <div class="cleaninglight-top-content">
                                    <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "link_{$pageindex}" ); ?>>
                                        <div class="cleaninglight-service-image cleaninglight-bg">
                                            <?php Group_Control_Image_Size::print_attachment_image_html( $page, 'service_image' ); ?>
                                        </div>
                                    </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                                </div>
                            <?php } ?>
                            <div class="cleaninglight-bottom-content">

                                <?php if( $serviceicon2 == 'yes' ): ?>
                                    <div class="cleaninglight-icon-boxicon elementor-icon">
                                        <div class="elementor-icon">
                                            <?php Icons_Manager::render_icon( $page['service_icon'], ['aria-hidden' => 'true'] ); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ( ! empty( $page['service_title'] ) ) : ?>
                                    <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                                        <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "link_{$pageindex}" ); ?>>
                                            <?php echo esc_html( $page['service_title'] ); ?>
                                        </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                                    </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                                <?php endif; ?>
                                
                                <?php if ( ! empty( $page['service_description'] ) ) : ?>
                                    <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                                        <?php echo esc_html( $page['service_description'] ); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ( ! empty( $page['service_button_text'] ) ) : ?>
                                    <div <?php $this->print_render_attribute_string( 'button_wrap' ); ?>>
                                        <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "linkonlybutton_{$pageindex}" ); ?>>
                                            <?php echo esc_html( $page['service_button_text'] ); ?>
                                            <span class="cleaninglight-link-icon elementor-icon">
                                                <?php Icons_Manager::render_icon($page['link_icon'], ['aria-hidden' => 'true']); ?>
                                            </span>
                                        </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                                    </div>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } ?>
        </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>

        <?php
    }

}
