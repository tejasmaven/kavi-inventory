<?php
/**
 * @package Ikreate Themes
 */
$header_class = array('site-header', 'headerthree', 'headroom', 'hover-style1');

?>
<header id="masthead" class="<?php echo esc_attr(implode(' ', $header_class)); ?>">
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