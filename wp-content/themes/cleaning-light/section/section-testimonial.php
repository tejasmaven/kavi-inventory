<?php

if (! function_exists( 'cleaninglight_themes_testimonial' ) ):
    
    function cleaninglight_themes_testimonial(){
        
        $layout = get_theme_mod('cleaninglight_testimonial_layout', 'style1');

        $section = get_theme_mod('cleaninglight_testimonial_disable','enable');
        if( !empty( $section ) && $section == 'enable' ){
            $testimonial_class = array(
                'section',
                'testimonial-section',
                $layout
            );
        ?>
            <section id="testimonial-section" class="<?php echo esc_attr(implode(' ', $testimonial_class)) ?>">
                <div class="section-wrap">   
                    <div class="container">
                        <div class="inner-section-wrap">
                            <?php 
                                $supertitle  = get_theme_mod( 'cleaninglight_testimonial_super_title' );
                                $title 		 = get_theme_mod( 'cleaninglight_testimonial_title' );
                                $titlestyle  = get_theme_mod( 'cleaninglight_testimonial_title_align','text-center' );
                                $designstyle = get_theme_mod('cleaninglight_testimonial_title_style','style1');

                                cleaninglight_themes_section_title( $supertitle, $title, $titlestyle, $designstyle );

                                $displaystyle = get_theme_mod('cleaninglight_testimonial_display_style', 'slide');
                                if( !empty( $displaystyle ) && $displaystyle == 'grid' ){ ?>
                                    <div class="d-grid d-grid-column-3">
                                <?php }else{ 
                                    $controls = json_encode(array(
                                        'item' => 3
                                    ));
                                    $controls = json_decode($controls, true);
                                    $data = cleaninglight_themes_get_data_attribute($controls);
                                ?>
                                    <div class="testimonial-block-slider owl-carousel carouseldots" <?php echo ( $data ); ?>>
                                <?php   } 
                                    $testimonial_type = get_theme_mod('cleaninglight_testimonial_type','default');
                                    if( !empty( $testimonial_type ) && $testimonial_type == 'default' ):

                                        $testimonial_items = get_theme_mod('cleaninglight_testimonial_page');

                                        if (!empty( $testimonial_items ) ):
                                            $testimonialitems = json_decode($testimonial_items);

                                        foreach ($testimonialitems as $testimonialitem):
                                            
                                        if (!empty( $testimonialitem->testimonial_page )):

                                            $testimonial_query = new WP_Query('page_id=' . $testimonialitem->testimonial_page);
                                            if ($testimonial_query->have_posts()): while ($testimonial_query->have_posts()): $testimonial_query->the_post();
                                    ?>
                                        <div class="testimonial-block-wrapper">
                                            <?php if( !empty( $layout ) && $layout == 'style2' ): ?>
                                                <div class="testimonial-block-content-wrap">
                                                    <?php the_excerpt(); ?>
                                                    <div class="testimonial-block-inner-content">
                                                        <figure class="testimonial-block-image">
                                                            <?php if( has_post_thumbnail()){ ?>
                                                                <?php the_post_thumbnail('post-thumbnail'); ?>
                                                            <?php }else{ ?>
                                                                <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                            <?php } ?>
                                                        </figure>
                                                        <div class="testimonial-title-wrap">
                                                            <h3 class="testimonial-title">
                                                                <?php the_title(); ?>
                                                            </h3>
                                                            <?php if (!empty( $testimonialitem->designation ) ): ?>
                                                                <div class="designation"><?php echo esc_html($testimonialitem->designation); ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php if( !empty( $testimonialitem->rating ) ): ?>
                                                        <div class="testimonial-rating">
                                                            <?php foreach( range( 1, intval( $testimonialitem->rating )) as $index ): ?>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <figure class="testimonial-block-image">
                                                    <?php if( has_post_thumbnail()){ ?>
                                                            <?php the_post_thumbnail('post-thumbnail'); ?>
                                                    <?php }else{ ?>
                                                            <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                    <?php } ?>
                                                </figure>
                                                <div class="testimonial-block-content">
                                                    <?php the_excerpt(); ?>
                                                    <div class="testimonial-title-wrap">
                                                        <h3 class="testimonial-title">
                                                            <?php the_title(); ?>
                                                        </h3>
                                                        <?php if (!empty( $testimonialitem->designation ) ): ?>
                                                            <div class="designation">
                                                                <?php echo esc_html($testimonialitem->designation); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if( !empty( $testimonialitem->rating ) ): ?>
                                                        <div class="testimonial-rating">
                                                            <?php foreach( range( 1, intval( $testimonialitem->rating )) as $index ): ?>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; endif; endif; endforeach; endif; else: 
                                        
                                    $testimonial_advance_items = get_theme_mod('cleaninglight_testimonial_advance_settings');
                                    if (!empty( $testimonial_advance_items ) ):

                                        $testimonialadvanceitems = json_decode($testimonial_advance_items);
                                        foreach ($testimonialadvanceitems as $tadvanceitem):
                                    ?>
                                        <div class="testimonial-block-wrapper">
                                            <?php if( !empty( $layout ) && $layout == 'style2' ): ?>
                                                <div class="testimonial-block-content-wrap">
                                                    <p><?php echo esc_html( $tadvanceitem->block_text ) ?></p>
                                                    <div class="testimonial-block-inner-content">
                                                        <figure class="testimonial-block-image">
                                                            <?php if( !empty( $tadvanceitem->block_image ) ){ ?>
                                                                <img src="<?php echo esc_url($tadvanceitem->block_image); ?>" alt="<?php echo esc_attr( $tadvanceitem->block_title ) ?>"/>
                                                            <?php }else{ ?>
                                                                <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                            <?php } ?>
                                                        </figure>
                                                        <div class="testimonial-title-wrap">
                                                            <h3 class="testimonial-title">
                                                                <?php echo esc_html( $tadvanceitem->block_title ) ?>
                                                            </h3>
                                                            <?php if (!empty( $tadvanceitem->block_designation ) ): ?>
                                                                <div class="designation"><?php echo esc_html($tadvanceitem->block_designation); ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php if( !empty( $tadvanceitem->block_rating ) ): ?>
                                                        <div class="testimonial-rating">
                                                            <?php foreach( range( 1, intval( $tadvanceitem->block_rating )) as $index ): ?>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php else: ?>
                                                <figure class="testimonial-block-image">
                                                    <?php if( !empty( $tadvanceitem->block_image ) ){ ?>
                                                        <img src="<?php echo esc_url($tadvanceitem->block_image); ?>" alt="<?php echo esc_attr( $tadvanceitem->block_title ) ?>"/>
                                                    <?php }else{ ?>
                                                        <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                    <?php } ?>
                                                </figure>
                                                <div class="testimonial-block-content">
                                                    <p><?php echo esc_html( $tadvanceitem->block_text ) ?></p>
                                                    <div class="testimonial-title-wrap">
                                                        <h3 class="testimonial-title">
                                                            <?php echo esc_html( $tadvanceitem->block_title ) ?>
                                                        </h3>
                                                        <?php if (!empty( $tadvanceitem->block_designation ) ): ?>
                                                            <div class="designation">
                                                                <?php echo esc_html($tadvanceitem->block_designation); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if( !empty( $tadvanceitem->block_rating ) ): ?>
                                                        <div class="testimonial-rating">
                                                            <?php foreach( range( 1, intval( $tadvanceitem->block_rating )) as $index ): ?>
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; endif; endif; ?>
                                </div>
                            <?php 
                                $link = get_theme_mod('cleaninglight_testimonial_review_link');
                                if( !empty( $link ) ): 
                            ?>
                                <div class="total_review">
                                    <a href="<?php echo esc_url($link); ?>"><?php echo esc_html__('TOTAL USER REVIEWS', 'cleaning-light');?> <i class="fa-solid fa-arrow-right-long"></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php } 
    }
endif;
add_action('cleaninglight_themes_action_testimonial', 'cleaninglight_themes_testimonial', 70);

do_action('cleaninglight_themes_action_testimonial');