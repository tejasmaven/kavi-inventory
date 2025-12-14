<?php 

get_header();

do_action( 'cleaninglight_themes_enable_front_page' );

$enable_front_page = get_theme_mod( 'cleaninglight_enable_frontpage', 'disable' );

if ( $enable_front_page === 'enable' || $enable_front_page === true ) {
    
    $cleaninglight_home_sections = cleaninglight_themes_homepage_section();
    
    if ( is_array( $cleaninglight_home_sections ) && ! empty( $cleaninglight_home_sections ) ) {
        foreach ( $cleaninglight_home_sections as $cleaninglight_homepage_section ) {
            $cleaninglight_homepage_section = str_replace( 'cleaninglight_', '', $cleaninglight_homepage_section );
            $cleaninglight_homepage_section = str_replace( '_section', '', $cleaninglight_homepage_section );
            
            get_template_part( 'section/section', $cleaninglight_homepage_section );
        }
    }
}

get_footer();