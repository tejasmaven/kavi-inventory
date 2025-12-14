<?php
/**
 * Theme Functions
 *
 * @package Cleaning Light
 */

if ( ! function_exists( 'cleaninglight_themes_section_title' ) ) {
	/**
	 * Display section title
	 *
	 * @param string $super_title Super title text.
	 * @param string $title Title text.
	 * @param string $titlestyle Title style class.
	 * @param string $designstyle Design style class.
	 * @return void
	 */
	function cleaninglight_themes_section_title( $super_title, $title, $titlestyle, $designstyle ) {

		$title_class = array(
			'section-title-wrapper',
			$titlestyle,
			$designstyle,
		);

		if ( ! empty( $super_title ) || ! empty( $title ) ) {
			?>

			<div class="<?php echo esc_attr( implode( ' ', $title_class ) ); ?>">
				<div class="titlewrap">
					<?php if ( ! empty( $super_title ) ) { ?>
						<span class="super-title"><?php echo esc_html( $super_title ); ?></span>
					<?php } ?>

					<?php if ( ! empty( $title ) ) { ?>
						<h2 class="section-title"><?php echo esc_html( $title ); ?></h2>
					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'cleaninglight_themes_header_logo' ) ) {
	/**
	 * Display header logo
	 *
	 * @return void
	 */
	function cleaninglight_themes_header_logo() {
		?>
		<div class="site-branding">
			<div class="site-brandinglogo">
				<?php the_custom_logo(); ?>
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
				<?php else : ?>
					<p class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</p>
				<?php endif; ?>
				<?php
				$cleaninglight_description = get_bloginfo( 'description', 'display' );
				if ( $cleaninglight_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo esc_html( $cleaninglight_description ); ?></p>
				<?php endif; ?>
			</div>
			<button class="header-nav-toggle" data-toggle-target=".header-mobile-menu" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
				<div class="cleaninglight-menu-modal">
					<span class="cleaninglight-icon-bar"></span>
					<span class="cleaninglight-icon-bar"></span>
					<span class="cleaninglight-icon-bar"></span>
				</div>
			</button>
		</div>

		<?php
	}
}

if ( ! function_exists( 'cleaninglight_themes_home_post_meta' ) ) {
	/**
	 * Display home post meta
	 *
	 * @return void
	 */
	function cleaninglight_themes_home_post_meta() {

		$postauthor = get_theme_mod( 'cleaninglight_home_post_author_options', 'enable' );
		$date       = get_theme_mod( 'cleaninglight_home_post_date_options', 'enable' );
		$read_time  = get_theme_mod( 'cleaninglight_home_post_reading_time', 'enable' );

		if ( 'enable' === $date || 'enable' === $postauthor || 'enable' === $read_time ) :
			?>
			<div class="entry-meta info">
				<?php
				if ( ! empty( $postauthor ) && 'enable' === $postauthor ) {
					cleaninglight_themes_posted_by();
				}
				if ( ! empty( $date ) && 'enable' === $date ) {
					cleaninglight_themes_posted_on();
				}
				if ( ! empty( $read_time ) && 'enable' === $read_time ) {
					echo wp_kses_post( cleaninglight_themes_estimated_reading_time() );
				}
				?>
			</div>
			<?php
		endif;
	}
}
add_action( 'cleaninglight_themes_home_post_meta', 'cleaninglight_themes_home_post_meta', 10 );

if ( ! function_exists( 'cleaninglight_themes_post_meta' ) ) {
	/**
	 * Display post meta
	 *
	 * @return void
	 */
	function cleaninglight_themes_post_meta() {

		$postdate    = get_theme_mod( 'cleaninglight_post_date_options', 'enable' );
		$postcomment = get_theme_mod( 'cleaninglight_post_comments_options', 'enable' );
		$postauthor  = get_theme_mod( 'cleaninglight_post_author_options', 'enable' );
		$read_time   = get_theme_mod( 'cleaninglight_post_reading_time', 'enable' );

		if ( 'enable' === $postdate || 'enable' === $postcomment || 'enable' === $postauthor || 'enable' === $read_time ) :
			?>
			<div class="entry-meta info">
				<?php
				if ( ! empty( $postauthor ) && 'enable' === $postauthor ) {
					cleaninglight_themes_posted_by();
				}

				if ( ! empty( $postdate ) && 'enable' === $postdate ) {
					cleaninglight_themes_posted_on();
				}

				if ( is_singular() ) {
					if ( ! empty( $postcomment ) && 'enable' === $postcomment ) {
						cleaninglight_themes_comments();
					}
				}

				if ( ! empty( $read_time ) && 'enable' === $read_time ) {
					echo wp_kses_post( cleaninglight_themes_estimated_reading_time() );
				}
				?>
			</div>
			<?php
		endif;
	}
}
add_action( 'cleaninglight_themes_post_meta', 'cleaninglight_themes_post_meta', 10 );

if ( ! function_exists( 'cleaninglight_themes_post_format_media' ) ) {
	/**
	 * Display post format media
	 *
	 * @return void
	 */
	function cleaninglight_themes_post_format_media() {

		if ( is_singular() ) {
			$imagesize = 'large';
		} else {
			$imagesize = 'post-thumbnail';
		}

		if ( has_post_thumbnail() ) {
			?>
			<div class="blog-post-thumbnail">
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail( $imagesize ); ?>
				</a>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'cleaninglight_themes_top_footer_content' ) ) {
	/**
	 * Display top footer content
	 *
	 * @return void
	 */
	function cleaninglight_themes_top_footer_content() {
		?>
		<footer id="footer-section" class="footer-section section site-footer">
			<div class="container">
				<div class="d-grid <?php echo esc_attr( get_theme_mod( 'cleaninglight_footer_column', 'd-grid-column-3' ) ); ?>">
					<?php
					for ( $i = 1; $i <= 4; $i++ ) {
						if ( is_active_sidebar( 'footer-' . $i ) ) {
							dynamic_sidebar( 'footer-' . $i );
						}
					}
					?>
				</div>
			</div>
		</footer>
		<?php
	}
}
add_action( 'cleaninglight_themes_top_footer_content', 'cleaninglight_themes_top_footer_content' );

if ( ! function_exists( 'cleaninglight_themes_footer_copyright' ) ) {
	/**
	 * Display footer copyright
	 *
	 * @return void
	 */
	function cleaninglight_themes_footer_copyright() {

		echo esc_html(
			apply_filters(
				'cleaninglight_themes_footer_copy_right',
				$content = esc_html__( '&copy; Copyright ', 'cleaning-light' ) . date_i18n( 'Y' ) . ' '
			)
		);
		printf(
			/* translators: %s: Developer link */
			esc_html__( 'All Rights Reserved. Developed by %s', 'cleaning-light' ),
			'<a href="' . esc_url( 'https://ikreatethemes.com/' ) . '" rel="designer" target="_blank">' . esc_html__( 'Ikreate Themes', 'cleaning-light' ) . '</a>'
		);
	}
}
add_action( 'cleaninglight_themes_copyright', 'cleaninglight_themes_footer_copyright', 5 );

if ( ! function_exists( 'cleaninglight_themes_nav_buttons' ) ) {
	/**
	 * Display navigation buttons
	 *
	 * @return void
	 */
	function cleaninglight_themes_nav_buttons() {
		?>
		<div class="nav-buttons">
			<?php if ( 'enable' === get_theme_mod( 'cleaninglight_enable_search', 'enable' ) ) { ?>
				<div class="menu-item-search">
					<a class="searchicon" href="javascript:void(0)">
						<i class="fas fa-search"></i>
					</a>
				</div>
			<?php } ?>

			<?php if ( 'enable' === get_theme_mod( 'cleaninglight_header_button_enable', 'enable' ) ) { ?>
				<div class="menu-item-button">
					<?php cleaninglight_themes_header_button(); ?>
				</div>
			<?php } ?>
		</div>
		<?php
	}
}
add_action( 'cleaninglight_themes_nav_buttons', 'cleaninglight_themes_nav_buttons' );

/**
 * Enqueue admin (custom-editor-style) styles.
 *
 * @return void
 */
function cleaninglight_themes_admin_editor_style() {

	add_editor_style(
		get_stylesheet_directory_uri() . '/custom-editor-style.css',
		array(),
		wp_date( 'Ymd-Gis', filemtime( get_theme_file_path( 'style.css' ) ) )
	);

}
add_action( 'admin_init', 'cleaninglight_themes_admin_editor_style' );

if ( ! function_exists( 'cleaninglight_themes_contact_info_section' ) ) {
	/**
	 * Display contact info section
	 *
	 * @return void
	 */
	function cleaninglight_themes_contact_info_section() {

		$details = get_theme_mod( 'cleaninglight_contact_details' );
		$details = json_decode( $details, true );

		if ( is_array( $details ) && count( $details ) > 0 ) :
			?>
			<div class="get-touch-contact">
				<?php
				foreach ( $details as $contact ) :
					if ( empty( $contact['icon'] ) && empty( $contact['label'] ) && empty( $contact['description'] ) ) {
						continue;
					}
					?>
					<div class="get-touch">
						<?php if ( ! empty( $contact['icon'] ) ) : ?>
							<div class="get-touch-icon">
								<i class="<?php echo esc_attr( $contact['icon'] ); ?>"></i>
							</div>
						<?php endif; ?>
						<div class="get-tuch-info">
							<?php if ( ! empty( $contact['label'] ) ) : ?>
								<h3 class="get-tuch-title"><?php echo esc_html( $contact['label'] ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $contact['description'] ) ) : ?>
								<p><?php echo esc_html( $contact['description'] ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<?php
		endif;
	}
}
add_action( 'cleaninglight_themes_contact_info_section', 'cleaninglight_themes_contact_info_section' );

if ( ! function_exists( 'cleaninglight_themes_quick_contact' ) ) :
	/**
	 * Display quick contact info
	 *
	 * @return void
	 */
	function cleaninglight_themes_quick_contact() {
		?>
		<ul class="cleaninglight-quick-info">
			<?php
			$quick_content = get_theme_mod(
				'cleaninglight_top_header_quick_content',
				wp_json_encode(
					array(
						array(
							'icon'   => 'fa-solid fa-headset',
							'label'  => '',
							'val'    => '+01-555-555-5555',
							'enable' => 'enable',
						),
						array(
							'icon'   => 'fa-regular fa-envelope-open',
							'label'  => esc_html__( 'eMail :', 'cleaning-light' ),
							'val'    => 'example@example.com',
							'enable' => 'enable',
						),
						array(
							'icon'   => 'fas fa-map-marker-alt',
							'label'  => esc_html__( 'Address :', 'cleaning-light' ),
							'val'    => '123 Main Street, Springfield, USA',
							'enable' => 'enable',
						),
					)
				)
			);

			$quick_content = json_decode( $quick_content );

			if ( is_array( $quick_content ) ) {
				foreach ( $quick_content as $index => $quick ) {
					if ( ! ( 'on' === $quick->enable || 'enable' === $quick->enable ) ) {
						continue;
					}
					?>
					<li>  
						<?php if ( ! empty( $quick->icon ) ) : ?>
							<i class="<?php echo esc_attr( $quick->icon ); ?>"></i>
						<?php endif; ?>

						<?php if ( ! empty( $quick->label ) ) : ?>
							<span class="quick-label"><?php echo esc_html( $quick->label ); ?></span>
						<?php endif; ?>
						
						<?php if ( ! empty( $quick->val ) ) : ?>
							<?php if ( filter_var( $quick->val, FILTER_VALIDATE_EMAIL ) ) { ?>
								<a href="mailto:<?php echo esc_attr( $quick->val ); ?>">
									<?php echo esc_html( $quick->val ); ?>
								</a>
							<?php } elseif ( preg_match( '/^\+?[0-9\-\(\)\s]+$/', $quick->val ) && 0 === $index ) { ?>
								<a href="tel:<?php echo esc_attr( preg_replace( '/\D+/', '', $quick->val ) ); ?>">
									<?php echo esc_html( $quick->val ); ?>
								</a>
							<?php } else { ?>
								<?php echo esc_html( $quick->val ); ?>
							<?php } ?>
						<?php endif; ?>
					</li>
					<?php
				}
			}
			?> 
		</ul>
		<?php
	}
endif;

if ( ! function_exists( 'cleaninglight_themes_quick_contact_info_header' ) ) :
	/**
	 * Display quick contact info in header
	 *
	 * @return void
	 */
	function cleaninglight_themes_quick_contact_info_header() {
		?>
		<div class="cleaninglight-quick-contact">
			<?php
			$quick_content = get_theme_mod(
				'cleaninglight_quick_content',
				wp_json_encode(
					array(
						array(
							'icon'   => 'fa-regular fa-envelope-open',
							'label'  => esc_html__( 'Quick Questions? Email Us', 'cleaning-light' ),
							'val'    => 'example@example.com',
							'enable' => 'enable',
						),
						array(
							'icon'   => 'fa-solid fa-headset',
							'label'  => esc_html__( 'Talk to an Expert (Aradia)', 'cleaning-light' ),
							'val'    => '(555)-555-5555',
							'enable' => 'enable',
						),
						array(
							'icon'   => 'fas fa-map-marker-alt',
							'label'  => esc_html__( 'Office Address', 'cleaning-light' ),
							'val'    => '123 Main Street, Springfield, USA',
							'enable' => 'enable',
						),
					)
				)
			);
			$quick_content = json_decode( $quick_content );

			if ( is_array( $quick_content ) ) {
				foreach ( $quick_content as $index => $quick ) {
					if ( ! ( 'enable' === $quick->enable ) ) {
						continue;
					}
					?>
					<div class="cleaninglight-contact-item">                                    
						<div class="cleaninglight-contact-wrap">
							<?php if ( filter_var( $quick->val, FILTER_VALIDATE_EMAIL ) ) { ?>
								<a href="mailto:<?php echo esc_attr( $quick->val ); ?>">
									<div class="cleaninglight-contact-value">
										<?php echo esc_html( $quick->val ); ?>
									</div>
								</a>
								<div class="cleaninglight-contact-title">
									<?php echo esc_html( $quick->label ); ?>
								</div>
							<?php } elseif ( preg_match( '/^\+?[0-9\-\(\)\s]+$/', $quick->val ) && 1 === $index ) { ?>
								<div class="cleaninglight-contact-title">
									<?php echo esc_html( $quick->label ); ?>
								</div>
								<div class="cleaninglight-contact-value">
									<a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D+/', '', $quick->val ) ); ?>?text=Hi" target="_blank" aria-label="<?php esc_attr_e( 'WhatsApp', 'cleaning-light' ); ?>">
										<svg class="icon icon-whatsapp"><use xlink:href="#icon-whatsapp"></use></svg>
									</a>
									<a href="tel:<?php echo esc_attr( preg_replace( '/\D+/', '', $quick->val ) ); ?>">
										<div class="cleaninglight-contact-value">
											<?php echo esc_html( $quick->val ); ?>
										</div>
									</a>
								</div>
							<?php } else { ?>
								<div class="cleaninglight-contact-value">
									<?php echo esc_html( $quick->val ); ?>
								</div>
								<div class="cleaninglight-contact-title">
									<?php echo esc_html( $quick->label ); ?>
								</div>
							<?php } ?>
						</div>
						<?php if ( ! empty( $quick->icon ) ) : ?>
							<div class="cleaninglight-contact-icon">
								<i class="<?php echo esc_attr( $quick->icon ); ?>"></i>
							</div>
						<?php endif; ?>
					</div>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
endif;
add_action( 'cleaninglight_themes_quick_contact_info_header', 'cleaninglight_themes_quick_contact_info_header' );

if ( ! function_exists( 'cleaninglight_themes_topheader_social' ) ) :
	/**
	 * Display top header social icons
	 *
	 * @return void
	 */
	function cleaninglight_themes_topheader_social() {
		$social_icon = get_theme_mod(
			'cleaninglight_topheader_social',
			wp_json_encode(
				array(
					array(
						'icon' => 'fab fa-facebook',
						'link' => '#',
					),
					array(
						'icon' => 'fa-brands fa-x-twitter',
						'link' => '#',
					),
					array(
						'icon' => 'fab fa-linkedin',
						'link' => '#',
					),
					array(
						'icon' => 'fab fa-pinterest',
						'link' => '#',
					),
					array(
						'icon' => 'fab fa-instagram',
						'link' => '#',
					),
					array(
						'icon' => 'fab fa-youtube',
						'link' => '#',
					),
				)
			)
		);

		echo '<ul class="cleaninglight-socialicon">';
		if ( ! empty( $social_icon ) ) :
			$social_icon = json_decode( $social_icon );
			foreach ( $social_icon as $icon ) {
				?>
				<li>
					<a href="<?php echo ! empty( $icon->link ) ? esc_url( $icon->link ) : '#'; ?>" target="_blank" rel="noopener noreferrer"><i class="<?php echo esc_attr( $icon->icon ); ?>"></i></a>
				</li>
				<?php
			}
		endif;
		echo '</ul>';
	}
endif;
add_action( 'cleaninglight_themes_social_icons', 'cleaninglight_themes_topheader_social' );

if ( ! function_exists( 'cleaninglight_themes_header_button' ) ) {
	/**
	 * Display header button
	 *
	 * @return void
	 */
	function cleaninglight_themes_header_button() {

		$ikbutton        = get_theme_mod( 'cleaninglight_header_button_enable', 'enable' );
		$ikbutton_title  = get_theme_mod( 'cleaninglight_hb_title', 'Book Now' );
		$ikbutton_text   = get_theme_mod( 'cleaninglight_hb_text', '(555)-555-5555' );
		$ikbutton_icon   = get_theme_mod( 'cleaninglight_hb_icon', 'fa-solid fa-headset' );
		$ikbutton_link   = get_theme_mod( 'cleaninglight_hb_link', '#' );
		$ikbutton_style  = get_theme_mod( 'cleaninglight_button_style', 'disable' );

		if ( 'enable' === $ikbutton ) {
			if ( 'enable' === $ikbutton_style ) {
				?>
				<?php if ( ! empty( $ikbutton_link ) ) { ?>
					<a class="ikbutton-link" href="<?php echo esc_url( $ikbutton_link ); ?>">
				<?php } ?>
					<div class="ikbutton-single-wrap">
						<?php if ( ! empty( $ikbutton_icon ) ) : ?>
							<div class="ikbutton-icon">
								<i class="<?php echo esc_attr( $ikbutton_icon ); ?>"></i>
							</div>
						<?php endif; ?>
						<div class="ikbutton-content-wrap">
							<?php if ( ! empty( $ikbutton_title ) ) : ?>
								<div class="ikbutton-title">
									<?php echo esc_html( $ikbutton_title ); ?>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $ikbutton_text ) ) : ?>
								<div class="ikbutton-text">
									<?php echo esc_html( $ikbutton_text ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php if ( ! empty( $ikbutton_link ) ) { ?>
					</a>
				<?php } ?>
				<?php
			} else {
				?>
				<?php if ( ! empty( $ikbutton_link ) ) { ?>
					<a class="ikbutton-link" href="<?php echo esc_url( $ikbutton_link ); ?>">
				<?php } ?>
					<div class="ikbutton-single-wrap style1">
						<?php if ( ! empty( $ikbutton_icon ) ) : ?>
							<div class="ikbutton-icon">
								<i class="<?php echo esc_attr( $ikbutton_icon ); ?>"></i>
							</div>
						<?php endif; ?>
						<div class="ikbutton-content-wrap">
							<?php if ( ! empty( $ikbutton_title ) ) : ?>
								<div class="ikbutton-title">
									<?php echo esc_html( $ikbutton_title ); ?>
								</div>
							<?php else : ?>
								<?php if ( ! empty( $ikbutton_text ) ) : ?>
									<div class="ikbutton-text">
										<?php echo esc_html( $ikbutton_text ); ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				<?php if ( ! empty( $ikbutton_link ) ) { ?>
					</a>
				<?php } ?>
				<?php
			}
		}
	}
}
add_action( 'cleaninglight_themes_header_button', 'cleaninglight_themes_header_button' );

if ( ! function_exists( 'cleaninglight_themes_topheader_free_hand' ) ) :
	/**
	 * Display top header free hand content
	 *
	 * @return void
	 */
	function cleaninglight_themes_topheader_free_hand() {

		$free_hand = get_theme_mod( 'cleaninglight_topheader_free_hand', 'Need Any Help: <b>+1-555-555-5555 or example@example.com</b>' );
		?>
			<span class="free-hand"><?php echo wp_kses_post( $free_hand ); ?></span>
		<?php
	}
endif;

if ( ! function_exists( 'cleaninglight_themes_breadcrumbs' ) ) :
	/**
	 * Display breadcrumbs
	 *
	 * @return void
	 */
	function cleaninglight_themes_breadcrumbs() {
		$service_class = array(
			'titlebar-section',
			'section',
			get_theme_mod( 'cleaninglight_titlebar_title_align', 'text-left' ),
		);
		?>
			<div class="breadcrumb-section">
				<div id="titlebar-section" class="<?php echo esc_attr( implode( ' ', $service_class ) ); ?>">
					<div class="section-wrap">
						<div class="container">
							<div class="inner-section-wrap breadcrumb_wrapper">
								<?php
								if ( get_theme_mod( 'cleaninglight_show_title', true ) ) :
									if ( is_single() || is_page() ) :
										the_title( '<h2 class="section-title">', '</h2>' );
									elseif ( is_archive() ) :
										the_archive_title( '<h2 class="section-title">', '</h2>' );
									elseif ( is_search() ) :
										?>
										<h2 class="section-title">
											<?php
											printf(
												/* translators: %s: Search query */
												esc_html__( 'Search Results for: %s', 'cleaning-light' ),
												'<span>' . get_search_query() . '</span>'
											);
											?>
										</h2>
									<?php elseif ( is_404() ) : ?>
										<h2 class="section-title"><?php esc_html_e( '404 Error', 'cleaning-light' ); ?></h2>
									<?php elseif ( is_home() ) : ?>
										<?php
										$page_for_posts_id = get_option( 'page_for_posts' );
										$page_title        = get_the_title( $page_for_posts_id );
										?>
										<h2 class="section-title"><?php echo esc_html( $page_title ); ?></h2>
									<?php else : ?>
										<h2 class="section-title"><?php echo esc_html( $page_title ); ?></h2>
										<?php
									endif;
								endif;
								if ( get_theme_mod( 'cleaninglight_breadcrumb', true ) ) :
									?>
									<nav id="breadcrumb" class="breadcrumb">
										<?php
										breadcrumb_trail(
											array(
												'container'     => 'div',
												'show_browse'   => false,
												'show_on_front' => false,
											)
										);
										?>
									</nav>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="breadcrumb-seprator">
					<?php cleaninglight_themes_add_bottom_seperator( 'titlebar' ); ?> 
				</div>
			</div>
		<?php
	}
endif;
add_action( 'cleaninglight_themes_breadcrumbs', 'cleaninglight_themes_breadcrumbs', 100 );

if ( ! function_exists( 'cleaninglight_themes_banner_slider' ) ) :
	/**
	 * Display banner slider
	 *
	 * @return void
	 */
	function cleaninglight_themes_banner_slider() {

		$all_slider = get_theme_mod( 'cleaninglight_banner_sliders' );

		$banner_slider = json_decode( $all_slider );

		if ( ! empty( $banner_slider ) ) {

			$controls = get_theme_mod(
				'main_slider_controls',
				wp_json_encode(
					array(
						'navtype'   => 'both',
						'navstyle'  => 'imagestyle',
						'dotstyle'  => 'numberstyle',
						'loop'      => 1,
						'autoplay'  => 1,
						'easing'    => 'linear',
						'drag'      => 1,
						'speed'     => 500,
						'pause'     => 5000,
					)
				)
			);
			$controls = json_decode( $controls, true );

			$data = cleaninglight_themes_get_data_attribute( $controls );

			$bg_overlay_color = get_theme_mod( 'cleaninglight_banner_overlay_color', 'rgba(0, 0, 0, 0.35)' );

			$slider_class = array( 'cleaninglight-banner-slide', 'owl-carousel', $controls['navstyle'], $controls['dotstyle'] );

			?>
			<div class="cleaninglight-banner-wrapper">
				<div id="cleaninglight-banner" class="<?php echo esc_attr( implode( ' ', $slider_class ) ); ?>" <?php echo wp_kses_data( $data ); ?>>
					<?php
					foreach ( $banner_slider as $slider ) {
						$page_id = $slider->slider_page;

						if ( ! empty( $page_id ) ) {

							$slider_page = new WP_Query( 'page_id=' . $page_id );
							if ( $slider_page->have_posts() ) {
								while ( $slider_page->have_posts() ) {
									$slider_page->the_post();
									$slide_item = '';
									?>
									<div class="cleaninglight-slider-item-wrap">
										<?php
										if ( ! empty( $bg_overlay_color ) ) {
											$slide_item = '<div class="cleaninglight-banner-bg-overlay"></div>';
										}

										echo '<div class="cleaninglight-banner-item-bg cleaninglight-ken-burns cleaninglight-ken-burns--in" style="background-image: url(' . esc_url( get_the_post_thumbnail_url() ) . ')" data-img-url="' . esc_url( get_the_post_thumbnail_url() ) . '" role="img"></div>' . wp_kses_post( $slide_item );
										?>
										<div class="cleaninglight-banner-caption-wrap <?php echo esc_attr( $slider->alignment ); ?>" style="justify-content:<?php echo esc_attr( $slider->alignment ); ?>">
											<div class="cleaninglight-banner-caption">
												<?php if ( ! empty( $slider->subtitile ) ) : ?>
													<h3 class="cleaninglight-banner-supertitle"><?php echo esc_html( $slider->subtitile ); ?></h3>
												<?php endif; ?>

												<h2 class="cleaninglight-banner-title"><?php the_title(); ?></h2>
												<div class="cleaninglight-banner-content"><?php the_excerpt(); ?></div>
												<div class="cleaninglight-banner-btn-wrap">
													<?php if ( ! empty( $slider->button_text ) ) : ?>
														<a href="<?php echo esc_url( $slider->button_url ); ?>" class="btn btn-primary">
															<?php echo esc_html( $slider->button_text ); ?>
														</a>
													<?php endif; ?>

													<?php if ( ! empty( $slider->button_one_text ) ) : ?>
														<a href="<?php echo esc_url( $slider->button_one_url ); ?>" class="btn style-white">
															<?php echo esc_html( $slider->button_one_text ); ?>
														</a>
													<?php endif; ?>
												</div>
											</div>
										</div>
									</div>
									<?php
								}
							}
						}
					}
					wp_reset_query();
					?>
				</div>
				<?php do_action( 'after_slider_section' ); ?>    
			</div>
			<?php
		}
	}

endif;
add_action( 'cleaninglight_themes_action_banner_slider', 'cleaninglight_themes_banner_slider', 5 );

if ( ! function_exists( 'cleaninglight_themes_advance_banner_slider' ) ) :
	/**
	 * Display advance banner slider
	 *
	 * @return void
	 */
	function cleaninglight_themes_advance_banner_slider() {

		$all_slider = get_theme_mod( 'cleaninglight_slider_advance_settings' );

		$banner_slider = json_decode( $all_slider );

		if ( ! empty( $banner_slider ) ) {

			$controls = get_theme_mod(
				'main_slider_controls',
				wp_json_encode(
					array(
						'navtype'   => 'both',
						'navstyle'  => 'imagestyle',
						'dotstyle'  => 'numberstyle',
						'loop'      => 1,
						'autoplay'  => 1,
						'easing'    => 'linear',
						'drag'      => 1,
						'speed'     => 500,
						'pause'     => 5000,
					)
				)
			);

			$controls = json_decode( $controls, true );

			$data = cleaninglight_themes_get_data_attribute( $controls );

			$bg_overlay_color = get_theme_mod( 'cleaninglight_banner_overlay_color', 'rgba(0, 0, 0, 0.35)' );

			$slider_class = array( 'cleaninglight-banner-slide', 'owl-carousel', $controls['navstyle'], $controls['dotstyle'] );
			?>
			<div class="cleaninglight-banner-wrapper">
				<div id="cleaninglight-banner" class="<?php echo esc_attr( implode( ' ', $slider_class ) ); ?>" <?php echo wp_kses_data( $data ); ?>>
					<?php foreach ( $banner_slider as $slider ) { ?>
						<div class="cleaninglight-slider-item-wrap">
							<?php
							if ( ! empty( $bg_overlay_color ) ) {
								echo '<div class="cleaninglight-banner-bg-overlay"></div>';
							}
							?>
							<div class="cleaninglight-banner-item-bg cleaninglight-ken-burns cleaninglight-ken-burns--in" style="background-image: url(<?php echo esc_url( $slider->block_image ); ?>)" data-img-url="<?php echo esc_url( $slider->block_image ); ?>" role="img"></div>
							<div class="cleaninglight-banner-caption-wrap <?php echo esc_attr( $slider->alignment ); ?>" style="justify-content:<?php echo esc_attr( $slider->alignment ); ?>">
								<div class="cleaninglight-banner-caption">
									<?php if ( ! empty( $slider->block_subtitile ) ) : ?>
										<h3 class="cleaninglight-banner-supertitle"><?php echo esc_html( $slider->block_subtitile ); ?></h3>
									<?php endif; ?>

									<?php if ( ! empty( $slider->block_title ) ) : ?>
										<h2 class="cleaninglight-banner-title"><?php echo esc_html( $slider->block_title ); ?></h2>
									<?php endif; ?>

									<?php if ( ! empty( $slider->block_desc ) ) : ?>
										<div class="cleaninglight-banner-content"><?php echo esc_html( $slider->block_desc ); ?></div>
									<?php endif; ?>

									<div class="cleaninglight-banner-btn-wrap">
										<?php if ( ! empty( $slider->button_text ) ) : ?>
											<a href="<?php echo esc_url( $slider->button_url ); ?>" class="btn btn-primary">
												<?php echo esc_html( $slider->button_text ); ?>
											</a>
										<?php endif; ?>

										<?php if ( ! empty( $slider->button_one_text ) ) : ?>
											<a href="<?php echo esc_url( $slider->button_one_url ); ?>" class="btn style-white">
												<?php echo esc_html( $slider->button_one_text ); ?>
											</a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<?php do_action( 'after_slider_section' ); ?>    
			</div>
			<?php
		}
	}
endif;
add_action( 'cleaninglight_themes_advance_slider', 'cleaninglight_themes_advance_banner_slider', 10 );

if ( ! function_exists( 'cleaninglight_themes_all_slider_type' ) ) :
	/**
	 * Display all slider types
	 *
	 * @return void
	 */
	function cleaninglight_themes_all_slider_type() {

		$slider_type = get_theme_mod( 'cleaninglight_slider_type', 'default' );

		switch ( $slider_type ) {
			case 'advance':
				do_action( 'cleaninglight_themes_advance_slider' );
				break;

			default:
				do_action( 'cleaninglight_themes_action_banner_slider' );
				break;
		}
	}
endif;
add_action( 'cleaninglight_themes_slider_type', 'cleaninglight_themes_all_slider_type', 25 );

if ( ! function_exists( 'cleaninglight_themes_add_slider_bottom_section_seperator' ) ) {
	/**
	 * Add slider bottom section separator
	 *
	 * @return void
	 */
	function cleaninglight_themes_add_slider_bottom_section_seperator() {

		if ( 'bottom' === get_theme_mod( 'cleaninglight_slider_section_seperator', 'no' ) ) {
			$bottom_seperator = get_theme_mod( 'cleaninglight_slider_bottom_seperator', 'curv-8' );
			?>
			<div class="section-seperator bottom-section-seperator svg-<?php echo esc_attr( $bottom_seperator ); ?>-wrap">
				<?php get_template_part( 'inc/svg/' . $bottom_seperator ); ?>
			</div>
			<?php
		}
	}
}
add_action( 'after_slider_section', 'cleaninglight_themes_add_slider_bottom_section_seperator' );

if ( ! function_exists( 'cleaninglight_themes_add_footer_seperator' ) ) {
	/**
	 * Add footer separator
	 *
	 * @return void
	 */
	function cleaninglight_themes_add_footer_seperator() {

		if ( 'top' === get_theme_mod( 'cleaninglight_footer_section_seperator', 'no' ) ) {
			$footer_top_seperator = get_theme_mod( 'cleaninglight_footer_top_seperator', 'curv-8' );
			?>
			<div class="section-seperator bottom-section-seperator svg-<?php echo esc_attr( $footer_top_seperator ); ?>-wrap">
				<?php get_template_part( 'inc/svg/' . $footer_top_seperator ); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'cleaninglight_themes_add_top_seperator' ) ) :
	/**
	 * Add top separator
	 *
	 * @param string $section_name Section name.
	 * @return void
	 */
	function cleaninglight_themes_add_top_seperator( $section_name ) {

		$section_seperator = get_theme_mod( 'cleaninglight_' . $section_name . '_section_seperator', 'no' );

		if ( 'top' === $section_seperator || 'top-bottom' === $section_seperator ) {
			$top_seperator = get_theme_mod( 'cleaninglight_' . $section_name . '_top_seperator', 'curv-9' );
			?>
			<div class="section-seperator top-section-seperator svg-<?php echo esc_attr( $top_seperator ); ?>-wrap">
				<?php get_template_part( 'inc/svg/' . $top_seperator ); ?>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'cleaninglight_themes_add_bottom_seperator' ) ) :
	/**
	 * Add bottom separator
	 *
	 * @param string $section_name Section name.
	 * @return void
	 */
	function cleaninglight_themes_add_bottom_seperator( $section_name ) {

		$section_seperator = get_theme_mod( 'cleaninglight_' . $section_name . '_section_seperator', 'bottom' );

		if ( 'bottom' === $section_seperator || 'top-bottom' === $section_seperator ) {
			$bottom_seperator = get_theme_mod( 'cleaninglight_' . $section_name . '_bottom_seperator', 'curv-9' );
			?>
			<div class="section-seperator bottom-section-seperator svg-<?php echo esc_attr( $bottom_seperator ); ?>-wrap">
				<?php get_template_part( 'inc/svg/' . $bottom_seperator ); ?>
			</div>
			<?php
		}
	}
endif;

if ( ! function_exists( 'cleaninglight_themes_alignment_class' ) ) {
	/**
	 * Get alignment class
	 *
	 * @param string $align Alignment string.
	 * @return string
	 */
	function cleaninglight_themes_alignment_class( $align ) {
		if ( $align ) {
			$align = json_decode( $align );
			if ( is_object( $align ) ) {
				$css = 'desktop-' . $align->desktop;
				if ( $align->tablet ) {
					$css .= ' tablet-' . $align->tablet;
				}
				if ( $align->mobile ) {
					$css .= ' mobile-' . $align->mobile;
				}
				return $css;
			}
		}
		return '';
	}
}

if ( ! function_exists( 'cleaninglight_themes_get_data_attribute' ) ) {
	/**
	 * Get data attribute
	 *
	 * @param array $controls Controls array.
	 * @return string
	 */
	function cleaninglight_themes_get_data_attribute( $controls ) {
		$data = '';
		foreach ( $controls as $k => $v ) {
			$data .= " data-{$k}='" . esc_attr( $v ) . "'";
		}
		return $data;
	}
}

if ( ! function_exists( 'cleaninglight_themes_post_category' ) ) {
	/**
	 * Get post categories
	 *
	 * @return array
	 */
	function cleaninglight_themes_post_category() {
		$categories = get_categories();
		$blog_cat   = array();
		foreach ( $categories as $category ) {
			$blog_cat[ $category->term_id ] = $category->name;
		}
		return $blog_cat;
	}
}

if ( ! function_exists( 'cleaninglight_themes_svg_seperator' ) ) {
	/**
	 * Get SVG separator options
	 *
	 * @return array
	 */
	function cleaninglight_themes_svg_seperator() {
		return array(
			'big-triangle-center' => esc_html__( 'Big Triangle Center', 'cleaning-light' ),
			'big-triangle-left'   => esc_html__( 'Big Triangle Left', 'cleaning-light' ),
			'big-triangle-right'  => esc_html__( 'Big Triangle Right', 'cleaning-light' ),
			'clouds'              => esc_html__( 'Clouds', 'cleaning-light' ),
			'droplets'            => esc_html__( 'Droplets', 'cleaning-light' ),
			'paper-cut'           => esc_html__( 'Paint Brush', 'cleaning-light' ),
			'big-waves'           => esc_html__( 'Big Waves', 'cleaning-light' ),
			'slanted-waves'       => esc_html__( 'Slanted Waves', 'cleaning-light' ),
			'curv-3'              => esc_html__( 'Curv 3', 'cleaning-light' ),
			'curv-4'              => esc_html__( 'Curv 4', 'cleaning-light' ),
			'curv-5'              => esc_html__( 'Curv 5', 'cleaning-light' ),
			'curv-6'              => esc_html__( 'Curv 6', 'cleaning-light' ),
			'curv-7'             => esc_html__( 'Curv 7', 'cleaning-light' ),
			'curv-8'             => esc_html__( 'Curv 8', 'cleaning-light' ),
			'curv-9'             => esc_html__( 'Curv 9', 'cleaning-light' ),
			'curv-10'            => esc_html__( 'Curv 10', 'cleaning-light' ),
			'curv-11'            => esc_html__( 'Curv 11', 'cleaning-light' ),
			'curv-12'            => esc_html__( 'Curv 12', 'cleaning-light' ),
		);
	}
}

if ( ! function_exists( 'cleaninglight_font_awesome_social_icon_array' ) ) {
	/**
	 * Font Awesome social icon array
	 *
	 * @return array
	 */
	function cleaninglight_font_awesome_social_icon_array() {
		return array("fa-brands fa-facebook","fa-brands fa-facebook-f","fa-brands fa-facebook-messenger","fa-brands fa-square-facebook","fab fa-youtube","fa-brands fa-square-whatsapp","fa-brands fa-whatsapp","fa-brands fa-snapchat","fa-brands fa-square-snapchat","fa-brands fa-telegram","fa-brands fa-viber","fa-brands fa-spotify","fa-brands fa-quora","fa-brands fa-medium","fa-brands fa-tiktok","fa-brands fa-x-twitter","fa-brands fa-square-x-twitter","fa-brands fa-square-twitter","fa-brands fa-twitch","fa-brands fa-twitter","fa-brands fa-instagram","fa-brands fa-square-instagram","fa-brands fa-google","fa-brands fa-google-drive","fa-brands fa-skype","fa-brands fa-google-pay","fa-brands fa-google-play","fa-brands fa-google-plus","fa-brands fa-google-plus-g","fa-brands fa-google-wallet","fa-brands fa-square-google-plus","fa-brands fa-linkedin","fa-brands fa-linkedin-in","fa-brands fa-pinterest","fa-brands fa-pinterest-p","fa-brands fa-square-pinterest","fa-brands fa-dribbble","fa-brands fa-square-dribbble","fa-brands fa-stumbleupon","fa-brands fa-stumbleupon-circle","fa-brands fa-square-tumblr","fa-brands fa-tumblr","fa-brands fa-square-vimeo","fa-brands fa-vimeo","fa-brands fa-vimeo-v","fa-solid fa-rss","fa-solid fa-square-rss","fa-brands fa-flickr","fa-solid fa-envelope","fa-regular fa-envelope","fa-solid fa-envelope-circle-check","fa-solid fa-envelope-open","fa-regular fa-envelope-open","fa-solid fa-envelope-open-text","fa-solid fa-envelopes-bulk","fa fa-heart","fa-solid fa-heart-crack","fa-solid fa-heart-pulse","fa-solid fa-shield-heart","fa-regular fa-face-grin-hearts","fa-regular fa-face-kiss-wink-heart");
	}
}

/**
 * Font Awesome Icon
 */
if (!function_exists('cleaninglight_font_awesome_icon_array')) {
    function cleaninglight_font_awesome_icon_array() {
        return array('', 'fa-solid fa-0', 'fa-solid fa-1', 'fa-solid fa-2', 'fa-solid fa-3', 'fa-solid fa-4', 'fa-solid fa-5', 'fa-solid fa-6', 'fa-solid fa-7', 'fa-solid fa-8', 'fa-solid fa-9', 'fa-brands fa-42-group', 'fa-brands fa-500px', 'fa-solid fa-a', 'fa-brands fa-accessible-icon', 'fa-brands fa-accusoft', 'fa-solid fa-address-book', 'fa-regular fa-address-book', 'fa-solid fa-address-card', 'fa-regular fa-address-card', 'fa-brands fa-adn', 'fa-brands fa-adversal', 'fa-brands fa-affiliatetheme', 'fa-brands fa-airbnb', 'fa-brands fa-algolia', 'fa-solid fa-align-center', 'fa-solid fa-align-justify', 'fa-solid fa-align-left', 'fa-solid fa-align-right', 'fa-brands fa-alipay', 'fa-brands fa-amazon', 'fa-brands fa-amazon-pay', 'fa-brands fa-amilia', 'fa-solid fa-anchor', 'fa-solid fa-anchor-circle-check', 'fa-solid fa-anchor-circle-exclamation', 'fa-solid fa-anchor-circle-xmark', 'fa-solid fa-anchor-lock', 'fa-brands fa-android', 'fa-brands fa-angellist', 'fa-solid fa-angle-down', 'fa-solid fa-angle-left', 'fa-solid fa-angle-right', 'fa-solid fa-angle-up', 'fa-solid fa-angles-down', 'fa-solid fa-angles-left', 'fa-solid fa-angles-right', 'fa-solid fa-angles-up', 'fa-brands fa-angrycreative', 'fa-brands fa-angular', 'fa-solid fa-ankh', 'fa-brands fa-app-store', 'fa-brands fa-app-store-ios', 'fa-brands fa-apper', 'fa-brands fa-apple', 'fa-brands fa-apple-pay', 'fa-solid fa-apple-whole', 'fa-solid fa-archway', 'fa-solid fa-arrow-down', 'fa-solid fa-arrow-down-1-9', 'fa-solid fa-arrow-down-9-1', 'fa-solid fa-arrow-down-a-z', 'fa-solid fa-arrow-down-long', 'fa-solid fa-arrow-down-short-wide', 'fa-solid fa-arrow-down-up-across-line', 'fa-solid fa-arrow-down-up-lock', 'fa-solid fa-arrow-down-wide-short', 'fa-solid fa-arrow-down-z-a', 'fa-solid fa-arrow-left', 'fa-solid fa-arrow-left-long', 'fa-solid fa-arrow-pointer', 'fa-solid fa-arrow-right', 'fa-solid fa-arrow-right-arrow-left', 'fa-solid fa-arrow-right-from-bracket', 'fa-solid fa-arrow-right-long', 'fa-solid fa-arrow-right-to-bracket', 'fa-solid fa-arrow-right-to-city', 'fa-solid fa-arrow-rotate-left', 'fa-solid fa-arrow-rotate-right', 'fa-solid fa-arrow-trend-down', 'fa-solid fa-arrow-trend-up', 'fa-solid fa-arrow-turn-down', 'fa-solid fa-arrow-turn-up', 'fa-solid fa-arrow-up', 'fa-solid fa-arrow-up-1-9', 'fa-solid fa-arrow-up-9-1', 'fa-solid fa-arrow-up-a-z', 'fa-solid fa-arrow-up-from-bracket', 'fa-solid fa-arrow-up-from-ground-water', 'fa-solid fa-arrow-up-from-water-pump', 'fa-solid fa-arrow-up-long', 'fa-solid fa-arrow-up-right-dots', 'fa-solid fa-arrow-up-right-from-square', 'fa-solid fa-arrow-up-short-wide', 'fa-solid fa-arrow-up-wide-short', 'fa-solid fa-arrow-up-z-a', 'fa-solid fa-arrows-down-to-line', 'fa-solid fa-arrows-down-to-people', 'fa-solid fa-arrows-left-right', 'fa-solid fa-arrows-left-right-to-line', 'fa-solid fa-arrows-rotate', 'fa-solid fa-arrows-spin', 'fa-solid fa-arrows-split-up-and-left', 'fa-solid fa-arrows-to-circle', 'fa-solid fa-arrows-to-dot', 'fa-solid fa-arrows-to-eye', 'fa-solid fa-arrows-turn-right', 'fa-solid fa-arrows-turn-to-dots', 'fa-solid fa-arrows-up-down', 'fa-solid fa-arrows-up-down-left-right', 'fa-solid fa-arrows-up-to-line', 'fa-brands fa-artstation', 'fa-solid fa-asterisk', 'fa-brands fa-asymmetrik', 'fa-solid fa-at', 'fa-brands fa-atlassian', 'fa-solid fa-atom', 'fa-brands fa-audible', 'fa-solid fa-audio-description', 'fa-solid fa-austral-sign', 'fa-brands fa-autoprefixer', 'fa-brands fa-avianex', 'fa-brands fa-aviato', 'fa-solid fa-award', 'fa-brands fa-aws', 'fa-solid fa-b', 'fa-solid fa-baby', 'fa-solid fa-baby-carriage', 'fa-solid fa-backward', 'fa-solid fa-backward-fast', 'fa-solid fa-backward-step', 'fa-solid fa-bacon', 'fa-solid fa-bacteria', 'fa-solid fa-bacterium', 'fa-solid fa-bag-shopping', 'fa-solid fa-bahai', 'fa-solid fa-baht-sign', 'fa-solid fa-ban', 'fa-solid fa-ban-smoking', 'fa-solid fa-bandage', 'fa-brands fa-bandcamp', 'fa-solid fa-bangladeshi-taka-sign', 'fa-solid fa-barcode', 'fa-solid fa-bars', 'fa-solid fa-bars-progress', 'fa-solid fa-bars-staggered', 'fa-solid fa-baseball', 'fa-solid fa-baseball-bat-ball', 'fa-solid fa-basket-shopping', 'fa-solid fa-basketball', 'fa-solid fa-bath', 'fa-solid fa-battery-empty', 'fa-solid fa-battery-full', 'fa-solid fa-battery-half', 'fa-solid fa-battery-quarter', 'fa-solid fa-battery-three-quarters', 'fa-brands fa-battle-net', 'fa-solid fa-bed', 'fa-solid fa-bed-pulse', 'fa-solid fa-beer-mug-empty', 'fa-brands fa-behance', 'fa-solid fa-bell', 'fa-regular fa-bell', 'fa-solid fa-bell-concierge', 'fa-solid fa-bell-slash', 'fa-regular fa-bell-slash', 'fa-solid fa-bezier-curve', 'fa-solid fa-bicycle', 'fa-brands fa-bilibili', 'fa-brands fa-bimobject', 'fa-solid fa-binoculars', 'fa-solid fa-biohazard', 'fa-brands fa-bitbucket', 'fa-brands fa-bitcoin', 'fa-solid fa-bitcoin-sign', 'fa-brands fa-bity', 'fa-brands fa-black-tie', 'fa-brands fa-blackberry', 'fa-solid fa-blender', 'fa-solid fa-blender-phone', 'fa-solid fa-blog', 'fa-brands fa-blogger', 'fa-brands fa-blogger-b', 'fa-brands fa-bluetooth', 'fa-brands fa-bluetooth-b', 'fa-solid fa-bold', 'fa-solid fa-bolt', 'fa-solid fa-bolt-lightning', 'fa-solid fa-bomb', 'fa-solid fa-bone', 'fa-solid fa-bong', 'fa-solid fa-book', 'fa-solid fa-book-atlas', 'fa-solid fa-book-bible', 'fa-solid fa-book-bookmark', 'fa-solid fa-book-journal-whills', 'fa-solid fa-book-medical', 'fa-solid fa-book-open', 'fa-solid fa-book-open-reader', 'fa-solid fa-book-quran', 'fa-solid fa-book-skull', 'fa-solid fa-book-tanakh', 'fa-solid fa-bookmark', 'fa-regular fa-bookmark', 'fa-brands fa-bootstrap', 'fa-solid fa-border-all', 'fa-solid fa-border-none', 'fa-solid fa-border-top-left', 'fa-solid fa-bore-hole', 'fa-brands fa-bots', 'fa-solid fa-bottle-droplet', 'fa-solid fa-bottle-water', 'fa-solid fa-bowl-food', 'fa-solid fa-bowl-rice', 'fa-solid fa-bowling-ball', 'fa-solid fa-box', 'fa-solid fa-box-archive', 'fa-solid fa-box-open', 'fa-solid fa-box-tissue', 'fa-solid fa-boxes-packing', 'fa-solid fa-boxes-stacked', 'fa-solid fa-braille', 'fa-solid fa-brain', 'fa-solid fa-brazilian-real-sign', 'fa-solid fa-bread-slice', 'fa-solid fa-bridge', 'fa-solid fa-bridge-circle-check', 'fa-solid fa-bridge-circle-exclamation', 'fa-solid fa-bridge-circle-xmark', 'fa-solid fa-bridge-lock', 'fa-solid fa-bridge-water', 'fa-solid fa-briefcase', 'fa-solid fa-briefcase-medical', 'fa-solid fa-broom', 'fa-solid fa-broom-ball', 'fa-solid fa-brush', 'fa-brands fa-btc', 'fa-solid fa-bucket', 'fa-brands fa-buffer', 'fa-solid fa-bug', 'fa-solid fa-bug-slash', 'fa-solid fa-bugs', 'fa-solid fa-building', 'fa-regular fa-building', 'fa-solid fa-building-circle-arrow-right', 'fa-solid fa-building-circle-check', 'fa-solid fa-building-circle-exclamation', 'fa-solid fa-building-circle-xmark', 'fa-solid fa-building-columns', 'fa-solid fa-building-flag', 'fa-solid fa-building-lock', 'fa-solid fa-building-ngo', 'fa-solid fa-building-shield', 'fa-solid fa-building-un', 'fa-solid fa-building-user', 'fa-solid fa-building-wheat', 'fa-solid fa-bullhorn', 'fa-solid fa-bullseye', 'fa-solid fa-burger', 'fa-brands fa-buromobelexperte', 'fa-solid fa-burst', 'fa-solid fa-bus', 'fa-solid fa-bus-simple', 'fa-solid fa-business-time', 'fa-brands fa-buy-n-large', 'fa-brands fa-buysellads', 'fa-solid fa-c', 'fa-solid fa-cable-car', 'fa-solid fa-cake-candles', 'fa-solid fa-calculator', 'fa-solid fa-calendar', 'fa-regular fa-calendar', 'fa-solid fa-calendar-check', 'fa-regular fa-calendar-check', 'fa-solid fa-calendar-day', 'fa-solid fa-calendar-days', 'fa-regular fa-calendar-days', 'fa-solid fa-calendar-minus', 'fa-regular fa-calendar-minus', 'fa-solid fa-calendar-plus', 'fa-regular fa-calendar-plus', 'fa-solid fa-calendar-week', 'fa-solid fa-calendar-xmark', 'fa-regular fa-calendar-xmark', 'fa-solid fa-camera', 'fa-solid fa-camera-retro', 'fa-solid fa-camera-rotate', 'fa-solid fa-campground', 'fa-brands fa-canadian-maple-leaf', 'fa-solid fa-candy-cane', 'fa-solid fa-cannabis', 'fa-solid fa-capsules', 'fa-solid fa-car', 'fa-solid fa-car-battery', 'fa-solid fa-car-burst', 'fa-solid fa-car-on', 'fa-solid fa-car-rear', 'fa-solid fa-car-side', 'fa-solid fa-car-tunnel', 'fa-solid fa-caravan', 'fa-solid fa-caret-down', 'fa-solid fa-caret-left', 'fa-solid fa-caret-right', 'fa-solid fa-caret-up', 'fa-solid fa-carrot', 'fa-solid fa-cart-arrow-down', 'fa-solid fa-cart-flatbed', 'fa-solid fa-cart-flatbed-suitcase', 'fa-solid fa-cart-plus', 'fa-solid fa-cart-shopping', 'fa-solid fa-cash-register', 'fa-solid fa-cat', 'fa-brands fa-cc-amazon-pay', 'fa-brands fa-cc-amex', 'fa-brands fa-cc-apple-pay', 'fa-brands fa-cc-diners-club', 'fa-brands fa-cc-discover', 'fa-brands fa-cc-jcb', 'fa-brands fa-cc-mastercard', 'fa-brands fa-cc-paypal', 'fa-brands fa-cc-stripe', 'fa-brands fa-cc-visa', 'fa-solid fa-cedi-sign', 'fa-solid fa-cent-sign', 'fa-brands fa-centercode', 'fa-brands fa-centos', 'fa-solid fa-certificate', 'fa-solid fa-chair', 'fa-solid fa-chalkboard', 'fa-solid fa-chalkboard-user', 'fa-solid fa-champagne-glasses', 'fa-solid fa-charging-station', 'fa-solid fa-chart-area', 'fa-solid fa-chart-bar', 'fa-regular fa-chart-bar', 'fa-solid fa-chart-column', 'fa-solid fa-chart-gantt', 'fa-solid fa-chart-line', 'fa-solid fa-chart-pie', 'fa-solid fa-chart-simple', 'fa-solid fa-check', 'fa-solid fa-check-double', 'fa-solid fa-check-to-slot', 'fa-solid fa-cheese', 'fa-solid fa-chess', 'fa-solid fa-chess-bishop', 'fa-regular fa-chess-bishop', 'fa-solid fa-chess-board', 'fa-solid fa-chess-king', 'fa-regular fa-chess-king', 'fa-solid fa-chess-knight', 'fa-regular fa-chess-knight', 'fa-solid fa-chess-pawn', 'fa-regular fa-chess-pawn', 'fa-solid fa-chess-queen', 'fa-regular fa-chess-queen', 'fa-solid fa-chess-rook', 'fa-regular fa-chess-rook', 'fa-solid fa-chevron-down', 'fa-solid fa-chevron-left', 'fa-solid fa-chevron-right', 'fa-solid fa-chevron-up', 'fa-solid fa-child', 'fa-solid fa-child-combatant', 'fa-solid fa-child-dress', 'fa-solid fa-child-reaching', 'fa-solid fa-children', 'fa-brands fa-chrome', 'fa-brands fa-chromecast', 'fa-solid fa-church', 'fa-solid fa-circle', 'fa-regular fa-circle', 'fa-solid fa-circle-arrow-down', 'fa-solid fa-circle-arrow-left', 'fa-solid fa-circle-arrow-right', 'fa-solid fa-circle-arrow-up', 'fa-solid fa-circle-check', 'fa-regular fa-circle-check', 'fa-solid fa-circle-chevron-down', 'fa-solid fa-circle-chevron-left', 'fa-solid fa-circle-chevron-right', 'fa-solid fa-circle-chevron-up', 'fa-solid fa-circle-dollar-to-slot', 'fa-solid fa-circle-dot', 'fa-regular fa-circle-dot', 'fa-solid fa-circle-down', 'fa-regular fa-circle-down', 'fa-solid fa-circle-exclamation', 'fa-solid fa-circle-h', 'fa-solid fa-circle-half-stroke', 'fa-solid fa-circle-info', 'fa-solid fa-circle-left', 'fa-regular fa-circle-left', 'fa-solid fa-circle-minus', 'fa-solid fa-circle-nodes', 'fa-solid fa-circle-notch', 'fa-solid fa-circle-pause', 'fa-regular fa-circle-pause', 'fa-solid fa-circle-play', 'fa-regular fa-circle-play', 'fa-solid fa-circle-plus', 'fa-solid fa-circle-question', 'fa-regular fa-circle-question', 'fa-solid fa-circle-radiation', 'fa-solid fa-circle-right', 'fa-regular fa-circle-right', 'fa-solid fa-circle-stop', 'fa-regular fa-circle-stop', 'fa-solid fa-circle-up', 'fa-regular fa-circle-up', 'fa-solid fa-circle-user', 'fa-regular fa-circle-user', 'fa-solid fa-circle-xmark', 'fa-regular fa-circle-xmark', 'fa-solid fa-city', 'fa-solid fa-clapperboard', 'fa-solid fa-clipboard', 'fa-regular fa-clipboard', 'fa-solid fa-clipboard-check', 'fa-solid fa-clipboard-list', 'fa-solid fa-clipboard-question', 'fa-solid fa-clipboard-user', 'fa-solid fa-clock', 'fa-regular fa-clock', 'fa-solid fa-clock-rotate-left', 'fa-solid fa-clone', 'fa-regular fa-clone', 'fa-solid fa-closed-captioning', 'fa-regular fa-closed-captioning', 'fa-solid fa-cloud', 'fa-solid fa-cloud-arrow-down', 'fa-solid fa-cloud-arrow-up', 'fa-solid fa-cloud-bolt', 'fa-solid fa-cloud-meatball', 'fa-solid fa-cloud-moon', 'fa-solid fa-cloud-moon-rain', 'fa-solid fa-cloud-rain', 'fa-solid fa-cloud-showers-heavy', 'fa-solid fa-cloud-showers-water', 'fa-solid fa-cloud-sun', 'fa-solid fa-cloud-sun-rain', 'fa-brands fa-cloudflare', 'fa-brands fa-cloudscale', 'fa-brands fa-cloudsmith', 'fa-brands fa-cloudversify', 'fa-solid fa-clover', 'fa-brands fa-cmplid', 'fa-solid fa-code', 'fa-solid fa-code-branch', 'fa-solid fa-code-commit', 'fa-solid fa-code-compare', 'fa-solid fa-code-fork', 'fa-solid fa-code-merge', 'fa-solid fa-code-pull-request', 'fa-brands fa-codepen', 'fa-brands fa-codiepie', 'fa-solid fa-coins', 'fa-solid fa-colon-sign', 'fa-solid fa-comment', 'fa-regular fa-comment', 'fa-solid fa-comment-dollar', 'fa-solid fa-comment-dots', 'fa-regular fa-comment-dots', 'fa-solid fa-comment-medical', 'fa-solid fa-comment-slash', 'fa-solid fa-comment-sms', 'fa-solid fa-comments', 'fa-regular fa-comments', 'fa-solid fa-comments-dollar', 'fa-solid fa-compact-disc', 'fa-solid fa-compass', 'fa-regular fa-compass', 'fa-solid fa-compass-drafting', 'fa-solid fa-compress', 'fa-solid fa-computer', 'fa-solid fa-computer-mouse', 'fa-brands fa-confluence', 'fa-brands fa-connectdevelop', 'fa-brands fa-contao', 'fa-solid fa-cookie', 'fa-solid fa-cookie-bite', 'fa-solid fa-copy', 'fa-regular fa-copy', 'fa-solid fa-copyright', 'fa-regular fa-copyright', 'fa-brands fa-cotton-bureau', 'fa-solid fa-couch', 'fa-solid fa-cow', 'fa-brands fa-cpanel', 'fa-brands fa-creative-commons', 'fa-brands fa-creative-commons-by', 'fa-brands fa-creative-commons-nc', 'fa-brands fa-creative-commons-nc-eu', 'fa-brands fa-creative-commons-nc-jp', 'fa-brands fa-creative-commons-nd', 'fa-brands fa-creative-commons-pd', 'fa-brands fa-creative-commons-pd-alt', 'fa-brands fa-creative-commons-remix', 'fa-brands fa-creative-commons-sa', 'fa-brands fa-creative-commons-sampling', 'fa-brands fa-creative-commons-sampling-plus', 'fa-brands fa-creative-commons-share', 'fa-brands fa-creative-commons-zero', 'fa-solid fa-credit-card', 'fa-regular fa-credit-card', 'fa-brands fa-critical-role', 'fa-solid fa-crop', 'fa-solid fa-crop-simple', 'fa-solid fa-cross', 'fa-solid fa-crosshairs', 'fa-solid fa-crow', 'fa-solid fa-crown', 'fa-solid fa-crutch', 'fa-solid fa-cruzeiro-sign', 'fa-brands fa-css3', 'fa-brands fa-css3-alt', 'fa-solid fa-cube', 'fa-solid fa-cubes', 'fa-solid fa-cubes-stacked', 'fa-brands fa-cuttlefish', 'fa-solid fa-d', 'fa-brands fa-d-and-d', 'fa-brands fa-d-and-d-beyond', 'fa-brands fa-dailymotion', 'fa-brands fa-dashcube', 'fa-solid fa-database', 'fa-brands fa-deezer', 'fa-solid fa-delete-left', 'fa-brands fa-delicious', 'fa-solid fa-democrat', 'fa-brands fa-deploydog', 'fa-brands fa-deskpro', 'fa-solid fa-desktop', 'fa-brands fa-dev', 'fa-brands fa-deviantart', 'fa-solid fa-dharmachakra', 'fa-brands fa-dhl', 'fa-solid fa-diagram-next', 'fa-solid fa-diagram-predecessor', 'fa-solid fa-diagram-project', 'fa-solid fa-diagram-successor', 'fa-solid fa-diamond', 'fa-solid fa-diamond-turn-right', 'fa-brands fa-diaspora', 'fa-solid fa-dice', 'fa-solid fa-dice-d20', 'fa-solid fa-dice-d6', 'fa-solid fa-dice-five', 'fa-solid fa-dice-four', 'fa-solid fa-dice-one', 'fa-solid fa-dice-six', 'fa-solid fa-dice-three', 'fa-solid fa-dice-two', 'fa-brands fa-digg', 'fa-brands fa-digital-ocean', 'fa-brands fa-discord', 'fa-brands fa-discourse', 'fa-solid fa-disease', 'fa-solid fa-display', 'fa-solid fa-divide', 'fa-solid fa-dna', 'fa-brands fa-dochub', 'fa-brands fa-docker', 'fa-solid fa-dog', 'fa-solid fa-dollar-sign', 'fa-solid fa-dolly', 'fa-solid fa-dong-sign', 'fa-solid fa-door-closed', 'fa-solid fa-door-open', 'fa-solid fa-dove', 'fa-solid fa-down-left-and-up-right-to-center', 'fa-solid fa-down-long', 'fa-solid fa-download', 'fa-brands fa-draft2digital', 'fa-solid fa-dragon', 'fa-solid fa-draw-polygon', 'fa-brands fa-dribbble', 'fa-brands fa-dropbox', 'fa-solid fa-droplet', 'fa-solid fa-droplet-slash', 'fa-solid fa-drum', 'fa-solid fa-drum-steelpan', 'fa-solid fa-drumstick-bite', 'fa-brands fa-drupal', 'fa-solid fa-dumbbell', 'fa-solid fa-dumpster', 'fa-solid fa-dumpster-fire', 'fa-solid fa-dungeon', 'fa-brands fa-dyalog', 'fa-solid fa-e', 'fa-solid fa-ear-deaf', 'fa-solid fa-ear-listen', 'fa-brands fa-earlybirds', 'fa-solid fa-earth-africa', 'fa-solid fa-earth-americas', 'fa-solid fa-earth-asia', 'fa-solid fa-earth-europe', 'fa-solid fa-earth-oceania', 'fa-brands fa-ebay', 'fa-brands fa-edge', 'fa-brands fa-edge-legacy', 'fa-solid fa-egg', 'fa-solid fa-eject', 'fa-brands fa-elementor', 'fa-solid fa-elevator', 'fa-solid fa-ellipsis', 'fa-solid fa-ellipsis-vertical', 'fa-brands fa-ello', 'fa-brands fa-ember', 'fa-brands fa-empire', 'fa-solid fa-envelope', 'fa-regular fa-envelope', 'fa-solid fa-envelope-circle-check', 'fa-solid fa-envelope-open', 'fa-regular fa-envelope-open', 'fa-solid fa-envelope-open-text', 'fa-solid fa-envelopes-bulk', 'fa-brands fa-envira', 'fa-solid fa-equals', 'fa-solid fa-eraser', 'fa-brands fa-erlang', 'fa-brands fa-ethereum', 'fa-solid fa-ethernet', 'fa-brands fa-etsy', 'fa-solid fa-euro-sign', 'fa-brands fa-evernote', 'fa-solid fa-exclamation', 'fa-solid fa-expand', 'fa-brands fa-expeditedssl', 'fa-solid fa-explosion', 'fa-solid fa-eye', 'fa-regular fa-eye', 'fa-solid fa-eye-dropper', 'fa-solid fa-eye-low-vision', 'fa-solid fa-eye-slash', 'fa-regular fa-eye-slash', 'fa-solid fa-f', 'fa-solid fa-face-angry', 'fa-regular fa-face-angry', 'fa-solid fa-face-dizzy', 'fa-regular fa-face-dizzy', 'fa-solid fa-face-flushed', 'fa-regular fa-face-flushed', 'fa-solid fa-face-frown', 'fa-regular fa-face-frown', 'fa-solid fa-face-frown-open', 'fa-regular fa-face-frown-open', 'fa-solid fa-face-grimace', 'fa-regular fa-face-grimace', 'fa-solid fa-face-grin', 'fa-regular fa-face-grin', 'fa-solid fa-face-grin-beam', 'fa-regular fa-face-grin-beam', 'fa-solid fa-face-grin-beam-sweat', 'fa-regular fa-face-grin-beam-sweat', 'fa-solid fa-face-grin-hearts', 'fa-regular fa-face-grin-hearts', 'fa-solid fa-face-grin-squint', 'fa-regular fa-face-grin-squint', 'fa-solid fa-face-grin-squint-tears', 'fa-regular fa-face-grin-squint-tears', 'fa-solid fa-face-grin-stars', 'fa-regular fa-face-grin-stars', 'fa-solid fa-face-grin-tears', 'fa-regular fa-face-grin-tears', 'fa-solid fa-face-grin-tongue', 'fa-regular fa-face-grin-tongue', 'fa-solid fa-face-grin-tongue-squint', 'fa-regular fa-face-grin-tongue-squint', 'fa-solid fa-face-grin-tongue-wink', 'fa-regular fa-face-grin-tongue-wink', 'fa-solid fa-face-grin-wide', 'fa-regular fa-face-grin-wide', 'fa-solid fa-face-grin-wink', 'fa-regular fa-face-grin-wink', 'fa-solid fa-face-kiss', 'fa-regular fa-face-kiss', 'fa-solid fa-face-kiss-beam', 'fa-regular fa-face-kiss-beam', 'fa-solid fa-face-kiss-wink-heart', 'fa-regular fa-face-kiss-wink-heart', 'fa-solid fa-face-laugh', 'fa-regular fa-face-laugh', 'fa-solid fa-face-laugh-beam', 'fa-regular fa-face-laugh-beam', 'fa-solid fa-face-laugh-squint', 'fa-regular fa-face-laugh-squint', 'fa-solid fa-face-laugh-wink', 'fa-regular fa-face-laugh-wink', 'fa-solid fa-face-meh', 'fa-regular fa-face-meh', 'fa-solid fa-face-meh-blank', 'fa-regular fa-face-meh-blank', 'fa-solid fa-face-rolling-eyes', 'fa-regular fa-face-rolling-eyes', 'fa-solid fa-face-sad-cry', 'fa-regular fa-face-sad-cry', 'fa-solid fa-face-sad-tear', 'fa-regular fa-face-sad-tear', 'fa-solid fa-face-smile', 'fa-regular fa-face-smile', 'fa-solid fa-face-smile-beam', 'fa-regular fa-face-smile-beam', 'fa-solid fa-face-smile-wink', 'fa-regular fa-face-smile-wink', 'fa-solid fa-face-surprise', 'fa-regular fa-face-surprise', 'fa-solid fa-face-tired', 'fa-regular fa-face-tired', 'fa-brands fa-facebook', 'fa-brands fa-facebook-f', 'fa-brands fa-facebook-messenger', 'fa-solid fa-fan', 'fa-brands fa-fantasy-flight-games', 'fa-solid fa-faucet', 'fa-solid fa-faucet-drip', 'fa-solid fa-fax', 'fa-solid fa-feather', 'fa-solid fa-feather-pointed', 'fa-brands fa-fedex', 'fa-brands fa-fedora', 'fa-solid fa-ferry', 'fa-brands fa-figma', 'fa-solid fa-file', 'fa-regular fa-file', 'fa-solid fa-file-arrow-down', 'fa-solid fa-file-arrow-up', 'fa-solid fa-file-audio', 'fa-regular fa-file-audio', 'fa-solid fa-file-circle-check', 'fa-solid fa-file-circle-exclamation', 'fa-solid fa-file-circle-minus', 'fa-solid fa-file-circle-plus', 'fa-solid fa-file-circle-question', 'fa-solid fa-file-circle-xmark', 'fa-solid fa-file-code', 'fa-regular fa-file-code', 'fa-solid fa-file-contract', 'fa-solid fa-file-csv', 'fa-solid fa-file-excel', 'fa-regular fa-file-excel', 'fa-solid fa-file-export', 'fa-solid fa-file-image', 'fa-regular fa-file-image', 'fa-solid fa-file-import', 'fa-solid fa-file-invoice', 'fa-solid fa-file-invoice-dollar', 'fa-solid fa-file-lines', 'fa-regular fa-file-lines', 'fa-solid fa-file-medical', 'fa-solid fa-file-pdf', 'fa-regular fa-file-pdf', 'fa-solid fa-file-pen', 'fa-solid fa-file-powerpoint', 'fa-regular fa-file-powerpoint', 'fa-solid fa-file-prescription', 'fa-solid fa-file-shield', 'fa-solid fa-file-signature', 'fa-solid fa-file-video', 'fa-regular fa-file-video', 'fa-solid fa-file-waveform', 'fa-solid fa-file-word', 'fa-regular fa-file-word', 'fa-solid fa-file-zipper', 'fa-regular fa-file-zipper', 'fa-solid fa-fill', 'fa-solid fa-fill-drip', 'fa-solid fa-film', 'fa-solid fa-filter', 'fa-solid fa-filter-circle-dollar', 'fa-solid fa-filter-circle-xmark', 'fa-solid fa-fingerprint', 'fa-solid fa-fire', 'fa-solid fa-fire-burner', 'fa-solid fa-fire-extinguisher', 'fa-solid fa-fire-flame-curved', 'fa-solid fa-fire-flame-simple', 'fa-brands fa-firefox', 'fa-brands fa-firefox-browser', 'fa-brands fa-first-order', 'fa-brands fa-first-order-alt', 'fa-brands fa-firstdraft', 'fa-solid fa-fish', 'fa-solid fa-fish-fins', 'fa-solid fa-flag', 'fa-regular fa-flag', 'fa-solid fa-flag-checkered', 'fa-solid fa-flag-usa', 'fa-solid fa-flask', 'fa-solid fa-flask-vial', 'fa-brands fa-flickr', 'fa-brands fa-flipboard', 'fa-solid fa-floppy-disk', 'fa-regular fa-floppy-disk', 'fa-solid fa-florin-sign', 'fa-brands fa-fly', 'fa-solid fa-folder', 'fa-regular fa-folder', 'fa-solid fa-folder-closed', 'fa-regular fa-folder-closed', 'fa-solid fa-folder-minus', 'fa-solid fa-folder-open', 'fa-regular fa-folder-open', 'fa-solid fa-folder-plus', 'fa-solid fa-folder-tree', 'fa-solid fa-font', 'fa-solid fa-font-awesome', 'fa-regular fa-font-awesome', 'fa-brands fa-font-awesome', 'fa-brands fa-fonticons', 'fa-brands fa-fonticons-fi', 'fa-solid fa-football', 'fa-brands fa-fort-awesome', 'fa-brands fa-fort-awesome-alt', 'fa-brands fa-forumbee', 'fa-solid fa-forward', 'fa-solid fa-forward-fast', 'fa-solid fa-forward-step', 'fa-brands fa-foursquare', 'fa-solid fa-franc-sign', 'fa-brands fa-free-code-camp', 'fa-brands fa-freebsd', 'fa-solid fa-frog', 'fa-brands fa-fulcrum', 'fa-solid fa-futbol', 'fa-regular fa-futbol', 'fa-solid fa-g', 'fa-brands fa-galactic-republic', 'fa-brands fa-galactic-senate', 'fa-solid fa-gamepad', 'fa-solid fa-gas-pump', 'fa-solid fa-gauge', 'fa-solid fa-gauge-high', 'fa-solid fa-gauge-simple', 'fa-solid fa-gauge-simple-high', 'fa-solid fa-gavel', 'fa-solid fa-gear', 'fa-solid fa-gears', 'fa-solid fa-gem', 'fa-regular fa-gem', 'fa-solid fa-genderless', 'fa-brands fa-get-pocket', 'fa-brands fa-gg', 'fa-brands fa-gg-circle', 'fa-solid fa-ghost', 'fa-solid fa-gift', 'fa-solid fa-gifts', 'fa-brands fa-git', 'fa-brands fa-git-alt', 'fa-brands fa-github', 'fa-brands fa-github-alt', 'fa-brands fa-gitkraken', 'fa-brands fa-gitlab', 'fa-brands fa-gitter', 'fa-solid fa-glass-water', 'fa-solid fa-glass-water-droplet', 'fa-solid fa-glasses', 'fa-brands fa-glide', 'fa-brands fa-glide-g', 'fa-solid fa-globe', 'fa-brands fa-gofore', 'fa-brands fa-golang', 'fa-solid fa-golf-ball-tee', 'fa-brands fa-goodreads', 'fa-brands fa-goodreads-g', 'fa-brands fa-google', 'fa-brands fa-google-drive', 'fa-brands fa-google-pay', 'fa-brands fa-google-play', 'fa-brands fa-google-plus', 'fa-brands fa-google-plus-g', 'fa-brands fa-google-wallet', 'fa-solid fa-gopuram', 'fa-solid fa-graduation-cap', 'fa-brands fa-gratipay', 'fa-brands fa-grav', 'fa-solid fa-greater-than', 'fa-solid fa-greater-than-equal', 'fa-solid fa-grip', 'fa-solid fa-grip-lines', 'fa-solid fa-grip-lines-vertical', 'fa-solid fa-grip-vertical', 'fa-brands fa-gripfire', 'fa-solid fa-group-arrows-rotate', 'fa-brands fa-grunt', 'fa-solid fa-guarani-sign', 'fa-brands fa-guilded', 'fa-solid fa-guitar', 'fa-brands fa-gulp', 'fa-solid fa-gun', 'fa-solid fa-h', 'fa-brands fa-hacker-news', 'fa-brands fa-square-threads', 'fa-brands fa-x-twitter', 'fa-brands fa-square-x-twitter', 'fa-brands fa-hackerrank', 'fa-solid fa-hammer', 'fa-solid fa-hamsa', 'fa-solid fa-hand', 'fa-regular fa-hand', 'fa-solid fa-hand-back-fist', 'fa-regular fa-hand-back-fist', 'fa-solid fa-hand-dots', 'fa-solid fa-hand-fist', 'fa-solid fa-hand-holding', 'fa-solid fa-hand-holding-dollar', 'fa-solid fa-hand-holding-droplet', 'fa-solid fa-hand-holding-hand', 'fa-solid fa-hand-holding-heart', 'fa-solid fa-hand-holding-medical', 'fa-solid fa-hand-lizard', 'fa-regular fa-hand-lizard', 'fa-solid fa-hand-middle-finger', 'fa-solid fa-hand-peace', 'fa-regular fa-hand-peace', 'fa-solid fa-hand-point-down', 'fa-regular fa-hand-point-down', 'fa-solid fa-hand-point-left', 'fa-regular fa-hand-point-left', 'fa-solid fa-hand-point-right', 'fa-regular fa-hand-point-right', 'fa-solid fa-hand-point-up', 'fa-regular fa-hand-point-up', 'fa-solid fa-hand-pointer', 'fa-regular fa-hand-pointer', 'fa-solid fa-hand-scissors', 'fa-regular fa-hand-scissors', 'fa-solid fa-hand-sparkles', 'fa-solid fa-hand-spock', 'fa-regular fa-hand-spock', 'fa-solid fa-handcuffs', 'fa-solid fa-hands', 'fa-solid fa-hands-asl-interpreting', 'fa-solid fa-hands-bound', 'fa-solid fa-hands-bubbles', 'fa-solid fa-hands-clapping', 'fa-solid fa-hands-holding', 'fa-solid fa-hands-holding-child', 'fa-solid fa-hands-holding-circle', 'fa-solid fa-hands-praying', 'fa-solid fa-handshake', 'fa-regular fa-handshake', 'fa-solid fa-handshake-angle', 'fa-solid fa-handshake-simple', 'fa-solid fa-handshake-simple-slash', 'fa-solid fa-handshake-slash', 'fa-solid fa-hanukiah', 'fa-solid fa-hard-drive', 'fa-regular fa-hard-drive', 'fa-brands fa-hashnode', 'fa-solid fa-hashtag', 'fa-solid fa-hat-cowboy', 'fa-solid fa-hat-cowboy-side', 'fa-solid fa-hat-wizard', 'fa-solid fa-head-side-cough', 'fa-solid fa-head-side-cough-slash', 'fa-solid fa-head-side-mask', 'fa-solid fa-head-side-virus', 'fa-solid fa-heading', 'fa-solid fa-headset', 'fa-solid fa-headset-simple', 'fa-solid fa-headset', 'fa-solid fa-heart', 'fa-regular fa-heart', 'fa-solid fa-heart-circle-bolt', 'fa-solid fa-heart-circle-check', 'fa-solid fa-heart-circle-exclamation', 'fa-solid fa-heart-circle-minus', 'fa-solid fa-heart-circle-plus', 'fa-solid fa-heart-circle-xmark', 'fa-solid fa-heart-crack', 'fa-solid fa-heart-pulse', 'fa-solid fa-helicopter', 'fa-solid fa-helicopter-symbol', 'fa-solid fa-helmet-safety', 'fa-solid fa-helmet-un', 'fa-solid fa-highlighter', 'fa-solid fa-hill-avalanche', 'fa-solid fa-hill-rockslide', 'fa-solid fa-hippo', 'fa-brands fa-hips', 'fa-brands fa-hire-a-helper', 'fa-brands fa-hive', 'fa-solid fa-hockey-puck', 'fa-solid fa-holly-berry', 'fa-brands fa-hooli', 'fa-brands fa-hornbill', 'fa-solid fa-horse', 'fa-solid fa-horse-head', 'fa-solid fa-hospital', 'fa-regular fa-hospital', 'fa-solid fa-hospital-user', 'fa-solid fa-hot-tub-person', 'fa-solid fa-hotdog', 'fa-solid fa-hotel', 'fa-brands fa-hotjar', 'fa-solid fa-hourglass', 'fa-regular fa-hourglass', 'fa-solid fa-hourglass-end', 'fa-solid fa-hourglass-half', 'fa-regular fa-hourglass-half', 'fa-solid fa-hourglass-start', 'fa-solid fa-house', 'fa-solid fa-house-chimney', 'fa-solid fa-house-chimney-crack', 'fa-solid fa-house-chimney-medical', 'fa-solid fa-house-chimney-user', 'fa-solid fa-house-chimney-window', 'fa-solid fa-house-circle-check', 'fa-solid fa-house-circle-exclamation', 'fa-solid fa-house-circle-xmark', 'fa-solid fa-house-crack', 'fa-solid fa-house-fire', 'fa-solid fa-house-flag', 'fa-solid fa-house-flood-water', 'fa-solid fa-house-flood-water-circle-arrow-right', 'fa-solid fa-house-laptop', 'fa-solid fa-house-lock', 'fa-solid fa-house-medical', 'fa-solid fa-house-medical-circle-check', 'fa-solid fa-house-medical-circle-exclamation', 'fa-solid fa-house-medical-circle-xmark', 'fa-solid fa-house-medical-flag', 'fa-solid fa-house-signal', 'fa-solid fa-house-tsunami', 'fa-solid fa-house-user', 'fa-brands fa-houzz', 'fa-solid fa-hryvnia-sign', 'fa-brands fa-html5', 'fa-brands fa-hubspot', 'fa-solid fa-hurricane', 'fa-solid fa-i', 'fa-solid fa-i-cursor', 'fa-solid fa-ice-cream', 'fa-solid fa-icicles', 'fa-solid fa-icons', 'fa-solid fa-id-badge', 'fa-regular fa-id-badge', 'fa-solid fa-id-card', 'fa-regular fa-id-card', 'fa-solid fa-id-card-clip', 'fa-brands fa-ideal', 'fa-solid fa-igloo', 'fa-solid fa-image', 'fa-regular fa-image', 'fa-solid fa-image-portrait', 'fa-solid fa-images', 'fa-regular fa-images', 'fa-brands fa-imdb', 'fa-solid fa-inbox', 'fa-solid fa-indent', 'fa-solid fa-indian-rupee-sign', 'fa-solid fa-industry', 'fa-solid fa-infinity', 'fa-solid fa-info', 'fa-brands fa-instagram', 'fa-brands fa-instalod', 'fa-brands fa-intercom', 'fa-brands fa-internet-explorer', 'fa-brands fa-invision', 'fa-brands fa-ioxhost', 'fa-solid fa-italic', 'fa-brands fa-itch-io', 'fa-brands fa-itunes', 'fa-brands fa-itunes-note', 'fa-solid fa-j', 'fa-solid fa-jar', 'fa-solid fa-jar-wheat', 'fa-brands fa-java', 'fa-solid fa-jedi', 'fa-brands fa-jedi-order', 'fa-brands fa-jenkins', 'fa-solid fa-jet-fighter', 'fa-solid fa-jet-fighter-up', 'fa-brands fa-jira', 'fa-brands fa-joget', 'fa-solid fa-joint', 'fa-brands fa-joomla', 'fa-brands fa-js', 'fa-brands fa-jsfiddle', 'fa-solid fa-jug-detergent', 'fa-solid fa-k', 'fa-solid fa-kaaba', 'fa-brands fa-kaggle', 'fa-solid fa-key', 'fa-brands fa-keybase', 'fa-solid fa-keyboard', 'fa-regular fa-keyboard', 'fa-brands fa-keycdn', 'fa-solid fa-khanda', 'fa-brands fa-kickstarter', 'fa-brands fa-kickstarter-k', 'fa-solid fa-kip-sign', 'fa-solid fa-kit-medical', 'fa-solid fa-kitchen-set', 'fa-solid fa-kiwi-bird', 'fa-brands fa-korvue', 'fa-solid fa-l', 'fa-solid fa-land-mine-on', 'fa-solid fa-landmark', 'fa-solid fa-landmark-dome', 'fa-solid fa-landmark-flag', 'fa-solid fa-language', 'fa-solid fa-laptop', 'fa-solid fa-laptop-code', 'fa-solid fa-laptop-file', 'fa-solid fa-laptop-medical', 'fa-brands fa-laravel', 'fa-solid fa-lari-sign', 'fa-brands fa-lastfm', 'fa-solid fa-layer-group', 'fa-solid fa-leaf', 'fa-brands fa-leanpub', 'fa-solid fa-left-long', 'fa-solid fa-left-right', 'fa-solid fa-lemon', 'fa-regular fa-lemon', 'fa-brands fa-less', 'fa-solid fa-less-than', 'fa-solid fa-less-than-equal', 'fa-solid fa-life-ring', 'fa-regular fa-life-ring', 'fa-solid fa-lightbulb', 'fa-regular fa-lightbulb', 'fa-brands fa-line', 'fa-solid fa-lines-leaning', 'fa-solid fa-link', 'fa-solid fa-link-slash', 'fa-brands fa-linkedin', 'fa-brands fa-linkedin-in', 'fa-brands fa-linode', 'fa-brands fa-linux', 'fa-solid fa-lira-sign', 'fa-solid fa-list', 'fa-solid fa-list-check', 'fa-solid fa-list-ol', 'fa-solid fa-list-ul', 'fa-solid fa-litecoin-sign', 'fa-solid fa-location-arrow', 'fa-solid fa-location-crosshairs', 'fa-solid fa-location-dot', 'fa-solid fa-location-pin', 'fa-solid fa-location-pin-lock', 'fa-solid fa-lock', 'fa-solid fa-lock-open', 'fa-solid fa-locust', 'fa-solid fa-lungs', 'fa-solid fa-lungs-virus', 'fa-brands fa-lyft', 'fa-solid fa-m', 'fa-brands fa-magento', 'fa-solid fa-magnet', 'fa-solid fa-magnifying-glass', 'fa-solid fa-magnifying-glass-arrow-right', 'fa-solid fa-magnifying-glass-chart', 'fa-solid fa-magnifying-glass-dollar', 'fa-solid fa-magnifying-glass-location', 'fa-solid fa-magnifying-glass-minus', 'fa-solid fa-magnifying-glass-plus', 'fa-brands fa-mailchimp', 'fa-solid fa-manat-sign', 'fa-brands fa-mandalorian', 'fa-solid fa-map', 'fa-regular fa-map', 'fa-solid fa-map-location', 'fa-solid fa-map-location-dot', 'fa-solid fa-map-pin', 'fa-brands fa-markdown', 'fa-solid fa-marker', 'fa-solid fa-mars', 'fa-solid fa-mars-and-venus', 'fa-solid fa-mars-and-venus-burst', 'fa-solid fa-mars-double', 'fa-solid fa-mars-stroke', 'fa-solid fa-mars-stroke-right', 'fa-solid fa-mars-stroke-up', 'fa-solid fa-martini-glass', 'fa-solid fa-martini-glass-citrus', 'fa-solid fa-martini-glass-empty', 'fa-solid fa-mask', 'fa-solid fa-mask-face', 'fa-solid fa-mask-ventilator', 'fa-solid fa-masks-theater', 'fa-brands fa-mastodon', 'fa-solid fa-mattress-pillow', 'fa-brands fa-maxcdn', 'fa-solid fa-maximize', 'fa-brands fa-mdb', 'fa-solid fa-medal', 'fa-brands fa-medapps', 'fa-brands fa-medium', 'fa-brands fa-medrt', 'fa-brands fa-meetup', 'fa-brands fa-megaport', 'fa-solid fa-memory', 'fa-brands fa-mendeley', 'fa-solid fa-menorah', 'fa-solid fa-mercury', 'fa-solid fa-message', 'fa-regular fa-message', 'fa-brands fa-meta', 'fa-solid fa-meteor', 'fa-brands fa-microblog', 'fa-solid fa-microchip', 'fa-solid fa-microphone', 'fa-solid fa-microphone-lines', 'fa-solid fa-microphone-lines-slash', 'fa-solid fa-microphone-slash', 'fa-solid fa-microscope', 'fa-brands fa-microsoft', 'fa-solid fa-mill-sign', 'fa-solid fa-minimize', 'fa-solid fa-minus', 'fa-solid fa-mitten', 'fa-brands fa-mix', 'fa-brands fa-mixcloud', 'fa-brands fa-mixer', 'fa-brands fa-mizuni', 'fa-solid fa-mobile', 'fa-solid fa-mobile-button', 'fa-solid fa-mobile-retro', 'fa-solid fa-mobile-screen', 'fa-solid fa-mobile-screen-button', 'fa-brands fa-modx', 'fa-brands fa-monero', 'fa-solid fa-money-bill', 'fa-solid fa-money-bill-1', 'fa-regular fa-money-bill-1', 'fa-solid fa-money-bill-1-wave', 'fa-solid fa-money-bill-transfer', 'fa-solid fa-money-bill-trend-up', 'fa-solid fa-money-bill-wave', 'fa-solid fa-money-bill-wheat', 'fa-solid fa-money-bills', 'fa-solid fa-money-check', 'fa-solid fa-money-check-dollar', 'fa-solid fa-monument', 'fa-solid fa-moon', 'fa-regular fa-moon', 'fa-solid fa-mortar-pestle', 'fa-solid fa-mosque', 'fa-solid fa-mosquito', 'fa-solid fa-mosquito-net', 'fa-solid fa-motorcycle', 'fa-solid fa-mound', 'fa-solid fa-mountain', 'fa-solid fa-mountain-city', 'fa-solid fa-mountain-sun', 'fa-solid fa-mug-hot', 'fa-solid fa-mug-saucer', 'fa-solid fa-music', 'fa-solid fa-n', 'fa-solid fa-naira-sign', 'fa-brands fa-napster', 'fa-brands fa-neos', 'fa-solid fa-network-wired', 'fa-solid fa-neuter', 'fa-solid fa-newspaper', 'fa-regular fa-newspaper', 'fa-brands fa-nfc-directional', 'fa-brands fa-nfc-symbol', 'fa-brands fa-nimblr', 'fa-brands fa-node', 'fa-brands fa-node-js', 'fa-solid fa-not-equal', 'fa-solid fa-notdef', 'fa-solid fa-note-sticky', 'fa-regular fa-note-sticky', 'fa-solid fa-notes-medical', 'fa-brands fa-npm', 'fa-brands fa-ns8', 'fa-brands fa-nutritionix', 'fa-solid fa-o', 'fa-solid fa-object-group', 'fa-regular fa-object-group', 'fa-solid fa-object-ungroup', 'fa-regular fa-object-ungroup', 'fa-brands fa-octopus-deploy', 'fa-brands fa-odnoklassniki', 'fa-brands fa-odysee', 'fa-solid fa-oil-can', 'fa-solid fa-oil-well', 'fa-brands fa-old-republic', 'fa-solid fa-om', 'fa-brands fa-opencart', 'fa-brands fa-openid', 'fa-brands fa-opera', 'fa-brands fa-optin-monster', 'fa-brands fa-orcid', 'fa-brands fa-osi', 'fa-solid fa-otter', 'fa-solid fa-outdent', 'fa-solid fa-p', 'fa-brands fa-padlet', 'fa-brands fa-page4', 'fa-brands fa-pagelines', 'fa-solid fa-pager', 'fa-solid fa-paint-roller', 'fa-solid fa-paintbrush', 'fa-solid fa-palette', 'fa-brands fa-palfed', 'fa-solid fa-pallet', 'fa-solid fa-panorama', 'fa-solid fa-paper-plane', 'fa-regular fa-paper-plane', 'fa-solid fa-paperclip', 'fa-solid fa-parachute-box', 'fa-solid fa-paragraph', 'fa-solid fa-passport', 'fa-solid fa-paste', 'fa-regular fa-paste', 'fa-brands fa-patreon', 'fa-solid fa-pause', 'fa-solid fa-paw', 'fa-brands fa-paypal', 'fa-solid fa-peace', 'fa-solid fa-pen', 'fa-solid fa-pen-clip', 'fa-solid fa-pen-fancy', 'fa-solid fa-pen-nib', 'fa-solid fa-pen-ruler', 'fa-solid fa-pen-to-square', 'fa-regular fa-pen-to-square', 'fa-solid fa-pencil', 'fa-solid fa-people-arrows', 'fa-solid fa-people-carry-box', 'fa-solid fa-people-group', 'fa-solid fa-people-line', 'fa-solid fa-people-pulling', 'fa-solid fa-people-robbery', 'fa-solid fa-people-roof', 'fa-solid fa-pepper-hot', 'fa-brands fa-perbyte', 'fa-solid fa-percent', 'fa-brands fa-periscope', 'fa-solid fa-person', 'fa-solid fa-person-arrow-down-to-line', 'fa-solid fa-person-arrow-up-from-line', 'fa-solid fa-person-biking', 'fa-solid fa-person-booth', 'fa-solid fa-person-breastfeeding', 'fa-solid fa-person-burst', 'fa-solid fa-person-cane', 'fa-solid fa-person-chalkboard', 'fa-solid fa-person-circle-check', 'fa-solid fa-person-circle-exclamation', 'fa-solid fa-person-circle-minus', 'fa-solid fa-person-circle-plus', 'fa-solid fa-person-circle-question', 'fa-solid fa-person-circle-xmark', 'fa-solid fa-person-digging', 'fa-solid fa-person-dots-from-line', 'fa-solid fa-person-dress', 'fa-solid fa-person-dress-burst', 'fa-solid fa-person-drowning', 'fa-solid fa-person-falling', 'fa-solid fa-person-falling-burst', 'fa-solid fa-person-half-dress', 'fa-solid fa-person-harassing', 'fa-solid fa-person-hiking', 'fa-solid fa-person-military-pointing', 'fa-solid fa-person-military-rifle', 'fa-solid fa-person-military-to-person', 'fa-solid fa-person-praying', 'fa-solid fa-person-pregnant', 'fa-solid fa-person-rays', 'fa-solid fa-person-rifle', 'fa-solid fa-person-running', 'fa-solid fa-person-shelter', 'fa-solid fa-person-skating', 'fa-solid fa-person-skiing', 'fa-solid fa-person-skiing-nordic', 'fa-solid fa-person-snowboarding', 'fa-solid fa-person-swimming', 'fa-solid fa-person-through-window', 'fa-solid fa-person-walking', 'fa-solid fa-person-walking-arrow-loop-left', 'fa-solid fa-person-walking-arrow-right', 'fa-solid fa-person-walking-dashed-line-arrow-right', 'fa-solid fa-person-walking-luggage', 'fa-solid fa-person-walking-with-cane', 'fa-solid fa-peseta-sign', 'fa-solid fa-peso-sign', 'fa-brands fa-phabricator', 'fa-brands fa-phoenix-framework', 'fa-brands fa-phoenix-squadron', 'fa-solid fa-phone', 'fa-solid fa-phone-flip', 'fa-solid fa-phone-slash', 'fa-solid fa-phone-volume', 'fa-solid fa-photo-film', 'fa-brands fa-php', 'fa-brands fa-pied-piper', 'fa-brands fa-pied-piper-alt', 'fa-brands fa-pied-piper-hat', 'fa-brands fa-pied-piper-pp', 'fa-solid fa-piggy-bank', 'fa-solid fa-pills', 'fa-brands fa-pinterest', 'fa-brands fa-pinterest-p', 'fa-brands fa-pix', 'fa-solid fa-pizza-slice', 'fa-solid fa-place-of-worship', 'fa-solid fa-plane', 'fa-solid fa-plane-arrival', 'fa-solid fa-plane-circle-check', 'fa-solid fa-plane-circle-exclamation', 'fa-solid fa-plane-circle-xmark', 'fa-solid fa-plane-departure', 'fa-solid fa-plane-lock', 'fa-solid fa-plane-slash', 'fa-solid fa-plane-up', 'fa-solid fa-plant-wilt', 'fa-solid fa-plate-wheat', 'fa-solid fa-play', 'fa-brands fa-playstation', 'fa-solid fa-plug', 'fa-solid fa-plug-circle-bolt', 'fa-solid fa-plug-circle-check', 'fa-solid fa-plug-circle-exclamation', 'fa-solid fa-plug-circle-minus', 'fa-solid fa-plug-circle-plus', 'fa-solid fa-plug-circle-xmark', 'fa-solid fa-plus', 'fa-solid fa-plus-minus', 'fa-solid fa-podcast', 'fa-solid fa-poo', 'fa-solid fa-poo-storm', 'fa-solid fa-poop', 'fa-solid fa-power-off', 'fa-solid fa-prescription', 'fa-solid fa-prescription-bottle', 'fa-solid fa-prescription-bottle-medical', 'fa-solid fa-print', 'fa-brands fa-product-hunt', 'fa-solid fa-pump-medical', 'fa-solid fa-pump-soap', 'fa-brands fa-pushed', 'fa-solid fa-puzzle-piece', 'fa-brands fa-python', 'fa-solid fa-q', 'fa-brands fa-qq', 'fa-solid fa-qrcode', 'fa-solid fa-question', 'fa-brands fa-quinscape', 'fa-brands fa-quora', 'fa-solid fa-quote-left', 'fa-solid fa-quote-right', 'fa-solid fa-r', 'fa-brands fa-r-project', 'fa-solid fa-radiation', 'fa-solid fa-radio', 'fa-solid fa-rainbow', 'fa-solid fa-ranking-star', 'fa-brands fa-raspberry-pi', 'fa-brands fa-ravelry', 'fa-brands fa-react', 'fa-brands fa-reacteurope', 'fa-brands fa-readme', 'fa-brands fa-rebel', 'fa-solid fa-receipt', 'fa-solid fa-record-vinyl', 'fa-solid fa-rectangle-ad', 'fa-solid fa-rectangle-list', 'fa-regular fa-rectangle-list', 'fa-solid fa-rectangle-xmark', 'fa-regular fa-rectangle-xmark', 'fa-solid fa-recycle', 'fa-brands fa-red-river', 'fa-brands fa-reddit', 'fa-brands fa-reddit-alien', 'fa-brands fa-redhat', 'fa-solid fa-registered', 'fa-regular fa-registered', 'fa-brands fa-renren', 'fa-solid fa-repeat', 'fa-solid fa-reply', 'fa-solid fa-reply-all', 'fa-brands fa-replyd', 'fa-solid fa-republican', 'fa-brands fa-researchgate', 'fa-brands fa-resolving', 'fa-solid fa-restroom', 'fa-solid fa-retweet', 'fa-brands fa-rev', 'fa-solid fa-ribbon', 'fa-solid fa-right-from-bracket', 'fa-solid fa-right-left', 'fa-solid fa-right-long', 'fa-solid fa-right-to-bracket', 'fa-solid fa-ring', 'fa-solid fa-road', 'fa-solid fa-road-barrier', 'fa-solid fa-road-bridge', 'fa-solid fa-road-circle-check', 'fa-solid fa-road-circle-exclamation', 'fa-solid fa-road-circle-xmark', 'fa-solid fa-road-lock', 'fa-solid fa-road-spikes', 'fa-solid fa-robot', 'fa-solid fa-rocket', 'fa-brands fa-rocketchat', 'fa-brands fa-rockrms', 'fa-solid fa-rotate', 'fa-solid fa-rotate-left', 'fa-solid fa-rotate-right', 'fa-solid fa-route', 'fa-solid fa-rss', 'fa-solid fa-ruble-sign', 'fa-solid fa-rug', 'fa-solid fa-ruler', 'fa-solid fa-ruler-combined', 'fa-solid fa-ruler-horizontal', 'fa-solid fa-ruler-vertical', 'fa-solid fa-rupee-sign', 'fa-solid fa-rupiah-sign', 'fa-brands fa-rust', 'fa-solid fa-s', 'fa-solid fa-sack-dollar', 'fa-solid fa-sack-xmark', 'fa-brands fa-safari', 'fa-solid fa-sailboat', 'fa-brands fa-salesforce', 'fa-brands fa-sass', 'fa-solid fa-satellite', 'fa-solid fa-satellite-dish', 'fa-solid fa-scale-balanced', 'fa-solid fa-scale-unbalanced', 'fa-solid fa-scale-unbalanced-flip', 'fa-brands fa-schlix', 'fa-solid fa-school', 'fa-solid fa-school-circle-check', 'fa-solid fa-school-circle-exclamation', 'fa-solid fa-school-circle-xmark', 'fa-solid fa-school-flag', 'fa-solid fa-school-lock', 'fa-solid fa-scissors', 'fa-brands fa-screenpal', 'fa-solid fa-screwdriver', 'fa-solid fa-screwdriver-wrench', 'fa-brands fa-scribd', 'fa-solid fa-scroll', 'fa-solid fa-scroll-torah', 'fa-solid fa-sd-card', 'fa-brands fa-searchengin', 'fa-solid fa-section', 'fa-solid fa-seedling', 'fa-brands fa-sellcast', 'fa-brands fa-sellsy', 'fa-solid fa-server', 'fa-brands fa-servicestack', 'fa-solid fa-shapes', 'fa-solid fa-share', 'fa-solid fa-share-from-square', 'fa-regular fa-share-from-square', 'fa-solid fa-share-nodes', 'fa-solid fa-sheet-plastic', 'fa-solid fa-shekel-sign', 'fa-solid fa-shield', 'fa-solid fa-shield-cat', 'fa-solid fa-shield-dog', 'fa-solid fa-shield-halved', 'fa-solid fa-shield-heart', 'fa-solid fa-shield-virus', 'fa-solid fa-ship', 'fa-solid fa-shirt', 'fa-brands fa-shirtsinbulk', 'fa-solid fa-shoe-prints', 'fa-solid fa-shop', 'fa-solid fa-shop-lock', 'fa-solid fa-shop-slash', 'fa-brands fa-shopify', 'fa-brands fa-shopware', 'fa-solid fa-shower', 'fa-solid fa-shrimp', 'fa-solid fa-shuffle', 'fa-solid fa-shuttle-space', 'fa-solid fa-sign-hanging', 'fa-solid fa-signal', 'fa-solid fa-signature', 'fa-solid fa-signs-post', 'fa-solid fa-sim-card', 'fa-brands fa-simplybuilt', 'fa-solid fa-sink', 'fa-brands fa-sistrix', 'fa-solid fa-sitemap', 'fa-brands fa-sith', 'fa-brands fa-sitrox', 'fa-brands fa-sketch', 'fa-solid fa-skull', 'fa-solid fa-skull-crossbones', 'fa-brands fa-skyatlas', 'fa-brands fa-skype', 'fa-brands fa-slack', 'fa-solid fa-slash', 'fa-solid fa-sleigh', 'fa-solid fa-sliders', 'fa-brands fa-slideshare', 'fa-solid fa-smog', 'fa-solid fa-smoking', 'fa-brands fa-snapchat', 'fa-solid fa-snowflake', 'fa-regular fa-snowflake', 'fa-solid fa-snowman', 'fa-solid fa-snowplow', 'fa-solid fa-soap', 'fa-solid fa-socks', 'fa-solid fa-solar-panel', 'fa-solid fa-sort', 'fa-solid fa-sort-down', 'fa-solid fa-sort-up', 'fa-brands fa-soundcloud', 'fa-brands fa-sourcetree', 'fa-solid fa-spa', 'fa-brands fa-space-awesome', 'fa-solid fa-spaghetti-monster-flying', 'fa-brands fa-speakap', 'fa-brands fa-speaker-deck', 'fa-solid fa-spell-check', 'fa-solid fa-spider', 'fa-solid fa-spinner', 'fa-solid fa-splotch', 'fa-solid fa-spoon', 'fa-brands fa-spotify', 'fa-solid fa-spray-can', 'fa-solid fa-spray-can-sparkles', 'fa-solid fa-square', 'fa-regular fa-square', 'fa-solid fa-square-arrow-up-right', 'fa-brands fa-square-behance', 'fa-solid fa-square-caret-down', 'fa-regular fa-square-caret-down', 'fa-solid fa-square-caret-left', 'fa-regular fa-square-caret-left', 'fa-solid fa-square-caret-right', 'fa-regular fa-square-caret-right', 'fa-solid fa-square-caret-up', 'fa-regular fa-square-caret-up', 'fa-solid fa-square-check', 'fa-regular fa-square-check', 'fa-brands fa-square-dribbble', 'fa-solid fa-square-envelope', 'fa-brands fa-square-facebook', 'fa-brands fa-square-font-awesome', 'fa-brands fa-square-font-awesome-stroke', 'fa-solid fa-square-full', 'fa-regular fa-square-full', 'fa-brands fa-square-git', 'fa-brands fa-square-github', 'fa-brands fa-square-gitlab', 'fa-brands fa-square-google-plus', 'fa-solid fa-square-h', 'fa-brands fa-square-hacker-news', 'fa-brands fa-square-instagram', 'fa-brands fa-square-js', 'fa-brands fa-square-lastfm', 'fa-solid fa-square-minus', 'fa-regular fa-square-minus', 'fa-solid fa-square-nfi', 'fa-brands fa-square-odnoklassniki', 'fa-solid fa-square-parking', 'fa-solid fa-square-pen', 'fa-solid fa-square-person-confined', 'fa-solid fa-square-phone', 'fa-solid fa-square-phone-flip', 'fa-brands fa-square-pied-piper', 'fa-brands fa-square-pinterest', 'fa-solid fa-square-plus', 'fa-regular fa-square-plus', 'fa-solid fa-square-poll-horizontal', 'fa-solid fa-square-poll-vertical', 'fa-brands fa-square-reddit', 'fa-solid fa-square-root-variable', 'fa-solid fa-square-rss', 'fa-solid fa-square-share-nodes', 'fa-brands fa-square-snapchat', 'fa-brands fa-square-steam', 'fa-brands fa-square-tumblr', 'fa-brands fa-square-twitter', 'fa-solid fa-square-up-right', 'fa-brands fa-square-viadeo', 'fa-brands fa-square-vimeo', 'fa-solid fa-square-virus', 'fa-brands fa-square-whatsapp', 'fa-brands fa-square-xing', 'fa-solid fa-square-xmark', 'fa-brands fa-square-youtube', 'fa-brands fa-squarespace', 'fa-brands fa-stack-exchange', 'fa-brands fa-stack-overflow', 'fa-brands fa-stackpath', 'fa-solid fa-staff-snake', 'fa-solid fa-stairs', 'fa-solid fa-stamp', 'fa-solid fa-stapler', 'fa-solid fa-star', 'fa-regular fa-star', 'fa-solid fa-star-and-crescent', 'fa-solid fa-star-half', 'fa-regular fa-star-half', 'fa-solid fa-star-half-stroke', 'fa-regular fa-star-half-stroke', 'fa-solid fa-star-of-david', 'fa-solid fa-star-of-life', 'fa-brands fa-staylinked', 'fa-brands fa-steam', 'fa-brands fa-steam-symbol', 'fa-solid fa-sterling-sign', 'fa-solid fa-stethoscope', 'fa-brands fa-sticker-mule', 'fa-solid fa-stop', 'fa-solid fa-stopwatch', 'fa-solid fa-stopwatch-20', 'fa-solid fa-store', 'fa-solid fa-store-slash', 'fa-brands fa-strava', 'fa-solid fa-street-view', 'fa-solid fa-strikethrough', 'fa-brands fa-stripe', 'fa-brands fa-stripe-s', 'fa-solid fa-stroopwafel', 'fa-brands fa-stubber', 'fa-brands fa-studiovinari', 'fa-brands fa-stumbleupon', 'fa-brands fa-stumbleupon-circle', 'fa-solid fa-subscript', 'fa-solid fa-suitcase', 'fa-solid fa-suitcase-medical', 'fa-solid fa-suitcase-rolling', 'fa-solid fa-sun', 'fa-regular fa-sun', 'fa-solid fa-sun-plant-wilt', 'fa-brands fa-superpowers', 'fa-solid fa-superscript', 'fa-brands fa-supple', 'fa-brands fa-suse', 'fa-solid fa-swatchbook', 'fa-brands fa-swift', 'fa-brands fa-symfony', 'fa-solid fa-synagogue', 'fa-solid fa-syringe', 'fa-solid fa-t', 'fa-solid fa-table', 'fa-solid fa-table-cells', 'fa-solid fa-table-cells-large', 'fa-solid fa-table-columns', 'fa-solid fa-table-list', 'fa-solid fa-table-tennis-paddle-ball', 'fa-solid fa-tablet', 'fa-solid fa-tablet-button', 'fa-solid fa-tablet-screen-button', 'fa-solid fa-tablets', 'fa-solid fa-tachograph-digital', 'fa-solid fa-tag', 'fa-solid fa-tags', 'fa-solid fa-tape', 'fa-solid fa-tarp', 'fa-solid fa-tarp-droplet', 'fa-solid fa-taxi', 'fa-brands fa-teamspeak', 'fa-solid fa-teeth', 'fa-solid fa-teeth-open', 'fa-brands fa-telegram', 'fa-solid fa-temperature-arrow-down', 'fa-solid fa-temperature-arrow-up', 'fa-solid fa-temperature-empty', 'fa-solid fa-temperature-full', 'fa-solid fa-temperature-half', 'fa-solid fa-temperature-high', 'fa-solid fa-temperature-low', 'fa-solid fa-temperature-quarter', 'fa-solid fa-temperature-three-quarters', 'fa-brands fa-tencent-weibo', 'fa-solid fa-tenge-sign', 'fa-solid fa-tent', 'fa-solid fa-tent-arrow-down-to-line', 'fa-solid fa-tent-arrow-left-right', 'fa-solid fa-tent-arrow-turn-left', 'fa-solid fa-tent-arrows-down', 'fa-solid fa-tents', 'fa-solid fa-terminal', 'fa-solid fa-text-height', 'fa-solid fa-text-slash', 'fa-solid fa-text-width', 'fa-brands fa-the-red-yeti', 'fa-brands fa-themeco', 'fa-brands fa-themeisle', 'fa-solid fa-thermometer', 'fa-brands fa-think-peaks', 'fa-solid fa-thumbs-down', 'fa-regular fa-thumbs-down', 'fa-solid fa-thumbs-up', 'fa-regular fa-thumbs-up', 'fa-solid fa-thumbtack', 'fa-solid fa-ticket', 'fa-solid fa-ticket-simple', 'fa-brands fa-tiktok', 'fa-solid fa-timeline', 'fa-solid fa-toggle-off', 'fa-solid fa-toggle-on', 'fa-solid fa-toilet', 'fa-solid fa-toilet-paper', 'fa-solid fa-toilet-paper-slash', 'fa-solid fa-toilet-portable', 'fa-solid fa-toilets-portable', 'fa-solid fa-toolbox', 'fa-solid fa-tooth', 'fa-solid fa-torii-gate', 'fa-solid fa-tornado', 'fa-solid fa-tower-broadcast', 'fa-solid fa-tower-cell', 'fa-solid fa-tower-observation', 'fa-solid fa-tractor', 'fa-brands fa-trade-federation', 'fa-solid fa-trademark', 'fa-solid fa-traffic-light', 'fa-solid fa-trailer', 'fa-solid fa-train', 'fa-solid fa-train-subway', 'fa-solid fa-train-tram', 'fa-solid fa-transgender', 'fa-solid fa-trash', 'fa-solid fa-trash-arrow-up', 'fa-solid fa-trash-can', 'fa-regular fa-trash-can', 'fa-solid fa-trash-can-arrow-up', 'fa-solid fa-tree', 'fa-solid fa-tree-city', 'fa-brands fa-trello', 'fa-solid fa-triangle-exclamation', 'fa-solid fa-trophy', 'fa-solid fa-trowel', 'fa-solid fa-trowel-bricks', 'fa-solid fa-truck', 'fa-solid fa-truck-arrow-right', 'fa-solid fa-truck-droplet', 'fa-solid fa-truck-fast', 'fa-solid fa-truck-field', 'fa-solid fa-truck-field-un', 'fa-solid fa-truck-front', 'fa-solid fa-truck-medical', 'fa-solid fa-truck-monster', 'fa-solid fa-truck-moving', 'fa-solid fa-truck-pickup', 'fa-solid fa-truck-plane', 'fa-solid fa-truck-ramp-box', 'fa-solid fa-tty', 'fa-brands fa-tumblr', 'fa-solid fa-turkish-lira-sign', 'fa-solid fa-turn-down', 'fa-solid fa-turn-up', 'fa-solid fa-tv', 'fa-brands fa-twitch', 'fa-brands fa-twitter', 'fa-brands fa-typo3', 'fa-solid fa-u', 'fa-brands fa-uber', 'fa-brands fa-ubuntu', 'fa-brands fa-uikit', 'fa-brands fa-umbraco', 'fa-solid fa-umbrella', 'fa-solid fa-umbrella-beach', 'fa-brands fa-uncharted', 'fa-solid fa-underline', 'fa-brands fa-uniregistry', 'fa-brands fa-unity', 'fa-solid fa-universal-access', 'fa-solid fa-unlock', 'fa-solid fa-unlock-keyhole', 'fa-brands fa-unsplash', 'fa-brands fa-untappd', 'fa-solid fa-up-down', 'fa-solid fa-up-down-left-right', 'fa-solid fa-up-long', 'fa-solid fa-up-right-and-down-left-from-center', 'fa-solid fa-up-right-from-square', 'fa-solid fa-upload', 'fa-brands fa-ups', 'fa-brands fa-usb', 'fa-solid fa-user', 'fa-regular fa-user', 'fa-solid fa-user-astronaut', 'fa-solid fa-user-check', 'fa-solid fa-user-clock', 'fa-solid fa-user-doctor', 'fa-solid fa-user-gear', 'fa-solid fa-user-graduate', 'fa-solid fa-user-group', 'fa-solid fa-user-injured', 'fa-solid fa-user-large', 'fa-solid fa-user-large-slash', 'fa-solid fa-user-lock', 'fa-solid fa-user-minus', 'fa-solid fa-user-ninja', 'fa-solid fa-user-nurse', 'fa-solid fa-user-pen', 'fa-solid fa-user-plus', 'fa-solid fa-user-secret', 'fa-solid fa-user-shield', 'fa-solid fa-user-slash', 'fa-solid fa-user-tag', 'fa-solid fa-user-tie', 'fa-solid fa-user-xmark', 'fa-solid fa-users', 'fa-solid fa-users-between-lines', 'fa-solid fa-users-gear', 'fa-solid fa-users-line', 'fa-solid fa-users-rays', 'fa-solid fa-users-rectangle', 'fa-solid fa-users-slash', 'fa-solid fa-users-viewfinder', 'fa-brands fa-usps', 'fa-brands fa-ussunnah', 'fa-solid fa-utensils', 'fa-solid fa-v', 'fa-brands fa-vaadin', 'fa-solid fa-van-shuttle', 'fa-solid fa-vault', 'fa-solid fa-vector-square', 'fa-solid fa-venus', 'fa-solid fa-venus-double', 'fa-solid fa-venus-mars', 'fa-solid fa-vest', 'fa-solid fa-vest-patches', 'fa-brands fa-viacoin', 'fa-brands fa-viadeo', 'fa-solid fa-vial', 'fa-solid fa-vial-circle-check', 'fa-solid fa-vial-virus', 'fa-solid fa-vials', 'fa-brands fa-viber', 'fa-solid fa-video', 'fa-solid fa-video-slash', 'fa-solid fa-vihara', 'fa-brands fa-vimeo', 'fa-brands fa-vimeo-v', 'fa-brands fa-vine', 'fa-solid fa-virus', 'fa-solid fa-virus-covid', 'fa-solid fa-virus-covid-slash', 'fa-solid fa-virus-slash', 'fa-solid fa-viruses', 'fa-brands fa-vk', 'fa-brands fa-vnv', 'fa-solid fa-voicemail', 'fa-solid fa-volcano', 'fa-solid fa-volleyball', 'fa-solid fa-volume-high', 'fa-solid fa-volume-low', 'fa-solid fa-volume-off', 'fa-solid fa-volume-xmark', 'fa-solid fa-vr-cardboard', 'fa-brands fa-vuejs', 'fa-solid fa-w', 'fa-solid fa-walkie-talkie', 'fa-solid fa-wallet', 'fa-solid fa-wand-magic', 'fa-solid fa-wand-magic-sparkles', 'fa-solid fa-wand-sparkles', 'fa-solid fa-warehouse', 'fa-brands fa-watchman-monitoring', 'fa-solid fa-water', 'fa-solid fa-water-ladder', 'fa-solid fa-wave-square', 'fa-brands fa-waze', 'fa-brands fa-weebly', 'fa-brands fa-weibo', 'fa-solid fa-weight-hanging', 'fa-solid fa-weight-scale', 'fa-brands fa-weixin', 'fa-brands fa-whatsapp', 'fa-solid fa-wheat-awn', 'fa-solid fa-wheat-awn-circle-exclamation', 'fa-solid fa-wheelchair', 'fa-solid fa-wheelchair-move', 'fa-solid fa-whiskey-glass', 'fa-brands fa-whmcs', 'fa-solid fa-wifi', 'fa-brands fa-wikipedia-w', 'fa-solid fa-wind', 'fa-solid fa-window-maximize', 'fa-regular fa-window-maximize', 'fa-solid fa-window-minimize', 'fa-regular fa-window-minimize', 'fa-solid fa-window-restore', 'fa-regular fa-window-restore', 'fa-brands fa-windows', 'fa-solid fa-wine-bottle', 'fa-solid fa-wine-glass', 'fa-solid fa-wine-glass-empty', 'fa-brands fa-wirsindhandwerk', 'fa-brands fa-wix', 'fa-brands fa-wizards-of-the-coast', 'fa-brands fa-wodu', 'fa-brands fa-wolf-pack-battalion', 'fa-solid fa-won-sign', 'fa-brands fa-wordpress', 'fa-brands fa-wordpress-simple', 'fa-solid fa-worm', 'fa-brands fa-wpbeginner', 'fa-brands fa-wpexplorer', 'fa-brands fa-wpforms', 'fa-brands fa-wpressr', 'fa-solid fa-wrench', 'fa-solid fa-x', 'fa-solid fa-x-ray', 'fa-brands fa-xbox', 'fa-brands fa-xing', 'fa-solid fa-xmark', 'fa-solid fa-xmarks-lines', 'fa-solid fa-y', 'fa-brands fa-y-combinator', 'fa-brands fa-yahoo', 'fa-brands fa-yammer', 'fa-brands fa-yandex', 'fa-brands fa-yandex-international', 'fa-brands fa-yarn', 'fa-brands fa-yelp', 'fa-solid fa-yen-sign', 'fa-solid fa-yin-yang', 'fa-brands fa-yoast', 'fa-brands fa-youtube', 'fa-solid fa-z', 'fa-brands fa-zhihu');
    }
}

/**
 * IconFont Icon Set
*/
if (!function_exists('cleaninglight_icofont_icon_array')) {
    function cleaninglight_icofont_icon_array() {
        return array("icofont-angry-monster","icofont-bathtub","icofont-bird-wings","icofont-bow","icofont-castle","icofont-circuit","icofont-crown-king","icofont-crown-queen","icofont-dart","icofont-disability-race","icofont-diving-goggle","icofont-eye-open","icofont-flora-flower","icofont-flora","icofont-gift-box","icofont-halloween-pumpkin","icofont-hand-power","icofont-hand-thunder","icofont-king-monster","icofont-love","icofont-magician-hat","icofont-native-american","icofont-owl-look","icofont-phoenix","icofont-robot-face","icofont-sand-clock","icofont-shield-alt","icofont-ship-wheel","icofont-skull-danger","icofont-skull-face","icofont-snowmobile","icofont-space-shuttle","icofont-star-shape","icofont-swirl","icofont-tattoo-wing","icofont-throne","icofont-tree-alt","icofont-triangle","icofont-unity-hand","icofont-weed","icofont-woman-bird","icofont-bat","icofont-bear-face","icofont-bear-tracks","icofont-bear","icofont-bird-alt","icofont-bird-flying","icofont-bird","icofont-birds","icofont-bone","icofont-bull","icofont-butterfly-alt","icofont-butterfly","icofont-camel-alt","icofont-camel-head","icofont-camel","icofont-cat-alt-1","icofont-cat-alt-2","icofont-cat-alt-3","icofont-cat-dog","icofont-cat-face","icofont-cat","icofont-cow-head","icofont-cow","icofont-crab","icofont-crocodile","icofont-deer-head","icofont-dog-alt","icofont-dog-barking","icofont-dog","icofont-dolphin","icofont-duck-tracks","icofont-eagle-head","icofont-eaten-fish","icofont-elephant-alt","icofont-elephant-head-alt","icofont-elephant-head","icofont-elephant","icofont-elk","icofont-fish-1","icofont-fish-2","icofont-fish-3","icofont-fish-4","icofont-fish-5","icofont-fish","icofont-fox-alt","icofont-fox","icofont-frog-tracks","icofont-frog","icofont-froggy","icofont-giraffe-head-1","icofont-giraffe-head-2","icofont-giraffe-head","icofont-giraffe","icofont-goat-head","icofont-gorilla","icofont-hen-tracks","icofont-horse-head-1","icofont-horse-head-2","icofont-horse-head","icofont-horse-tracks","icofont-jellyfish","icofont-kangaroo","icofont-lemur","icofont-lion-head-1","icofont-lion-head-2","icofont-lion-head","icofont-lion","icofont-monkey-2","icofont-monkey-3","icofont-monkey-face","icofont-monkey","icofont-octopus-alt","icofont-octopus","icofont-owl","icofont-panda-face","icofont-panda","icofont-panther","icofont-parrot-lip","icofont-parrot","icofont-paw","icofont-pelican","icofont-penguin","icofont-pig-face","icofont-pig","icofont-pigeon-1","icofont-pigeon-2","icofont-pigeon","icofont-rabbit","icofont-rat","icofont-rhino-head","icofont-rhino","icofont-rooster","icofont-seahorse","icofont-seal","icofont-shrimp-alt","icofont-shrimp","icofont-snail-1","icofont-snail-2","icofont-snail-3","icofont-snail","icofont-snake","icofont-squid","icofont-squirrel","icofont-tiger-face","icofont-tiger","icofont-turtle","icofont-whale","icofont-woodpecker","icofont-zebra","icofont-brand-acer","icofont-brand-adidas","icofont-brand-adobe","icofont-brand-air-new-zealand","icofont-brand-airbnb","icofont-brand-aircell","icofont-brand-airtel","icofont-brand-alcatel","icofont-brand-alibaba","icofont-brand-aliexpress","icofont-brand-alipay","icofont-brand-amazon","icofont-brand-amd","icofont-brand-american-airlines","icofont-brand-android-robot","icofont-brand-android","icofont-brand-aol","icofont-brand-apple","icofont-brand-appstore","icofont-brand-asus","icofont-brand-ati","icofont-brand-att","icofont-brand-audi","icofont-brand-axiata","icofont-brand-bada","icofont-brand-bbc","icofont-brand-bing","icofont-brand-blackberry","icofont-brand-bmw","icofont-brand-box","icofont-brand-burger-king","icofont-brand-business-insider","icofont-brand-buzzfeed","icofont-brand-cannon","icofont-brand-casio","icofont-brand-china-mobile","icofont-brand-china-telecom","icofont-brand-china-unicom","icofont-brand-cisco","icofont-brand-citibank","icofont-brand-cnet","icofont-brand-cnn","icofont-brand-cocal-cola","icofont-brand-compaq","icofont-brand-debian","icofont-brand-delicious","icofont-brand-dell","icofont-brand-designbump","icofont-brand-designfloat","icofont-brand-disney","icofont-brand-dodge","icofont-brand-dove","icofont-brand-drupal","icofont-brand-ebay","icofont-brand-eleven","icofont-brand-emirates","icofont-brand-espn","icofont-brand-etihad-airways","icofont-brand-etisalat","icofont-brand-etsy","icofont-brand-fastrack","icofont-brand-fedex","icofont-brand-ferrari","icofont-brand-fitbit","icofont-brand-flikr","icofont-brand-forbes","icofont-brand-foursquare","icofont-brand-foxconn","icofont-brand-fujitsu","icofont-brand-general-electric","icofont-brand-gillette","icofont-brand-gizmodo","icofont-brand-gnome","icofont-brand-google","icofont-brand-gopro","icofont-brand-gucci","icofont-brand-hallmark","icofont-brand-hi5","icofont-brand-honda","icofont-brand-hp","icofont-brand-hsbc","icofont-brand-htc","icofont-brand-huawei","icofont-brand-hulu","icofont-brand-hyundai","icofont-brand-ibm","icofont-brand-icofont","icofont-brand-icq","icofont-brand-ikea","icofont-brand-imdb","icofont-brand-indiegogo","icofont-brand-intel","icofont-brand-ipair","icofont-brand-jaguar","icofont-brand-java","icofont-brand-joomla","icofont-brand-kickstarter","icofont-brand-kik","icofont-brand-lastfm","icofont-brand-lego","icofont-brand-lenovo","icofont-brand-levis","icofont-brand-lexus","icofont-brand-lg","icofont-brand-life-hacker","icofont-brand-linux-mint","icofont-brand-linux","icofont-brand-lionix","icofont-brand-loreal","icofont-brand-louis-vuitton","icofont-brand-mac-os","icofont-brand-marvel-app","icofont-brand-mashable","icofont-brand-mazda","icofont-brand-mcdonals","icofont-brand-mercedes","icofont-brand-micromax","icofont-brand-microsoft","icofont-brand-mobileme","icofont-brand-mobily","icofont-brand-motorola","icofont-brand-msi","icofont-brand-mts","icofont-brand-myspace","icofont-brand-mytv","icofont-brand-nasa","icofont-brand-natgeo","icofont-brand-nbc","icofont-brand-nescafe","icofont-brand-nestle","icofont-brand-netflix","icofont-brand-nexus","icofont-brand-nike","icofont-brand-nokia","icofont-brand-nvidia","icofont-brand-omega","icofont-brand-opensuse","icofont-brand-oracle","icofont-brand-panasonic","icofont-brand-paypal","icofont-brand-pepsi","icofont-brand-philips","icofont-brand-pizza-hut","icofont-brand-playstation","icofont-brand-puma","icofont-brand-qatar-air","icofont-brand-qvc","icofont-brand-readernaut","icofont-brand-redbull","icofont-brand-reebok","icofont-brand-reuters","icofont-brand-samsung","icofont-brand-sap","icofont-brand-saudia-airlines","icofont-brand-scribd","icofont-brand-shell","icofont-brand-siemens","icofont-brand-sk-telecom","icofont-brand-slideshare","icofont-brand-smashing-magazine","icofont-brand-snapchat","icofont-brand-sony-ericsson","icofont-brand-sony","icofont-brand-soundcloud","icofont-brand-sprint","icofont-brand-squidoo","icofont-brand-starbucks","icofont-brand-stc","icofont-brand-steam","icofont-brand-suzuki","icofont-brand-symbian","icofont-brand-t-mobile","icofont-brand-tango","icofont-brand-target","icofont-brand-tata-indicom","icofont-brand-techcrunch","icofont-brand-telenor","icofont-brand-teliasonera","icofont-brand-tesla","icofont-brand-the-verge","icofont-brand-thenextweb","icofont-brand-toshiba","icofont-brand-toyota","icofont-brand-tribenet","icofont-brand-ubuntu","icofont-brand-unilever","icofont-brand-vaio","icofont-brand-verizon","icofont-brand-viber","icofont-brand-vodafone","icofont-brand-volkswagen","icofont-brand-walmart","icofont-brand-warnerbros","icofont-brand-whatsapp","icofont-brand-wikipedia","icofont-brand-windows","icofont-brand-wire","icofont-brand-wordpress","icofont-brand-xiaomi","icofont-brand-yahoobuzz","icofont-brand-yamaha","icofont-brand-youtube","icofont-brand-zain","icofont-bank-alt","icofont-bank","icofont-barcode","icofont-bill-alt","icofont-billboard","icofont-briefcase-1","icofont-briefcase-2","icofont-businessman","icofont-businesswoman","icofont-chair","icofont-coins","icofont-company","icofont-contact-add","icofont-files-stack","icofont-handshake-deal","icofont-id-card","icofont-meeting-add","icofont-money-bag","icofont-pie-chart","icofont-presentation-alt","icofont-presentation","icofont-stamp","icofont-stock-mobile","icofont-chart-arrows-axis","icofont-chart-bar-graph","icofont-chart-flow-1","icofont-chart-flow-2","icofont-chart-flow","icofont-chart-growth","icofont-chart-histogram-alt","icofont-chart-histogram","icofont-chart-line-alt","icofont-chart-line","icofont-chart-pie-alt","icofont-chart-pie","icofont-chart-radar-graph","icofont-architecture-alt","icofont-architecture","icofont-barricade","icofont-bolt","icofont-bricks","icofont-building-alt","icofont-bull-dozer","icofont-calculations","icofont-cement-mix","icofont-cement-mixer","icofont-concrete-mixer","icofont-danger-zone","icofont-drill","icofont-eco-energy","icofont-eco-environmen","icofont-energy-air","icofont-energy-oil","icofont-energy-savings","icofont-energy-solar","icofont-energy-water","icofont-engineer","icofont-fire-extinguisher-alt","icofont-fire-extinguisher","icofont-fix-tools","icofont-fork-lift","icofont-glue-oil","icofont-hammer-alt","icofont-hammer","icofont-help-robot","icofont-industries-1","icofont-industries-2","icofont-industries-3","icofont-industries-4","icofont-industries-5","icofont-industries","icofont-labour","icofont-mining","icofont-paint-brush","icofont-pollution","icofont-power-zone","icofont-radio-active","icofont-recycle-alt","icofont-recycling-man","icofont-safety-hat-light","icofont-safety-hat","icofont-saw","icofont-screw-driver","icofont-tools-1","icofont-tools-bag","icofont-tow-truck","icofont-trolley","icofont-trowel","icofont-under-construction-alt","icofont-under-construction","icofont-vehicle-cement","icofont-vehicle-crane","icofont-vehicle-delivery-van","icofont-vehicle-dozer","icofont-vehicle-excavator","icofont-vehicle-trucktor","icofont-vehicle-wrecking","icofont-worker","icofont-workers-group","icofont-wrench","icofont-afghani-false","icofont-afghani-minus","icofont-afghani-plus","icofont-afghani-true","icofont-afghani","icofont-baht-false","icofont-baht-minus","icofont-baht-plus","icofont-baht-true","icofont-baht","icofont-bitcoin-false","icofont-bitcoin-minus","icofont-bitcoin-plus","icofont-bitcoin-true","icofont-bitcoin","icofont-dollar-flase","icofont-dollar-minus","icofont-dollar-plus","icofont-dollar-true","icofont-dollar","icofont-dong-false","icofont-dong-minus","icofont-dong-plus","icofont-dong-true","icofont-dong","icofont-euro-false","icofont-euro-minus","icofont-euro-plus","icofont-euro-true","icofont-euro","icofont-frank-false","icofont-frank-minus","icofont-frank-plus","icofont-frank-true","icofont-frank","icofont-hryvnia-false","icofont-hryvnia-minus","icofont-hryvnia-plus","icofont-hryvnia-true","icofont-hryvnia","icofont-lira-false","icofont-lira-minus","icofont-lira-plus","icofont-lira-true","icofont-lira","icofont-peseta-false","icofont-peseta-minus","icofont-peseta-plus","icofont-peseta-true","icofont-peseta","icofont-peso-false","icofont-peso-minus","icofont-peso-plus","icofont-peso-true","icofont-peso","icofont-pound-false","icofont-pound-minus","icofont-pound-plus","icofont-pound-true","icofont-pound","icofont-renminbi-false","icofont-renminbi-minus","icofont-renminbi-plus","icofont-renminbi-true","icofont-renminbi","icofont-riyal-false","icofont-riyal-minus","icofont-riyal-plus","icofont-riyal-true","icofont-riyal","icofont-rouble-false","icofont-rouble-minus","icofont-rouble-plus","icofont-rouble-true","icofont-rouble","icofont-rupee-false","icofont-rupee-minus","icofont-rupee-plus","icofont-rupee-true","icofont-rupee","icofont-taka-false","icofont-taka-minus","icofont-taka-plus","icofont-taka-true","icofont-taka","icofont-turkish-lira-false","icofont-turkish-lira-minus","icofont-turkish-lira-plus","icofont-turkish-lira-true","icofont-turkish-lira","icofont-won-false","icofont-won-minus","icofont-won-plus","icofont-won-true","icofont-won","icofont-yen-false","icofont-yen-minus","icofont-yen-plus","icofont-yen-true","icofont-yen","icofont-android-nexus","icofont-android-tablet","icofont-apple-watch","icofont-drawing-tablet","icofont-earphone","icofont-flash-drive","icofont-game-console","icofont-game-controller","icofont-game-pad","icofont-game","icofont-headphone-alt-1","icofont-headphone-alt-2","icofont-headphone-alt-3","icofont-headphone-alt","icofont-headphone","icofont-htc-one","icofont-imac","icofont-ipad","icofont-iphone","icofont-ipod-nano","icofont-ipod-touch","icofont-keyboard-alt","icofont-keyboard-wireless","icofont-keyboard","icofont-laptop-alt","icofont-laptop","icofont-macbook","icofont-magic-mouse","icofont-micro-chip","icofont-microphone-alt","icofont-microphone","icofont-monitor","icofont-mouse","icofont-mp3-player","icofont-nintendo","icofont-playstation-alt","icofont-psvita","icofont-radio-mic","icofont-radio","icofont-refrigerator","icofont-samsung-galaxy","icofont-surface-tablet","icofont-ui-head-phone","icofont-ui-keyboard","icofont-washing-machine","icofont-wifi-router","icofont-wii-u","icofont-windows-lumia","icofont-wireless-mouse","icofont-xbox-360","icofont-arrow-down","icofont-arrow-left","icofont-arrow-right","icofont-arrow-up","icofont-block-down","icofont-block-left","icofont-block-right","icofont-block-up","icofont-bubble-down","icofont-bubble-left","icofont-bubble-right","icofont-bubble-up","icofont-caret-down","icofont-caret-left","icofont-caret-right","icofont-caret-up","icofont-circled-down","icofont-circled-left","icofont-circled-right","icofont-circled-up","icofont-collapse","icofont-cursor-drag","icofont-curved-double-left","icofont-curved-double-right","icofont-curved-down","icofont-curved-left","icofont-curved-right","icofont-curved-up","icofont-dotted-down","icofont-dotted-left","icofont-dotted-right","icofont-dotted-up","icofont-double-left","icofont-double-right","icofont-expand-alt","icofont-hand-down","icofont-hand-drag","icofont-hand-drag1","icofont-hand-drag2","icofont-hand-drawn-alt-down","icofont-hand-drawn-alt-left","icofont-hand-drawn-alt-right","icofont-hand-drawn-alt-up","icofont-hand-drawn-down","icofont-hand-drawn-left","icofont-hand-drawn-right","icofont-hand-drawn-up","icofont-hand-grippers","icofont-hand-left","icofont-hand-right","icofont-hand-up","icofont-line-block-down","icofont-line-block-left","icofont-line-block-right","icofont-line-block-up","icofont-long-arrow-down","icofont-long-arrow-left","icofont-long-arrow-right","icofont-long-arrow-up","icofont-rounded-collapse","icofont-rounded-double-left","icofont-rounded-double-right","icofont-rounded-down","icofont-rounded-expand","icofont-rounded-left-down","icofont-rounded-left-up","icofont-rounded-left","icofont-rounded-right-down","icofont-rounded-right-up","icofont-rounded-right","icofont-rounded-up","icofont-scroll-bubble-down","icofont-scroll-bubble-left","icofont-scroll-bubble-right","icofont-scroll-bubble-up","icofont-scroll-double-down","icofont-scroll-double-left","icofont-scroll-double-right","icofont-scroll-double-up","icofont-scroll-down","icofont-scroll-left","icofont-scroll-long-down","icofont-scroll-long-left","icofont-scroll-long-right","icofont-scroll-long-up","icofont-scroll-right","icofont-scroll-up","icofont-simple-down","icofont-simple-left-down","icofont-simple-left-up","icofont-simple-left","icofont-simple-right-down","icofont-simple-right-up","icofont-simple-right","icofont-simple-up","icofont-square-down","icofont-square-left","icofont-square-right","icofont-square-up","icofont-stylish-down","icofont-stylish-left","icofont-stylish-right","icofont-stylish-up","icofont-swoosh-down","icofont-swoosh-left","icofont-swoosh-right","icofont-swoosh-up","icofont-thin-double-left","icofont-thin-double-right","icofont-thin-down","icofont-thin-left","icofont-thin-right","icofont-thin-up","icofont-abc","icofont-atom","icofont-award","icofont-bell-alt","icofont-black-board","icofont-book-alt","icofont-book","icofont-brainstorming","icofont-certificate-alt-1","icofont-certificate-alt-2","icofont-certificate","icofont-education","icofont-electron","icofont-fountain-pen","icofont-globe-alt","icofont-graduate-alt","icofont-graduate","icofont-group-students","icofont-hat-alt","icofont-hat","icofont-instrument","icofont-lamp-light","icofont-medal","icofont-microscope-alt","icofont-microscope","icofont-paper","icofont-pen-alt-4","icofont-pen-nib","icofont-pencil-alt-5","icofont-quill-pen","icofont-read-book-alt","icofont-read-book","icofont-school-bag","icofont-school-bus","icofont-student-alt","icofont-student","icofont-teacher","icofont-test-bulb","icofont-test-tube-alt","icofont-university","icofont-angry","icofont-astonished","icofont-confounded","icofont-confused","icofont-crying","icofont-dizzy","icofont-expressionless","icofont-heart-eyes","icofont-laughing","icofont-nerd-smile","icofont-open-mouth","icofont-rage","icofont-rolling-eyes","icofont-sad","icofont-simple-smile","icofont-slightly-smile","icofont-smirk","icofont-stuck-out-tongue","icofont-wink-smile","icofont-worried","icofont-file-alt","icofont-file-audio","icofont-file-avi-mp4","icofont-file-bmp","icofont-file-code","icofont-file-css","icofont-file-document","icofont-file-eps","icofont-file-excel","icofont-file-exe","icofont-file-file","icofont-file-flv","icofont-file-gif","icofont-file-html5","icofont-file-image","icofont-file-iso","icofont-file-java","icofont-file-javascript","icofont-file-jpg","icofont-file-midi","icofont-file-mov","icofont-file-mp3","icofont-file-pdf","icofont-file-php","icofont-file-png","icofont-file-powerpoint","icofont-file-presentation","icofont-file-psb","icofont-file-psd","icofont-file-python","icofont-file-ruby","icofont-file-spreadsheet","icofont-file-sql","icofont-file-svg","icofont-file-text","icofont-file-tiff","icofont-file-video","icofont-file-wave","icofont-file-wmv","icofont-file-word","icofont-file-zip","icofont-cycling-alt","icofont-cycling","icofont-dumbbell","icofont-dumbbells","icofont-gym-alt-1","icofont-gym-alt-2","icofont-gym-alt-3","icofont-gym","icofont-muscle-weight","icofont-muscle","icofont-apple","icofont-arabian-coffee","icofont-artichoke","icofont-asparagus","icofont-avocado","icofont-baby-food","icofont-banana","icofont-bbq","icofont-beans","icofont-beer","icofont-bell-pepper-capsicum","icofont-birthday-cake","icofont-bread","icofont-broccoli","icofont-burger","icofont-cabbage","icofont-carrot","icofont-cauli-flower","icofont-cheese","icofont-chef","icofont-cherry","icofont-chicken-fry","icofont-chicken","icofont-cocktail","icofont-coconut-water","icofont-coconut","icofont-coffee-alt","icofont-coffee-cup","icofont-coffee-mug","icofont-coffee-pot","icofont-cola","icofont-corn","icofont-croissant","icofont-crop-plant","icofont-cucumber","icofont-culinary","icofont-cup-cake","icofont-dining-table","icofont-donut","icofont-egg-plant","icofont-egg-poached","icofont-farmer-alt","icofont-farmer","icofont-fast-food","icofont-food-basket","icofont-food-cart","icofont-fork-and-knife","icofont-french-fries","icofont-fruits","icofont-grapes","icofont-honey","icofont-hot-dog","icofont-ice-cream-alt","icofont-ice-cream","icofont-juice","icofont-ketchup","icofont-kiwi","icofont-layered-cake","icofont-lemon-alt","icofont-lemon","icofont-lobster","icofont-mango","icofont-milk","icofont-mushroom","icofont-noodles","icofont-onion","icofont-orange","icofont-pear","icofont-peas","icofont-pepper","icofont-pie-alt","icofont-pie","icofont-pineapple","icofont-pizza-slice","icofont-pizza","icofont-plant","icofont-popcorn","icofont-potato","icofont-pumpkin","icofont-raddish","icofont-restaurant-menu","icofont-restaurant","icofont-salt-and-pepper","icofont-sandwich","icofont-sausage","icofont-soft-drinks","icofont-soup-bowl","icofont-spoon-and-fork","icofont-steak","icofont-strawberry","icofont-sub-sandwich","icofont-sushi","icofont-taco","icofont-tea-pot","icofont-tea","icofont-tomato","icofont-watermelon","icofont-wheat","icofont-baby-backpack","icofont-baby-cloth","icofont-baby-milk-bottle","icofont-baby-trolley","icofont-baby","icofont-candy","icofont-holding-hands","icofont-infant-nipple","icofont-kids-scooter","icofont-safety-pin","icofont-teddy-bear","icofont-toy-ball","icofont-toy-cat","icofont-toy-duck","icofont-toy-elephant","icofont-toy-hand","icofont-toy-horse","icofont-toy-lattu","icofont-toy-train","icofont-burglar","icofont-cannon-firing","icofont-cc-camera","icofont-cop-badge","icofont-cop","icofont-court-hammer","icofont-court","icofont-finger-print","icofont-gavel","icofont-handcuff-alt","icofont-handcuff","icofont-investigation","icofont-investigator","icofont-jail","icofont-judge","icofont-law-alt-1","icofont-law-alt-2","icofont-law-alt-3","icofont-law-book","icofont-law-document","icofont-law-order","icofont-law-protect","icofont-law-scales","icofont-law","icofont-lawyer-alt-1","icofont-lawyer-alt-2","icofont-lawyer","icofont-legal","icofont-pistol","icofont-police-badge","icofont-police-cap","icofont-police-car-alt-1","icofont-police-car-alt-2","icofont-police-car","icofont-police-hat","icofont-police-van","icofont-police","icofont-thief-alt","icofont-thief","icofont-abacus-alt","icofont-abacus","icofont-angle-180","icofont-angle-45","icofont-angle-90","icofont-angle","icofont-calculator-alt-1","icofont-calculator-alt-2","icofont-calculator","icofont-circle-ruler-alt","icofont-circle-ruler","icofont-compass-alt-1","icofont-compass-alt-2","icofont-compass-alt-3","icofont-compass-alt-4","icofont-golden-ratio","icofont-marker-alt-1","icofont-marker-alt-2","icofont-marker-alt-3","icofont-marker","icofont-math","icofont-mathematical-alt-1","icofont-mathematical-alt-2","icofont-mathematical","icofont-pen-alt-1","icofont-pen-alt-2","icofont-pen-alt-3","icofont-pen-holder-alt-1","icofont-pen-holder","icofont-pen","icofont-pencil-alt-1","icofont-pencil-alt-2","icofont-pencil-alt-3","icofont-pencil-alt-4","icofont-pencil","icofont-ruler-alt-1","icofont-ruler-alt-2","icofont-ruler-compass-alt","icofont-ruler-compass","icofont-ruler-pencil-alt-1","icofont-ruler-pencil-alt-2","icofont-ruler-pencil","icofont-ruler","icofont-rulers-alt","icofont-rulers","icofont-square-root","icofont-ui-calculator","icofont-aids","icofont-ambulance-crescent","icofont-ambulance-cross","icofont-ambulance","icofont-autism","icofont-bandage","icofont-blind","icofont-blood-drop","icofont-blood-test","icofont-blood","icofont-brain-alt","icofont-brain","icofont-capsule","icofont-crutch","icofont-disabled","icofont-dna-alt-1","icofont-dna-alt-2","icofont-dna","icofont-doctor-alt","icofont-doctor","icofont-drug-pack","icofont-drug","icofont-first-aid-alt","icofont-first-aid","icofont-heart-beat-alt","icofont-heart-beat","icofont-heartbeat","icofont-herbal","icofont-hospital","icofont-icu","icofont-injection-syringe","icofont-laboratory","icofont-medical-sign-alt","icofont-medical-sign","icofont-nurse-alt","icofont-nurse","icofont-nursing-home","icofont-operation-theater","icofont-paralysis-disability","icofont-patient-bed","icofont-patient-file","icofont-pills","icofont-prescription","icofont-pulse","icofont-stethoscope-alt","icofont-stethoscope","icofont-stretcher","icofont-surgeon-alt","icofont-surgeon","icofont-tablets","icofont-test-bottle","icofont-test-tube","icofont-thermometer-alt","icofont-thermometer","icofont-tooth","icofont-xray","icofont-ui-add","icofont-ui-alarm","icofont-ui-battery","icofont-ui-block","icofont-ui-bluetooth","icofont-ui-brightness","icofont-ui-browser","icofont-ui-calendar","icofont-ui-call","icofont-ui-camera","icofont-ui-cart","icofont-ui-cell-phone","icofont-ui-chat","icofont-ui-check","icofont-ui-clip-board","icofont-ui-clip","icofont-ui-clock","icofont-ui-close","icofont-ui-contact-list","icofont-ui-copy","icofont-ui-cut","icofont-ui-delete","icofont-ui-dial-phone","icofont-ui-edit","icofont-ui-email","icofont-ui-file","icofont-ui-fire-wall","icofont-ui-flash-light","icofont-ui-flight","icofont-ui-folder","icofont-ui-game","icofont-ui-handicapped","icofont-ui-home","icofont-ui-image","icofont-ui-laoding","icofont-ui-lock","icofont-ui-love-add","icofont-ui-love-broken","icofont-ui-love-remove","icofont-ui-love","icofont-ui-map","icofont-ui-message","icofont-ui-messaging","icofont-ui-movie","icofont-ui-music-player","icofont-ui-music","icofont-ui-mute","icofont-ui-network","icofont-ui-next","icofont-ui-note","icofont-ui-office","icofont-ui-password","icofont-ui-pause","icofont-ui-play-stop","icofont-ui-play","icofont-ui-pointer","icofont-ui-power","icofont-ui-press","icofont-ui-previous","icofont-ui-rate-add","icofont-ui-rate-blank","icofont-ui-rate-remove","icofont-ui-rating","icofont-ui-record","icofont-ui-remove","icofont-ui-reply","icofont-ui-rotation","icofont-ui-rss","icofont-ui-search","icofont-ui-settings","icofont-ui-social-link","icofont-ui-tag","icofont-ui-text-chat","icofont-ui-text-loading","icofont-ui-theme","icofont-ui-timer","icofont-ui-touch-phone","icofont-ui-travel","icofont-ui-unlock","icofont-ui-user-group","icofont-ui-user","icofont-ui-v-card","icofont-ui-video-chat","icofont-ui-video-message","icofont-ui-video-play","icofont-ui-video","icofont-ui-volume","icofont-ui-weather","icofont-ui-wifi","icofont-ui-zoom-in","icofont-ui-zoom-out","icofont-cassette-player","icofont-cassette","icofont-forward","icofont-guiter","icofont-movie","icofont-multimedia","icofont-music-alt","icofont-music-disk","icofont-music-note","icofont-music-notes","icofont-music","icofont-mute-volume","icofont-pause","icofont-play-alt-1","icofont-play-alt-2","icofont-play-alt-3","icofont-play-pause","icofont-play","icofont-record","icofont-retro-music-disk","icofont-rewind","icofont-song-notes","icofont-sound-wave-alt","icofont-sound-wave","icofont-stop","icofont-video-alt","icofont-video-cam","icofont-video-clapper","icofont-video","icofont-volume-bar","icofont-volume-down","icofont-volume-mute","icofont-volume-off","icofont-volume-up","icofont-youtube-play","icofont-2checkout-alt","icofont-2checkout","icofont-amazon-alt","icofont-amazon","icofont-american-express-alt","icofont-american-express","icofont-apple-pay-alt","icofont-apple-pay","icofont-bank-transfer-alt","icofont-bank-transfer","icofont-braintree-alt","icofont-braintree","icofont-cash-on-delivery-alt","icofont-cash-on-delivery","icofont-diners-club-alt-1","icofont-diners-club-alt-2","icofont-diners-club-alt-3","icofont-diners-club","icofont-discover-alt","icofont-discover","icofont-eway-alt","icofont-eway","icofont-google-wallet-alt-1","icofont-google-wallet-alt-2","icofont-google-wallet-alt-3","icofont-google-wallet","icofont-jcb-alt","icofont-jcb","icofont-maestro-alt","icofont-maestro","icofont-mastercard-alt","icofont-mastercard","icofont-payoneer-alt","icofont-payoneer","icofont-paypal-alt","icofont-paypal","icofont-sage-alt","icofont-sage","icofont-skrill-alt","icofont-skrill","icofont-stripe-alt","icofont-stripe","icofont-visa-alt","icofont-visa-electron","icofont-visa","icofont-western-union-alt","icofont-western-union","icofont-boy","icofont-business-man-alt-1","icofont-business-man-alt-2","icofont-business-man-alt-3","icofont-business-man","icofont-female","icofont-funky-man","icofont-girl-alt","icofont-girl","icofont-group","icofont-hotel-boy-alt","icofont-hotel-boy","icofont-kid","icofont-man-in-glasses","icofont-people","icofont-support","icofont-user-alt-1","icofont-user-alt-2","icofont-user-alt-3","icofont-user-alt-4","icofont-user-alt-5","icofont-user-alt-6","icofont-user-alt-7","icofont-user-female","icofont-user-male","icofont-user-suited","icofont-user","icofont-users-alt-1","icofont-users-alt-2","icofont-users-alt-3","icofont-users-alt-4","icofont-users-alt-5","icofont-users-alt-6","icofont-users-social","icofont-users","icofont-waiter-alt","icofont-waiter","icofont-woman-in-glasses","icofont-search-1","icofont-search-2","icofont-search-document","icofont-search-folder","icofont-search-job","icofont-search-map","icofont-search-property","icofont-search-restaurant","icofont-search-stock","icofont-search-user","icofont-search","icofont-500px","icofont-aim","icofont-badoo","icofont-baidu-tieba","icofont-bbm-messenger","icofont-bebo","icofont-behance","icofont-blogger","icofont-bootstrap","icofont-brightkite","icofont-cloudapp","icofont-concrete5","icofont-delicious","icofont-designbump","icofont-designfloat","icofont-deviantart","icofont-digg","icofont-dotcms","icofont-dribbble","icofont-dribble","icofont-dropbox","icofont-ebuddy","icofont-ello","icofont-ember","icofont-envato","icofont-evernote","icofont-facebook-messenger","icofont-facebook","icofont-feedburner","icofont-flikr","icofont-folkd","icofont-foursquare","icofont-friendfeed","icofont-ghost","icofont-github","icofont-gnome","icofont-google-buzz","icofont-google-hangouts","icofont-google-map","icofont-google-plus","icofont-google-talk","icofont-hype-machine","icofont-instagram","icofont-kakaotalk","icofont-kickstarter","icofont-kik","icofont-kiwibox","icofont-line-messenger","icofont-line","icofont-linkedin","icofont-linux-mint","icofont-live-messenger","icofont-livejournal","icofont-magento","icofont-meetme","icofont-meetup","icofont-mixx","icofont-newsvine","icofont-nimbuss","icofont-odnoklassniki","icofont-opencart","icofont-oscommerce","icofont-pandora","icofont-photobucket","icofont-picasa","icofont-pinterest","icofont-prestashop","icofont-qik","icofont-qq","icofont-readernaut","icofont-reddit","icofont-renren","icofont-rss","icofont-shopify","icofont-silverstripe","icofont-skype","icofont-slack","icofont-slashdot","icofont-slidshare","icofont-smugmug","icofont-snapchat","icofont-soundcloud","icofont-spotify","icofont-stack-exchange","icofont-stack-overflow","icofont-steam","icofont-stumbleupon","icofont-tagged","icofont-technorati","icofont-telegram","icofont-tinder","icofont-trello","icofont-tumblr","icofont-twitch","icofont-twitter","icofont-typo3","icofont-ubercart","icofont-viber","icofont-viddler","icofont-vimeo","icofont-vine","icofont-virb","icofont-virtuemart","icofont-vk","icofont-wechat","icofont-weibo","icofont-whatsapp","icofont-xing","icofont-yahoo","icofont-yelp","icofont-youku","icofont-youtube","icofont-zencart","icofont-badminton-birdie","icofont-baseball","icofont-baseballer","icofont-basketball-hoop","icofont-basketball","icofont-billiard-ball","icofont-boot-alt-1","icofont-boot-alt-2","icofont-boot","icofont-bowling-alt","icofont-bowling","icofont-canoe","icofont-cheer-leader","icofont-climbing","icofont-corner","icofont-field-alt","icofont-field","icofont-football-alt","icofont-football-american","icofont-football","icofont-foul","icofont-goal-keeper","icofont-goal","icofont-golf-alt","icofont-golf-bag","icofont-golf-cart","icofont-golf-field","icofont-golf","icofont-golfer","icofont-helmet","icofont-hockey-alt","icofont-hockey","icofont-ice-skate","icofont-jersey-alt","icofont-jersey","icofont-jumping","icofont-kick","icofont-leg","icofont-match-review","icofont-medal-sport","icofont-offside","icofont-olympic-logo","icofont-olympic","icofont-padding","icofont-penalty-card","icofont-racer","icofont-racing-car","icofont-racing-flag-alt","icofont-racing-flag","icofont-racings-wheel","icofont-referee","icofont-refree-jersey","icofont-result-sport","icofont-rugby-ball","icofont-rugby-player","icofont-rugby","icofont-runner-alt-1","icofont-runner-alt-2","icofont-runner","icofont-score-board","icofont-skiing-man","icofont-skydiving-goggles","icofont-snow-mobile","icofont-steering","icofont-stopwatch","icofont-substitute","icofont-swimmer","icofont-table-tennis","icofont-team-alt","icofont-team","icofont-tennis-player","icofont-tennis","icofont-tracking","icofont-trophy-alt","icofont-trophy","icofont-volleyball-alt","icofont-volleyball-fire","icofont-volleyball","icofont-water-bottle","icofont-whistle-alt","icofont-whistle","icofont-win-trophy","icofont-align-center","icofont-align-left","icofont-align-right","icofont-all-caps","icofont-bold","icofont-brush","icofont-clip-board","icofont-code-alt","icofont-color-bucket","icofont-color-picker","icofont-copy-invert","icofont-copy","icofont-cut","icofont-delete-alt","icofont-edit-alt","icofont-eraser-alt","icofont-font","icofont-heading","icofont-indent","icofont-italic-alt","icofont-italic","icofont-justify-all","icofont-justify-center","icofont-justify-left","icofont-justify-right","icofont-link-broken","icofont-outdent","icofont-paper-clip","icofont-paragraph","icofont-pin","icofont-printer","icofont-redo","icofont-rotation","icofont-save","icofont-small-cap","icofont-strike-through","icofont-sub-listing","icofont-subscript","icofont-superscript","icofont-table","icofont-text-height","icofont-text-width","icofont-trash","icofont-underline","icofont-undo","icofont-air-balloon","icofont-airplane-alt","icofont-airplane","icofont-articulated-truck","icofont-auto-mobile","icofont-auto-rickshaw","icofont-bicycle-alt-1","icofont-bicycle-alt-2","icofont-bicycle","icofont-bus-alt-1","icofont-bus-alt-2","icofont-bus-alt-3","icofont-bus","icofont-cab","icofont-cable-car","icofont-car-alt-1","icofont-car-alt-2","icofont-car-alt-3","icofont-car-alt-4","icofont-car","icofont-delivery-time","icofont-fast-delivery","icofont-fire-truck-alt","icofont-fire-truck","icofont-free-delivery","icofont-helicopter","icofont-motor-bike-alt","icofont-motor-bike","icofont-motor-biker","icofont-oil-truck","icofont-rickshaw","icofont-rocket-alt-1","icofont-rocket-alt-2","icofont-rocket","icofont-sail-boat-alt-1","icofont-sail-boat-alt-2","icofont-sail-boat","icofont-scooter","icofont-sea-plane","icofont-ship-alt","icofont-ship","icofont-speed-boat","icofont-taxi","icofont-tractor","icofont-train-line","icofont-train-steam","icofont-tram","icofont-truck-alt","icofont-truck-loaded","icofont-truck","icofont-van-alt","icofont-van","icofont-yacht","icofont-5-star-hotel","icofont-air-ticket","icofont-beach-bed","icofont-beach","icofont-camping-vest","icofont-direction-sign","icofont-hill-side","icofont-hill","icofont-hotel","icofont-island-alt","icofont-island","icofont-sandals-female","icofont-sandals-male","icofont-travelling","icofont-breakdown","icofont-celsius","icofont-clouds","icofont-cloudy","icofont-dust","icofont-eclipse","icofont-fahrenheit","icofont-forest-fire","icofont-full-night","icofont-full-sunny","icofont-hail-night","icofont-hail-rainy-night","icofont-hail-rainy-sunny","icofont-hail-rainy","icofont-hail-sunny","icofont-hail-thunder-night","icofont-hail-thunder-sunny","icofont-hail-thunder","icofont-hail","icofont-hill-night","icofont-hill-sunny","icofont-hurricane","icofont-meteor","icofont-night","icofont-rainy-night","icofont-rainy-sunny","icofont-rainy-thunder","icofont-rainy","icofont-snow-alt","icofont-snow-flake","icofont-snow-temp","icofont-snow","icofont-snowy-hail","icofont-snowy-night-hail","icofont-snowy-night-rainy","icofont-snowy-night","icofont-snowy-rainy","icofont-snowy-sunny-hail","icofont-snowy-sunny-rainy","icofont-snowy-sunny","icofont-snowy-thunder-night","icofont-snowy-thunder-sunny","icofont-snowy-thunder","icofont-snowy-windy-night","icofont-snowy-windy-sunny","icofont-snowy-windy","icofont-snowy","icofont-sun-alt","icofont-sun-rise","icofont-sun-set","icofont-sun","icofont-sunny-day-temp","icofont-sunny","icofont-thunder-light","icofont-tornado","icofont-umbrella-alt","icofont-umbrella","icofont-volcano","icofont-wave","icofont-wind-scale-0","icofont-wind-scale-1","icofont-wind-scale-10","icofont-wind-scale-11","icofont-wind-scale-12","icofont-wind-scale-2","icofont-wind-scale-3","icofont-wind-scale-4","icofont-wind-scale-5","icofont-wind-scale-6","icofont-wind-scale-7","icofont-wind-scale-8","icofont-wind-scale-9","icofont-wind-waves","icofont-wind","icofont-windy-hail","icofont-windy-night","icofont-windy-raining","icofont-windy-sunny","icofont-windy-thunder-raining","icofont-windy-thunder","icofont-windy","icofont-addons","icofont-address-book","icofont-adjust","icofont-alarm","icofont-anchor","icofont-archive","icofont-at","icofont-attachment","icofont-audio","icofont-automation","icofont-badge","icofont-bag-alt","icofont-bag","icofont-ban","icofont-bar-code","icofont-bars","icofont-basket","icofont-battery-empty","icofont-battery-full","icofont-battery-half","icofont-battery-low","icofont-beaker","icofont-beard","icofont-bed","icofont-bell","icofont-beverage","icofont-bill","icofont-bin","icofont-binary","icofont-binoculars","icofont-bluetooth","icofont-bomb","icofont-book-mark","icofont-box","icofont-briefcase","icofont-broken","icofont-bucket","icofont-bucket1","icofont-bucket2","icofont-bug","icofont-building","icofont-bulb-alt","icofont-bullet","icofont-bullhorn","icofont-bullseye","icofont-calendar","icofont-camera-alt","icofont-camera","icofont-card","icofont-cart-alt","icofont-cart","icofont-cc","icofont-charging","icofont-chat","icofont-check-alt","icofont-check-circled","icofont-check","icofont-checked","icofont-children-care","icofont-clip","icofont-clock-time","icofont-close-circled","icofont-close-line-circled","icofont-close-line-squared-alt","icofont-close-line-squared","icofont-close-line","icofont-close-squared-alt","icofont-close-squared","icofont-close","icofont-cloud-download","icofont-cloud-refresh","icofont-cloud-upload","icofont-cloud","icofont-code-not-allowed","icofont-code","icofont-comment","icofont-compass-alt","icofont-compass","icofont-computer","icofont-connection","icofont-console","icofont-contacts","icofont-contrast","icofont-copyright","icofont-credit-card","icofont-crop","icofont-crown","icofont-cube","icofont-cubes","icofont-dashboard-web","icofont-dashboard","icofont-data","icofont-database-add","icofont-database-locked","icofont-database-remove","icofont-database","icofont-delete","icofont-diamond","icofont-dice-multiple","icofont-dice","icofont-disc","icofont-diskette","icofont-document-folder","icofont-download-alt","icofont-download","icofont-downloaded","icofont-drag","icofont-drag1","icofont-drag2","icofont-drag3","icofont-earth","icofont-ebook","icofont-edit","icofont-eject","icofont-email","icofont-envelope-open","icofont-envelope","icofont-eraser","icofont-error","icofont-excavator","icofont-exchange","icofont-exclamation-circle","icofont-exclamation-square","icofont-exclamation-tringle","icofont-exclamation","icofont-exit","icofont-expand","icofont-external-link","icofont-external","icofont-eye-alt","icofont-eye-blocked","icofont-eye-dropper","icofont-eye","icofont-favourite","icofont-fax","icofont-file-fill","icofont-film","icofont-filter","icofont-fire-alt","icofont-fire-burn","icofont-fire","icofont-flag-alt-1","icofont-flag-alt-2","icofont-flag","icofont-flame-torch","icofont-flash-light","icofont-flash","icofont-flask","icofont-focus","icofont-folder-open","icofont-folder","icofont-foot-print","icofont-garbage","icofont-gear-alt","icofont-gear","icofont-gears","icofont-gift","icofont-glass","icofont-globe","icofont-graffiti","icofont-grocery","icofont-hand","icofont-hanger","icofont-hard-disk","icofont-heart-alt","icofont-heart","icofont-history","icofont-home","icofont-horn","icofont-hour-glass","icofont-id","icofont-image","icofont-inbox","icofont-infinite","icofont-info-circle","icofont-info-square","icofont-info","icofont-institution","icofont-interface","icofont-invisible","icofont-jacket","icofont-jar","icofont-jewlery","icofont-karate","icofont-key-hole","icofont-key","icofont-label","icofont-lamp","icofont-layers","icofont-layout","icofont-leaf","icofont-leaflet","icofont-learn","icofont-lego","icofont-lens","icofont-letter","icofont-letterbox","icofont-library","icofont-license","icofont-life-bouy","icofont-life-buoy","icofont-life-jacket","icofont-life-ring","icofont-light-bulb","icofont-lighter","icofont-lightning-ray","icofont-like","icofont-line-height","icofont-link-alt","icofont-link","icofont-list","icofont-listening","icofont-listine-dots","icofont-listing-box","icofont-listing-number","icofont-live-support","icofont-location-arrow","icofont-location-pin","icofont-lock","icofont-login","icofont-logout","icofont-lollipop","icofont-long-drive","icofont-look","icofont-loop","icofont-luggage","icofont-lunch","icofont-lungs","icofont-magic-alt","icofont-magic","icofont-magnet","icofont-mail-box","icofont-mail","icofont-male","icofont-map-pins","icofont-map","icofont-maximize","icofont-measure","icofont-medicine","icofont-mega-phone","icofont-megaphone-alt","icofont-megaphone","icofont-memorial","icofont-memory-card","icofont-mic-mute","icofont-mic","icofont-military","icofont-mill","icofont-minus-circle","icofont-minus-square","icofont-minus","icofont-mobile-phone","icofont-molecule","icofont-money","icofont-moon","icofont-mop","icofont-muffin","icofont-mustache","icofont-navigation-menu","icofont-navigation","icofont-network-tower","icofont-network","icofont-news","icofont-newspaper","icofont-no-smoking","icofont-not-allowed","icofont-notebook","icofont-notepad","icofont-notification","icofont-numbered","icofont-opposite","icofont-optic","icofont-options","icofont-package","icofont-page","icofont-paint","icofont-paper-plane","icofont-paperclip","icofont-papers","icofont-pay","icofont-penguin-linux","icofont-pestle","icofont-phone-circle","icofont-phone","icofont-picture","icofont-pine","icofont-pixels","icofont-plugin","icofont-plus-circle","icofont-plus-square","icofont-plus","icofont-polygonal","icofont-power","icofont-price","icofont-print","icofont-puzzle","icofont-qr-code","icofont-queen","icofont-question-circle","icofont-question-square","icofont-question","icofont-quote-left","icofont-quote-right","icofont-random","icofont-recycle","icofont-refresh","icofont-repair","icofont-reply-all","icofont-reply","icofont-resize","icofont-responsive","icofont-retweet","icofont-road","icofont-robot","icofont-royal","icofont-rss-feed","icofont-safety","icofont-sale-discount","icofont-satellite","icofont-send-mail","icofont-server","icofont-settings-alt","icofont-settings","icofont-share-alt","icofont-share-boxed","icofont-share","icofont-shield","icofont-shopping-cart","icofont-sign-in","icofont-sign-out","icofont-signal","icofont-site-map","icofont-smart-phone","icofont-soccer","icofont-sort-alt","icofont-sort","icofont-space","icofont-spanner","icofont-speech-comments","icofont-speed-meter","icofont-spinner-alt-1","icofont-spinner-alt-2","icofont-spinner-alt-3","icofont-spinner-alt-4","icofont-spinner-alt-5","icofont-spinner-alt-6","icofont-spinner","icofont-spreadsheet","icofont-square","icofont-ssl-security","icofont-star-alt-1","icofont-star-alt-2","icofont-star","icofont-street-view","icofont-support-faq","icofont-tack-pin","icofont-tag","icofont-tags","icofont-tasks-alt","icofont-tasks","icofont-telephone","icofont-telescope","icofont-terminal","icofont-thumbs-down","icofont-thumbs-up","icofont-tick-boxed","icofont-tick-mark","icofont-ticket","icofont-tie","icofont-toggle-off","icofont-toggle-on","icofont-tools-alt-2","icofont-tools","icofont-touch","icofont-traffic-light","icofont-transparent","icofont-tree","icofont-unique-idea","icofont-unlock","icofont-unlocked","icofont-upload-alt","icofont-upload","icofont-usb-drive","icofont-usb","icofont-vector-path","icofont-verification-check","icofont-wall-clock","icofont-wall","icofont-wallet","icofont-warning-alt","icofont-warning","icofont-water-drop","icofont-web","icofont-wheelchair","icofont-wifi-alt","icofont-wifi","icofont-world","icofont-zigzag","icofont-zipped");
    }
}