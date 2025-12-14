<?php
$post_sidebar =  get_theme_mod( 'cleaninglight_blog_template_sidebar','right' );

$column =  get_theme_mod( 'cleaninglight_post_column', 2 );

$bspace =  get_theme_mod( 'cleaninglight_blog_post_space', 1 );

$article_wrap_class = array("ikthemes-article-wrap", "d-grid", "d-grid-column-$column");
 
get_header(); ?>

<div class="container">
	<div class="d-grid d-blog-grid-column-2 sidebar-<?php echo esc_attr($post_sidebar); ?>">
		<?php if( $post_sidebar == 'left' && is_active_sidebar('sidebar-2') ){ get_sidebar('left'); } ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<?php if ( have_posts() ) :?>
					<div class="<?php echo esc_attr(implode(' ', $article_wrap_class)); ?>" style="gap:<?php echo intval($bspace); ?>rem;">
						<?php 
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', get_post_format() );
								
							endwhile;
						?>
					</div>
					<?php
                        // Display pagination.
                        the_posts_pagination(
                            array(
                                'mid_size'           => 2,
                                'prev_text'          => sprintf(
                                    '<i class="fas fa-arrow-left" aria-hidden="true"></i> <span>%s</span>',
                                    esc_html__( 'Prev', 'cleaning-light' )
                                ),
                                'next_text'          => sprintf(
                                    '<span>%s</span> <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>',
                                    esc_html__( 'Next', 'cleaning-light' )
                                ),
                                'screen_reader_text' => esc_html__( 'Posts navigation', 'cleaning-light' ),
                            )
                        );

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