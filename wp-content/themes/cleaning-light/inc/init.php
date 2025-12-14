<?php
require get_theme_file_path('inc/themes-functions.php');

require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/customizer/customizer.php';

require get_template_directory() .'/inc/customizer/typography.php';

require get_template_directory() . '/inc/breadcrumbs/breadcrumbs.php';

require get_template_directory() . '/inc/dynamic-css.php';

require get_template_directory() . '/inc/dynamic.php';

require get_template_directory() . '/inc/mobile-menu/init.php';

/* Include the TGM_Plugin_Activation class. */
get_template_part( 'inc/libs/class-tgm-plugin-activation' );

/* Welcome Page */
require get_template_directory() . '/inc/welcome/welcome.php';

/* Elementor Elements */
if (defined('ELEMENTOR_VERSION')) {
    require get_template_directory() . '/inc/elements/elements.php';
}

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}