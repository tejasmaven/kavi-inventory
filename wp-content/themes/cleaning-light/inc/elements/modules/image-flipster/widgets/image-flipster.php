<?php

namespace CleaningLightElements\Modules\ImageFlipster\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class ImageFlipster extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-image-flipster';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Image Flipster Carousel', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-slider-album';
    }

    public function get_keywords() {
		return [ 'image', 'flipster', 'gallery','photos' ];
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
            'section_settings', [
                'label' => esc_html__('Layouts', 'cleaning-light'),
            ]
        );

            $this->add_control(
                'layout', [
                    'label' => esc_html__('Layout', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default' => 'carousel',
                    'options' => [
                        'carousel' => esc_html__('Carousel', 'cleaning-light'),
                        'coverflow' => esc_html__('Coverflow', 'cleaning-light')
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(), [
                    'name' => 'thumb',
                    'exclude' => ['custom'],
                    'include' => [],
                    'default' => 'full',
                    'separator' => 'after'
                ]
            );

            $this->add_responsive_control(
                'image_height', [
                    'label' => esc_html__('Image Height', 'cleaning-light'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 50,
                    'max' => 1000,
                    'step' => 1,
                    'default' => 500,
                ]
            );

            $this->add_responsive_control(
                'image_width', [
                    'label' => esc_html__('Image Width', 'cleaning-light'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 50,
                    'max' => 1000,
                    'step' => 1,
                    'default' => 490,
                ]
            );

            $this->add_control(
                'image_stretch', [
                    'label' => esc_html__('Image Stretch', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default' => 'ikthemes-image-stretch-yes',
                    'options' => [
                        'ikthemes-image-stretch-yes' => esc_html__('Yes', 'cleaning-light'),
                        'ikthemes-image-stretch-no' => esc_html__('No', 'cleaning-light')
                    ],
                ]
            );

            $this->add_control(
                'image_bg', [
                    'label' => esc_html__('Background', 'cleaning-light'),
                    'type' => Controls_Manager::COLOR,
                    'condition' => [
                        'image_stretch' => 'ikthemes-image-stretch-no',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ikthemes-image-flipster-carousel .ikthemes-image-slide .flip-content' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'enable_nav', [
                    'label' => esc_html__('Navigation Buttons', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'cleaning-light'),
                    'label_off' => esc_html__('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'nav_position', [
                    'label' => esc_html__('Position', 'cleaning-light'),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default' => 'ikthemes-nav-side',
                    'options' => [
                        'ikthemes-nav-bottom' => esc_html__('Bottom Center', 'cleaning-light'),
                        'ikthemes-nav-side' => esc_html__('Middle Side Ways', 'cleaning-light')
                    ],
                    'condition' => [
                        'enable_nav' => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content', [
                'label' => esc_html__('Content', 'cleaning-light'),
            ]
        );

            $repeater = new Repeater();

            $repeater->add_control(
                'title', [
                    'label' => esc_html__('Logo Title', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__('FlipSter Image', 'cleaning-light'),
                ]
            );

            $repeater->add_control(
                'image', [
                    'label' => esc_html__('Choose Image', 'cleaning-light'),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_control(
                'logo_link', [
                    'label' => esc_html__('Link', 'cleaning-light'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'slides',[
                    'label' => esc_html__( 'FlipSter Image List', 'cleaning-light' ),
                    'type' => Controls_Manager::REPEATER,
                    'show_label' => true,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'title' => esc_html__( 'FlipSter Image One', 'cleaning-light' ),
                            'logo_link' => '#',
                            'link_new_tab' => 'yes',
                        ],
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'title' => esc_html__( 'FlipSter Image Two', 'cleaning-light' ),
                            'logo_link' => '#',
                            'link_new_tab' => 'yes',
                        ],
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'title' => esc_html__( 'FlipSter Image Three', 'cleaning-light' ),
                            'logo_link' => '#',
                            'link_new_tab' => 'yes',
                        ],
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'title' => esc_html__( 'FlipSter Image Four', 'cleaning-light' ),
                            'logo_link' => '#',
                            'link_new_tab' => 'yes',
                        ],
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'title' => esc_html__( 'FlipSter Image Five', 'cleaning-light' ),
                            'logo_link' => '#',
                            'link_new_tab' => 'yes',
                        ],
                        [
                            'image' => Utils::get_placeholder_image_src(),
                            'title' => esc_html__( 'FlipSter Image Six', 'cleaning-light' ),
                            'logo_link' => '#',
                            'link_new_tab' => 'yes',
                        ]
                    ],
                    'title_field' => '{{{ title }}}',
                ]
            );

            $this->add_control(
                'link_new_tab', [
                    'label' => esc_html__('Open Link in New Tab', 'cleaning-light'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'cleaning-light'),
                    'label_off' => esc_html__('No', 'cleaning-light'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'navigation_style', [
                'label' => esc_html__('Navigation Button', 'cleaning-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'navigation_tabs' );

                $this->start_controls_tab(
                    'normal_tab', [
                        'label' => esc_html__('Normal', 'cleaning-light'),
                    ]
                );

                    $this->add_control(
                        'navigation_bg_color', [
                            'label' => esc_html__('Background Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-image-flipster-carousel .flipto-nav a' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'arrow_color', [
                            'label' => esc_html__('Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-image-flipster-carousel .flipto-nav a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'active_tab', [
                        'label' => esc_html__('Hover', 'cleaning-light'),
                    ]
                );

                    $this->add_control(
                        'navigation_bg_color_hover', [
                            'label' => esc_html__('Background Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-image-flipster-carousel .flipto-nav a:hover' => 'background-color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'arrow_color_hover', [
                            'label' => esc_html__('Color', 'cleaning-light'),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ikthemes-image-flipster-carousel .flipto-nav a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();
    }


    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display();
        $style = array();
        $target = $settings['link_new_tab'] ? '_blank' : '_self';
        $style[] = ($settings['image_height']) ? 'height:' . $settings['image_height'] . 'px' : '';
        $style[] = ($settings['image_width']) ? 'width:' . $settings['image_width'] . 'px' : '';
        $nav_class = $settings['enable_nav'] == 'yes' ? '' : 'ikthemes-disable-nav';

        $this->add_render_attribute('wrapper', [
                'class' => ['ikthemes-image-flipster-carousel', esc_attr($settings['image_stretch']), esc_attr($settings['nav_position']), esc_attr($nav_class)],
                'data-style' => $settings['layout'],
            ]
        );
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <?php
                if ($settings['slides']) {

                    echo '<div class="ikthemes-flipster">';

                        foreach ($settings['slides'] as $item) {

                            $image_url = Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumb', $settings);
                            if (!$image_url) {
                                $image_url = Utils::get_placeholder_image_src();
                            }
                            $image_html = '<img src="' . esc_attr($image_url) . '" alt="' . esc_attr(\Elementor\Control_Media::get_image_alt($item['image'])) . '" />';

                            echo '<div class="ikthemes-image-slide" style="' . implode(';', $style) . '">';
                            
                                if (!empty($item['logo_link'])) { ?>
                                    <a href="<?php echo esc_url($item['logo_link']) ?>" target="<?php echo esc_attr($target) ?>">
                                        <?php echo $image_html; ?>
                                    </a>
                                <?php } else {

                                echo $image_html;
                            }
                            
                            echo '</div>';
                        }

                    echo '</div>';
                }
            ?>
        </div>
        <?php
    }
}
