<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    
<?php wp_body_open(); ?>

<?php do_action('cleaninglight_themes_before_page'); ?>

<div id="page" class="site">

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cleaning-light' ); ?></a>
    <?php
        $headerlayout = get_theme_mod('cleaninglight_header_layout','layout_one');

        if($headerlayout == 'layout_one'){
            
            get_template_part('header/header', 'one');

        }else if($headerlayout == 'layout_two'){

            get_template_part('header/header', 'two');

        }else if($headerlayout == 'layout_three'){

            get_template_part('header/header', 'three');

        }else{ 

            get_template_part('header/header', 'one');
        }
        
        if( is_front_page() ){ 
            $bannerslider = get_theme_mod('cleaninglight_banner_slider_section', 'enable');
            if ($bannerslider == 'enable') {
                do_action('cleaninglight_themes_slider_type');
            }
        }
    ?>
    <?php
        $breadcrumbs_enable = get_theme_mod('cleaninglight_breadcrumb_option', 'enable');
        if ($breadcrumbs_enable == 'enable') {
            if (!is_front_page() && !is_home()) {
                do_action('cleaninglight_themes_breadcrumbs');
            }
        }
    ?>
	<div id="content" class="site-content">