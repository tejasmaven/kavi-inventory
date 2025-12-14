<?php

namespace CleaningLightElements\Modules\VideoPopup\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class VideoPopup extends Widget_Base {

    /** Widget Name */
    public function get_name() {
        return 'CleaningLight-video-popup';
    }

    /** Widget Title */
    public function get_title() {
        return esc_html__('Video PopUp', 'cleaning-light');
    }

    /** Icon */
    public function get_icon() {
        return 'eicon-play';
    }

    public function get_keywords() {
		return [ 'video', 'popup', 'lightbox' ];
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
            'section_content', [
                'label' => esc_html__('Content', 'cleaning-light'),
            ]
        );

        $this->add_control(
            'video_url', [
                'label' => esc_html__('Video URL', 'cleaning-light'),
                'type' => Controls_Manager::URL,
                'description' => esc_html__('To display YouTube, Vimeo or VK video, paste the video URL (https://www.youtube.com/watch?v=XzwqRZtBRDY)', 'cleaning-light'),
                'placeholder' => esc_html__('https://your-link.com', 'cleaning-light'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'icon_type', [
                'label' => esc_html__('Video Icon Type', 'cleaning-light'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'cleaning-light'),
                    'icon' => esc_html__('Font & SVG Icon', 'cleaning-light'),
                    'image' => esc_html__('Image Icon', 'cleaning-light'),
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_font_size', [
                'label' => esc_html__('Icon Font Size', 'cleaning-light'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 250,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'condition' => [
                    'icon_type' => ['default'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ikthemes-play-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ikthemes-play-button, {{WRAPPER}} .ikthemes-play-button:before, {{WRAPPER}} .ikthemes-play-button:after' => 'width: calc({{SIZE}}{{UNIT}} + 15px);; height: calc({{SIZE}}{{UNIT}} + 15px);;',
                ],
            ]
        );

        $this->add_responsive_control(
            'font_icon', [
                'label' => esc_html__('Select Icon', 'cleaning-light'),
                'description' => esc_html__('On clicking the video play button, the video will show in popup.', 'cleaning-light'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-play-circle',
                    'library' => 'regular',
                ],
                'condition' => [
                    'icon_type' => ['icon'],
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
                        'min' => 50,
                        'max' => 250,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'condition' => [
                    'icon_type' => ['icon'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ikthemes-play-button-svg i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ikthemes-play-button-svg svg, {{WRAPPER}} .ikthemes-play-button-svg::before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_icon', [
                'label' => esc_html__('Select Image', 'cleaning-light'),
                'type' => Controls_Manager::MEDIA,
                'description' => esc_html__('On clicking the video play button, the video will show in popup.', 'cleaning-light'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon_type' => ['image'],
                ],
            ]
        );

        $this->add_responsive_control(
            'image_size', [
                'label' => esc_html__('Image Size', 'cleaning-light'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 250,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'condition' => [
                    'icon_type' => ['image'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ikthemes-play-button-img img, {{WRAPPER}} .ikthemes-play-button-img:before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'default_icon_bg_color', [
                'label' => esc_html__('Background Color', 'cleaning-light'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'icon_type' => ['default','image','icon']
                ],
                'selectors' => [
                    '{{WRAPPER}} .ikthemes-play-button, {{WRAPPER}} .ikthemes-play-button:before, {{WRAPPER}} .ikthemes-play-button:after, {{WRAPPER}} .ikthemes-play-button-img:before, {{WRAPPER}} .ikthemes-play-button-svg svg, {{WRAPPER}} .ikthemes-play-button-svg:before' => 'background-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'default_icon_color', [
                'label' => esc_html__('Icon Color', 'cleaning-light'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'condition' => [
                    'icon_type' => ['default'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ikthemes-play-button i' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'icon_color', [
                'label' => esc_html__('Icon Color', 'cleaning-light'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => [
                    'icon_type' => ['icon'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ikthemes-video-popup a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ikthemes-video-popup a svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover', [
                'label' => esc_html__('Icon Color(Hover)', 'cleaning-light'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'icon_type' => ['icon'],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ikthemes-video-popup a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .ikthemes-video-popup a:hover svg:hover' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_align', [
                'label' => esc_html__('Alignment', 'cleaning-light'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'cleaning-light'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'cleaning-light'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'cleaning-light'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
    }

    /** Render Layout */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $video_url = $settings['video_url']['url'];

        ?>
        <div class="ikthemes-video-popup <?php echo esc_attr('ikthemes-video-popup-align-' . $settings['icon_align']) ?>">
            <a href="<?php echo esc_url($video_url); ?>" target="_blank" rel="ikthemesVideo[iframe]" class="shadow-ripples">
                <?php if ($settings['icon_type'] == 'default') { ?>
                    <span class="ikthemes-play-button"><i class="fa-solid fa-circle-play"></i></span>
                <?php } elseif ($settings['icon_type'] == 'icon') { ?>
                    <span class="ikthemes-play-button-svg">
                        <?php  Icons_Manager::render_icon($settings['font_icon'], ['aria-hidden' => 'true']); ?>
                    </span>
                <?php } elseif ($settings['icon_type'] == 'image') { ?>
                    <span class="ikthemes-play-button-img">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'full', 'image_icon'); ?>
                    </span>
                <?php } ?>
            </a>
        </div>
        <?php
    }

}
