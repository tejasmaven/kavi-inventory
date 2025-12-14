<?php

if (! function_exists( 'cleaninglight_themes_team' ) ):

    function cleaninglight_themes_team(){
        
        $layout = get_theme_mod('cleaninglight_team_style', 'style2');
        $team_options = get_theme_mod('cleaninglight_team_disable','enable');
        if( !empty( $team_options ) && $team_options == 'enable' ){
            $team_class = array(
                'section',
                'team-section',
                $layout
            );
        ?>
        <section id="team-section" class="<?php echo esc_attr(implode(' ', $team_class)) ?>">
            <div class="section-wrap">
                <div class="container">
                    <div class="inner-section-wrap">
                        <?php 
                            $supertitle = get_theme_mod( 'cleaninglight_team_super_title' );
                            $title 		= get_theme_mod( 'cleaninglight_team_title' );
                            $titlestyle  = get_theme_mod('cleaninglight_team_title_align', 'text-center');
                            $designstyle = get_theme_mod('cleaninglight_team_title_style','style1');

                            cleaninglight_themes_section_title( $supertitle, $title, $titlestyle, $designstyle ); 

                        $displaystyle = get_theme_mod('cleaninglight_team_display_style', 'grid');
                        if( !empty( $displaystyle ) && $displaystyle == 'grid' ){ ?>
                            <div class="d-grid d-grid-column-3">
                        <?php }else{ 
                            $controls = json_encode(array(
                                'item' => 3
                            ));
                            $controls = json_decode($controls, true);
                            $data = cleaninglight_themes_get_data_attribute($controls);
                        ?>
                            <div class="team-block-slider owl-carousel carouseldots" <?php echo ( $data ); ?>>
                        <?php  } 
                            $team_type = get_theme_mod('cleaninglight_team_type','default');
                            if( !empty( $team_type ) && $team_type == 'default' ):

                                $team_all_page = get_theme_mod('cleaninglight_team');
                                if (!empty( $team_all_page ) ):
                                    $team_pages = json_decode($team_all_page);

                                foreach ($team_pages as $teamitem):
                                    
                                if (!empty( $teamitem->team_page )):

                                    $team_query = new WP_Query('page_id=' . $teamitem->team_page);
                                    if ($team_query->have_posts()): while ($team_query->have_posts()): $team_query->the_post();
                                
                                $team_wrap_class = array("team-member-block-wrapper");
                            ?>
                                <div class="<?php echo esc_attr(implode(' ', $team_wrap_class)); ?>">
                                    <?php if( !empty( $layout ) && $layout == 'style2' ): ?>
                                        <figure class="team-member-block-image">
                                            <div class="ikthemes-team-image-header">
                                                <?php if( has_post_thumbnail()){ ?>
                                                    <?php the_post_thumbnail('post-thumbnail'); ?>
                                                <?php }else{ ?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                <?php } ?>
                                            </div>
                                            <div class="ikthemes-team-image-wrap">
                                                <?php if(!empty( $teamitem->teamimage)){ ?>
                                                    <img src="<?php echo esc_url($teamitem->teamimage); ?>" alt=""/>
                                                <?php }else{ ?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                <?php } ?>
                                            </div>
                                        </figure>
                                    <?php else: ?>
                                        <figure class="team-member-block-image">
                                            <?php if( has_post_thumbnail()){ ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('post-thumbnail'); ?>
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                </a>
                                            <?php } ?>
                                            <?php if( !empty( $layout ) && $layout == 'style3' ): ?>
                                                <h3 class="team-member-title">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                            <?php endif; ?>
                                        </figure>
                                    <?php endif; ?>
                                    <div class="team-member-block-content">
                                        <div class="team-member-title-wrap">
                                            <h3 class="team-member-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php if (!empty( $teamitem->designation ) ): ?>
                                                <div class="designation"><?php echo esc_html($teamitem->designation); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if( !empty( $layout ) && $layout == 'style3' ): ?>
                                            <?php the_excerpt(); ?>
                                        <?php endif; ?>
                                        <ul class="team-member-socialicon">
                                            <?php if (!empty( $teamitem->facebook ) ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $teamitem->facebook ); ?>">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                            <?php endif; if (!empty( $teamitem->twitter ) ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url($teamitem->twitter); ?>">
                                                        <i class="fab fa-x-twitter"></i>
                                                    </a>
                                                </li>
                                            <?php endif; if (!empty( $teamitem->linkedin ) ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url($teamitem->linkedin); ?>">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>
                                            <?php endif; if (!empty( $teamitem->instagram ) ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url($teamitem->instagram); ?>">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endwhile; endif; endif; endforeach; endif; else: 
                                $team_advance_all = get_theme_mod('cleaninglight_team_advance');
                                if (!empty( $team_advance_all ) ):
                                $team_advance = json_decode($team_advance_all);
                                foreach ($team_advance as $teamitem):

                                $team_wrap_class = array("team-member-block-wrapper");
                            ?>
                                <div class="<?php echo esc_attr(implode(' ', $team_wrap_class)); ?>">
                                    <?php if( !empty( $layout ) && $layout == 'style2' ): ?>
                                        <figure class="team-member-block-image">
                                            <div class="ikthemes-team-image-header">
                                                <?php if(!empty( $teamitem->team_image)){ ?>
                                                    <img src="<?php echo esc_url($teamitem->team_image); ?>" alt=""/>
                                                <?php }else{ ?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                <?php } ?>
                                            </div>
                                            <div class="ikthemes-team-image-wrap">
                                                <?php if(!empty( $teamitem->teamimage)){ ?>
                                                    <img src="<?php echo esc_url($teamitem->teamimage); ?>" alt=""/>
                                                <?php }else{ ?>
                                                    <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                <?php } ?>
                                            </div>
                                        </figure>
                                    <?php else: ?>
                                        <figure class="team-member-block-image">
                                            <?php if(!empty( $teamitem->team_image)){ ?>
                                                <a href="<?php echo esc_url( $teamitem->team_url ); ?>">
                                                    <img src="<?php echo esc_url($teamitem->team_image); ?>" alt="<?php echo esc_attr( $teamitem->team_title ); ?>"/>
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?php echo esc_url( $teamitem->team_url ); ?>">
                                                    <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                                </a>
                                            <?php } ?>
                                            <?php if( !empty( $layout ) && $layout == 'style3' ): ?>
                                                <h3 class="team-member-title"><a href="<?php echo esc_url( $teamitem->team_url ); ?>"><?php echo esc_html( $teamitem->team_title ); ?></a></h3>
                                            <?php endif; ?>
                                        </figure>
                                    <?php endif; ?>
                                    <div class="team-member-block-content">
                                        <div class="team-member-title-wrap">
                                            <h3 class="team-member-title">
                                                <a href="<?php echo esc_url( $teamitem->team_url ); ?>">
                                                    <?php echo esc_html( $teamitem->team_title ); ?>
                                                </a>
                                            </h4>
                                            
                                            <?php if (!empty( $teamitem->team_designation ) ): ?>
                                                <div class="designation">
                                                    <?php echo esc_html($teamitem->team_designation); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php if( !empty( $layout ) && $layout == 'style3' ): ?>
                                            <p><?php echo esc_html( $teamitem->team_desc ) ?></p>
                                        <?php endif; ?>
                                        <ul class="team-member-socialicon">
                                            <?php if (!empty( $teamitem->facebook ) ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $teamitem->facebook ); ?>">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                            <?php endif; if (!empty( $teamitem->twitter ) ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url($teamitem->twitter); ?>">
                                                        <i class="fab fa-x-twitter"></i>
                                                    </a>
                                                </li>
                                            <?php endif; if (!empty( $teamitem->linkedin ) ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url($teamitem->linkedin); ?>">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>
                                            <?php endif; if (!empty( $teamitem->instagram ) ) : ?>
                                                <li>
                                                    <a href="<?php echo esc_url($teamitem->instagram); ?>">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach; endif; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } }
endif;
add_action('cleaninglight_themes_action_team', 'cleaninglight_themes_team', 75);

do_action('cleaninglight_themes_action_team');