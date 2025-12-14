<?php

$excerpt_count = get_theme_mod( 'cleaninglight_post_excerpt_length', 20 );

$alignment = get_theme_mod('cleaninglight_blog_alignment', 'text-center');

$blogreadmore_btn = get_theme_mod( 'cleaninglight_blogtemplate_btn', 'Read More' );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('ikthemes-article-item article ' .$alignment); ?>>
	<div class="blog-post-thumbnail">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php the_post_thumbnail('full'); ?>
			<?php }else{ ?>
				<img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/default-placeholder.png" />
			<?php } ?>
			<span class="ikthemes-article-date"><?php echo get_the_date( "d M Y" ); ?></span>
		</a>
	</div>
	<div class="ikthemes-article-content">
		<?php 
			the_title( '<h3 class="ikthemes-article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); 
			
			if ( 'post' === get_post_type() ){ do_action( 'cleaninglight_themes_post_meta', 10 ); } 
		?>
		<div class="ikthemes-article-desc">
			<?php echo wp_trim_words( get_the_content(), $excerpt_count ); ?>
		</div>
		<?php if( !empty( $blogreadmore_btn ) ){ ?>
			<div class="ikthemes-article-btn-wrap">
				<a href="<?php the_permalink(); ?>" class="btn btn-primary">
					<span><?php echo esc_html( $blogreadmore_btn ); ?></span>
				</a>
			</div>
		<?php } ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->