<?php

if (! function_exists( 'cleaninglight_themes_blog' ) ):

    function cleaninglight_themes_blog(){
        
        $blog_options = get_theme_mod('cleaninglight_blog_disable','enable');
        if( !empty( $blog_options ) && $blog_options == 'enable' ){
            $service_class = array(
                'section',
                'blog-section'
            );
        ?>
        <section id="blog-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>">
            <div class="section-wrap">
                <div class="container">
                    <div class="inner-section-wrap">
                        <?php 
                            $supertitle = get_theme_mod( 'cleaninglight_blog_super_title' );
                            $title 		= get_theme_mod( 'cleaninglight_blog_title' );
                            $titlestyle  = get_theme_mod('cleaninglight_blog_title_align', 'text-center');
                            $designstyle = get_theme_mod('cleaninglight_blog_title_style','style1');

                            cleaninglight_themes_section_title( $supertitle, $title, $titlestyle, $designstyle ); 

                        $displaystyle = get_theme_mod('cleaninglight_blog_display_style', 'grid');
                        if( !empty( $displaystyle ) && $displaystyle == 'grid' ){ ?>
                            <div class="d-grid d-grid-column-3">
                        <?php }else{ 
                            $controls = json_encode(array(
                                'item' => 3
                            ));
                            $controls = json_decode($controls, true);
                            $data = cleaninglight_themes_get_data_attribute($controls);
                        ?>
                            <div class="blog-block-slider owl-carousel carouseldots" <?php echo ( $data ); ?>>
                        <?php  }
                        
                                $blog = get_theme_mod('cleaninglight_blog_categories');
                                $cat_id = explode(',', $blog);
                                $post_num = get_theme_mod('cleaninglight_posts_num', 6);
                                $args = array(
                                    'posts_per_page' => $post_num,
                                    'post_type' => 'post',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'category',
                                            'field' => 'term_id',
                                            'terms' => $cat_id
                                        ),
                                    ),
                                );
                                $blog_query = new WP_Query ($args);
                                
                                if ( $blog_query->have_posts() ): while ( $blog_query->have_posts() ) : $blog_query->the_post();
                                
                                $blogreadmore_btn = get_theme_mod( 'cleaninglight_blog_home_btn','Read More');
                                $alignment = get_theme_mod('cleaninglight_home_blog_alignment', 'text-center');
                                $date = get_theme_mod( 'cleaninglight_home_post_date_options', 'enable' );
                            ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('ikthemes-article-item article ' .$alignment); ?>>
                                    <div class="blog-post-thumbnail">
                                        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                                            <?php if ( has_post_thumbnail() ) { ?>
                                                <?php the_post_thumbnail('medium_large'); ?>
                                            <?php }else{ ?>
                                                <img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/default-placeholder.png" />
                                            <?php } ?>

                                            <?php if(!empty($date) && $date == 'enable'){ ?>
                                                <span class="ikthemes-article-date"><?php echo get_the_date( "d M Y" ); ?></span>
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="ikthemes-article-content">
                                        <?php 
                                            the_title( '<h3 class="ikthemes-article-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); 
                                            
                                            if ( 'post' === get_post_type() ){ do_action( 'cleaninglight_themes_home_post_meta', 10 ); } 
                                        ?>
                                        <div class="ikthemes-article-desc">
                                            <?php echo wp_trim_words( get_the_content(), 20 ); ?>
                                        </div>
                                        <?php if( !empty( $blogreadmore_btn ) ){ ?>
                                            <div class="ikthemes-article-btn-wrap">
                                                <a href="<?php the_permalink(); ?>" class="btn btn-noborder">
                                                    <span><?php echo esc_html( $blogreadmore_btn ); ?></span>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </article>
                            <?php endwhile; endif; wp_reset_query(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } }

endif;
add_action('cleaninglight_themes_action_blog', 'cleaninglight_themes_blog', 65);


do_action('cleaninglight_themes_action_blog');