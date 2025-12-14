<?php

if (! function_exists( 'cleaninglight_themes_video_calltoaction_section' ) ):

    function cleaninglight_themes_video_calltoaction_section(){

        $video_cta_options = get_theme_mod('cleaninglight_videcta_disable','enable');
        if( !empty( $video_cta_options ) && $video_cta_options == 'enable' ){ 
            $service_class = array(
                'section',
                'video_calltoaction-section',
            );
        ?>
        <section id="video_calltoaction-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>">
            <div class="section-wrap">
                <div class="container">
                    <div class="inner-section-wrap">
                        <?php 
                            $youtube_video_url  = get_theme_mod('cleaninglight_video_button_url','https://www.youtube.com/watch?v=1IaZy0sDLu0');
                            if( $youtube_video_url ){
                            
                            $videoimg = get_theme_mod('cleaninglight_video_calltoaction_video_bg', get_template_directory_uri() . '/assets/images/bg.jpg');
                            $withimage = '';
                            if( empty($videoimg) ){
                                $withimage = 'withoutimage';
                            }
                            $appointment_shortcode = get_theme_mod('cleaninglight_appointment_shortcode');
                            $reverse = get_theme_mod('cleaninglight_video_cta_layout', 'video-cta-top');
                            $class = '';
                            if( !empty( $reverse ) && $reverse == 'video-cta-left' && !empty( $appointment_shortcode ) && !empty( $videoimg ) ){
                                $class = 'video-cta-left';
                            }elseif( !empty( $reverse ) && $reverse == 'video-cta-right' && !empty( $appointment_shortcode ) && !empty( $videoimg ) ){
                                $class = 'video-cta-right';
                            }elseif( !empty( $reverse ) && $reverse == 'video-cta-below'){
                                $class = 'video-cta-below';
                            }else{
                                $class = 'video-cta-top';
                            }
                        ?>
                            <div class="<?php echo esc_attr( $class ); ?>">
                                
                                <div class="video-call-to-action-video-wrap <?php echo esc_attr( $withimage ); ?>">
                                    <?php if( !empty($videoimg) ){ ?>
                                        <div class="video-cat-image-wrap">
                                            <img src="<?php echo ( $videoimg); ?>" alt="" role="img">
                                        </div> 
                                    <?php } ?>    
                                    <a href="<?php echo esc_url( $youtube_video_url ); ?>" target="_blank" rel="prettyVideo[iframe]" class="box-shadow-ripples">
                                        <i class="fas fa-play "></i>
                                    </a>
                                </div>

                                <?php if( $appointment_shortcode ): ?>
                                    <div class="video-call-to-action-content-wrap contact-form">
                                        <?php 
                                            $title = get_theme_mod('cleaninglight_appointment_contact_title','Get in Touch Quickly');
                                            if( !empty( $title ) ){ 
                                        ?>
                                            <h3 class="section-title"><?php echo esc_html( $title); ?></h3>
                                        <?php } ?>
                                        <?php echo do_shortcode($appointment_shortcode); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php } }

endif;

add_action('cleaninglight_themes_video_calltoaction', 'cleaninglight_themes_video_calltoaction_section', 40);

do_action('cleaninglight_themes_video_calltoaction');