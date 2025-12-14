<?php

namespace CleaningLightElements\Modules\ProgressBar\Widgets;

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

class ProgressBar extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-progress-bar';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Progress Bar Block ', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-skill-bar';
    }

    public function get_keywords() {
		return [ 'progress', 'bar', 'design' ];
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
            'progressbar', [
                'label' => esc_html__('Progress Bars', 'cleaning-light'),
            ]
        );

            $repeater = new Repeater();

            $repeater->add_control(
                'progressbar_title', [
                    'label' => esc_html__('Title', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('Web Designer', 'cleaning-light'),
                ]
            );

            $repeater->add_control(
                'title_html_tag', [
                    'label' => esc_html__('Title HTML Tag', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'span',
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

            $repeater->add_control(
                'progressbar_percentage',[
                    'label' => esc_html__( 'Percentage', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => '90',
                        'unit' => '%',
                    ],
                ]
            );

            $repeater->add_control(
                'display_percentage',[
                    'label' => esc_html__( 'Display Percentage', 'cleaning-light' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', 'cleaning-light' ),
                    'label_off' => esc_html__( 'Hide', 'cleaning-light' ),
                    'return_value' => 'show',
                    'default' => 'show',
                ]
            );

            $repeater->add_control(
                'progress_item_color',[
                    'label' => esc_html__( 'Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .cleaninglight-progress-bar-length' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'progressbar_block', [
                    'label' => esc_html__('Progress Bars Items', 'cleaning-light'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'progressbar_title' => esc_html__('Web Designer', 'cleaning-light'),
                            'progressbar_percentage' => 80,
                            'display_percentage'    => 'show',
                            'progress_item_color' => '#000000'
                        ],
                        [
                            'progressbar_title' => esc_html__('WordPress', 'cleaning-light'),
                            'progressbar_percentage' => 90,
                            'display_percentage'    => 'show',
                            'progress_item_color' => '#07F4D2'
                        ],
                        [
                            'progressbar_title' => esc_html__('HTML Design', 'cleaning-light'),
                            'progressbar_percentage' => 55,
                            'display_percentage'    => 'show',
                            'progress_item_color' => '#4E9D06'
                        ],
                        [
                            'progressbar_title' => esc_html__('Planning', 'cleaning-light'),
                            'progressbar_percentage' => 97,
                            'display_percentage'    => 'show',
                            'progress_item_color' => '#8224e3'
                        ],
                    ],
                    'title_field' => '{{{ progressbar_title }}}',
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'progressbar_settings', [
                'label' => esc_html__('Settings', 'cleaning-light'),
            ]
        );

            $this->add_responsive_control(
                'progressbar_spacing', [
                    'label' => esc_html__('Space Progress Bar Item', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        'rem' => [
                            'min' => 0,
                            'max' => 10,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'rem',
                        'size' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-progress-bar-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'progressbar_spacing_content', [
                    'label' => esc_html__('Space Content', 'cleaning-light'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => '5',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-progress-item' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


        $this->end_controls_section();

        $this->start_controls_section(
			'section_progress_style',[
				'label' => esc_html__( 'Progress Bar', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'progress_color',[
                    'label' => esc_html__( 'Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-progress-bar-length' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'progress_bg_color',[
                    'label' => esc_html__( 'Background Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-progress-bar' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'progress_height',[
                    'label' => esc_html__( 'Height', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-progress-bar' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'progress_border_radius',[
                    'label' => esc_html__( 'Border Radius', 'cleaning-light' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-progress-bar' => 'border-radius: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'inner_text_heading',[
                    'label' => esc_html__( 'Percentage Text', 'cleaning-light' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'progress_inline_color',[
                    'label' => esc_html__( 'Color', 'cleaning-light' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-progress-bar-length span' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),[
                    'name' => 'progress_inner_typography',
                    'selector' => '{{WRAPPER}} .cleaninglight-progress-bar-length span',
                    'exclude' => [
                        'line_height',
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
                'progress_title_color', [
                    'label' => esc_html__('Color', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .cleaninglight-progress-title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(), [
                    'name' => 'progress_title_typography',
                    'label' => esc_html__('Typography', 'cleaning-light'),
                    'selector' => '{{WRAPPER}} .cleaninglight-progress-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Stroke::get_type(),[
                    'name' => 'progress_title_stroke',
                    'selector' => '{{WRAPPER}} .cleaninglight-progress-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),[
                    'name' => 'progress_title_shadow',
                    'selector' => '{{WRAPPER}} .cleaninglight-progress-title',
                ]
            );

        $this->end_controls_section();

    }

    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $progressbars = $settings['progressbar_block'];

        $wrapper_tag = 'div';

        

        $this->add_render_attribute('wrapper', 'class', [
                'cleaninglight-progress-bar-wrapper',
            ]
        );
        $this->add_render_attribute( 'title', 'class', ['cleaninglight-progress-title'] );

        ?>
        <<?php Utils::print_validated_html_tag( $wrapper_tag ); ?> <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <?php 
                foreach ($progressbars as $key => $progressbar) { 
                    
                    $title_tag = Utils::validate_html_tag( $progressbar['title_html_tag'] );
            ?>
                <div class="cleaninglight-progress-item elementor-repeater-item-<?php echo esc_attr( $progressbar['_id'] ); ?>">
                    <?php if ( ! empty( $progressbar['progressbar_title'] ) ) : ?>
                        <<?php Utils::print_validated_html_tag( $title_tag ); ?> <?php $this->print_render_attribute_string( 'title' ); ?>>
                            <?php echo esc_html( $progressbar['progressbar_title'] ); ?>
                        </<?php Utils::print_validated_html_tag( $title_tag ); ?>>
                    <?php endif; ?>

                    <div class="cleaninglight-progress-bar" data-width="<?php echo absint( $progressbar['progressbar_percentage']['size'] ); ?>">
                        <div class="cleaninglight-progress-bar-length">
                            <?php if( !empty( $progressbar['display_percentage'] && $progressbar['display_percentage'] == 'show' ) ){ ?>
                                <span><?php echo absint( $progressbar['progressbar_percentage']['size'] ) . "%"; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </<?php Utils::print_validated_html_tag( $wrapper_tag ); ?>>
        <?php
    }

}