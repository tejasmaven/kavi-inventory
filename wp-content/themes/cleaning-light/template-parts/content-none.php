<section class="no-results not-found text-center">
	<header class="page-header">
		<h2 class="page-title"><?php esc_html_e( 'Oops! nothing be found.', 'cleaning-light' ); ?></h2>
	</header>
	<div class="page-content">
		<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :
				printf(
					'<p>' . wp_kses(
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cleaning-light' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					) . '</p>',
					esc_url( admin_url( 'post-new.php' ) )
				);
			elseif ( is_search() ) :
		?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cleaning-light' ); ?></p>

			<?php get_search_form();

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cleaning-light' ); ?></p>
		
		<?php

				get_search_form();

			endif;
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
			<span><?php esc_html_e('Back To Home','cleaning-light'); ?></span>
		</a>
	</div>
</section>
