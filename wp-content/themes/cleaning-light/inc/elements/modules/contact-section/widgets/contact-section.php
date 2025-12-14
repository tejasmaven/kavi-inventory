<?php

namespace CleaningLightElements\Modules\ContactSection\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Core\Schemes\Color;
use Elementor\Repeater;
use Elementor\Modules\DynamicTags\Module as TagsModule;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class ContactSection extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-contact-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Contact Us With Map', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_keywords() {
		return [ 'contact', 'map', 'form' ];
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
            'section_contact_detail', [
                'label' => esc_html__('Contact Detail', 'cleaning-light'),
            ]
        );

            $repeater = new Repeater();
            $repeater->add_control(
                'contact_detail_icon', [
                    'label' => esc_html__('Contact Icon', 'cleaning-light'),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                ]
            );

            $repeater->add_control(
                'contact_detail_label', [
                    'label' => esc_html__('Contact Label', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => 'Contact Label'
                ]
            );

            $repeater->add_control(
                'contact_detail_desc', [
                    'label' => esc_html__('Contact Description', 'cleaning-light'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Contact Description' , 'cleaning-light' ),
                    'placeholder' => esc_html__('Type your contact description here', 'cleaning-light'),
                ]
            );

            $this->add_control(
                'contact_list', [
                    'label' => esc_html__('Contact Detail Items', 'cleaning-light'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'contact_detail_icon' => [
                                'value' => 'fas fa-map-signs',
                                'library' => 'solid',
                            ],
                            'contact_detail_label' => esc_html__( 'Office Location', 'cleaning-light' ),
                            'contact_detail_desc' => esc_html__( '5305 Creek CT Garland, TX 75043', 'cleaning-light' )
                        ],
                        [
                            'contact_detail_icon' => [
                                'value' => 'fas fa-phone-volume',
                                'library' => 'solid',
                            ],
                            'contact_detail_label' => esc_html__( 'Phone Number', 'cleaning-light' ),
                            'contact_detail_desc' => esc_html__( '+1 - (214) 838-0543 Or (214) 838-0543 ( Give us a free call 24/7 )', 'cleaning-light' ),
                        ],
                        [
                            'contact_detail_icon' => [
                                'value' => 'fas fa-envelope',
                                'library' => 'solid',
                            ],
                            'contact_detail_label' => esc_html__( 'Write Us Mail', 'cleaning-light' ),
                            'contact_detail_desc' => esc_html__( 'example@example.com Or support@example.com', 'cleaning-light' ),
                        ],
                    ],
                    'title_field' => '{{{ contact_detail_label }}}',
                ]
            );

            $this->add_control(
                'shortcode', [
                    'label' => esc_html__('Contact Form Shortcode', 'cleaning-light'),
                    'description' => sprintf(esc_html__('Install %s plugin to get the shortcode', 'cleaning-light'), '<a target="_blank" href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>'),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => '[contact-form-7 id="0c5d3c9" title="Contact form 1"]',
                    'label_block' => true,
                    'separator' => 'after'
                ]
            );

            $default_address = esc_html__('London Eye, London, United Kingdom', 'cleaning-light');

            $this->add_control(
                'address', [
                    'label' => esc_html__('Location', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'dynamic' => [
                        'active' => true,
                        'categories' => [
                            TagsModule::POST_META_CATEGORY,
                        ],
                    ],
                    'placeholder' => $default_address,
                    'default' => $default_address,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'zoom', [
                    'label' => esc_html__('Zoom', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 15,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 20,
                        ],
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'view', [
                    'label' => esc_html__('View', 'cleaning-light'),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'traditional',
                ]
            );

        $this->end_controls_section();
        

        $this->start_controls_section(
            'section_settings', [
                'label' => esc_html__('General Style', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'contact_form_position', [
                    'label' => esc_html__( 'Contact Row Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Start', 'cleaning-light' ),
                            'icon' => "eicon-h-align-left",
                        ],
                        'end' => [
                            'title' => esc_html__( 'End', 'cleaning-light' ),
                            'icon' => "eicon-h-align-right",
                        ],
                    ],
                    'selectors_dictionary' => [
                        'start' => 'flex-direction: row;',
                        'end' => 'flex-direction: row-reverse;',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-content' => '{{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'contact_form_column_position', [
                    'label' => esc_html__( 'Contact Column Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'before' => [
                            'title' => esc_html__( 'Before', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'after' => [
                            'title' => esc_html__( 'After', 'cleaning-light' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'selectors_dictionary' => [
                        'before' => 'display:flex; flex-direction: column;',
                        'after' => 'display:flex; flex-direction: column-reverse;',
                    ],
                    'prefix_class' => 'cleaninglight-contact-position-',
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-area' => '{{VALUE}}',
                    ]
                ]
            );

        $this->end_controls_section();
        

        $this->start_controls_section(
            'contact_detail_style', [
                'label' => esc_html__('Contact Detail', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'contact_detail_items' );

                $this->start_controls_tab(
                    'contact_detail_item', [
                        'label' => esc_html__('Items', 'cleaning-light'),
                    ]
                );

                    $this->add_control(
                        'contact_detail_item_bg', [
                            'label' => esc_html__('Background Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-touch' => 'background: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),[
                            'name' => 'contact_detail_item_box_shadow',
                            'selector' => '{{WRAPPER}} .ikthemes-touch',
                        ]
                    );

                    $this->add_responsive_control(
                        'contact_detail_item_padding', [
                            'label' => esc_html__('Padding', 'cleaning-light'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-touch' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();


                $this->start_controls_tab(
                    'contact_detail_item_icon', [
                        'label' => esc_html__('Icon', 'cleaning-light'),
                    ]
                );

                    $this->add_control(
                        'contact_detail_item_icon_color', [
                            'label' => esc_html__('Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-touch-icon' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .ikthemes-touch-icon svg' => 'fill: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'contact_detail_item_icon_padding', [
                            'label' => esc_html__('Padding', 'cleaning-light'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-contact-area .ikthemes-touch-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'contact_detail_item_detail', [
                        'label' => esc_html__('Detail', 'cleaning-light'),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(), [
                            'name' => 'contact_detail_item_title_typography',
                            'label' => esc_html__('Title Typography', 'cleaning-light'),
                            'selector' => '{{WRAPPER}} .ikthemes-touch-title',
                        ]
                    );


                    $this->add_control(
                        'contact_detail_item_title_color', [
                            'label' => esc_html__('Title Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-touch-title' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'contact_detail_item_title_margin', [
                            'label' => esc_html__('Title Margin', 'cleaning-light'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'allowed_dimensions' => 'vertical',
                            'separator' => 'after',
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-touch-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(), [
                            'name' => 'contact_detail_item_content_typography',
                            'label' => esc_html__('Content Typography', 'cleaning-light'),
                            'selector' => '{{WRAPPER}} .ikthemes-touch-content',
                        ]
                    );

                    $this->add_control(
                        'contact_detail_item_content_color', [
                            'label' => esc_html__('Content Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-touch-content' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'contact_detail_item_content_margin', [
                            'label' => esc_html__('Content Margin', 'cleaning-light'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'allowed_dimensions' => 'vertical',
                            'size_units' => ['px', '%', 'em'],
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-touch-content' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'contact_form_style', [
                'label' => esc_html__('Contact Form', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

             $this->add_control(
                'contact_detail_bg', [
                    'label' => esc_html__('Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-detail' => 'background: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'contact_detail_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-detail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'contact_form_bg', [
                    'label' => esc_html__('Background Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#f9f9f9',
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-form' => 'background: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'contact_form_text_color', [
                    'label' => esc_html__('Text Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#112437',
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-form label, {{WRAPPER}} .ikthemes-contact-form h3, {{WRAPPER}} .ikthemes-contact-form h2, {{WRAPPER}} .ikthemes-contact-form h4' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'contact_form_input_text_color', [
                    'label' => esc_html__('Input Text Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#112437',
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-form input[type="text"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="email"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="url"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="password"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="search"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="number"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="tel"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="range"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="date"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="month"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="week"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="time"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="datetime"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="datetime-local"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="color"],
                        {{WRAPPER}} .ikthemes-contact-form textarea' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'contact_form_input_border_color', [
                    'label' => esc_html__('Input Border Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#eeeeee',
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-form input[type="text"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="email"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="url"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="password"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="search"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="number"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="tel"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="range"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="date"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="month"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="week"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="time"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="datetime"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="datetime-local"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="color"],
                        {{WRAPPER}} .ikthemes-contact-form textarea' => 'border-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'contact_form_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .ikthemes-contact-form label, 
                        {{WRAPPER}} .ikthemes-contact-form input[type="text"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="email"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="url"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="password"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="search"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="number"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="tel"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="range"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="date"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="month"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="week"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="time"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="datetime"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="datetime-local"],
                        {{WRAPPER}} .ikthemes-contact-form input[type="color"],
                        {{WRAPPER}} .ikthemes-contact-form textarea',
                ]
            );

            $this->add_control(
            	'button_link_heading',[
            		'type' => Controls_Manager::HEADING,
            		'label' => esc_html__( 'Submit Button', 'cleaning-light' ),
                    'separator' => 'before',
            	]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'button_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .ikthemes-contact-form input[type="submit"], {{WRAPPER}} .ikthemes-contact-form input[type="button"]',
                ]
            );

            $this->add_responsive_control(
                'button_padding', [
                    'label' => esc_html__('Padding', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-form input[type="submit"], {{WRAPPER}} .ikthemes-contact-form input[type="button"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_radius', [
                    'label' => esc_html__('Radius', 'cleaning-light'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-contact-form input[type="submit"], {{WRAPPER}} .ikthemes-contact-form input[type="button"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),[
                    'name' => 'counter_border',
                    'selector' => '{{WRAPPER}} .ikthemes-contact-form input[type="submit"], {{WRAPPER}} .ikthemes-contact-form input[type="button"]',
                    'default' => 'none',
                ]
            );
        
            $this->start_controls_tabs( 'button_style_tabs' );

                $this->start_controls_tab(
                    'button_normal_tab', [
                        'label' => __('Normal', 'cleaning-light'),
                    ]
                );

                    $this->add_control(
                        'button_bg_color', [
                            'label' => esc_html__('Background Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-contact-form input[type="submit"], {{WRAPPER}} .ikthemes-contact-form input[type="button"]' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_color', [
                            'label' => esc_html__('Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-contact-form input[type="submit"], {{WRAPPER}} .ikthemes-contact-form input[type="button"]' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            
                $this->start_controls_tab(
                    'button_hover_tab', [
                        'label' => esc_html__('Hover', 'cleaning-light'),
                    ]
                );

                    $this->add_control(
                        'button_bg_hover_color', [
                            'label' => esc_html__('Background Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-contact-form input[type="submit"]:hover, {{WRAPPER}} .ikthemes-contact-form input[type="button"]:hover' => 'background: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_hover_color', [
                            'label' => esc_html__('Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-contact-form input[type="submit"]:hover, {{WRAPPER}} .ikthemes-contact-form input[type="button"]:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        

    }


    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display(); ?>

        <div class="ikthemes-contact-area">
            <div class="ikthemes-touch-contact">
                <?php $this->get_contact_information(); ?>
            </div>
            <div class="ikthemes-contact-content">
                <?php $this->get_iframe(); ?>
                <div class="ikthemes-contact-detail">
                    <div class="ikthemes-contact-form">
                        <?php echo do_shortcode($settings['shortcode']); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function get_iframe() {

        $settings = $this->get_settings_for_display();

        if (empty($settings['address'])) {
            return;
        }

        if (0 === absint($settings['zoom']['size'])) {
            $settings['zoom']['size'] = 10;
        }

        printf('<div class="ikthemes-maps-embed"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%1$s&amp;t=m&amp;z=%2$d&amp;output=embed&amp;iwloc=near" title="%3$s" aria-label="%3$s"></iframe></div>', rawurlencode($settings['address']), absint($settings['zoom']['size']), esc_attr($settings['address']));
    }

    protected function get_contact_information() {

        $settings = $this->get_settings_for_display();

        foreach ($settings['contact_list'] as $item) { ?>
            <div class="ikthemes-touch">
                <?php if( !empty( $item['contact_detail_icon'] ) ){ ?>
                    <div class="ikthemes-touch-icon">
                        <?php Icons_Manager::render_icon($item['contact_detail_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                <?php } ?>

                <div class="ikthemes-touch-info">
                    <?php if( $item['contact_detail_label']){ ?>
                        <h3 class="ikthemes-touch-title">
                            <?php echo $item['contact_detail_label']; ?>
                        </h3>
                    <?php } ?>

                    <?php if($item['contact_detail_desc']){ ?>
                        <p class="ikthemes-touch-content">
                            <?php echo $item['contact_detail_desc']; ?>
                        </p>
                    <?php } ?>
                </div>
            </div>

        <?php } 
    }

}
