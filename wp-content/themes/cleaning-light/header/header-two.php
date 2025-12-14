<?php
/**
 * @package Ikreate Themes
 */
$header_class = array('site-header', 'headertwo', 'headroom', 'hover-style1');

?>
<header id="masthead" class="<?php echo esc_attr(implode(' ', $header_class)); ?>">
	<?php
		$top_header_class = get_theme_mod('cleaninglight_top_header_hide_show', json_encode(array(
			'desktop' => 'show',
			'tablet' => 'show',
			'mobile' => 'hide'
		)));
		$top_class = cleaninglight_themes_alignment_class($top_header_class);
	?>
	<div class="top-menu-bar <?php echo esc_attr($top_class); ?>">
		<div class="container">
			<div class="inner-row d-flex">
				<div class="top-bar-menu left">
					<?php
						$topheaderleft = get_theme_mod( 'cleaninglight_topheader_left', 'free_hand' );
						if($topheaderleft == 'quick_contact'){    
							cleaninglight_themes_quick_contact();
						}else if($topheaderleft == 'free_hand'){    
							cleaninglight_themes_topheader_free_hand();
						}else if($topheaderleft == 'top_menu'){
							if ( has_nav_menu( 'top' ) ) {
								wp_nav_menu( array(
									'theme_location' => 'top',
									'depth' => 1
								) );
							} else {
								wp_page_menu();
							}
						}
						if(!in_array($topheaderleft, array('quick_contact','top_menu'))) {
							echo apply_filters( 'cleaninglight_topheader_left_empty', '' );
						}
					?>
				</div>
				<div class="top-bar-menu right">
					<?php
						$topheaderright = get_theme_mod( 'cleaninglight_topheader_right', 'social_media' );
						if($topheaderright == 'social_media'){    
							cleaninglight_themes_topheader_social();
						}else if($topheaderright == 'top_menu'){
							if ( has_nav_menu( 'top' ) ) {
								wp_nav_menu( array(
									'theme_location' => 'top',
									'depth' => 1
								) );
							} else {
								wp_page_menu();
							}
						}
						if(!in_array($topheaderright, array('social_media','top_menu'))) {
							echo apply_filters( 'cleaninglight_topheader_right_empty', '' );
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="nav-classic">
		<div class="nav-menu">
			<div class="container">
				<div class="nav-inner-wrap">
					<?php
						cleaninglight_themes_header_logo();
					?>
					<nav class="box-header-nav main-menu-wapper" aria-label="<?php esc_attr_e( 'Main Menu', 'cleaning-light' ); ?>" role="navigation">
						<?php
							if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'container'       => '',
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'main-menu',
								) );
							} else {
								wp_page_menu( array(
									'menu_class' => 'main-menu',
								) );
							}
						?>
					</nav>
					<?php do_action('cleaninglight_themes_nav_buttons'); ?>
				</div>
			</div>
		</div>
	</div>
</header>