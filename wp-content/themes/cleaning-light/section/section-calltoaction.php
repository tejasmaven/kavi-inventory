<?php

if (! function_exists( 'cleaninglight_themes_calltoaction' ) ):
    function cleaninglight_themes_calltoaction(){

        $cta_title       = get_theme_mod( 'cleaninglight_call_to_action_title','Welcome to our Cleaning WordPress Themes!' );
        $cta_sub_title   = get_theme_mod( 'cleaninglight_call_to_action_subtitle','Try our premium themes risk-free. If you are not 100% satisfied with the features and performance of our premium themes, we will credit your original payment method without any question.' );
        
        $button_text     = get_theme_mod('cleaninglight_call_to_action_button','WordPress Themes');
        $button_text_one = get_theme_mod('cleaninglight_call_to_action_button_one','Buy Now');
        $button_link = get_theme_mod('cleaninglight_call_to_action_link');
        $button_link_one = get_theme_mod('cleaninglight_call_to_action_link_one');

        $cta_options = get_theme_mod('cleaninglight_cta_disable','enable');
        if( !empty( $cta_options ) && $cta_options == 'enable' ){
            
            $service_class = array(
                'section',
                'calltoaction-section',
                get_theme_mod('cleaninglight_cta_alignment', 'center'),
                get_theme_mod('cleaninglight_cta_style', 'cover'),
            );
            
            $reverse = get_theme_mod('cleaninglight_cta_layout', 'cta-above');
            $about_image = get_theme_mod('cleaninglight_calltoaction_image', get_template_directory_uri() . '/assets/images/bg.jpg');
            $class = '';
            if( $about_image ){
                $class = ' withimage ';
            }
            $class .= $reverse;

            $calltoactionicon = get_theme_mod('cleaninglight_calltoaction_icon','fa-solid fa-headset');
        ?>
            <section id="calltoaction-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>">
                <div class="section-wrap">
                    <div class="<?php echo esc_attr( get_theme_mod('cleaninglight_cta_width','container') ); ?>">
                        <div class="inner-section-wrap <?php echo esc_attr( $class ); ?>">
                            <div class="call-to-action-wrapper">
                                <?php if( !empty( $about_image ) ): ?>
                                    <div class="call-to-action-bg-wrap">
                                        <div class="call-to-action-bg-img">
                                            <img src="<?php echo ( $about_image); ?>" alt="<?php echo esc_html( $cta_title ); ?>" role="img">
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="call-to-action-content-wrap">
                                    <?php if( !empty( $calltoactionicon ) ): ?>
                                        <div class="call-to-action-icon">
                                            <i class="<?php echo esc_attr( $calltoactionicon ); ?>"></i>
                                        </div>
                                    <?php endif; ?>
                                    <h2 class="section-title"><?php echo esc_html( $cta_title ); ?></h2>
                                    <p><?php echo esc_html( $cta_sub_title ); ?></p>
                                    <div class="call-to-action-button-wrap">
                                        <?php if( !empty( $button_text ) ){ ?>
                                            <a href="<?php echo esc_url( $button_link ); ?>" class="btn btn-primary">
                                                <?php echo esc_html( $button_text ); ?>
                                            </a>
                                        <?php } if( !empty( $button_text_one ) ){ ?>
                                            <a href="<?php echo esc_url( $button_link_one ); ?>" class="btn style-white">
                                                <?php echo esc_html( $button_text_one ); ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php } }
endif;
add_action('cleaninglight_themes_action_calltoaction', 'cleaninglight_themes_calltoaction', 50);

do_action('cleaninglight_themes_action_calltoaction');