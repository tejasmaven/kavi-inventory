<?php

namespace CleaningLightElements\Modules\HighlightBlock\Widgets;

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

class HighlightBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-highlight-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Highlight Service Block', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-featured-image';
    }

    public function get_keywords() {
		return [ 'Highlight', 'Service', 'block' ];
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

            $this->add_control(
                'layout', [
                    'label' => esc_html__('Layout', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default' => 'style1',
                    'options' => [
                        'style1' => esc_html__('Style 1', 'cleaning-light'),
                        'style3' => esc_html__('Style 3', 'cleaning-light'),
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
                ]
            );

            $this->add_responsive_control(
                'image_height', [
                    'label' => esc_html__('Image Height', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px'],
                    'range' => [
                        'px' => [
                            'min' => 200,
                            'max' => 650,
                            'step' => 10
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 375,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-highlight-item img' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'custom_height' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'icon', [
                    'label' => esc_html__('Icon', 'cleaning-light'),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fab fa-artstation',
                        'library' => 'solid',
                    ],
                ]
            );

            $this->add_control(
                'image',[
                    'label' => esc_html__( 'Choose Image', 'cleaning-light' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),[
                    'name' => 'graphic_image', // Actually its `image_size`
                    'default' => 'full',
                    'exclude' => ['custom'],
                    'condition' => [
                        'image[id]!' => '',
                    ],
                ]
            );

            $this->add_control(
                'title', [
                    'label' => esc_html__('Title', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => esc_html__('Enter your title here', 'cleaning-light'),
                    'default' => esc_html__('Highlight Service Title', 'cleaning-light')
                ]
            );

            $this->add_control(
                'content', [
                    'label' => esc_html__('Content', 'cleaning-light'),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'placeholder' => esc_html__('Type your description here', 'cleaning-light'),
                    'default' => esc_html__('End your search here! Unlock Our Premium Themes to launch your website. All themes are user-friendly and fully customizable.', 'cleaning-light'),
                ]
            );

            $this->add_control(
                'link_text', [
                    'label' => esc_html__('Button Text', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => esc_html__('Enter the button text here', 'cleaning-light'),
                    'default' => esc_html__('Read More', 'cleaning-light')
                ]
            );

            $this->add_control(
                'link', [
                    'label' => esc_html__('Button Link', 'cleaning-light'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('Enter URL', 'cleaning-light'),
                    'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
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
                        'link[url]!' => '',
                        'link_text!' => '',
                    ],
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

        //(style)
        $this->start_controls_section(
            'general_styles', [
                'label' => esc_html__('General', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'front_view_bg_color', [
                    'label' => esc_html__('Overlay Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'condition' => ['layout' => ['style1', 'style3']],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-highlight-area.style1 .cleaninglight-highlight-item .cleaninglight-top-content-wrap, {{WRAPPER}} .cleaninglight-highlight-area.style3 .cleaninglight-highlight-item::after' => 'background-color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_control(
                'back_view_bg_color', [
                    'label' => esc_html__('Back View Overlay Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'condition' => ['layout' => ['style1', 'style3']],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-highlight-area.style1 .cleaninglight-highlight-item .cleaninglight-bottom-content-wrap, {{WRAPPER}} .cleaninglight-highlight-area.style3 .cleaninglight-highlight-item .cleaninglight-top-content-wrap, {{WRAPPER}} .cleaninglight-highlight-area.style3 .cleaninglight-highlight-item .cleaninglight-bottom-content-wrap' => 'background-color: {{VALUE}}',
                    ]
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
                        '{{WRAPPER}} .cleaninglight-top-content-wrap, {{WRAPPER}} .cleaninglight-bottom-content-wrap' => 'text-align: {{VALUE}}; align-items: {{VALUE}};'
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_space',[
                    'label' => esc_html__( 'Content Spacing', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 16,
                        'unit' => 'px',
                    ],
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
                        '{{WRAPPER}} .cleaninglight-top-content-wrap' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'icon_styles', [
                'label' => esc_html__('Icon', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'icon_bg_color', [
                    'label' => esc_html__('Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'condition' => ['layout' => ['style1']],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-icon-box' => 'background-color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_control(
                'icon_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-icon-box i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-icon-box svg' => 'fill: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_size',[
                    'label' => esc_html__( 'Icon Size', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 150,
                            'step' => 1,
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
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-icon-box' => 'font-size:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}};'
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_padding',[
                    'label' => esc_html__( 'Padding', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'condition' => ['layout' => ['style1']],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_radius',[
                    'label' => esc_html__( 'Radius', 'cleaning-light' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ '%', 'px', 'em', 'rem', 'vw', 'custom' ],
                    'condition' => ['layout' => ['style1']],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} / {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_styles', [
                'label' => esc_html__('Title', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'title_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-highlight-title' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-highlight-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'title_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-highlight-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'text_stroke',
                    'selector' => '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-highlight-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'title_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-highlight-title',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'excerpt_styles', [
                'label' => esc_html__('Content', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'excerpt_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-highlight-excerpt' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'excerpt_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-highlight-area .cleaninglight-highlight-excerpt',
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
                            'default' => '#ffffff',
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
                            'default' => '#ffffff',
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

        $wrapper_tag = 'div';
        $button_tag = 'a';
        $this->add_link_attributes( "link", $settings['link'] );
        $this->add_link_attributes( "button", $settings['link'] );

        $image_id = $settings['image']['id'];
        $custom_height_class = $settings['custom_height'] == 'yes' ? 'cleaninglight-custom-height' : '';

        $this->add_render_attribute('wrapper', 'class', [
                'cleaninglight-highlight-area',
                $layout,
                $custom_height_class
            ]
        );
        $this->add_render_attribute( 'title', 'class', ['cleaninglight-highlight-title'] );
        $this->add_render_attribute( 'description', 'class', ['cleaninglight-highlight-excerpt'] );
        $this->add_render_attribute( 'button_wrap', 'class', ['cleaninglight-button-wrap'] );
        $this->add_render_attribute( 'button', 'class', ['cleaninglight-button','cleaninglight-button-noborder'] );
        ?>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <div class="cleaninglight-highlight-item">
                <?php
                    $image_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'graphic_image', $settings);
                    if (!$image_url) {
                        $image_url = Utils::get_placeholder_image_src();
                    }
                ?>
                <div class="highlight-image">
                    <?php Group_Control_Image_Size::print_attachment_image_html( $settings, 'image' ); ?>
                </div>
                <div class="bottom-content">
                    <?php if( !empty( $layout ) && $layout != 'style4' ){ ?>
                        <div class="cleaninglight-top-content-wrap">
                            <?php if (!empty( $settings['icon']['value'] ) ) : ?>
                                <div class="cleaninglight-icon-box elementor-icon">
                                    <?php Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                            <?php endif; ?>
                            
                            <<?php echo $settings['title_html_tag']; ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "link" ); ?>>
                                    <?php echo esc_html($settings['title']); ?>
                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                            </<?php echo $settings['title_html_tag']; ?>>

                            <?php if( !empty( $layout ) && $layout != 'style3' ){ ?>
                                <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                                    <?php echo wp_kses_post( $settings['content'] ); ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <div class="cleaninglight-bottom-content-wrap">
                        <<?php echo $settings['title_html_tag']; ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                            <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "link" ); ?>>
                                <?php echo esc_html($settings['title']); ?>
                            </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                        </<?php echo $settings['title_html_tag']; ?>>
                        
                        <?php if ( ! empty( $settings['content'] ) ){ ?>
                            <div <?php $this->print_render_attribute_string( 'description' ); ?>>
                                <?php echo wp_kses_post( $settings['content'] ); ?>
                            </div>
                        <?php } ?>

                        <?php if ( !empty( $settings['link_text'] ) ||  !empty($settings['link'] )) { ?>
                            <div <?php $this->print_render_attribute_string( 'button_wrap' ); ?>>
                                <<?php Utils::print_validated_html_tag( $button_tag ); ?> <?php $this->print_render_attribute_string( "button" ); ?>>
                                    <?php echo esc_html($settings['link_text']); ?>
                                    <?php if (!empty( $settings['link_icon']['value'] ) ) : ?>
                                        <span class="cleaninglight-link-icon elementor-icon">
                                            <?php Icons_Manager::render_icon($settings['link_icon'], ['aria-hidden' => 'true']); ?>
                                        </span>
                                    <?php endif; ?>
                                </<?php Utils::print_unescaped_internal_string( $button_tag ); ?>>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}
