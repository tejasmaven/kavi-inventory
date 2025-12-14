<?php

function cleaninglight_themes_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_control('header_textcolor')->section = "title_tagline";
	
	$wp_customize->get_section( 'static_front_page' )->title 	= esc_html__('Enable (Home) Front Page', 'cleaning-light');
	$wp_customize->get_section( 'static_front_page' )->priority = 12;

	
	$wp_customize->register_control_type('Cleaninglight_Custom_Control_Tab');
	$wp_customize->register_control_type('Cleaninglight_Background_Control');
    $wp_customize->register_control_type('Cleaninglight_Range_Slider_Control');
    $wp_customize->register_control_type('Cleaninglight_Sortable_Control');
    $wp_customize->register_control_type('Cleaninglight_Custom_Control_Buttonset');
	$wp_customize->register_section_type('Cleaninglight_Toggle_Section');
	$wp_customize->register_section_type('Cleaninglight_Themes_Upgrade_Section');

	// Register custom section types.
	$wp_customize->register_section_type( 'Cleaninglight_Themes_Customize_Section' );
	$wp_customize->add_section(
		new Cleaninglight_Themes_Customize_Section(
			$wp_customize,
			'cleaninglight-info',
			array(
				// 'title' => esc_html__('35% Off Use Coupon Code : NEW2023 Validity : DEC 26 - JAN 10', 'cleaning-light'),
				'pro_text' => esc_html__( 'Upgrade To Pro','cleaning-light' ),
				'pro_url'  => apply_filters('cleaninglight-link', esc_url('https://ikreatethemes.com/wordpress-theme/cleaning-wordpress-theme/') ),
				'priority'  => -1,
			)
		)
	);
	
    require get_template_directory() . '/inc/customizer/customizer-panel/social-settings.php';
    require get_template_directory() . '/inc/customizer/customizer-panel/quick-info.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/footer.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/colors.php';
	
	$wp_customize->add_setting('cleaninglight_enable_frontpage', array(
        'default' => 'disable',
        'sanitize_callback' => 'cleaninglight_themes_sanitize_switch',  
    ));
    $wp_customize->add_control(new Cleaninglight_Switch_Control($wp_customize, 'cleaninglight_enable_frontpage', array(
        'label' => esc_html__('Enable FrontPage', 'cleaning-light'),
        'settings' => 'cleaninglight_enable_frontpage',
		'description' => sprintf(esc_html__('Overwrites the homepage displays setting and shows the frontpage for Customizer %s', 'cleaning-light'), '<a href="javascript:wp.customize.panel(\'cleaninglight_frontpage_settings\').focus()">' . esc_html__('Front Page Sections', 'cleaning-light') . '</a>') . '<br/><br/>' . esc_html__('Do not enable this option if you want to use Elementor in home page.', 'cleaning-light'),
        'section' => 'static_front_page',
        'switch_label' => array(
            'enable' => esc_html__('On', 'cleaning-light'),
            'disable' => esc_html__('Off', 'cleaning-light'),
        ),
    )));
    
    
	$pages = array();
	$pages_obj = get_pages();
	$pages[''] = esc_html__('Select Page', 'cleaning-light');
	foreach ($pages_obj as $page) {
	    $pages[$page->ID] = $page->post_title;
	}
	$blog_cat = cleaninglight_themes_post_category();
	
	$wp_customize->add_panel('cleaninglight_header_settings', array(
		'title'		=>	esc_html__('Header Settings','cleaning-light'),
		'priority'	=>	10,
	));

	$wp_customize->get_section( 'title_tagline' )->panel = 'cleaninglight_header_settings';


	$wp_customize->add_setting('cleaninglight_pro_title_tagline', array(
		'sanitize_callback' => 'cleaninglight_sanitize_text'
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_title_tagline', array(
		'section' => 'title_tagline',
		'label' => esc_html__('For More Settings,', 'cleaning-light'),
		'choices' => array(
			esc_html__('Title, Tagline & Logo Alignment', 'cleaning-light'),
			esc_html__('Title, Tagline Color Options', 'cleaning-light')
		),
		'priority' => 250,
	)));


	/** Page Sidebar */
	$wp_customize->add_section('cleaninglight_sidebar', array(
		'title'		=>	esc_html__('Page Sidebar Settings','cleaning-light'),
		'panel'		=> 'cleaninglight_general_settings_panel',
	));

	$wp_customize->add_setting('cleaninglight_page_sidebar', array(
		'default' => 'no',
		'sanitize_callback' => 'cleaninglight_themes_sanitize_options'
	));
	$wp_customize->add_control(new Cleaninglight_Selector($wp_customize, 'cleaninglight_page_sidebar', array(
		'section' => 'cleaninglight_sidebar',
		'label' => esc_html__('Page Layout Setting', 'cleaning-light'),
		'options' => array(
			'no' => get_template_directory_uri() . '/inc/customizer/images/no-sidebar.png',
			'left' => get_template_directory_uri() . '/inc/customizer/images/left-sidebar.png',
			'right' => get_template_directory_uri() . '/inc/customizer/images/right-sidebar.png',
		)
	)));

	/** Upgrade Pro Version */
	$wp_customize->add_setting('cleaninglight_pro_upgrade_sidebar_sticky', array(
		'sanitize_callback' => 'cleaninglight_sanitize_text'
	));
	$wp_customize->add_control(new Cleaninglight_Themes_Upgrade_Text($wp_customize, 'cleaninglight_pro_upgrade_sidebar_sticky', array(
		'section' => 'cleaninglight_sidebar',
		'label' => esc_html__('For More Settings,', 'cleaning-light'),
		'choices' => array(
			esc_html__('Sticky widget sidebar options', 'cleaning-light'),
		),
		'priority' => 250,
	)));
	
	require get_template_directory() . '/inc/customizer/customizer-panel/general-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/top-header.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/header.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/header-cta.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/blog.php';
	
	$wp_customize->add_panel('cleaninglight_frontpage_settings', array(
		'title'		=>	esc_html__('Home Section','cleaning-light'),
		'priority'	=>	35,
		'description' => esc_html__('Drag and Drop to Reorder', 'cleaning-light'). '<img class="cleaninglight_light-drag-spinner" src="'.admin_url('/images/spinner.gif').'">',
	));

	require get_template_directory() . '/inc/customizer/customizer-panel/home/common-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-slider-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-about-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-promoservices-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-cta-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-services-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-counter-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-video-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-recentwork-settings.php';
	//require get_template_directory() . '/inc/customizer/customizer-panel/home/home-howitworks-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-testimonial-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-team-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-client-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-blog-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-customa-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/home-contact-settings.php';
	require get_template_directory() . '/inc/customizer/customizer-panel/home/breadcrumb.php';	

	/****** Upgrade Pro in Front Page Section */
	$wp_customize->add_section(new Cleaninglight_Themes_Upgrade_Section($wp_customize, 'cleaninglight-frontpage-notice', array(
		'title' => sprintf(esc_html__('Important! Home Page Sections are not enabled. Enable it %1shere%2s.', 'cleaning-light'), '<a href="javascript:wp.customize.section( \'static_front_page\' ).focus()">', '</a>'),
		'priority' => -1,
		'class' => 'ikthemes-enable-front',
		'panel' => 'cleaninglight_frontpage_settings',
	)));

	$wp_customize->add_section(new Cleaninglight_Themes_Upgrade_Section($wp_customize, 'cleaninglight_frontpage_upgrade_pro_section', array(
		'title' => esc_html__('More Sections on Premium', 'cleaning-light'),
		'panel' => 'cleaninglight_frontpage_settings',
		'priority' => 500,
		'class' => 'ikthemes-upgrade-boxed',
		'options' => array(
			esc_html__('- All above section with more styles and customization options', 'cleaning-light'),
			esc_html__('- Multiple Services Layouts', 'cleaning-light'),
			esc_html__('- News and Events Section', 'cleaning-light'),
			esc_html__('- Free Hand Text (HTML)', 'cleaning-light'),
			esc_html__('- Highlight Section', 'cleaning-light'),
			esc_html__('- How It Works Section', 'cleaning-light'),
			esc_html__('- Portfolio Section', 'cleaning-light'),
			esc_html__('- WooCommerce Section', 'cleaning-light'),
			esc_html__('- Pricing Table Section', 'cleaning-light'),
			esc_html__('- Tab Section', 'cleaning-light'),
			esc_html__('- Custom Section B', 'cleaning-light'),
			esc_html__('- 40+ Elementor Widgets', 'cleaning-light'),
			esc_html__('- Advanced Typography Settings', 'cleaning-light'),
			esc_html__('----------------------------------------------- Many More Sections ---------', 'cleaning-light'),
			esc_html__('All the above sections can be created with Elementor block page builder or customizer whichever you prefer.', 'cleaning-light'),
		),
		'upgrade_text' => esc_html__('Upgrade to Pro', 'cleaning-light'),
		'upgrade_url' => apply_filters('cleaninglight-link', esc_url('https://ikreatethemes.com/wordpress-theme/cleaning-wordpress-theme/') ),
	)));
}
add_action( 'customize_register', 'cleaninglight_themes_customize_register' );


