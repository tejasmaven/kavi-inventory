<?php

namespace CleaningLightElements\Modules\CounterBlock\Widgets;

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

class CounterBlock extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-counter-block';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Counter Block', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-counter';
    }

	public function get_keywords() {
		return [ 'counter', 'block', 'count' ];
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
			'section_counter',[
				'label' => esc_html__( 'Content', 'cleaning-light' ),
			]
		);

			$this->add_control(
				'layout', [
					'label' => esc_html__('Counter Layout', 'cleaning-light'),
					'type' => Controls_Manager::SELECT,
					'default' => 'style1',
					'label_block' => true,
					'options' => [
						'style1' => esc_html__('Style 1', 'cleaning-light'),
						'style2' => esc_html__('Style 2', 'cleaning-light'),
						'style3' => esc_html__('Style 3', 'cleaning-light'),
						'style4' => esc_html__('Style 4', 'cleaning-light'),
					],
				]
			);

			$this->add_control(
				'counter_icon', [
					'type' => Controls_Manager::ICONS,
					'separator' => 'after',
					'default' => [
						'value' => 'fas fa-street-view',
						'library' => 'solid',
					],
				]
			);

			$this->add_control(
				'starting_number',[
					'label' => esc_html__( 'Starting Number', 'cleaning-light' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 0,
				]
			);

			$this->add_control(
				'ending_number',[
					'label' => esc_html__( 'Ending Number', 'cleaning-light' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 4575,
				]
			);

			$this->add_control(
				'prefix', [
					'label' => esc_html__( 'Number Prefix', 'cleaning-light' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'ai' => [
						'active' => false,
					],
				]
			);

			$this->add_control(
				'suffix', [
					'label' => esc_html__( 'Number Suffix', 'cleaning-light' ),
					'type' => Controls_Manager::TEXT,
					'dynamic' => [
						'active' => true,
					],
					'ai' => [
						'active' => false,
					],
				]
			);

			$this->add_control(
				'duration', [
					'label' => esc_html__( 'Animation Duration', 'cleaning-light' ) . ' (ms)',
					'type' => Controls_Manager::NUMBER,
					'default' => 2000,
					'min' => 100,
					'step' => 100,
				]
			);

			$this->add_control(
				'thousand_separator_char', [
					'label' => esc_html__( 'Separator', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'' => 'Default',
						'.' => 'Dot',
						' ' => 'Space',
						'_' => 'Underline',
						"'" => 'Apostrophe',
					],
				]
			);

			$this->add_control(
				'title', [
					'label' => esc_html__( 'Title', 'cleaning-light' ),
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'separator' => 'before',
					'default' => esc_html__( 'Cool Themes', 'cleaning-light' ),
				]
			);

			$this->add_control(
				'title_html_tag', [
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
					'default' => 'h3',
					'condition' => [
						'title!' => '',
					],
				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_counter_style', [
				'label' => esc_html__( 'General Style', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'counter_bg_color', [
					'label' => esc_html__('Background Color', 'cleaning-light'),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-counter-wrapper' => 'background-color: {{VALUE}}',
					]
				]
			);

			$this->add_responsive_control(
                'counter_position',[
                    'label' => esc_html__( 'Position', 'cleaning-light' ),
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
						'above' => 'flex-direction: column;',
						'below' => 'flex-direction: column-reverse;',
						'left' => 'flex-direction: row;',
						'right' => 'flex-direction: row-reverse;',
					],
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-counter-wrapper' => '{{VALUE}}',
					],
					//'prefix_class' => 'cleaninglight-counter-layout-',
					'condition' => [
						'layout' => ['style1','style2','style3']
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
                        '{{WRAPPER}} .cleaninglight-counter-wrapper' => 'align-items:{{VALUE}};',
                    ],
                    'selectors_dictionary' => [
                        'top' => 'flex-start',
                        'middle' => 'center',
                        'bottom' => 'flex-end',
                    ],
                    'condition' => [
                    	'counter_position' => ['left','right'],
						'layout' => ['style1','style2']
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
						'{{WRAPPER}} .cleaninglight-counter-wrapper, {{WRAPPER}} .cleaninglight-counter-wrapper.style6' => 'justify-content:{{VALUE}};',
                        '{{WRAPPER}} .cleaninglight-content-wrap' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
                    ],
					'condition' => [
                    	'counter_position' => ['left','right'],
						'layout' => ['style1','style2']
                    ],
                ]
            );

			$this->add_responsive_control(
                'textalign',[
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
                        '{{WRAPPER}} .cleaninglight-counter-wrapper' => 'align-items: {{VALUE}}; text-align: {{VALUE}};',
                    ],
					'condition' => [
                    	'counter_position' => ['above','below'],
						'layout' => ['style1','style2']
                    ],
                ]
            );

			$this->add_responsive_control(
                'counter_position_six',[
                    'label' => esc_html__( 'Position', 'cleaning-light' ),
                    'type' => Controls_Manager::CHOOSE,
                    'default' => 'left',
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
					'selectors_dictionary' => [
						'left' => 'flex-direction: row;',
						'right' => 'flex-direction: row-reverse;',
					],
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-counter-wrapper.style4' => '{{VALUE}}',
					],
					'condition' => [
						'layout' => ['style4']
					],
                ]
            );

			$this->add_responsive_control(
                'textalignsix',[
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
                        '{{WRAPPER}} .cleaninglight-counter-wrapper.style4, {{WRAPPER}} .cleaninglight-counter-wrapper.style5' => 'justify-content: {{VALUE}};',
                    ],
					'condition' => [
						'layout' => ['style4']
                    ],
                ]
            );
	
			$this->add_responsive_control(
				'counter_gap', [
					'label' => esc_html__( 'Content Spacing', 'cleaning-light' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem', 'custom' ],
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-counter-wrapper, {{WRAPPER}} .cleaninglight-counter-wrapper.style6' => 'gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),[
					'name' => 'counter_box_shadow',
					'selector' => '{{WRAPPER}} .cleaninglight-counter-wrapper',
				]
			);

			$this->add_responsive_control(
				'counter_padding', [
					'label' => esc_html__('Padding', 'cleaning-light'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-counter-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'counter_radius', [
					'label' => esc_html__('Radius', 'cleaning-light'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-counter-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition' => [
						'layout' => ['style1','style4']
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),[
					'name' => 'counter_border',
					'selector' => '{{WRAPPER}} .cleaninglight-counter-wrapper',
					'default' => 'none',
					'condition' => [
						'layout' => ['style1','style4']
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),[
					'name' => 'counter_border3',
					'selector' => '{{WRAPPER}} .counter-shape',
					'default' => 'none',
					'condition' => [
						'layout' => ['style3']
					],
				]
			);

			$this->add_control(
                'border_width',[
                    'label' => esc_html__( 'Border Width', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        'px' => [
                            'max' => 20,
                        ],
                        'em' => [
                            'max' => 2,
                        ],
                        'rem' => [
                            'max' => 2,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-counter-wrapper.style2:before,
						{{WRAPPER}} .cleaninglight-counter-wrapper.style2:after,
						{{WRAPPER}} .cleaninglight-counter-wrapper.style2>span:before,
						{{WRAPPER}} .cleaninglight-counter-wrapper.style2>span:after' => 'border-width: {{SIZE}}{{UNIT}};',
                    ],
					'condition' => [
						'layout' => ['style2']
					],
                ]
            );

			$this->add_control(
				'border_color', [
					'label' => esc_html__('Border Color', 'cleaning-light'),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
                        '{{WRAPPER}} .cleaninglight-counter-wrapper.style2:before,
						{{WRAPPER}} .cleaninglight-counter-wrapper.style2:after,
						{{WRAPPER}} .cleaninglight-counter-wrapper.style2>span:before,
						{{WRAPPER}} .cleaninglight-counter-wrapper.style2>span:after' => 'border-color: {{VALUE}};',
                    ],
					'condition' => [
						'layout' => ['style2']
					],
				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_counter_icon_style', [
				'label' => esc_html__( 'Icon', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
			$this->add_responsive_control(
				'icon_size', [
					'label' => esc_html__( 'Icon Size', 'cleaning-light' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem', 'custom' ],
					'range' => [
						'px' => [
							'min' => 20,
							'max' => 200,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-icon-wrap .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					]
				]
			);
		
			$this->add_control(
				'icon_bg_color', [
					'label' => esc_html__('Background Color', 'cleaning-light'),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-icon-wrap' => 'background-color: {{VALUE}}',
					]
				]
			);
			
			$this->add_control(
				'icon_color', [
					'label' => esc_html__('Color', 'cleaning-light'),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-icon-wrap .elementor-icon' => 'color: {{VALUE}}; fill: {{VALUE}}',
					]
				]
			);
			
			$this->add_responsive_control(
				'icon_padding', [
					'label' => esc_html__('Padding', 'cleaning-light'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
			$this->add_responsive_control(
				'icon_radius', [
					'label' => esc_html__('Radius', 'cleaning-light'),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
			$this->add_group_control(
				\Elementor\Group_Control_Box_Shadow::get_type(),[
					'name' => 'icon_box_shadow',
					'selector' => '{{WRAPPER}} .cleaninglight-icon-wrap',
				]
			);
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_number', [
				'label' => esc_html__( 'Number', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'number_color', [
					'label' => esc_html__( 'Color', 'cleaning-light' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-content-wrap' => 'color: {{VALUE}};'
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(), [
					'name' => 'typography_number',
					'label' => esc_html__('Typography', 'cleaning-light'),
					'selector' => '{{WRAPPER}} .cleaninglight-content-wrap',
				]
			);

			$this->add_responsive_control(
				'number_margin', [
					'label' => esc_html__('Margin', 'cleaning-light'),
					'type' => Controls_Manager::DIMENSIONS,
					'allowed_dimensions' => 'vertical',
					'size_units' => ['px', '%', 'em'],
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-counter-number-wrap' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Text_Stroke::get_type(), [
					'name' => 'number_stroke',
					'selector' => '{{WRAPPER}} .cleaninglight-counter-number-wrap',
				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_title', [
				'label' => esc_html__( 'Title', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'title_color', [
					'label' => esc_html__( 'Color', 'cleaning-light' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .cleaninglight-counter-title' => 'color: {{VALUE}};',
					]
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(), [
					'name' => 'typography_title',
					'label' => esc_html__('Typography', 'cleaning-light'),
					'selector' => '{{WRAPPER}} .cleaninglight-counter-title',
				]
			);

			$this->add_group_control(
				Group_Control_Text_Stroke::get_type(), [
					'name' => 'title_stroke',
					'selector' => '{{WRAPPER}} .cleaninglight-counter-title',
				]
			);
	
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(), [
					'name' => 'title_shadow',
					'selector' => '{{WRAPPER}} .cleaninglight-counter-title',
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
				'cleaninglight-counter-wrapper',
				$settings['layout'],
			]
		);

		$this->add_render_attribute( 'icon', 'class', ['cleaninglight-icon-wrap'] );
		$this->add_render_attribute( 'title', 'class', ['cleaninglight-counter-title'] );
		$this->add_render_attribute(
			'counter',[
				'class' => 'ikthemes-counter-number',
				'data-durations' => $settings['duration'],
				'data-tovalue' => $settings['ending_number'],
				'data-fromvalue' => $settings['starting_number'],
				'data-delimiters' => empty( $settings['thousand_separator_char'] ) ? ',' : $settings['thousand_separator_char'],
			]
		);

		?>
		<<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php if( !empty( $settings['layout'] ) && $settings['layout'] == 'style4' ){ ?>
				<div class="cleaninglight-content-wrap">
					<?php if ( ! empty( $settings['counter_icon'] ) && ! empty( $settings['counter_icon']['value'] ) ) : ?>
						<div <?php $this->print_render_attribute_string( 'icon' ); ?>>
							<div class="elementor-icon">
								<?php Icons_Manager::render_icon( $settings['counter_icon'], ['aria-hidden' => 'true'] ); ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( isset( $settings['ending_number'] ) ) : ?>
						<div class="cleaninglight-counter-number-wrap">
							<?php if( !empty( $settings['prefix'] ) ){ ?>
								<span class="cleaninglight-counter-number-prefix">
									<?php echo esc_html( $settings['prefix'] ); ?>
								</span>
							<?php } ?>
							<span <?php $this->print_render_attribute_string( 'counter' ); ?>>
								<?php echo esc_html( $settings['ending_number'] ); ?>
							</span>
							<?php if( !empty( $settings['suffix'] ) ){ ?>
								<span class="cleaninglight-counter-number-suffix">
									<?php echo esc_html( $settings['suffix'] ); ?>
								</span>
							<?php } ?>
						</div>
					<?php endif; ?>
				</div>
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
						<?php $this->print_unescaped_setting( 'title' ); ?>
					</<?php Utils::print_validated_html_tag( $title_tag ); ?>>
				<?php endif; ?>
			<?php }else{ ?>
				<?php if( !empty( $settings['layout'] ) && $settings['layout'] == 'style3' ){ ?>
					<div class="counter-shape"><span></span></div>
				<?php } ?>
				<?php if ( ! empty( $settings['counter_icon'] ) && ! empty( $settings['counter_icon']['value'] ) ) : ?>
					<div <?php $this->print_render_attribute_string( 'icon' ); ?>>
						<div class="elementor-icon">
							<?php Icons_Manager::render_icon( $settings['counter_icon'], ['aria-hidden' => 'true'] ); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="cleaninglight-content-wrap">
					<?php if ( isset( $settings['ending_number'] ) ) : ?>
						<div class="cleaninglight-counter-number-wrap">
							<?php if( !empty( $settings['prefix'] ) ){ ?>
								<span class="cleaninglight-counter-number-prefix">
									<?php echo esc_html( $settings['prefix'] ); ?>
								</span>
							<?php } ?>
							<span <?php $this->print_render_attribute_string( 'counter' ); ?>>
								<?php echo esc_html( $settings['ending_number'] ); ?>
							</span>
							<?php if( !empty( $settings['suffix'] ) ){ ?>
								<span class="cleaninglight-counter-number-suffix">
									<?php echo esc_html( $settings['suffix'] ); ?>
								</span>
							<?php } ?>
						</div>
					<?php endif; ?>
					<?php if ( ! empty( $settings['title'] ) ) : ?>
						<<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
							<?php $this->print_unescaped_setting( 'title' ); ?>
						</<?php Utils::print_validated_html_tag( $title_tag ); ?>>
					<?php endif; ?>
				</div>
				<?php if( !empty( $settings['layout'] ) && $settings['layout'] == 'style2' ){ ?><span></span><?php } ?>
			<?php } ?>
		</<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
		<?php
	}
}
