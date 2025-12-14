<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
	
	<?php cleaninglight_themes_post_format_media(); ?>

	<div class="cleaninglight-page-content-wrap">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cleaning-light' ),
				'after'  => '</div>',
			) );
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
