<?php 

namespace CleaningLightElements\Modules\PortfolioGallery\Widgets;


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

// use Elementor\Controls_Manager;
use Elementor\Core\Breakpoints\Manager as Breakpoints_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
// use Elementor\Group_Control_Background;
// use Elementor\Group_Control_Css_Filter;
// use Elementor\Group_Control_Image_Size;
// use Elementor\Group_Control_Typography;
use Elementor\Repeater;
// use Elementor\Utils;
// use ElementorPro\Base\Base_Widget;
// use ElementorPro\Plugin;
//use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class PortfolioGallery extends Widget_Base {

	/** Widget Name */
	public function get_name() {
		return 'CleaningLight-portfolio-gallery';
	}

	/** Widget Title */
	public function get_title() {
		return esc_html__( 'Portfolio Gallery', 'cleaning-light' );
	}

	public function get_script_depends() {
		return [ 'elementor-gallery' ];
	}

	public function get_style_depends(): array {
		return [ 'widget-gallery', 'elementor-gallery', 'e-transitions' ];
	}

	/** Icon */
	public function get_icon() {
		return 'eicon-gallery-justified';
	}

	/** Category */
    public function get_categories() {
        return ['CleaningLight-elements'];
    }

	public function get_inline_css_depends() {
		if ( 'multiple' === $this->get_settings_for_display( 'gallery_type' ) ) {
			return [ 'nav-menu' ];
		}
		return [];
	}


	protected function register_controls() {

		$this->start_controls_section( 'settings', [ 'label' => esc_html__( 'Settings', 'cleaning-light' ) ] );

			$this->add_control(
				'gallery_type',[
					'type' => Controls_Manager::SELECT,
					'label' => esc_html__( 'Type', 'cleaning-light' ),
					'default' => 'single',
					'options' => [
						'single' => esc_html__( 'Single', 'cleaning-light' ),
						'multiple' => esc_html__( 'Multiple', 'cleaning-light' ),
					],
				]
			);

			$this->add_control(
				'gallery',[
					'type' => Controls_Manager::GALLERY,
					'condition' => [
						'gallery_type' => 'single',
					],
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'gallery_title',[
					'type' => Controls_Manager::TEXT,
					'label' => esc_html__( 'Title', 'cleaning-light' ),
					'default' => esc_html__( 'New Gallery', 'cleaning-light' ),
				]
			);

			$repeater->add_control(
				'multiple_gallery',[
					'type' => Controls_Manager::GALLERY,
				]
			);

			$this->add_control(
				'galleries',[
					'type' => Controls_Manager::REPEATER,
					'label' => esc_html__( 'Galleries', 'cleaning-light' ),
					'fields' => $repeater->get_controls(),
					'title_field' => '{{{ gallery_title }}}',
					'default' => [
						[
							'gallery_title' => esc_html__( 'New Gallery', 'cleaning-light' ),
						],
					],
					'condition' => [
						'gallery_type' => 'multiple',
					],
				]
			);

			$this->add_control(
				'order_by',[
					'type' => Controls_Manager::SELECT,
					'label' => esc_html__( 'Order By', 'cleaning-light' ),
					'options' => [
						'' => esc_html__( 'Default', 'cleaning-light' ),
						'random' => esc_html__( 'Random', 'cleaning-light' ),
					],
					'default' => '',
				]
			);

			$this->add_control(
				'lazyload',[
					'type' => Controls_Manager::SWITCHER,
					'label' => esc_html__( 'Lazy Load', 'cleaning-light' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'gallery_layout',[
					'type' => Controls_Manager::SELECT,
					'label' => esc_html__( 'Layout', 'cleaning-light' ),
					'default' => 'grid',
					'options' => [
						'grid' => esc_html__( 'Grid', 'cleaning-light' ),
						'justified' => esc_html__( 'Justified', 'cleaning-light' ),
						'masonry' => esc_html__( 'Masonry', 'cleaning-light' ),
					],
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'columns',[
					'label' => esc_html__( 'Columns', 'cleaning-light' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
						],
					],
					'default' => [
						'size' => 3,
					],
					'condition' => [
						'gallery_layout!' => 'justified',
					],
				]
			);

			$this->add_responsive_control(
				'ideal_row_height',[
					'label' => esc_html__( 'Row Height', 'cleaning-light' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 50,
							'max' => 500,
						],
					],
					'default' => [
						'size' => 300,
					],
					'condition' => [
						'gallery_layout' => 'justified',
					],
				]
			);

			$this->add_responsive_control(
				'gap',[
					'label' => esc_html__( 'Spacing', 'cleaning-light' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 15,
					],
				]
			);

			$this->add_control(
				'link_to',[
					'label' => esc_html__( 'Link', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'file',
					'options' => [
						'' => esc_html__( 'None', 'cleaning-light' ),
						'file' => esc_html__( 'Media File', 'cleaning-light' ),
						'custom' => esc_html__( 'Custom URL', 'cleaning-light' ),
					],
				]
			);

			$this->add_control(
				'url',[
					'label' => esc_html__( 'URL', 'cleaning-light' ),
					'type' => Controls_Manager::URL,
					'condition' => [
						'link_to' => 'custom',
					],
				]
			);

			$this->add_control(
				'open_lightbox',[
					'label' => esc_html__( 'Lightbox', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'description' => sprintf(
						/* translators: 1: Link open tag, 2: Link close tag. */
						esc_html__( 'Manage your site’s lightbox settings in the %1$sLightbox panel%2$s.', 'cleaning-light' ),
						'<a href="javascript: $e.run( \'panel/global/open\' ).then( () => $e.route( \'panel/global/settings-lightbox\' ) )">',
						'</a>'
					),
					'default' => 'default',
					'options' => [
						'default' => esc_html__( 'Default', 'cleaning-light' ),
						'yes' => esc_html__( 'Yes', 'cleaning-light' ),
						'no' => esc_html__( 'No', 'cleaning-light' ),
					],
					'condition' => [
						'link_to' => 'file',
					],
				]
			);

			$this->add_control(
				'aspect_ratio',[
					'type' => Controls_Manager::SELECT,
					'label' => esc_html__( 'Aspect Ratio', 'cleaning-light' ),
					'default' => '4:3',
					'options' => [
						'1:1' => '1:1',
						'3:2' => '3:2',
						'4:3' => '4:3',
						'9:16' => '9:16',
						'16:9' => '16:9',
						'21:9' => '21:9',
					],
					'condition' => [
						'gallery_layout' => 'grid',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),[
					'name' => 'thumbnail_image',
					'default' => 'full',
				]
			);

		$this->end_controls_section(); // settings

		$this->start_controls_section(
			'section_filter_bar_content',[
				'label' => esc_html__( 'Filter Bar', 'cleaning-light' ),
				'condition' => [
					'gallery_type' => 'multiple',
				],
			]
		);

			$this->add_control(
				'show_all_galleries',[
					'type' => Controls_Manager::SWITCHER,
					'label' => esc_html__( '"All" Filter', 'cleaning-light' ),
					'default' => 'yes',
					//'frontend_available' => true,
				]
			);

			$this->add_control(
				'show_all_galleries_label',[
					'type' => Controls_Manager::TEXT,
					'label' => esc_html__( '"All" Filter Label', 'cleaning-light' ),
					'default' => esc_html__( 'All', 'cleaning-light' ),
					'condition' => [
						'show_all_galleries' => 'yes',
					],
				]
			);

			$this->add_control(
				'pointer',[
					'label' => esc_html__( 'Pointer', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'underline',
					'options' => [
						'none' => esc_html__( 'None', 'cleaning-light' ),
						'underline' => esc_html__( 'Underline', 'cleaning-light' ),
						'overline' => esc_html__( 'Overline', 'cleaning-light' ),
						'double-line' => esc_html__( 'Double Line', 'cleaning-light' ),
						'framed' => esc_html__( 'Framed', 'cleaning-light' ),
						'background' => esc_html__( 'Background', 'cleaning-light' ),
						'text' => esc_html__( 'Text', 'cleaning-light' ),
					],
					'style_transfer' => true,
				]
			);

			$this->add_control(
				'animation_line',[
					'label' => esc_html__( 'Animation', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fade',
					'options' => [
						'fade' => 'Fade',
						'slide' => 'Slide',
						'grow' => 'Grow',
						'drop-in' => 'Drop In',
						'drop-out' => 'Drop Out',
						'none' => 'None',
					],
					'condition' => [
						'pointer' => [ 'underline', 'overline', 'double-line' ],
					],
				]
			);

			$this->add_control(
				'animation_framed',[
					'label' => esc_html__( 'Animation', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fade',
					'options' => [
						'fade' => 'Fade',
						'grow' => 'Grow',
						'shrink' => 'Shrink',
						'draw' => 'Draw',
						'corners' => 'Corners',
						'none' => 'None',
					],
					'condition' => [
						'pointer' => 'framed',
					],
				]
			);

			$this->add_control(
				'animation_background',[
					'label' => esc_html__( 'Animation', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fade',
					'options' => [
						'fade' => 'Fade',
						'grow' => 'Grow',
						'shrink' => 'Shrink',
						'sweep-left' => 'Sweep Left',
						'sweep-right' => 'Sweep Right',
						'sweep-up' => 'Sweep Up',
						'sweep-down' => 'Sweep Down',
						'shutter-in-vertical' => 'Shutter In Vertical',
						'shutter-out-vertical' => 'Shutter Out Vertical',
						'shutter-in-horizontal' => 'Shutter In Horizontal',
						'shutter-out-horizontal' => 'Shutter Out Horizontal',
						'none' => 'None',
					],
					'condition' => [
						'pointer' => 'background',
					],
				]
			);

			$this->add_control(
				'animation_text',[
					'label' => esc_html__( 'Animation', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'grow',
					'options' => [
						'grow' => 'Grow',
						'shrink' => 'Shrink',
						'sink' => 'Sink',
						'float' => 'Float',
						'skew' => 'Skew',
						'rotate' => 'Rotate',
						'none' => 'None',
					],
					'condition' => [
						'pointer' => 'text',
					],
				]
			);

		$this->end_controls_section(); // settings

		$this->start_controls_section( 'overlay', [ 'label' => esc_html__( 'Overlay', 'cleaning-light' ) ] );

			$this->add_control(
				'overlay_background',[
					'label' => esc_html__( 'Background', 'cleaning-light' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);

			$this->add_control(
				'overlay_title',[
					'label' => esc_html__( 'Title', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'title',
					'options' => [
						'' => esc_html__( 'None', 'cleaning-light' ),
						'title' => esc_html__( 'Title', 'cleaning-light' ),
						'caption' => esc_html__( 'Caption', 'cleaning-light' ),
						'alt' => esc_html__( 'Alt', 'cleaning-light' ),
						'description' => esc_html__( 'Description', 'cleaning-light' ),
					],
				]
			);

			$this->add_control(
				'overlay_description',[
					'label' => esc_html__( 'Description', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'title',
					'options' => [
						'' => esc_html__( 'None', 'cleaning-light' ),
						'title' => esc_html__( 'Title', 'cleaning-light' ),
						'caption' => esc_html__( 'Caption', 'cleaning-light' ),
						'alt' => esc_html__( 'Alt', 'cleaning-light' ),
						'description' => esc_html__( 'Description', 'cleaning-light' ),
					],
				]
			);

		$this->end_controls_section(); // overlay

		$this->start_controls_section(
			'image_style',[
				'label' => esc_html__( 'Image', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs( 'image_tabs' );

				$this->start_controls_tab(
					'image_normal',[
						'label' => esc_html__( 'Normal', 'cleaning-light' ),
					]
				);

					$this->add_control(
						'image_border_color',[
							'label' => esc_html__( 'Border Color', 'cleaning-light' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}}' => '--image-border-color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'image_border_width',[
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
								'em' => [
									'max' => 2,
								],
							],
							'selectors' => [
								'{{WRAPPER}}' => '--image-border-width: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_control(
						'image_border_radius',[
							'label' => esc_html__( 'Border Radius', 'cleaning-light' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
							'selectors' => [
								'{{WRAPPER}}' => '--image-border-radius: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Css_Filter::get_type(),[
							'name' => 'image_css_filters',
							'selector' => '{{WRAPPER}} .e-gallery-image',
						]
					);

				$this->end_controls_tab(); // overlay_background normal

				$this->start_controls_tab(
					'image_hover',[
						'label' => esc_html__( 'Hover', 'cleaning-light' ),
					]
				);

					$this->add_control(
						'image_border_color_hover',[
							'label' => esc_html__( 'Border Color', 'cleaning-light' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .cleaninglight-gallery-item:hover' => 'border-color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'image_border_radius_hover',[
							'label' => esc_html__( 'Border Radius', 'cleaning-light' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
							'selectors' => [
								'{{WRAPPER}} .cleaninglight-gallery-item:hover' => 'border-radius: {{SIZE}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Css_Filter::get_type(),[
							'name' => 'image_css_filters_hover',
							'selector' => '{{WRAPPER}} .e-gallery-item:hover .e-gallery-image',
						]
					);

				$this->end_controls_tab(); // overlay_background normal

			$this->end_controls_tabs();// overlay_background tabs

			$this->add_control(
            	'image_hover_animation',[
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

			$this->add_control(
				'image_animation_duration',[
					'label' => esc_html__( 'Animation Duration', 'cleaning-light' ) . ' (ms)',
					'type' => Controls_Manager::SLIDER,
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
						'{{WRAPPER}}' => '--image-transition-duration: {{SIZE}}ms',
					],
				]
			);

		$this->end_controls_section(); // overlay_background


		$this->start_controls_section(
			'overlay_style',[
				'label' => esc_html__( 'Overlay', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'overlay_background' => 'yes',
				],
			]
		);

			$this->start_controls_tabs( 'overlay_background_tabs' );

				$this->start_controls_tab(
					'overlay_normal',[
						'label' => esc_html__( 'Normal', 'cleaning-light' ),
					]
				);

					$this->add_group_control(
						Group_Control_Background::get_type(),[
							'name' => 'overlay_background',
							'types' => [ 'classic', 'gradient' ],
							'exclude' => [ 'image' ],
							'selector' => '{{WRAPPER}} .cleaninglight-gallery-item-overlay',
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

				$this->end_controls_tab(); // overlay_background normal

				$this->start_controls_tab(
					'overlay_hover',[
						'label' => esc_html__( 'Hover', 'cleaning-light' ),
					]
				);

					$this->add_group_control(
						Group_Control_Background::get_type(),[
							'name' => 'overlay_background_hover',
							'types' => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .e-gallery-item:hover .cleaninglight-gallery-item-overlay, {{WRAPPER}} .e-gallery-item:focus .cleaninglight-gallery-item-overlay',
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

				$this->end_controls_tab(); // overlay_background normal

			$this->end_controls_tabs();// overlay_background tabs

			$this->add_control(
				'image_blend_mode',[
					'label' => esc_html__( 'Blend Mode', 'cleaning-light' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'' => esc_html__( 'Normal', 'cleaning-light' ),
						'multiply' => 'Multiply',
						'screen' => 'Screen',
						'overlay' => 'Overlay',
						'darken' => 'Darken',
						'lighten' => 'Lighten',
						'color-dodge' => 'Color Dodge',
						'color-burn' => 'Color Burn',
						'hue' => 'Hue',
						'saturation' => 'Saturation',
						'color' => 'Color',
						'exclusion' => 'Exclusion',
						'luminosity' => 'Luminosity',
					],
					'selectors' => [
						'{{WRAPPER}}' => '--overlay-mix-blend-mode: {{VALUE}}',
					],
					'separator' => 'before',
					'render_type' => 'ui',
				]
			);

			$this->add_control(
            	'content_animation',[
            		'label' => esc_html__( 'Hover Animation', 'cleaning-light' ),
            		'type' => Controls_Manager::SELECT,
            		'groups' => [
            			[
            				'label' => esc_html__( 'None', 'cleaning-light' ),
            				'options' => [
            					'' => esc_html__( 'None', 'cleaning-light' ),
            				],
            			],
            			[
            				'label' => esc_html__( 'Entrance', 'cleaning-light' ),
            				'options' => [
            					'enter-from-right' => 'Slide In Right',
            					'enter-from-left' => 'Slide In Left',
            					'enter-from-top' => 'Slide In Up',
            					'enter-from-bottom' => 'Slide In Down',
            					'enter-zoom-in' => 'Zoom In',
            					'enter-zoom-out' => 'Zoom Out',
            					'fade-in' => 'Fade In',
            				],
            			],
            			[
            				'label' => esc_html__( 'Reaction', 'cleaning-light' ),
            				'options' => [
            					'grow' => 'Grow',
            					'shrink' => 'Shrink',
            					'move-right' => 'Move Right',
            					'move-left' => 'Move Left',
            					'move-up' => 'Move Up',
            					'move-down' => 'Move Down',
            				],
            			],
            			[
            				'label' => esc_html__( 'Exit', 'cleaning-light' ),
            				'options' => [
            					'exit-to-right' => 'Slide Out Right',
            					'exit-to-left' => 'Slide Out Left',
            					'exit-to-top' => 'Slide Out Up',
            					'exit-to-bottom' => 'Slide Out Down',
            					'exit-zoom-in' => 'Zoom In',
            					'exit-zoom-out' => 'Zoom Out',
            					'fade-out' => 'Fade Out',
            				],
            			],
            		],
            		'separator' => 'before',
					'default' => '',
            	]
            );

			$this->add_control(
				'background_overlay_animation_duration',[
					'label' => esc_html__( 'Animation Duration', 'cleaning-light' ) . ' (ms)',
					'type' => Controls_Manager::SLIDER,
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
						'{{WRAPPER}}' => '--overlay-transition-duration: {{SIZE}}ms',
					],
				]
			);

		$this->end_controls_section(); // overlay_background

		$this->start_controls_section(
			'overlay_content_style',[
				'label' => esc_html__( 'Content', 'cleaning-light' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'content_alignment',[
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
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}}' => '--content-text-align: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'content_vertical_position',[
					'label' => esc_html__( 'Vertical Position', 'cleaning-light' ),
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
					'selectors_dictionary' => [
						'top' => 'flex-start',
						'middle' => 'center',
						'bottom' => 'flex-end',
					],
					'selectors' => [
						'{{WRAPPER}}' => '--content-justify-content: {{VALUE}}',
					],
				]
			);

			$this->add_responsive_control(
				'content_padding',[
					'label' => esc_html__( 'Padding', 'cleaning-light' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
					'default' => [
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}}' => '--content-padding: {{SIZE}}{{UNIT}}',
					],
				]
			);

				$this->add_control(
					'heading_title',[
						'label' => esc_html__( 'Title', 'cleaning-light' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
						'condition' => [
							'overlay_title!' => '',
						],
					]
				);

					$this->add_control(
						'title_color',[
							'label' => esc_html__( 'Color', 'cleaning-light' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}}' => '--title-text-color: {{VALUE}}',
							],
							'condition' => [
								'overlay_title!' => '',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Typography::get_type(),[
							'name' => 'title_typography',
							'selector' => '{{WRAPPER}} .cleaninglight-gallery-item-title',
							'condition' => [
								'overlay_title!' => '',
							],
						]
					);

					$this->add_control(
						'title_spacing',[
							'label' => esc_html__( 'Spacing', 'cleaning-light' ),
							'type' => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
							'selectors' => [
								'{{WRAPPER}}' => '--description-margin-top: {{SIZE}}{{UNIT}}',
							],
							'condition' => [
								'overlay_title!' => '',
							],
						]
					);

				$this->add_control(
					'heading_description',[
						'label' => esc_html__( 'Description', 'cleaning-light' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
						'condition' => [
							'overlay_description!' => '',
						],
					]
				);

					$this->add_control(
						'description_color',[
							'label' => esc_html__( 'Color', 'cleaning-light' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}}' => '--description-text-color: {{VALUE}}',
							],
							'condition' => [
								'overlay_description!' => '',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Typography::get_type(),[
							'name' => 'description_typography',
							'selector' => '{{WRAPPER}} .cleaninglight-gallery-item-description',
							'condition' => [
								'overlay_description!' => '',
							],
						]
					);


			$this->add_control(
            	'content_hover_animation',[
            		'label' => esc_html__( 'Hover Animation', 'cleaning-light' ),
            		'type' => Controls_Manager::SELECT,
            		'groups' => [
            			[
            				'label' => esc_html__( 'None', 'cleaning-light' ),
            				'options' => [
            					'' => esc_html__( 'None', 'cleaning-light' ),
            				],
            			],
            			[
            				'label' => esc_html__( 'Entrance', 'cleaning-light' ),
            				'options' => [
            					'enter-from-right' => 'Slide In Right',
            					'enter-from-left' => 'Slide In Left',
            					'enter-from-top' => 'Slide In Up',
            					'enter-from-bottom' => 'Slide In Down',
            					'enter-zoom-in' => 'Zoom In',
            					'enter-zoom-out' => 'Zoom Out',
            					'fade-in' => 'Fade In',
            				],
            			],
            			[
            				'label' => esc_html__( 'Reaction', 'cleaning-light' ),
            				'options' => [
            					'grow' => 'Grow',
            					'shrink' => 'Shrink',
            					'move-right' => 'Move Right',
            					'move-left' => 'Move Left',
            					'move-up' => 'Move Up',
            					'move-down' => 'Move Down',
            				],
            			],
            			[
            				'label' => esc_html__( 'Exit', 'cleaning-light' ),
            				'options' => [
            					'exit-to-right' => 'Slide Out Right',
            					'exit-to-left' => 'Slide Out Left',
            					'exit-to-top' => 'Slide Out Up',
            					'exit-to-bottom' => 'Slide Out Down',
            					'exit-zoom-in' => 'Zoom In',
            					'exit-zoom-out' => 'Zoom Out',
            					'fade-out' => 'Fade Out',
            				],
            			],
            		],
            		'separator' => 'before',
					'default' => 'shrink',
            	]
            );

			$this->add_control(
				'content_animation_duration',[
					'label' => esc_html__( 'Animation Duration', 'cleaning-light' ) . ' (ms)',
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 800,
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 3000,
							'step' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}}' => '--content-transition-duration: {{SIZE}}ms; --content-transition-delay: {{SIZE}}ms;',
					],
					'condition' => [
						'content_hover_animation!' => '',
					],
				]
			);

			$this->add_control(
				'content_sequenced_animation',[
					'label' => esc_html__( 'Sequenced Animation', 'cleaning-light' ),
					'type' => Controls_Manager::SWITCHER,
					'condition' => [
						'content_hover_animation!' => '',
					],
					'frontend_available' => true,
					'render_type' => 'ui',
				]
			);

		$this->end_controls_section(); // overlay_content
		
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$is_multiple = 'multiple' === $settings['gallery_type'] && ! empty( $settings['galleries'] );

		$is_single = 'single' === $settings['gallery_type'] && ! empty( $settings['gallery'] );

		$galleries = [];

		if ( $is_multiple ) {

			$this->add_render_attribute(
				'titles-container',[
					'class' => 'elementor-gallery__titles-container',
					'aria-label' => esc_html__( 'Gallery filter', 'cleaning-light' ),
				]
			);

			// if ( $settings['pointer'] ) {
			// 	$this->add_render_attribute( 'titles-container', 'class', 'e--pointer-' . $settings['pointer'] );
			// 	foreach ( $settings as $key => $value ) {
			// 		if ( 0 === strpos( $key, 'animation' ) && $value ) {
			// 			$this->add_render_attribute( 'titles-container', 'class', 'e--animation-' . $value );
			// 			break;
			// 		}
			// 	}
			// }

			// foreach ( array_values( $settings['galleries'] ) as $multi_gallery ) {

			// 	if ( ! $multi_gallery['multiple_gallery'] ) {
			// 		continue;
			// 	}

			// 	$galleries[] = $multi_gallery['multiple_gallery'];

			// }
			?>
			<div <?php $this->print_render_attribute_string( 'titles-container' ); ?>>
				<?php if ( $settings['show_all_galleries'] ) { ?>
					<a class="elementor-item elementor-gallery-title active" role="button" data-filter="all">
						<?php $this->print_unescaped_setting( 'show_all_galleries_label' ); ?>
					</a>
				<?php } ?>
				<?php 
					foreach ( $settings['galleries'] as $index => $gallery ) :

						$galleries[ $index ] = $gallery['multiple_gallery'];
					?>
						<a class="elementor-item elementor-gallery-title" role="button" data-filter="<?php echo esc_attr( $index ); ?>">
							<?php $this->print_unescaped_setting( 'gallery_title', 'galleries', $index ); ?>
						</a>
				<?php endforeach; ?>
			</div>

		<?php  } elseif ( $is_single ) {

			$galleries[0] = $settings['gallery'];
		}
		
		$this->add_render_attribute( 'gallery_container', 'class', 'cleaninglight-gallery-wrapper' );

		if ( $settings['overlay_title'] || $settings['overlay_description'] ) {

			$this->add_render_attribute( 'gallery_item_content', 'class', 'cleaninglight-gallery-item-content' );

			if ( !empty( $settings['content_sequenced_animation'] ) ) {
				$this->add_render_attribute( 'gallery_item_content', 'class', 'calltoaction-sequenced-animation' );
			}
			
			if ( $settings['overlay_title'] ) {
				$this->add_render_attribute( 'gallery_item_title', 'class', 'cleaninglight-gallery-item-title' );
			}

			if ( $settings['overlay_description'] ) {
				$this->add_render_attribute( 'gallery_item_description', 'class', 'cleaninglight-gallery-item-description' );
			}

			if ( !empty( $settings['content_hover_animation'] ) ) {
				$this->add_render_attribute( 'gallery_item_title', 
					'class', 'calltoaction-animated-item--'.$settings['content_hover_animation'] 
				);
				$this->add_render_attribute( 'gallery_item_description', 
					'class', 'calltoaction-animated-item--'.$settings['content_hover_animation'] 
				);
			}
		}

		$this->add_render_attribute( 'gallery_item_background_overlay', [ 'class' => 'cleaninglight-gallery-item-overlay' ] );
		
		if ( !empty( $settings['content_animation'] ) ) {
			$this->add_render_attribute( 'gallery_item_background_overlay', [
				'class' => 'calltoaction-animated-item--'.$settings['content_animation'] ] 
			);
		}


	foreach ( $settings['galleries'] as $unique_index => $item ){

		$galleries[ $unique_index ] = $item['multiple_gallery'];

		$thumbnail_size = $settings['thumbnail_image_size'];
		// $gallery_items = [];
		// foreach ( $galleries[ $unique_index ] as $gallery_index => $gallery ) {
		// 	foreach ( $gallery as $index => $item ) {
		// 		if ( in_array( $item, array_keys( $gallery_items ), true ) ) {
		// 			$gallery_items[ $item ][] = $gallery_index;
		// 		} else {
		// 			$gallery_items[ $item ] = [ $gallery_index ];
		// 		}
		// 	}
		// }
		$gallery_items = [];
		foreach ( $galleries[ $unique_index ] as $gallery_index => $gallery ) {
			foreach ( $gallery as $index => $item ) {
				if ( in_array( $item, array_keys( $gallery_items ), true ) ) {
					$gallery_items[$item][] = $gallery_index;
				} else {
					$gallery_items[$item] = [ $gallery_index ];
				}
			}
		}

		// if ( 'random' === $settings['order_by'] ) {
		// 	$shuffled_items = [];
		// 	$keys = array_keys( $gallery_items );
		// 	shuffle( $keys );
		// 	foreach ( $keys as $key ) {
		// 		$shuffled_items[ $key ] = $gallery_items[ $key ];
		// 	}
		// 	$gallery_items = $shuffled_items;
		// }

		$gallery_item_tag = ! empty( $settings['link_to'] ) ? 'a' : 'div';

		
		$columns = 4;
		if ( !empty( $settings['columns']['size'] ) ) {
			$columns = $settings['columns']['size'];
		}
		
		$ideal_row_height = 200;
		if ( !empty( $settings['ideal_row_height']['size'] ) ) {
			$ideal_row_height = $settings['ideal_row_height']['size'];
		}
		
		$gap = $settings['gap']['size'] . $settings['gap']['unit'];

		$ratio_percentage = '75';
		if ( $settings['aspect_ratio'] ) {
			$ratio_array = explode( ':', $settings['aspect_ratio'] );
			$ratio_percentage = ( $ratio_array[1] / $ratio_array[0] ) * 100;
		}

		$params = array(
			'layout'		=> $settings['gallery_layout'],
            'columns' 		=> $columns,
            'gap' 			=> $settings['gap']['size'],
			'rowheight'		=> $ideal_row_height,
			'aspectratio' 	=> $settings['aspect_ratio'],
			'lazyload' 		=> $settings['lazyload'] == 'yes' ? true : false,
        );
        $params = json_encode($params);

		$this->add_render_attribute(
			'gallery_container',[
				'style' => "--columns: {$columns}; --aspect-ratio: {$ratio_percentage}%; --hgap: {$gap}; --vgap: {$gap};",
			]
		);
		

		if ( ! empty( $galleries ) ) { 
	?>
		<div <?php $this->print_render_attribute_string( 'gallery_container' ); ?> data-params='<?php echo $params; ?>'>
			<?php

			foreach ( $gallery_items as $id => $tags ) :

				//print_r( $id );

				$unique_index = $id; //$gallery_index . '_' . $index;

				$image_src = wp_get_attachment_image_src( $id, $thumbnail_size );

				if ( ! $image_src ) {
					continue;
				}

				$attachment = get_post( $id );
				$image_data = [
					'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
					'media' => wp_get_attachment_image_src( $id, 'full' )['0'],
					'src' => $image_src['0'],
					'width' => $image_src['1'],
					'height' => $image_src['2'],
					'caption' => $attachment->post_excerpt,
					'description' => $attachment->post_content,
					'title' => $attachment->post_title,
				];

				$this->add_render_attribute( 'gallery_item_' . $unique_index, [
					'class' => [
						'e-gallery-item',
						'cleaninglight-gallery-item'
					],
				] );

				// Image Hover Effect
				if ( !empty( $settings['image_hover_animation'] ) ) {
					$this->add_render_attribute( 'gallery_item_' . $unique_index, [ 
						'class' => 'cleaninglight-bg-transform-'.$settings['image_hover_animation'] ] 
					);
				}
				
				// Hover Overlay
				if ( !empty( $settings['content_animation'] ) || !empty( $settings['content_hover_animation'] ) ) {
					$this->add_render_attribute( 'gallery_item_' . $unique_index, [ 'class' => 'calltoaction-animated-content' ] );
				}

				if ( $is_multiple ) {
					$this->add_render_attribute( 'gallery_item_' . $unique_index, [
						'class' => [
							implode( ' ', $tags )
						],
					] );
					//$this->add_render_attribute( 'gallery_item_' . $unique_index, [ 'data-gallery-index' => implode( ',', $tags ) ] );
				}

				if ( 'a' === $gallery_item_tag ) {

					if ( 'file' === $settings['link_to'] ) {

						$href = $image_data['media'];

						$this->add_render_attribute( 'gallery_item_' . $unique_index, [
							'href' => esc_url( $href ),
						] );

						$this->add_lightbox_data_attributes( 'gallery_item_' . $unique_index, $id, $settings['open_lightbox'], $this->get_id() );

					} elseif ( 'custom' === $settings['link_to'] ) {

						$this->add_link_attributes( 'gallery_item_' . $unique_index, $settings['url'] );
					}
				}

				$this->add_render_attribute( 'gallery_item_image_' . $unique_index,
					[
						'class' => [
							'e-gallery-image',
							'cleaninglight-gallery-item-image',
							'cleaninglight-bg'
						],
						'data-thumbnail' => $image_data['src'],
						'data-width' => $image_data['width'],
						'data-height' => $image_data['height'],
						'aria-label' => $image_data['alt'],
						'role' => 'img',
						'style' => "background-image: url('{$image_src[0]}');",
					]
				);
			?>
				<<?php Utils::print_validated_html_tag( $gallery_item_tag ); ?> <?php $this->print_render_attribute_string( 'gallery_item_' . $unique_index ); ?>>
					<div <?php $this->print_render_attribute_string( 'gallery_item_image_' . $unique_index ); ?> ></div>
					<?php if ( ! empty( $settings['overlay_background'] ) ) : ?>
						<div <?php $this->print_render_attribute_string( 'gallery_item_background_overlay' ); ?>></div>
					<?php endif; ?>
					<?php if ( $settings['overlay_title'] || $settings['overlay_description'] ) : ?>
						<div <?php $this->print_render_attribute_string( 'gallery_item_content' ); ?>>
							<?php if ( $settings['overlay_title'] ) :
								$title = $image_data[ $settings['overlay_title'] ];
								if ( ! empty( $title ) ) : ?>
									<div <?php $this->print_render_attribute_string( 'gallery_item_title' ); ?>>
										<?php // PHPCS - the main text of a widget should not be escaped. ?>
										<?php echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</div>
								<?php endif;
							endif;
							if ( $settings['overlay_description'] ) :
								$description = $image_data[ $settings['overlay_description'] ];
								if ( ! empty( $description ) ) :?>
									<div <?php $this->print_render_attribute_string( 'gallery_item_description' ); ?>>
										<?php // PHPCS - the main text of a widget should not be escaped. ?>
										<?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</div>
								<?php endif;
							endif; ?>
						</div>
					<?php endif; ?>
				</<?php Utils::print_validated_html_tag( $gallery_item_tag ); ?>>
			<?php endforeach; } ?>
		</div>

	<?php } 

	}

}