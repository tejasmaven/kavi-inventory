<?php
global $post;

$post_sidebar = get_post_meta( $post->ID, 'cleaninglight_themes_sidebar_layout', true );

if(!$post_sidebar){
    $post_sidebar =  get_theme_mod( 'cleaninglight_blog_single_template_sidebar','right' );
}

$single_post_elements = get_theme_mod('cleaninglight_single_post_bottom_elements', array('pagination','comment','related_posts'));

get_header(); ?>
<div class="container">
	<div class="d-grid d-blog-grid-column-2 sidebar-<?php echo esc_attr($post_sidebar); ?>">
		<?php if( $post_sidebar == 'left' && is_active_sidebar('sidebar-2') ){ get_sidebar('left'); } ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<?php
					if ( have_posts() ) :
						
						while ( have_posts() ) :

							the_post();

							get_template_part( 'template-parts/content', 'single' );

						endwhile;
						
						foreach ($single_post_elements as $element) {

							$template_function_name = "cleaninglight_themes_single_{$element}";

							$template_function_name();
						}							

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
				?>
			</main>
		</div>
		<?php if( $post_sidebar == 'right' && is_active_sidebar('sidebar-1') ){ get_sidebar('right'); } ?>
	</div>
</div>
<?php get_footer();