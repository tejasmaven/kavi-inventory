<?php
if( !function_exists('cleaninglight_themes_about_us_image')):
    function cleaninglight_themes_about_us_image( $about_image, $astyle ){ ?>
            <div class="about-left about-img">
                <?php  if( !empty( $about_image ) ){ ?>
                    <img src="<?php echo esc_url(  $about_image  ); ?>"/>
                <?php } ?>
            </div>
        <?php 
    }
endif;

if( !function_exists('cleaninglight_themes_about_us_content')):

    function cleaninglight_themes_about_us_content( $astyle ){

        $super_title = get_theme_mod('cleaninglight_aboutus_super_title'); ?>
            <div class="about-right">
                <?php if( !empty( $super_title ) ){ ?>
                    <h4 class="about-super-title"><?php echo esc_html( $super_title ); ?></h4>
                <?php } ?>
                <h2 class="section-title"><?php the_title(); ?></h2>
                <div class="section-tagline-text">
                    <?php 
                    
                        the_content(); 
                    
                    if (get_theme_mod('cleaninglight_progress', 'disable') == 'enable'):
                        $about_progressitem = get_theme_mod('cleaninglight_progressbar_item');
                        $aboutprogressitems = json_decode($about_progressitem);

                        if( !empty( $aboutprogressitems ) ):
                        foreach ($aboutprogressitems as $progressitem):

                        if( $progressitem->progressbar_title || $progressitem->progressbar_number ):
                    ?>
                        <div class="cleaninglight-progress-bar-wrapper">
                            <div class="cleaninglight-progress-item">
                                <span class="cleaninglight-progress-title"><?php echo esc_html( $progressitem->progressbar_title ); ?></span>
                                <div class="cleaninglight-progress-bar" data-width="<?php echo esc_attr( $progressitem->progressbar_number ); ?>">
                                    <div class="cleaninglight-progress-bar-length" style="background-color:<?php echo esc_attr( $progressitem->progressbar_color ); ?>">
                                        <span style="color:<?php echo esc_html( $progressitem->progressbar_color ); ?>"><?php echo intval( $progressitem->progressbar_number ); ?>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; endforeach; endif; endif; ?>

                    <?php
                        $more_about_us = get_theme_mod('cleaninglight_more_about_us');
                        $moreaboutus = json_decode($more_about_us);
                        if (!empty( $more_about_us ) ): 
                    ?>
                        <div class="aboutus-service-wrapper">
                            <?php
                                $loopCount = 0;
                                foreach ($moreaboutus as $moreabout):
                            ?>
                                <div class="aboutus-service-item <?php if($loopCount == 0){ echo esc_attr('toggle-active'); } $loopCount+= 1; ?>">
                                    <?php if( $moreabout->aboutus_icon ): ?>
                                        <div class="aboutus-icon-wrapper">
                                            <div class="aboutus-service-icon">
                                                <i class="<?php echo esc_attr( $moreabout->aboutus_icon ); ?>"></i>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="aboutus-service-block-wrap">
                                        <?php if( $moreabout->aboutus_title ): ?>
                                            <h3 class="cleaninglight-item-title">
                                                <?php echo esc_html( $moreabout->aboutus_title ); ?>
                                            </h3>   
                                        <?php endif; ?>

                                        <?php if( $moreabout->aboutus_desc ): ?>             
                                            <div class="aboutus-inner-service-wrap">
                                                <div class="cleaninglight-item-description">
                                                    <?php echo esc_html( $moreabout->aboutus_desc ); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>           
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php
                        $about_button = get_theme_mod( 'cleaninglight_aboutus_button_text','More About Us' );
                        $video_link = get_theme_mod( 'cleaninglight_about_video_link');
                        $readmore_link = get_theme_mod( 'cleaninglight_about_readmore_link');
                    ?>
                    <div class="about-button-wrap">
                        <?php if ( !empty( $about_button ) && !empty( $readmore_link ) ) { ?>
                            <a href="<?php echo esc_url( $readmore_link ); ?>" class="btn btn-primary">
                                <?php echo esc_html( $about_button ); ?>
                            </a>
                        <?php } ?>

                        <?php if ( !empty( $video_link ) ) { ?>
                            <a href="<?php echo esc_url( $video_link ); ?>" rel="prettyVideo[iframe]" target="_blank" class="about-video-link box-shadow-ripples">
                                <i class="fas fa-play "></i>
                            </a>
                        <?php } ?>
                    </div>
                        
                    <?php 
                        $signature = get_theme_mod('cleaninglight_aboutus_signature');
                        $image = get_theme_mod('cleaninglight_aboutus_profile_image');
                        $profile_name = get_theme_mod('cleaninglight_aboutus_profile_name');
                        if( $image || $profile_name || $signature ): ?>
                            <div class="about-profile">
                                <?php if( !empty( $image )): ?>
                                    <div class="about-profile-img" style="background-image: url('<?php echo esc_url($image); ?>')"></div>
                                <?php endif; ?>
                                
                                <?php if( $profile_name ): ?>
                                    <div class="profile-info">
                                        <h4><?php echo esc_html($profile_name ); ?></h4>
                                        <?php if($profile_role = get_theme_mod('cleaninglight_aboutus_profile_role') ): ?>
                                            <span class="role"><?php echo esc_html( $profile_role ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if( !empty( $signature ) ): ?>
                                        <div class="about-signature">
                                            <img src="<?php echo esc_url($signature); ?>" alt="signature">
                                        </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; 
                    ?>
                </div>
            </div>
        <?php
    }
endif;


if (! function_exists( 'cleaninglight_themes_about' ) ):
    
    function cleaninglight_themes_about(){ 

        $aboutus_options = get_theme_mod('cleaninglight_aboutus_disable','enable');

        if( !empty( $aboutus_options ) && $aboutus_options == 'enable' ){

            $astyle = get_theme_mod('cleaninglight_aboutus_layout_design', 'layouttwo');
            $service_class = array(
                $astyle,
                'section',
                'aboutus-section',
                'about_us_front'
            );
        ?>
            <section id="aboutus-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>">
                <div class="section-wrap">
                    <div class="container">
                        <div class="about-wrapper inner-section-wrap">
                            <?php
                                $aboutus = get_theme_mod('cleaninglight_about');
                                if (!empty( $aboutus ) ):
                                $aboutus_args = array(
                                    'posts_per_page' => 1,
                                    'post_type' => 'page',
                                    'page_id' => $aboutus,
                                    'post_status' => 'publish',
                                );
                                $aboutus_query = new WP_Query($aboutus_args);
                                
                                if ( $aboutus_query->have_posts() ) : while ( $aboutus_query->have_posts() ) : $aboutus_query->the_post();
                                    
                                $about_image = get_theme_mod('cleaninglight_about_image');
                                
                                cleaninglight_themes_about_us_image( $about_image, $astyle );

                                cleaninglight_themes_about_us_content( $astyle );
                            ?>
                            <?php endwhile; endif; endif; wp_reset_query(); ?>
                        </div>
                    </div>
                </div>
            </section>
    <?php } }
endif;
add_action('cleaninglight_themes_action_about', 'cleaninglight_themes_about', 35);

do_action('cleaninglight_themes_action_about');