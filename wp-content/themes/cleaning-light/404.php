<?php

get_header(); ?>
<div class="container">
	<div class="d-grid d-blog-grid-column-1">
		<div id="primary" class="content-area text-center">
			<main id="main" class="site-main">
				<div class="error-404 not-found">
					<header class="page-header">
						<h1><?php esc_html_e('404','cleaning-light'); ?></h1>
						<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'cleaning-light' ); ?></h2>
					</header>
					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cleaning-light' ); ?></p>							
					</div>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
						<span><?php esc_html_e('Back To Home','cleaning-light'); ?></span>
					</a>
				</div>
			</main>
		</div>
	</div>
</div>
<?php get_footer();