add_action( 'customize_controls_print_scripts', 'cleaninglight_themes_customizer_dynamic_script', 30 );
function cleaninglight_themes_customizer_dynamic_script(){ ?>
	<script type="text/javascript">
		jQuery( function( $ ) {
			wp.customize.panel( 'cleaninglight_frontpage_settings', function( section ) {
				section.expanded.bind( function( isExpanded ) {
					if ( isExpanded ) {
						wp.customize.previewer.previewUrl.set( '<?php echo esc_js( home_url('/') ); ?>' );
					}
				} );
			} );
		} );
	</script>

	<?php
}


function cleaninglight_themes_customize_partial_blogname() {
	bloginfo( 'name' );
}

function cleaninglight_themes_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.6
 *
 */
function cleaninglight_themes_customize_preview_js() {

	wp_enqueue_script( 'cleaninglight-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'cleaninglight_themes_customize_preview_js' );



 if ( ! function_exists( 'cleaninglight_themes_customize_scripts' ) ){

	function cleaninglight_themes_customize_scripts() {
		wp_enqueue_script('wp-color-picker-alpha', get_template_directory_uri() . '/inc/customizer/js/wp-color-picker-alpha.js', array('jquery', 'wp-color-picker'), true);
		$color_picker_strings = array(
			'clear' => __('Clear', 'cleaning-light'),
			'clearAriaLabel' => __('Clear color', 'cleaning-light'),
			'defaultString' => __('Default', 'cleaning-light'),
			'defaultAriaLabel' => __('Select default color', 'cleaning-light'),
			'pick' => __('Select Color', 'cleaning-light'),
			'defaultLabel' => __('Color value', 'cleaning-light'),
		);
		wp_localize_script('wp-color-picker-alpha', 'wpColorPickerL10n', $color_picker_strings);
		wp_enqueue_script('cleaninglight-customizer', get_template_directory_uri() . '/inc/customizer/js/customizer-admin.js', array('jquery', 'customize-controls'), true);
		wp_enqueue_script('cleaninglight-customizer-script', get_template_directory_uri() . '/inc/customizer/js/customizer-controls.js', array('jquery', 'wp-color-picker', 'jquery-ui-datepicker'), true);
		wp_enqueue_style('cleaninglight-customizer-style', get_template_directory_uri() . '/inc/customizer/css/customizer-controls.css', array('wp-color-picker'));
	}
}
add_action('customize_controls_enqueue_scripts', 'cleaninglight_themes_customize_scripts');

require get_template_directory() . '/inc/customizer/customizer-control-class.php';
require get_template_directory() . '/inc/customizer/customizer-sanitization.php';


function cleaninglight_themes_sections_reorder() {
    if (isset($_POST['sections'])) {
        set_theme_mod('cleaninglight_frontpage_sections', $_POST['sections']);
    }
    wp_die();
}
add_action('wp_ajax_cleaninglight_sections_reorder', 'cleaninglight_themes_sections_reorder');

function cleaninglight_themes_get_section_position($key) {
    $sections = cleaninglight_themes_homepage_section();
    $position = array_search($key, $sections);
    $return = ( $position + 1 ) * 15;
    return $return;
}

if( !function_exists('cleaninglight_themes_homepage_section') ){
	function cleaninglight_themes_homepage_section(){
		$defaults = apply_filters('cleaninglight_homepage_sections',
			array(
				'cleaninglight_aboutus_section',
				'cleaninglight_promoservice_section',
				'cleaninglight_calltoaction_section',
				'cleaninglight_service_section',
				'cleaninglight_counter_section',
				'cleaninglight_video_calltoaction_section',
				'cleaninglight_recentwork_section',
				'cleaninglight_testimonial_section',
				'cleaninglight_team_section',
				'cleaninglight_client_section',
				'cleaninglight_blog_section',
				'cleaninglight_customa_section',
				'cleaninglight_contact_section',
			)
		);
		$sections = get_theme_mod('cleaninglight_frontpage_sections', $defaults);
        return $sections;
	}
}