<?php

if (! function_exists( 'cleaninglight_themes_customa_section' ) ):

    function cleaninglight_themes_customa_section(){

        $customa_options = get_theme_mod('cleaninglight_customa_disable','disable');
        if( !empty( $customa_options ) && $customa_options == 'enable' ){
            $customa_class = array(
                'section',
                'customa-section'
            );
        ?>
            <section id="customa-section" class="<?php echo esc_attr(implode(' ', $customa_class)) ?>">
                <div class="section-wrap">
                    <div class="container">
                        <div class="inner-section-wrap">
                            <?php 
                                $supertitle  = get_theme_mod( 'cleaninglight_customa_super_title');
                                $title 		 = get_theme_mod('cleaninglight_customa_title');
                                $titlestyle  = get_theme_mod( 'cleaninglight_customa_title_align','text-center' );
                                $designstyle = get_theme_mod('cleaninglight_customa_title_style','style1');
                                
                                cleaninglight_themes_section_title( $supertitle, $title, $titlestyle, $designstyle ); 
                            ?>
                            <div class="customa-wrap customa-pages">
                                <?php
                                    
                                    $customa_page = get_theme_mod('cleaninglight_customa_page_settings');

                                    $page_on_front = get_option('page_on_front');

                                    $page_for_posts = get_option('page_for_posts');

                                    if ($customa_page) {
                                
                                        if ($customa_page == $page_on_front) {
                                            esc_html_e('You can not choose the page that is set as the Homepage in Settings > Reading. Please choose another Page', 'cleaning-light');
                                        } else if ($customa_page == $page_for_posts) {
                                            esc_html_e('You can not choose the page that is set as the Posts page in Settings > Reading. Please choose another Page', 'cleaning-light');
                                        } else {
                                            
                                            $get_id = $customa_page; 

                                            $template_id = get_post($get_id);
                            
                                            if ($template_id && !is_wp_error($template_id)) {

                                                $content = $template_id->post_content;
                                            }

                                            echo apply_filters('iktheme_customa_content', $content);
                                    
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } }
endif;

add_action('cleaninglight_themes_action_customa', 'cleaninglight_themes_customa_section', 180);

do_action('cleaninglight_themes_action_customa');