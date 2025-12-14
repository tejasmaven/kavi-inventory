<?php

namespace CleaningLightElements\Modules\TeamCarousel\Widgets;

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

class TeamCarousel extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-team-carousel';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Team Carousel', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-person';
    }

    public function get_keywords() {
		return [ 'team', 'slide', 'carousel', 'loop'];
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
            'team', [
                'label' => esc_html__('Member Details', 'cleaning-light'),
            ]
        );

            $this->add_control(
                'layout', [
                    'label' => esc_html__('Team Member Style', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'style3',
                    'label_block' => true,
                    'options' => [
                        'style1' => esc_html__('Style 1', 'cleaning-light'),
                        'style3' => esc_html__('Style 2', 'cleaning-light'),
                        'style7' => esc_html__('Style 3', 'cleaning-light'),
                    ],
                ]
            );

            
            $this->add_responsive_control(
                'custom_height', [
                    'label' => esc_html__('Custom Image Height', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'cleaning-light'),
                    'label_off' => esc_html__('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => ['layout' => ['style1','style3']],
                ]
            );

            $this->add_responsive_control(
                'image_height', [
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
                        '.cleaninglight-team-member-img img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                    ],
                    'conditions' => [
                        'relation' => 'and',
                        'terms' => [
                            [
                                'name' => 'custom_height',
                                'operator' => '==',
                                'value' => 'yes',
                            ],
                            [
                                'relation' => 'or',
                                'terms' => [
                                    [
                                        'name' => 'layout',
                                        'operator' => '==',
                                        'value' => 'style1',
                                    ],
                                    [
                                        'name' => 'layout',
                                        'operator' => '==',
                                        'value' => 'style3',
                                    ],
                                ],
                            ],
                        ],
                    ]
                ]
            );

            $repeater = new Repeater();

            $repeater->add_control(
                'member_image', [
                    'label' => esc_html__('Choose Photo', 'cleaning-light'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_control(
                'header_member_image', [
                    'label' => esc_html__('Header Image(Only Work Style 3)', 'cleaning-light'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ]
                ]
            );

            $repeater->add_control(
                'member_name', [
                    'label' => esc_html__('Name', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('John Doe', 'cleaning-light'),
                    'placeholder' => esc_html__('Enter the name here', 'cleaning-light'),
                ]
            );

            $repeater->add_control(
                'member_designation', [
                    'label' => esc_html__('Designations', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => esc_html__('Enter the designation here', 'cleaning-light'),
                    'default' => esc_html__('Support Engineer', 'cleaning-light')
                ]
            );

            $repeater->add_control(
                'member_description', [
                    'label' => esc_html__('Description', 'cleaning-light'),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 5,
                    'placeholder' => esc_html__('Type the description here', 'cleaning-light'),
                    'default' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light')
                ]
            );

            $repeater->add_control(
                'button_link', [
                    'label' => esc_html__('Button Link', 'cleaning-light'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('Enter URL', 'cleaning-light'),
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
                ]
            );

            $repeater->add_control(
                'fb_icon', [
                    'label' => esc_html__('Facebook Icon', 'cleaning-light'),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fab fa-facebook-f',
                        'library' => 'solid',
                    ],
                    'skin' => 'inline',
                ]
            );
            $repeater->add_control(
                'fb_link', [
                    'label' => esc_html__('Facebook Link', 'cleaning-light'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('Enter URL', 'cleaning-light'),
                    //'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'x_icon', [
                    'label' => esc_html__('X (Twitter) Icon', 'cleaning-light'),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fab fa-x-twitter',
                        'library' => 'solid',
                    ],
                    'skin' => 'inline',
                ]
            );
            $repeater->add_control(
                'x_link', [
                    'label' => esc_html__('X (Twitter) Link', 'cleaning-light'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('Enter URL', 'cleaning-light'),
                    //'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'in_icon', [
                    'label' => esc_html__('Instagram Icon', 'cleaning-light'),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fab fa-instagram',
                        'library' => 'solid',
                    ],
                    'skin' => 'inline',
                ]
            );
            $repeater->add_control(
                'in_link', [
                    'label' => esc_html__('Instagram Link', 'cleaning-light'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('Enter URL', 'cleaning-light'),
                    //'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $repeater->add_control(
                'lin_icon', [
                    'label' => esc_html__('Linkedin Icon', 'cleaning-light'),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fab fa-linkedin-in',
                        'library' => 'solid',
                    ],
                    'skin' => 'inline',
                ]
            );
            $repeater->add_control(
                'lin_link', [
                    'label' => esc_html__('Linkedin Link', 'cleaning-light'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('Enter URL', 'cleaning-light'),
                    //'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                ]
            );

            $this->add_control(
                'team_block_items', [
                    'label' => esc_html__('Team Member Item', 'cleaning-light'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'member_image' => Utils::get_placeholder_image_src(),
                            'member_name' => esc_html__('Roma De Suza', 'cleaning-light'),
                            'member_designation' => esc_html__('Developer', 'cleaning-light'),
                            'member_description' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light'),
                            'button_link' => '#',
                            'fb_icon' => [
                                'value' => 'fab fa-facebook-f',
                                'library' => 'solid',
                            ],
                            'fb_link' => '#',
                            'x_icon' => [
                                'value' => 'fab fa-x-twitter',
                                'library' => 'solid',
                            ],
                            'x_link' => '#',
                            'in_icon' => [
                                'value' => 'fab fa-instagram',
                                'library' => 'solid',
                            ],
                            'in_link' => '#',
                            'lin_icon' => [
                                'value' => 'fab fa-linkedin-in',
                                'library' => 'solid',
                            ],
                            'lin_link' => '#'
                        ],
                        [
                            'member_image' => Utils::get_placeholder_image_src(),
                            'member_name' => esc_html__('John Doe', 'cleaning-light'),
                            'member_designation' => esc_html__('Support Engineer', 'cleaning-light'),
                            'member_description' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light'),
                            'button_link' => '#',
                            'fb_icon' => [
                                'value' => 'fab fa-facebook-f',
                                'library' => 'solid',
                            ],
                            'fb_link' => '#',
                            'x_icon' => [
                                'value' => 'fab fa-x-twitter',
                                'library' => 'solid',
                            ],
                            'x_link' => '#',
                            'in_icon' => [
                                'value' => 'fab fa-instagram',
                                'library' => 'solid',
                            ],
                            'in_link' => '#',
                            'lin_icon' => [
                                'value' => 'fab fa-linkedin-in',
                                'library' => 'solid',
                            ],
                            'lin_link' => '#'
                        ],
                        [
                            'member_image' => Utils::get_placeholder_image_src(),
                            'member_name' => esc_html__('Umar Jaiswal', 'cleaning-light'),
                            'member_designation' => esc_html__('Web Designer', 'cleaning-light'),
                            'member_description' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light'),
                            'button_link' => '#',
                            'fb_icon' => [
                                'value' => 'fab fa-facebook-f',
                                'library' => 'solid',
                            ],
                            'fb_link' => '#',
                            'x_icon' => [
                                'value' => 'fab fa-x-twitter',
                                'library' => 'solid',
                            ],
                            'x_link' => '#',
                            'in_icon' => [
                                'value' => 'fab fa-instagram',
                                'library' => 'solid',
                            ],
                            'in_link' => '#',
                            'lin_icon' => [
                                'value' => 'fab fa-linkedin-in',
                                'library' => 'solid',
                            ],
                            'lin_link' => '#'
                        ],
                        [
                            'member_image' => Utils::get_placeholder_image_src(),
                            'member_name' => esc_html__('Manish Khanal', 'cleaning-light'),
                            'member_designation' => esc_html__('Web Developer', 'cleaning-light'),
                            'member_description' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light'),
                            'button_link' => '#',
                            'fb_icon' => [
                                'value' => 'fab fa-facebook-f',
                                'library' => 'solid',
                            ],
                            'fb_link' => '#',
                            'x_icon' => [
                                'value' => 'fab fa-x-twitter',
                                'library' => 'solid',
                            ],
                            'x_link' => '#',
                            'in_icon' => [
                                'value' => 'fab fa-instagram',
                                'library' => 'solid',
                            ],
                            'in_link' => '#',
                            'lin_icon' => [
                                'value' => 'fab fa-linkedin-in',
                                'library' => 'solid',
                            ],
                            'lin_link' => '#'
                        ],
                    ],
                    'title_field' => '{{{ member_name }}}',
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
                'slides_to_show', [
                    'label' => esc_html__('Slide Items', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 2,
                            'max' => 10,
                        ],
                    ],
                    'default' => [
                        'size' => 3,
                        'unit' => 'px',
                    ]
                ]
            );

            $this->add_responsive_control(
                'slides_margin', [
                    'label' => esc_html__('Spacing Slide Items', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'size' => 20,
                        'unit' => 'px',
                    ],
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
                    'label' => esc_html__('Arrows', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'cleaning-light'),
                    'label_off' => __('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'dots', [
                    'label' => esc_html__('Dots', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Yes', 'cleaning-light'),
                    'label_off' => __('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

        $this->end_controls_section();

        //(Style)
        $this->start_controls_section(
            'general_style', [
                'label' => esc_html__('General Styles', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'background_color', [
                    'label' => esc_html__('Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'layout' => ['style1','style7']
                    ],
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-member-wrapper.style1,
                        {{WRAPPER}} .cleaninglight-team-member-wrapper.style2,
                        {{WRAPPER}} .cleaninglight-team-member-wrapper.style7' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'overlay_color', [
                    'label' => esc_html__('Overlay BG Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'layout' => ['style3','style7']
                    ],
                    'default' => 'rgba(255,255,255,0.9)',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-member-wrapper.style3 .cleaninglight-team-top-content .cleaninglight-team-title, 
                        {{WRAPPER}} .cleaninglight-team-member-wrapper.style3 .cleaninglight-team-buttom-content,
                        {{WRAPPER}} .style7 .cleaninglight-team-buttom-content' => 'background-color: {{VALUE}}',
                    ],
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
                        '{{WRAPPER}} .cleaninglight-team-member-wrapper' => '{{VALUE}}',
                    ],
                    'condition' => [
                        'layout' => ['style1'],
                    ]
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
                        '{{WRAPPER}} .cleaninglight-team-buttom-content' => 'justify-content:{{VALUE}};',
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
                        '{{WRAPPER}} .cleaninglight-team-buttom-content' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
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
                        '{{WRAPPER}} .cleaninglight-team-buttom-content' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


            $this->add_responsive_control(
                'item_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-member-wrapper.style1 .cleaninglight-team-buttom-content,
                        {{WRAPPER}} .cleaninglight-team-member-wrapper.style3 .cleaninglight-team-buttom-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'layout' => ['style1','style3']
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_radius', [
                    'label' => esc_html__('Radius', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-member-wrapper,
                        {{WRAPPER}} .cleaninglight-team-member-wrapper.style7' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),[
                    'name' => 'item_box_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-team-member-wrapper.style1',
                    'condition' => [
                        'layout' => ['style1']
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
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-title, {{WRAPPER}} .cleaninglight-team-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'name_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-team-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'text_stroke',
                    'selector' => '{{WRAPPER}} .cleaninglight-team-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'title_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-team-title',
                ]
            );

            $this->add_responsive_control(
                'name_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
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
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-designation' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'designation_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-team-designation',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'designation_stroke',
                    'selector' => '{{WRAPPER}} .cleaninglight-team-designation',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'designation_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-team-designation',
                ]
            );

            $this->add_responsive_control(
                'designation_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-designation' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style', [
                'label' => esc_html__('Short Detail', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'content_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-description' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'content_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-team-description',
                ]
            );

            $this->add_responsive_control(
                'content_margin', [
                    'label' => esc_html__('Margin', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'allowed_dimensions' => 'vertical',
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-description' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'social_style', [
                'label' => esc_html__('Social Icons', 'cleaning-light'),
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
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-socialicon-wrap .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .cleaninglight-team-socialicon-wrap a' =>  'width: calc({{SIZE}}{{UNIT}} + 20px); height: calc({{SIZE}}{{UNIT}} + 20px);',
                    ],
                ]
            );

            $this->add_control(
                'social_bg_color', [
                    'label' => esc_html__('Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-socialicon-wrap a' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'social_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-team-socialicon-wrap .elementor-icon' => 'color: {{VALUE}}; fill: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(), [
                    'name' => 'social_border',
                    'selector' => '{{WRAPPER}} .cleaninglight-team-socialicon-wrap a',
                    'separator' => 'before',
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
            		//'prefix_class' => 'cleaninglight-bg-transform cleaninglight-bg-transform-',
            	]
            );

            $this->start_controls_tabs( 'bg_effects_tabs' );

                $this->start_controls_tab( 'normal',[
                        'label' => esc_html__( 'Normal', 'cleaning-light' ),
                    ]
                );

                    $this->add_control(
                        'bg_overlay_color',[
                            'label' => esc_html__( 'Overlay Color', 'cleaning-light' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .cleaninglight-team-member-img::after' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Css_Filter::get_type(),[
                            'name' => 'bg_filters',
                            'selector' => '{{WRAPPER}} .cleaninglight-team-member-img',
                        ]
                    );

                    $this->add_control(
                        'overlay_blend_mode',[
                            'label' => esc_html__( 'Blend Mode', 'cleaning-light' ),
                            'type' => Controls_Manager::SELECT,
                            'label_block' => true,
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
                                '{{WRAPPER}} .cleaninglight-team-member-img' => 'mix-blend-mode: {{VALUE}}',
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
                                '{{WRAPPER}} .cleaninglight-team-top-content:hover .cleaninglight-team-member-img::after' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Css_Filter::get_type(),[
                            'name' => 'bg_filters_hover',
                            'selector' => '{{WRAPPER}} .cleaninglight-team-top-content:hover .cleaninglight-team-member-img',
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
                                '{{WRAPPER}} .cleaninglight-team-member-img' => 'transition-duration: {{SIZE}}ms',
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

        $settings = $this->get_settings_for_display();

        $layout = $settings['layout'];
        
        $wrapper_tag = 'div';
        $button_tag = 'a';
        $title_tag = Utils::validate_html_tag( $settings['title_html_tag'] );

        $this->add_render_attribute('wrapper', 'class', [
                'cleaninglight-team-member-wrapper',
                $layout,
                'cleaninglight-bg-transform-'.$settings['transformation']
            ]
        );
        $this->add_render_attribute( 'top_content', 'class', ['cleaninglight-team-top-content'] );
        $this->add_render_attribute( 'buttom_content', 'class', ['cleaninglight-team-buttom-content'] );
        $this->add_render_attribute( 'image_wrap', 'class', ['cleaninglight-team-member-img','cleaninglight-bg'] );
        $this->add_render_attribute( 'title', 'class', ['cleaninglight-team-title'] );
        $this->add_render_attribute( 'button_link', 'class', ['cleaninglight-team-link'] );
        $this->add_render_attribute( 'designation', 'class', ['cleaninglight-team-designation'] );
        $this->add_render_attribute( 'description', 'class', ['cleaninglight-team-description'] );
        $this->add_render_attribute( "social_icon", 'class', ['elementor-icon'] );

        $params = array(
            'items' => (int) $settings['slides_to_show']['size'],
            'margin' => (int) $settings['slides_margin']['size'],
            'autoplay' => $settings['autoplay'] == 'yes' ? true : false,
            'pause_on_hover' => $settings['pause_on_hover'] == 'yes' ? true : false,
            'loop' => $settings['infinite'] == 'yes' ? true : false,
            'speed' => (int) $settings['speed'],
            'dots' => $settings['dots'] == 'yes' ? true : false,
            'nav' => $settings['nav'] == 'yes' ? true : false,
        );
        
        if($settings['autoplay'] == 'yes'){
            $params['pause'] = (int) $settings['autoplay_speed']['size'] * 1000;
        }

        $params = json_encode($params);

        
        ?>
        <div class="cleaninglight-team-carousel owl-carousel carouseldots" data-params='<?php echo $params; ?>'>
            <?php
                foreach( $settings['team_block_items'] as $teamindex => $teamitem ):

                    $this->add_link_attributes( "button_link_{$teamindex}", $teamitem['button_link'] );
                    $this->add_link_attributes( "social_link_fb_{$teamindex}", $teamitem['fb_link'] );
                    $this->add_link_attributes( "social_link_x_{$teamindex}", $teamitem['x_link'] );
                    $this->add_link_attributes( "social_link_in_{$teamindex}", $teamitem['in_link'] );
                    $this->add_link_attributes( "social_link_lin_{$teamindex}", $teamitem['lin_link'] );
            ?>
                <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
                    <figure <?php $this->print_render_attribute_string( 'top_content' ); ?>>
                        <?php if( (!empty( $layout ) && $layout == 'style7')): ?>
                            <div class="ikthemes-team-image-header">
                                <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'image_wrap' ); ?>>
                                    <?php Group_Control_Image_Size::print_attachment_image_html($teamitem, 'header_member_image'); ?>
                                </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
                            </div>
                        <?php endif; ?>
                    
                        <div class="ikthemes-team-image-wrap">
                            <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'image_wrap' ); ?>>
                                <?php Group_Control_Image_Size::print_attachment_image_html($teamitem, 'member_image'); ?>
                            </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
                        </div>

                        <?php if( !empty( $layout ) && $layout == 'style3' ): ?>
                            <?php if ( ! empty( $teamitem['member_name'] ) ) : ?>
                                <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                                    <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( 'button_link' ); ?>>
                                        <?php $this->print_unescaped_setting( 'member_name', 'team_block_items', $teamindex ); ?>
                                    </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                                </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                            <?php endif; ?>
                        <?php endif; ?>
                    </figure>
                    <div <?php $this->print_render_attribute_string( 'buttom_content' ); ?>>
                        <div class="cleaninglight-team-title-wrap">
                            <?php if ( ! empty( $teamitem['member_name'] ) ) : ?>
                                <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                                    <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "button_link_{$teamindex}" ); ?>>
                                        <?php $this->print_unescaped_setting( 'member_name', 'team_block_items', $teamindex ); ?>
                                    </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                                </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                            <?php endif; ?>
                            <?php if ( ! empty( $teamitem['member_designation'] ) ) : ?>
                                <div <?php $this->print_render_attribute_string( 'designation' ); ?>>
                                    <?php $this->print_unescaped_setting( 'member_designation', 'team_block_items', $teamindex ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if( (!empty( $layout ) && $layout != 'style7')): if ( ! empty( $teamitem['member_description'] ) ) : ?>
                                <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                                    <?php $this->print_unescaped_setting( 'member_description', 'team_block_items', $teamindex ); ?>
                                </div>
                            <?php endif; endif; ?>
                        </div>
                        <div class="cleaninglight-team-socialicon-wrap">
                            <?php if( !empty( $teamitem['fb_link']['url'] ) ): ?>
                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "social_link_fb_{$teamindex}" ); ?>>
                                    <div <?php $this->print_render_attribute_string( 'social_icon' ); ?>>
                                        <?php Icons_Manager::render_icon( $teamitem['fb_icon'], ['aria-hidden' => 'true'] ); ?>
                                    </div>
                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                            <?php endif; ?>
                            <?php if( !empty( $teamitem['x_link']['url'] ) ): ?>
                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "social_link_x_{$teamindex}" ); ?>>
                                    <div <?php $this->print_render_attribute_string( 'social_icon' ); ?>>
                                        <?php Icons_Manager::render_icon( $teamitem['x_icon'], ['aria-hidden' => 'true'] ); ?>
                                    </div>
                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                            <?php endif; ?>
                            <?php if( !empty( $teamitem['in_link']['url'] ) ): ?>
                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "social_link_in_{$teamindex}" ); ?>>
                                    <div <?php $this->print_render_attribute_string( 'social_icon' ); ?>>
                                        <?php Icons_Manager::render_icon( $teamitem['in_icon'], ['aria-hidden' => 'true'] ); ?>
                                    </div>
                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                            <?php endif; ?>
                            <?php if( !empty( $teamitem['lin_link']['url'] ) ): ?>
                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "social_link_lin_{$teamindex}" ); ?>>
                                    <div <?php $this->print_render_attribute_string( 'social_icon' ); ?>>
                                        <?php Icons_Manager::render_icon( $teamitem['lin_icon'], ['aria-hidden' => 'true'] ); ?>
                                    </div>
                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                            <?php endif; ?>
                        </div>
                    </div>
                </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
            <?php endforeach; ?>
        </div>

        <?php
    }
    

}