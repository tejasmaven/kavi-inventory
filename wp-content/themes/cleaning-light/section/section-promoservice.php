<?php

if (! function_exists( 'cleaninglight_themes_promo_service' ) ):

    function cleaninglight_themes_promo_service(){

        $features_options = get_theme_mod('cleaninglight_promoservice_disable','enable');
        
        $style = get_theme_mod('cleaninglight_promoservice_style', 'style1');

        if( !empty( $features_options ) && $features_options == 'enable' ){
            $service_class = array(
                'section',
                'promoservice-section',
                $style
            );
        ?>
            <section id="promoservice-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>">
                <div class="section-wrap">
                    <div class="container">
                        <div class="inner-section-wrap">
                            <?php 
                                $supertitle  = get_theme_mod( 'cleaninglight_promoservice_super_title');
                                $title 		 = get_theme_mod('cleaninglight_promoservice_title');
                                $titlestyle  = get_theme_mod( 'cleaninglight_promoservice_title_align','text-center' );
                                $designstyle = get_theme_mod('cleaninglight_promoservice_title_style','style1');
                                
                                cleaninglight_themes_section_title( $supertitle, $title, $titlestyle, $designstyle ); 
                            ?>

                            <div class="feature-service-wrapper d-grid d-grid-column-3">
                                <?php
                                    $promoservice_type = get_theme_mod('cleaninglight_promoservice_type','default');
                                    
                                    switch ( $promoservice_type ) {
                                        case 'advance':
                                            cleaninglight_themes_promo_advance_sections();
                                            break;
                                        default:
                                            cleaninglight_themes_promo_default_sections();
                                            break;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } }
endif;

add_action('cleaninglight_themes_action_promo_service', 'cleaninglight_themes_promo_service', 30);


if(!function_exists('cleaninglight_themes_promo_default_sections')):
    function cleaninglight_themes_promo_default_sections(){

        $promo_service  = get_theme_mod('cleaninglight_promoservice');
        $show_image = get_theme_mod('cleaninglight_promoservice_show_image', 'enable');

        if (!empty($promo_service)):

        $pages = json_decode($promo_service);

        foreach ($pages as $page):

        $page_id = $page->service_page;

        if (!empty($page_id)):

            $service_query = new WP_Query(array('page_id' => intval($page_id)));

            if ( $service_query->have_posts() ): while ( $service_query->have_posts() ): $service_query->the_post();
            
            $style = '';
            if(!empty($page->bg_color) || !empty($page->color)){
                $bg_color = !empty($page->bg_color) ? 'background-color:' . esc_attr($page->bg_color) . ';' : '';
                $text_color = !empty($page->color) ? 'color:' . esc_attr($page->color) . ';' : '';
                $style = 'style="' . $bg_color . $text_color . '"';
            }
            
            $iconstyle = '';
            $layout = get_theme_mod('cleaninglight_promoservice_style', 'style1');
            if( !empty( $layout )  && $layout == 'style1'){
                $icon_margin = get_theme_mod('cleaninglight_promo_service_icon', 0);
                $icon_border_width = get_theme_mod('cleaninglight_promo_service_icon_border', 3);
                
                $icon_styles = array();
                
                if(!empty($icon_margin)){
                    $icon_styles[] = 'margin-top:' . intval($icon_margin) . 'px';
                }
                
                if(!empty($page->color)){
                    $icon_styles[] = 'color:' . esc_attr($page->color);
                    $icon_styles[] = 'border:' . intval($icon_border_width) . 'px solid ' . esc_attr($page->color);
                }
                
                if(!empty($icon_styles)){
                    $iconstyle = 'style="' . implode(';', $icon_styles) . ';"';
                }
            }
        ?>
            <div class="feature-service-wrap <?php echo esc_attr( $page->alignment ); ?><?php if(has_post_thumbnail() ): ?> image-<?php echo esc_attr($show_image); ?><?php endif; ?>" <?php echo $style; // Already escaped above ?>>
                <?php if( has_post_thumbnail() && $show_image == 'enable' ): ?>
                    <figure class="features-service-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('post-thumbnail'); ?>
                        </a>
                    </figure>
                <?php endif; ?>
                <div class="feature-service-content">
                    <?php if( get_theme_mod('cleaninglight_promoservice_show_icon', 'enable') == 'enable'): ?>
                        <div class="feature-service-icon" <?php echo $iconstyle; // Already escaped above ?>>
                            <i class="<?php echo esc_attr( $page->service_icon ); ?>"></i>
                        </div>
                    <?php endif; ?>
                    <h3>
                        <a href="<?php the_permalink(); ?>"<?php if(!empty($page->color)) { echo ' style="color:' . esc_attr($page->color) . ';"'; } ?>>
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <?php the_excerpt(); ?>
                    <div class="service-button-wrap">
                        <a href="<?php the_permalink(); ?>" class="btn btn-noborder"<?php if(!empty($page->color)) { echo ' style="color:' . esc_attr($page->color) . ';border-color:' . esc_attr($page->color) . ';"'; } ?>>
                            <?php echo esc_html__('Read More', 'cleaning-light'); ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php  endwhile; wp_reset_postdata(); endif; endif; endforeach; endif;
    }
endif;


if( !function_exists('cleaninglight_themes_promo_advance_sections') ):
    function cleaninglight_themes_promo_advance_sections(){
        
        $promo_service  = get_theme_mod('cleaninglight_promoservice_advance_settings');
        $show_image = get_theme_mod('cleaninglight_promoservice_show_image', 'enable');

        if (!empty($promo_service)):
        $pages = json_decode($promo_service);
        foreach ($pages as $page):
            if (!empty($page->block_title)):
                $style = '';
                if(!empty($page->block_bg_color) || !empty($page->block_color)){
                    $bg_color = !empty($page->block_bg_color) ? 'background-color:' . esc_attr($page->block_bg_color) . ';' : '';
                    $text_color = !empty($page->block_color) ? 'color:' . esc_attr($page->block_color) . ';' : '';
                    $style = 'style="' . $bg_color . $text_color . '"';
                }
                
                $iconstyle = '';
                $layout = get_theme_mod('cleaninglight_promoservice_style', 'style1');
                if( !empty( $layout )  && $layout == 'style1'){
                    $icon_margin = get_theme_mod('cleaninglight_promo_service_icon', 0);
                    $icon_border_width = get_theme_mod('cleaninglight_promo_service_icon_border', 3); // Get border width from theme mod
                    
                    $icon_styles = array();
                    
                    if( !empty( $icon_margin ) ){
                        $icon_styles[] = 'margin-top:' . intval($icon_margin) . 'px';
                    }
                    
                    if(!empty($page->block_color)){
                        $icon_styles[] = 'color:' . esc_attr($page->block_color);
                        $icon_styles[] = 'border:' . intval($icon_border_width) . 'px solid ' . esc_attr($page->block_color);
                    }
                    
                    if(!empty($icon_styles)){
                        $iconstyle = 'style="' . implode(';', $icon_styles) . ';"';
                    }
                }
        ?>
            <div class="feature-service-wrap <?php echo esc_attr( $page->block_alignment ); ?><?php if( !empty( $page->block_image ) ): ?> image-<?php echo esc_attr($show_image); ?><?php endif; ?>" <?php echo $style; // Already escaped above ?>>
                <?php if( !empty( $page->block_image ) && $show_image == 'enable' ): ?>
                    <figure class="features-service-image">
                        <a href="<?php echo esc_url( $page->button_url ); ?>">
                            <img src="<?php echo esc_url( $page->block_image ); ?>" alt="<?php echo esc_attr( $page->block_title ); ?>" />
                        </a>
                    </figure>
                <?php endif; ?>
                <div class="feature-service-content">
                    <?php if( get_theme_mod('cleaninglight_promoservice_show_icon', 'enable') == 'enable'): ?>
                        <div class="feature-service-icon" <?php echo $iconstyle; // Already escaped above ?>>
                            <i class="<?php echo esc_attr( $page->block_icon ); ?>"></i>
                        </div>
                    <?php endif; ?>
                    <h3>
                        <a href="<?php echo esc_url( $page->button_url ); ?>"<?php if(!empty($page->block_color)) { echo ' style="color:' . esc_attr($page->block_color) . ';"'; } ?>>
                            <?php echo esc_html( $page->block_title ); ?>
                        </a>
                    </h3>
                    <p><?php echo esc_html( $page->block_desc ); ?></p>
                    <?php if( !empty( $page->button_url ) ){ ?>
                        <div class="service-button-wrap">
                            <a href="<?php echo esc_url( $page->button_url ); ?>" class="btn btn-noborder"<?php if(!empty($page->block_color)) { echo ' style="color:' . esc_attr($page->block_color) . ';border-color:' . esc_attr($page->block_color) . ';"'; } ?>>
                                <?php echo esc_html( $page->button_text ); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endif; endforeach; endif;
    }
endif;

do_action('cleaninglight_themes_action_promo_service');