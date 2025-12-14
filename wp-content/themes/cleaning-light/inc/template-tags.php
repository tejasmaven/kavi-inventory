<?php
/**
 * Post meta and utility functions for the Cleaning Light theme.
 *
 * @package Cleaning Light
 */

if ( ! function_exists( 'cleaninglight_themes_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function cleaninglight_themes_posted_by() {
		$byline = sprintf(
			/* translators: %s: Author name */
			'<span itemprop="author" itemtype="https://schema.org/Person" class="author vcard">' . get_avatar( get_the_author_meta( 'ID' ), 30 ) . '<a itemprop="url" class="url" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<span itemprop="name" class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;


if ( ! function_exists( 'cleaninglight_themes_posted_on' ) ) :
	/**
	 * Display the post date with short month format.
	 *
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @return void
	 */
	function cleaninglight_themes_posted_on() {
		// Define short month date format.
		$short_date_format = 'M j, Y';
		
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date( $short_date_format ) ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date( $short_date_format ) )
		);

		$posted_on = sprintf(
			/* translators: %s: post date */
			esc_html_x( 'On %s', 'post date', 'cleaning-light' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on"> - ' . wp_kses_post( $posted_on ) . '</span>';
	}
endif;

if ( ! function_exists( 'cleaninglight_themes_comments' ) ) :
	/**
	 * Displays the comments link.
	 */
	function cleaninglight_themes_comments() {
		?>
		<div class="comments-link-wrapper">
			<span class="comments-link">
				- <span class="fa fa-comments"></span>
				<?php
				comments_popup_link(
					sprintf(
						wp_kses(
							/* translators: %s: Post title */
							__( 'no comment<span class="screen-reader-text"> on %1$s</span>', 'cleaning-light' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);
				?>
			</span>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'cleaninglight_themes_estimated_reading_time' ) ) :
	/**
	 * Calculates and returns estimated reading time.
	 *
	 * @return string HTML output for reading time.
	 */
	function cleaninglight_themes_estimated_reading_time() {
		global $post;

		$the_content = $post->post_content;
		$words       = str_word_count( wp_strip_all_tags( $the_content ) );
		$minute      = floor( $words / 200 );
		$second      = floor( $words % 200 / ( 200 / 60 ) );

		// Avoid division by zero.
		if ( 0 === $minute && 0 === $second ) {
			$minute = 1;
		}

		$minute_text = ( 1 === $minute ) ? 'min' : 'mins';
		$second_text = ( 1 === $second ) ? 'sec' : 'secs';

		$estimate = $minute . ' ' . $minute_text . ', ' . $second . ' ' . $second_text;
		$output   = '<span class="reading-time">- <span>' . esc_html( $estimate ) . '</span></span>';

		return $output;
	}
endif;

if ( ! function_exists( 'cleaninglight_themes_category' ) ) :
	/**
	 * Displays category list.
	 */
	function cleaninglight_themes_category() {
		$categories_list = get_the_category_list( esc_html__( ', ', 'cleaning-light' ) );
		if ( $categories_list ) {
			/* translators: %s: Category list */
			printf( '<span class="cat-links">%1$s</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
endif;

if ( ! function_exists( 'cleaninglight_themes_entry_footer' ) ) :
	/**
	 * Displays entry footer content (categories, tags, comments link, edit link).
	 */
	function cleaninglight_themes_entry_footer() {
		// Only show for posts.
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'cleaning-light' ) );
			if ( $categories_list ) {
				/* translators: %s: Category list */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'cleaning-light' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'cleaning-light' ) );
			if ( $tags_list ) {
				/* translators: %s: Tag list */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'cleaning-light' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		// Comments link.
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: Post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %1$s</span>', 'cleaning-light' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Post title */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'cleaning-light' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Filters the excerpt length.
 *
 * @param int $length Excerpt length.
 * @return int Modified excerpt length.
 */
function cleaninglight_themes_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'cleaninglight_post_excerpt_length', 20 );

	if ( is_admin() ) {
		return $length;
	} elseif ( is_front_page() ) {
		return 20;
	} else {
		return $excerpt_length;
	}
}
add_filter( 'excerpt_length', 'cleaninglight_themes_excerpt_length', 999 );

/**
 * Filters the excerpt more string.
 *
 * @param string $more The "more" string.
 * @return string Modified "more" string.
 */
function cleaninglight_themes_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return '&hellip;';
}
add_filter( 'excerpt_more', 'cleaninglight_themes_excerpt_more' );