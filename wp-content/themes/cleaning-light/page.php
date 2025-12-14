<?php

global $post;

$post_sidebar = get_post_meta( $post->ID, 'cleaninglight_themes_sidebar_layout', true );

if(!$post_sidebar){
    $post_sidebar =  get_theme_mod( 'cleaninglight_page_sidebar','no' );
}

$page_wrap_class ='';
if( $post_sidebar == 'left' || $post_sidebar == 'right'){
	$page_wrap_class ='d-grid d-blog-grid-column-2';
}else{
	$page_wrap_class ='fullwidth';
}
 
get_header(); ?>
<div class="container">
	<div class="<?php echo esc_attr($page_wrap_class); ?> sidebar-<?php echo esc_attr($post_sidebar); ?>">
		<?php if( $post_sidebar == 'left' && is_active_sidebar('sidebar-2') ){ get_sidebar('left'); } ?>
		<div id="primary" class="content-area cleaninglight-page-wrap">
			<main id="main" class="site-main">
				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						
					endwhile; 
				?>
			</main>
		</div>
		<?php if( $post_sidebar == 'right' && is_active_sidebar('sidebar-1') ){ get_sidebar('right'); } ?>
	</div>
</div>
<?php get_footer();