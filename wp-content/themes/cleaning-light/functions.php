<?php

if (!defined('CLEANINGLIGHT_VERSION')) {
    $themes_get_theme = wp_get_theme();
    $themes_version = $themes_get_theme->Version;
    define('CLEANINGLIGHT_VERSION', $themes_version);
}


if ( ! function_exists( 'cleaninglight_themes_setup' ) ) :
	
	function cleaninglight_themes_setup() {
		
		load_theme_textdomain( 'cleaning-light', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( "wp-block-styles" );

		add_theme_support( "responsive-embeds" );

		add_theme_support( "align-wide" );

		add_theme_support('custom-line-height');
 
		add_theme_support('custom-spacing');

		add_theme_support('custom-units');

		add_theme_support( 'title-tag' );
	
		add_theme_support( 'post-thumbnails' );
		
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary Menu', 'cleaning-light' ),
			'top'       => esc_html__( 'Top Menu', 'cleaning-light' ),
			'mobile'    => esc_html__( 'Mobile Menu', 'cleaning-light' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'cleaninglight_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'block-nav-menus' );

		add_theme_support( 'experimental-link-color' );

		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'cleaninglight_themes_setup' );

function cleaninglight_themes_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Right Widget Sidebar Area', 'cleaning-light' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cleaning-light' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Left Widget Sidebar Area', 'cleaning-light' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'cleaning-light' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'cleaning-light' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'cleaning-light' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
}
add_action( 'widgets_init', 'cleaninglight_themes_widgets_init' );


if ( ! function_exists( 'cleaninglight_fonts_url' ) ) :
	/**
	 * Register Google fonts for Cleaning Light
	 *
	 * Create your own cleaninglight_fonts_url() function to override in a child theme.
	 *
	 * @since Cleaning Light 1.0.6
	 *
	 * @return string Google fonts URL for the theme.
	 */
    function cleaninglight_fonts_url() {

        $fonts_url = '';

		/* Translators: If there are characters in your language that are not
		 * supported by Poppins, translate this to 'off'. Do not translate
		 * into your own language.
		*/
		$body_fonts = get_theme_mod('cleaninglight_body_font_family','Sora');
		$heading_font  = get_theme_mod('cleaninglight_heading_font_family', 'Marcellus');

		if( $body_fonts == 'Poppins' || $heading_font == 'Poppins'):
			$font_families[] = 'Poppins:wght@200;300;400;500;600;700&display=swap';
		endif;

		if( $body_fonts == 'Sora' || $heading_font == 'Sora'):
			$font_families[] = 'Sora:wght@200;300;400;500;600;700;800&display=swap';
		endif;

		if( $body_fonts == 'Marcellus' || $heading_font == 'Marcellus'):
			$font_families[] = 'Marcellus:wght@200;300;400;500;600;700&display=swap';
		endif;
		
		if( $body_fonts == 'Roboto' || $heading_font == 'Roboto'):
			$font_families[] = 'Roboto:wght@400;500;600;700;800&display=swap';
		endif;
		
		if( $body_fonts == 'Raleway' || $heading_font == 'Raleway'):
			$font_families[] = 'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600&display=swap';
		endif;

		if( $body_fonts == 'Montserrat' || $heading_font == 'Montserrat'):
			$font_families[] = 'Montserrat:ital,wght@0,100;0,200;0,300;1,100;1,200;1,300&display=swap';
		endif;

		if( $body_fonts == 'Arizonia' || $heading_font == 'Arizonia'):
			$font_families[] = 'Arizonia&display=swap';
		endif;

		if ( ! empty( $font_families ) ) {

			$query_args = array(
				'family' => implode( '&family=', $font_families ), 
				'display' => 'swap',
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css2' );
		}

		return $fonts_url;

    }
endif;


if(!function_exists('cleaninglight_themes_dynamic_fonts')){

	function cleaninglight_themes_dynamic_fonts(){

		wp_enqueue_style( 'dashicons' );

		wp_enqueue_style( 'fontawesome', get_template_directory_uri(). '/assets/css/all.css');

		wp_enqueue_style('icofont', get_template_directory_uri() . '/assets/css/icofont.css', array(), '4.4.0');

	}
}

if ( ! function_exists( 'cleaninglight_themes_scripts' ) ) {

	function cleaninglight_themes_scripts() {

        wp_enqueue_style( 'cleaninglight-fonts', cleaninglight_fonts_url(), array(), null );
		
		cleaninglight_themes_dynamic_fonts();

		wp_enqueue_script(
            'owl-carousel',
            get_template_directory_uri() . '/assets/library/owlcarousel/js/owl.carousel.js',
            array( 'jquery' ),
            '2.3.4',
            true
        );

		wp_enqueue_script(
            'prettyphoto',
            get_template_directory_uri() . '/assets/library/prettyphoto/js/jquery.prettyPhoto.js',
            array( 'jquery' ),
            '3.1.6',
            true
        );

		wp_enqueue_script(
            'isotope',
            get_template_directory_uri() . '/assets/js/isotope.pkgd.js',
            array( 'jquery', 'imagesloaded' ),
            '2.0.0',
            true
        );

		wp_enqueue_script(
            'skip-link-focus-fix',
            get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js',
            array(),
            '20151215',
            true
        );

		/** Load Leaflet JS/CSS only if enabled */
		if ( get_theme_mod( 'cleaninglight_contact_section_disable', 'enable' ) === 'enable' ) {

			wp_enqueue_script(
				'leaflet',
				get_template_directory_uri() . '/assets/library/leaflet.js',
				array(),
				'1.9.4',
				true
			);

			wp_enqueue_style(
				'leaflet',
				get_template_directory_uri() . '/assets/library/leaflet.css',
				array(),
				'1.9.4'
			);
		}

		wp_enqueue_script(
            'cleaninglight-custom',
            get_template_directory_uri() . '/assets/js/cleaninglight.js',
            array( 'jquery' ),
            CLEANINGLIGHT_VERSION,
            true
        );
        
        wp_localize_script(
            'cleaninglight-custom',
            'cleaninglight_options',
            array(
                'rtl'               => is_rtl() ? 'true' : 'false',
                'customize_preview' => is_customize_preview() ? 'true' : 'false',
            )
        );

		// Styles
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/library/owlcarousel/css/owl.carousel.css' );
		wp_enqueue_style( 'prettyphoto', get_template_directory_uri() . '/assets/library/prettyphoto/css/prettyPhoto.css' );
		wp_enqueue_style( 'cleaninglight-style', get_stylesheet_uri() );
		wp_enqueue_style( 'cleaninglight-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'cleaninglight_themes_scripts' );

if ( ! function_exists( 'cleaninglight_themes_admin_scripts' ) ) {
    function cleaninglight_themes_admin_scripts() {
		cleaninglight_themes_dynamic_fonts();
		wp_enqueue_style('cleaninglight-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), CLEANINGLIGHT_VERSION);
    }
}
add_action('admin_enqueue_scripts', 'cleaninglight_themes_admin_scripts');
add_action('elementor/editor/before_enqueue_scripts', 'cleaninglight_themes_admin_scripts');


function cleaninglight_themes_front_page_set( $template ) {

    $cleaninglight_front_page = get_theme_mod( 'cleaninglight_enable_frontpage' ,'disable' );

    if( !in_array($cleaninglight_front_page, array('enable', '1'))){

        if ( 'posts' == get_option( 'show_on_front' ) ) {

            include( get_home_template() );

        } else {

            include( get_page_template() );

        }
    }
}
add_filter( 'cleaninglight_themes_enable_front_page', 'cleaninglight_themes_front_page_set' );


if(!function_exists('cleaninglight_themes_register_block_patterns')){

	function cleaninglight_themes_register_block_patterns() {

		$patterns = array();

		$block_pattern_categories = array(
			'cleaninglight' => array( 'label' => esc_html__( 'Theme Pattern', 'cleaning-light' ) ),
		);

		$block_pattern_categories = apply_filters( 'cleaninglight_themes_register_block_patterns', $block_pattern_categories );

		foreach ( $block_pattern_categories as $name => $properties ) {

			if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {

				register_block_pattern_category( $name, $properties );

			}
		}

		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => esc_html__( 'Check Mark', 'cleaning-light' ),
				'inline_style' => '
				.is-style-checkmark-list .block-editor-block-list__block{
					display: flex;
					align-items: center;
				}
				.is-style-checkmark-list .block-editor-block-list__block:before{
					color: var(--wp--preset--color--primary);
				}
				.editor-styles-wrapper ol.is-style-checkmark-list, 
				.editor-styles-wrapper ul.is-style-checkmark-list,
				ol.is-style-checkmark-list,
				ul.is-style-checkmark-list{
					padding: 0;
				}
				.is-style-checkmark-list li{
					margin-bottom: 5px;
					list-style: none;
					display: flex;
					align-items: center;
				}
				.is-style-checkmark-list li a{
					margin-left: 3px;
				}
				.is-style-checkmark-list li:before {
					content: "\f12a";
					font-family: "dashicons";
					color: var(--theme-color);
					margin-right: 5px;
				}',
			)
		);

		register_block_style(
			'core/list',
			array(
				'name'         => 'circle-list',
				'label'        => esc_html__( 'Circle List', 'cleaning-light' ),
				'inline_style' => '
				.is-style-circle-list .block-editor-block-list__block{
					display: flex;
					align-items: center;
				}
				.is-style-circle-list .block-editor-block-list__block:before{
					color: var(--wp--preset--color--primary);
				}
				.editor-styles-wrapper ol.is-style-circle-list, 
				.editor-styles-wrapper ul.is-style-circle-list,
				ol.is-style-circle-list,
				ul.is-style-circle-list{
					padding: 0;
				}
				.is-style-circle-list li{
					margin-bottom: 5px;
					list-style: none;
					display: flex;
					align-items: center;
				}
				.is-style-circle-list li a{
					margin-left: 3px;
				}
				.is-style-circle-list li:before {
					content: "\f159";
					font-family: "dashicons";
					color: var(--theme-color);
					margin-right: 5px;
				}',
			)
		);

		/** Button */
		register_block_style(
			'core/button',
			array(
				'name'         => 'primary-button',
				'label'        => esc_html__( 'Primary Button', 'cleaning-light' ),
				'inline_style' => '
				.wp-block-button .wp-block-button__link.is-style-outline, 
				.wp-block-button.is-style-outline>.wp-block-button__link {
					padding: 12px 30px;
					cursor: pointer;
				}
				.wp-block-button.is-style-primary-button .wp-block-button__link,
				.editor-styles-wrapper .is-style-primary-button.wp-block-button .wp-block-button__link {
					overflow: hidden;
					position: relative;
					z-index: 1;
					vertical-align: middle;
					padding-right:55px;
					cursor: pointer;
					background-color: var(--wp--preset--color--primary);
					color: var(--wp--preset--color--white);
					margin-right: 25px;
				}
				.is-style-primary-button .wp-block-button__link::after {
					content: "\f344";
					position: absolute;
					margin-left: 5px;
					font-family: "dashicons";
				}
				.wp-block-button.is-style-primary-button .wp-block-button__link:before,
				.editor-styles-wrapper .is-style-primary-button.wp-block-button .wp-block-button__link:before {
					content: "";
					position: absolute;
					z-index: -1;
					background-color: var(--wp--preset--color--black);
					left: auto;
					right: 0;
					top: 0;
					height: 100%;
					width: 0;
					-webkit-transition: all ease 0.4s;
					-o-transition: all ease 0.4s;
					transition: all ease 0.4s;
				}
				.wp-block-button.is-style-primary-button .wp-block-button__link:hover,
				.editor-styles-wrapper .is-style-primary-button.wp-block-button .wp-block-button__link:hover {
					color: var(--wp--preset--color--white);
				}
				.wp-block-button.is-style-primary-button .wp-block-button__link:hover:before,
				.editor-styles-wrapper .is-style-primary-button.wp-block-button .wp-block-button__link:hover:before {
					width: 101%;
					right: auto;
					left: 0;
				}',
			)
		);

		register_block_style(
			'core/button',
			array(
				'name'         => 'secondary-button',
				'label'        => esc_html__( 'Secondary Button', 'cleaning-light' ),
				'inline_style' => '
				.wp-block-button.is-style-secondary-button .wp-block-button__link,
				.editor-styles-wrapper .is-style-secondary-button.wp-block-button .wp-block-button__link {
					overflow: hidden;
					position: relative;
					z-index: 1;
					vertical-align: middle;
					padding-right:55px;
					cursor: pointer;
					background-color: var(--wp--preset--color--white);
					color: var(--wp--preset--color--primary);
					border: 2px solid var(--wp--preset--color--primary);
					padding: 18px 55px 18px 30px;
				}
				.is-style-secondary-button .wp-block-button__link::after {
					content: "\f344";
					position: absolute;
					margin-left: 5px;
					font-family: "dashicons";
				}
				.wp-block-button.is-style-secondary-button .wp-block-button__link:before,
				.editor-styles-wrapper .is-style-secondary-button.wp-block-button .wp-block-button__link:before {
					content: "";
					position: absolute;
					z-index: -1;
					background-color: var(--wp--preset--color--primary);
					left: auto;
					right: 0;
					top: 0;
					height: 100%;
					width: 0;
					-webkit-transition: all ease 0.4s;
					-o-transition: all ease 0.4s;
					transition: all ease 0.4s;
				}
				.wp-block-button.is-style-secondary-button .wp-block-button__link:hover,
				.editor-styles-wrapper .is-style-secondary-button.wp-block-button .wp-block-button__link:hover {
					color: var(--wp--preset--color--white);
				}
				.wp-block-button.is-style-secondary-button .wp-block-button__link:hover:before,
				.editor-styles-wrapper .is-style-secondary-button.wp-block-button .wp-block-button__link:hover:before {
					width: 101%;
					right: auto;
					left: 0;
				}',
			)
		);

		register_block_style(
			'core/button',
			array(
				'name'         => 'no-border',
				'label'        => esc_html__( 'No Border', 'cleaning-light' ),
				'inline_style' => '
				.wp-block-button.is-style-no-border .wp-block-button__link,
				.editor-styles-wrapper .is-style-no-border.wp-block-button .wp-block-button__link {
					overflow: hidden;
					position: relative;
					z-index: 1;
					vertical-align: middle;
					cursor: pointer;
					background-color: transparent;
					color: var(--wp--preset--color--black);
					padding: 0 25px 0 0;
				}
				.is-style-no-border .wp-block-button__link::after {
					content: "\f344";
					position: absolute;
					margin-left: 5px;
					font-family: "dashicons";
				}
				.wp-block-button.is-style-no-border .wp-block-button__link:hover,
				.editor-styles-wrapper .is-style-no-border.wp-block-button .wp-block-button__link:hover {
					color: var(--wp--preset--color--primary);
				}',
			)
		);

		/** Read More */
		register_block_style(
			'core/read-more',
			array(
				'name'         => 'primary-button',
				'label'        => esc_html__( 'Primary Button', 'cleaning-light' ),
				'inline_style' => '
				.is-style-primary-button.wp-block-read-more{
					overflow: hidden;
					position: relative;
					z-index: 1;
					vertical-align: middle;
					padding: 15px 55px 15px 30px;
					border-radius: 5px;
					cursor: pointer;
					background: var(--wp--preset--color--primary);
					color: var(--wp--preset--color--white);
				}
				.is-style-primary-button.wp-block-read-more::after {
					content: "\f344";
					position: absolute;
					margin-left: 5px;
					font-family: "dashicons";
				}
				.is-style-primary-button.wp-block-read-more:before{
					content: "";
					position: absolute;
					z-index: -1;
					background-color: var(--wp--preset--color--black);
					left: auto;
					right: 0;
					top: 0;
					height: 100%;
					width: 0;
					-webkit-transition: all ease 0.4s;
					-o-transition: all ease 0.4s;
					transition: all ease 0.4s;
				}
				.is-style-primary-button.wp-block-read-more:hover{
					color: var(--wp--preset--color--white);
				}
				.is-style-primary-button.wp-block-read-more:hover:before{
					width: 101%;
					right: auto;
					left: 0;
				}',
			)
		);

		register_block_style(
			'core/read-more',
			array(
				'name'         => 'secondary-button',
				'label'        => esc_html__( 'Secondary Button', 'cleaning-light' ),
				'inline_style' => '
				.is-style-secondary-button.wp-block-read-more{
					overflow: hidden;
					position: relative;
					z-index: 1;
					padding: 12px 55px 12px 30px;
					border-radius: 5px;
					cursor: pointer;
					background-color: var(--wp--preset--color--white);
					color: var(--wp--preset--color--primary);
					border: 2px solid var(--wp--preset--color--primary);
				}
				.is-style-secondary-button.wp-block-read-more::after {
					content: "\f344";
					position: absolute;
					margin-left: 5px;
					font-family: "dashicons";
				}
				.is-style-secondary-button.wp-block-read-more:before {
					content: "";
					position: absolute;
					z-index: -1;
					background-color: var(--wp--preset--color--primary);
					left: auto;
					right: 0;
					top: 0;
					height: 100%;
					width: 0;
					-webkit-transition: all ease 0.4s;
					-o-transition: all ease 0.4s;
					transition: all ease 0.4s;
				}
				.is-style-secondary-button.wp-block-read-more:hover {
					color: var(--wp--preset--color--white);
				}
				.is-style-secondary-button.wp-block-read-more:hover:before {
					width: 101%;
					right: auto;
					left: 0;
				}',
			)
		);

		register_block_style(
			'core/read-more',
			array(
				'name'         => 'no-border',
				'label'        => esc_html__( 'No Border', 'cleaning-light' ),
				'inline_style' => '
				.is-style-no-border.wp-block-read-more{
					overflow: hidden;
					z-index: 1;
					vertical-align: middle;
					cursor: pointer;
					background-color: transparent;
					color: var(--wp--preset--color--black);
				}
				.is-style-no-border.wp-block-read-more::after {
					content: "\f344";
					position: absolute;
					margin-left: 5px;
					font-family: "dashicons";
				}
				.is-style-no-border.wp-block-read-more:hover {
					color: var(--wp--preset--color--primary);
				}',
			)
		);
	}
}
add_action( 'init', 'cleaninglight_themes_register_block_patterns', 9 );

if ( ! function_exists( 'cleaninglight_themes_editor_assets' ) ){
	function cleaninglight_themes_editor_assets() {
		wp_enqueue_style( 
			'cleaninglight-variations', 
			get_parent_theme_file_uri('assets/css/variations.css'),
			wp_get_theme()->get( 'Version' ),
			true
		);
	} 
}
add_action( 'enqueue_block_assets', 'cleaninglight_themes_editor_assets' );


require get_template_directory() . '/inc/init.php';

/**
 * Set Elementor globals when theme is activated
 */
function cleaninglight_set_elementor_globals() {
    // Check if already set
    if ( get_option( 'cleaninglight_elementor_globals_set' ) ) {
        return;
    }

    // Check if Elementor is active and loaded
    if ( ! class_exists( '\Elementor\Plugin' ) ) {
        return;
    }

    // Get Elementor instance
    $elementor = \Elementor\Plugin::$instance;
    
    // Check if kits manager is available
    if ( ! $elementor->kits_manager ) {
        return;
    }

    $active_kit = $elementor->kits_manager->get_active_kit();

    // Return if kit doesn't exist or is invalid
    if ( ! $active_kit || ! $active_kit->get_id() ) {
        return;
    }

    try {
        // Update the kit settings
        $active_kit->update_settings([
            'system_colors' => [
                [ '_id' => 'primary', 'title' => 'Primary', 'color' => '' ],
                [ '_id' => 'secondary', 'title' => 'Secondary', 'color' => '' ],
                [ '_id' => 'text', 'title' => 'Text', 'color' => '' ],
                [ '_id' => 'accent', 'title' => 'Accent', 'color' => '' ],
            ],
            'system_typography' => [
                [ '_id' => 'primary', 'title' => 'Primary', 'typography_typography' => 'custom', 'typography_font_family' => '' ],
                [ '_id' => 'secondary', 'title' => 'Secondary', 'typography_typography' => 'custom', 'typography_font_family' => '' ],
                [ '_id' => 'text', 'title' => 'Text', 'typography_typography' => 'custom', 'typography_font_family' => '' ],
                [ '_id' => 'accent', 'title' => 'Accent', 'typography_typography' => 'custom', 'typography_font_family' => '' ]
            ],
            'container_width' => [
                'unit' => 'px',
                'size' => 1280,
                'sizes' => [],
            ],
            'container_padding' => [
                'unit' => 'px',
                'top' => '0',
                'right' => '0',
                'bottom' => '0',
                'left' => '0',
                'isLinked' => false,
                'tablet' => [
                    'unit' => 'px',
                    'top' => '0',
                    'right' => '10',
                    'bottom' => '0',
                    'left' => '10',
                    'isLinked' => false,
                ],
                'mobile' => [
                    'unit' => 'px',
                    'top' => '0',
                    'right' => '10',
                    'bottom' => '0',
                    'left' => '10',
                    'isLinked' => false,
                ],
            ],
        ]);

        // Mark as set only after successful update
        update_option( 'cleaninglight_elementor_globals_set', true );
    } catch ( Exception $e ) {
        // Log error but don't crash
        error_log( 'Cleaning Light - Elementor globals error: ' . $e->getMessage() );
        return;
    }
}

/**
 * Reset Elementor globals to default values
 */
function cleaninglight_reset_elementor_globals() {
    // Check if Elementor is active and loaded
    if ( ! class_exists( '\Elementor\Plugin' ) ) {
        return;
    }

    $elementor = \Elementor\Plugin::$instance;
    
    if ( ! $elementor->kits_manager ) {
        return;
    }

    $active_kit = $elementor->kits_manager->get_active_kit();

    // Return if kit doesn't exist or is invalid
    if ( ! $active_kit || ! $active_kit->get_id() ) {
        return;
    }

    try {
        // Reset to Elementor default values
        $active_kit->update_settings([
            'system_colors' => [
                [ '_id' => 'primary', 'title' => 'Primary', 'color' => '#6EC1E4' ],
                [ '_id' => 'secondary', 'title' => 'Secondary', 'color' => '#54595F' ],
                [ '_id' => 'text', 'title' => 'Text', 'color' => '#7A7A7A' ],
                [ '_id' => 'accent', 'title' => 'Accent', 'color' => '#61CE70' ],
            ],
            'system_typography' => [
                [ '_id' => 'primary', 'title' => 'Primary', 'typography_typography' => 'custom', 'typography_font_family' => 'Roboto' ],
                [ '_id' => 'secondary', 'title' => 'Secondary', 'typography_typography' => 'custom', 'typography_font_family' => 'Roboto Slab' ],
                [ '_id' => 'text', 'title' => 'Text', 'typography_typography' => 'custom', 'typography_font_family' => 'Roboto' ],
                [ '_id' => 'accent', 'title' => 'Accent', 'typography_typography' => 'custom', 'typography_font_family' => 'Roboto' ]
            ],
            'container_width' => [
                'unit' => 'px',
                'size' => 1140,
                'sizes' => [],
            ],
            'container_padding' => [
                'unit' => 'px',
                'top' => '20',
                'right' => '20',
                'bottom' => '20',
                'left' => '20',
                'isLinked' => true,
            ],
        ]);
    } catch ( Exception $e ) {
        error_log( 'Cleaning Light - Elementor reset error: ' . $e->getMessage() );
        return;
    }
}

/**
 * Handle theme activation
 */
function cleaninglight_on_theme_activation() {
    // Delete the flag so globals will be set again
    delete_option( 'cleaninglight_elementor_globals_set' );
    
    // Try to set globals immediately if Elementor is already loaded
    if ( did_action( 'elementor/loaded' ) ) {
        cleaninglight_set_elementor_globals();
    }
}

/**
 * Handle theme switch (when switching away from this theme)
 */
function cleaninglight_on_theme_switch() {
    // Reset globals when switching away from this theme
    if ( did_action( 'elementor/loaded' ) ) {
        cleaninglight_reset_elementor_globals();
    }
    
    // Clean up options
    delete_option( 'cleaninglight_elementor_globals_set' );
}

// Hook into theme activation
add_action( 'after_switch_theme', 'cleaninglight_on_theme_activation' );

// Hook into theme switch (when switching away)
add_action( 'switch_theme', 'cleaninglight_on_theme_switch' );

// Set globals when Elementor is initialized (with lower priority to ensure kit is ready)
add_action( 'elementor/init', 'cleaninglight_set_elementor_globals', 20 );

// Fallback: try to set globals on admin_init if not already set
add_action( 'admin_init', function() {
    if ( ! get_option( 'cleaninglight_elementor_globals_set' ) ) {
        cleaninglight_set_elementor_globals();
    }
}, 20 );

// Additional fallback: set globals when Elementor is fully loaded
add_action( 'elementor/loaded', function() {
    // Delay to ensure everything is ready
    add_action( 'wp_loaded', function() {
        if ( ! get_option( 'cleaninglight_elementor_globals_set' ) ) {
            cleaninglight_set_elementor_globals();
        }
    }, 20 );
}, 20 );