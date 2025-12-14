<?php

if (! function_exists( 'cleaninglight_themes_service' ) ):

    function cleaninglight_themes_service(){

        $service_type = get_theme_mod('cleaninglight_service_type','default');
        $service_layout = get_theme_mod('cleaninglight_service_layout', 'style1');
        $services_options = get_theme_mod('cleaninglight_service_disable','disable');
        
        if( !empty( $services_options ) && $services_options == 'enable' ){
            $service_class = array(
                'section',
                'service-section',
                $service_layout
            );
        ?>
            <section id="service-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>">
                <div class="section-wrap">
                    <div class="container">
                        <div class="inner-section-wrap">
                            <?php 
                                $supertitle = get_theme_mod( 'cleaninglight_service_super_title' );
                                $title 		= get_theme_mod( 'cleaninglight_service_title' );
                                $titlestyle  = get_theme_mod('cleaninglight_service_title_align', 'text-center');
                                $designstyle = get_theme_mod('cleaninglight_service_title_style','style1');

                                cleaninglight_themes_section_title( $supertitle, $title, $titlestyle, $designstyle ); 
                            ?>
                            <?php
                                if( !empty( $service_type ) && $service_type == 'advance' ){
                                    
                                    if( $service_layout == 'style2'){

                                        cleaninglight_themes_service_advance_content_second(); 

                                    }else{

                                        cleaninglight_themes_service_advance_content($service_layout);
                                    }
                                }else{

                                    if( $service_layout == 'style2'){

                                        cleaninglight_themes_service_default_content_second();

                                    }else{
                                        
                                        cleaninglight_themes_service_default_content($service_layout);
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
    <?php } }
endif;
add_action('cleaninglight_themes_action_service', 'cleaninglight_themes_service', 45);


/** Default Service Settings Area */
if (! function_exists( 'cleaninglight_themes_left_services' ) ):
    function cleaninglight_themes_left_services($array){ ?>
        <div class="service-area-block-left service-area-block-wrap">
            <?php foreach($array as $page): ?>
                <div class="service-area-item-block">
                    <h3><a href="<?php echo esc_url( get_the_permalink($page->service_page) ); ?>"><?php echo esc_html( get_the_title($page->service_page) ); ?></a></h3>
                    <p><?php echo esc_html( get_the_excerpt( $page->service_page ) ); ?></p>
                    <?php if( !empty( $page->button_text ) ){ ?>
                        <a href="<?php the_permalink( $page->service_page ); ?>" class="btn btn-noborder">
                            <?php echo esc_html( $page->button_text ); ?>
                        </a>
                    <?php } ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
endif; 


if (! function_exists( 'cleaninglight_themes_right_services' ) ):
    function cleaninglight_themes_right_services($array){ ?>
        <div class="service-area-block-right service-area-block-wrap">
            <?php foreach($array as $page): ?>
                <div class="service-area-item-block">
                    <h3><a href="<?php echo esc_url( get_the_permalink($page->service_page) ); ?>"><?php echo esc_html( get_the_title($page->service_page) ); ?></a></h3>
                    <p><?php echo esc_html( get_the_excerpt( $page->service_page ) ); ?></p>
                    <?php if( !empty( $page->button_text ) ){ ?>
                        <a href="<?php the_permalink( $page->service_page ); ?>" class="btn btn-noborder">
                            <?php echo esc_html( $page->button_text ); ?>
                        </a>
                    <?php } ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
endif; 


if (! function_exists( 'cleaninglight_themes_service_default_content' ) ):
    function cleaninglight_themes_service_default_content($service_layout){

        $service_page = get_theme_mod('cleaninglight_service');

        if( $service_page ){
            $pages = json_decode($service_page);
        }
        if( $service_page):
            $leftArray = $rightArray = array();
            if( $pages && is_array($pages) && count($pages) > 1 && ($pages[0]->service_page)){
                list($leftArray, $rightArray) = array_chunk($pages, ceil(count($pages) / 2));
            }else{
                $leftArray = $pages;
            }

            $img = wp_get_attachment_url(get_theme_mod('cleaninglight_service_bg_url'));
        ?>
            <div class="service-area-detail <?php if( empty( $img ) ){ echo esc_attr('without-image'); } ?>">

                <?php cleaninglight_themes_left_services( $leftArray); ?>

                <?php if( !empty( $img ) ): ?>
                    <div class="service-area-feature-image-wrap">
                        <div class="service-area-feature-img">
                            <img src="<?php echo esc_url($img); ?>" alt="image">
                        </div>
                    </div>
                <?php endif; ?>

                <?php cleaninglight_themes_right_services( $rightArray); ?>

            </div>
    <?php endif;
    }
endif;


if( !function_exists("cleaninglight_themes_service_default_content_second")){
    function cleaninglight_themes_service_default_content_second(){
        
            $service_page   = get_theme_mod('cleaninglight_service');
            if( $service_page ){
                $pages = json_decode($service_page);  
            }
            if($service_page):
        ?>
        <div class="d-grid d-grid-column-3">
            <?php foreach($pages as $page): ?>
                <div class="service-area-block-wrap">
                    <figure class="service-area-block-image">
                        <a href="<?php echo esc_url( get_the_permalink($page->service_page) ); ?>">
                            <?php if ( has_post_thumbnail($page->service_page) ) : ?>
                                <?php echo get_the_post_thumbnail($page->service_page, 'medium_large'); ?>
                            <?php else: ?>
                                <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                            <?php endif; ?>
                        </a>
                    </figure>
                    <div class="service-area-item-block">
                        <?php if( $page->service_icon ): ?>
                            <div class="icon-box">
                                <i class="<?php echo esc_attr($page->service_icon); ?>"></i>
                            </div>
                        <?php endif; ?>
                        <h3><a href="<?php echo esc_url( get_the_permalink($page->service_page) ); ?>"><?php echo esc_html( get_the_title($page->service_page) ); ?></a></h3>
                        <p><?php echo esc_html( get_the_excerpt( $page->service_page ) ); ?></p>
                        <?php if( !empty( $page->button_text ) ){ ?>
                            <a href="<?php echo esc_url( $page->button_url ); ?>" class="btn btn-noborder">
                                <?php echo esc_html( $page->button_text ); ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif;
    }
}

/** Advance Service Settings Area */
if (! function_exists( 'cleaninglight_themes_service_advance_content' ) ):

    function cleaninglight_themes_service_advance_content($service_layout){

        $service_page  = get_theme_mod('cleaninglight_service_advance_settings');
        $img = wp_get_attachment_url(get_theme_mod('cleaninglight_service_bg_url'));

        if( $service_page ){
            $pages = json_decode($service_page);
        }
        if( $service_page):
            $leftArray = $rightArray = array();
            if( $pages && is_array($pages) && count($pages) > 1 && ($pages[0]->block_title)){
                list($leftArray, $rightArray) = array_chunk($pages, ceil(count($pages) / 2));
            }else{
                $leftArray = $pages;
            }
        ?>
            <div class="service-area-detail <?php if( empty( $img ) ){ echo esc_attr('without-image'); } ?>">
                <div class="service-area-block-left service-area-block-wrap">
                    <?php foreach($leftArray as $page): ?>
                        <div class="service-area-item-block">
                            <h3><a href="<?php echo esc_url( $page->button_url ); ?>"><?php echo esc_html( $page->block_title ); ?></a></h3>
                            <p><?php echo esc_html( $page->block_desc ); ?></p>
                            <?php if($page->button_text): ?>
                                <a href="<?php echo esc_url( $page->button_url ); ?>" class="btn btn-noborder">
                                    <?php echo esc_html( $page->button_text ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if( !empty( $img ) ): ?>
                    <div class="service-area-feature-image-wrap">
                        <div class="service-area-feature-img">
                            <img src="<?php echo esc_url($img); ?>" alt="image">
                        </div>
                    </div>
                <?php endif; ?>

                <div class="service-area-block-right service-area-block-wrap">
                    <?php foreach($rightArray as $page): ?>
                        <div class="service-area-item-block">
                            <h3><a href="<?php echo esc_url( $page->button_url ); ?>"><?php echo esc_html( $page->block_title ); ?></a></h3>
                            <p><?php echo esc_html( $page->block_desc ); ?></p>
                            <?php if($page->button_text): ?>
                                <a href="<?php echo esc_url( $page->button_url ); ?>" class="btn btn-noborder">
                                    <?php echo esc_html( $page->button_text ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif;
    }
endif;


if( !function_exists("cleaninglight_themes_service_advance_content_second")){

    function cleaninglight_themes_service_advance_content_second(){
        
        $service_page   = get_theme_mod('cleaninglight_service_advance_settings');

        if( $service_page ){
            $pages = json_decode($service_page);  
        }
        if( $service_page): ?>
            <div class="d-grid d-grid-column-3">
                <?php foreach($pages as $page): ?>
                    <div class="service-area-block-wrap">
                        <figure class="service-area-block-image">
                            <a href="<?php echo esc_url( $page->button_url ); ?>">
                                <?php if( !empty($page->block_image) ): ?>
                                    <img src="<?php echo esc_url($page->block_image); ?>" alt="<?php echo esc_attr($page->block_title); ?>"/>
                                <?php else: ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/default-placeholder.png'); ?>"/>
                                <?php endif; ?>
                            </a>
                        </figure>
                        <div class="service-area-item-block">
                            <?php if( $page->block_icon ): ?>
                                <div class="icon-box">
                                    <i class="<?php echo esc_attr($page->block_icon); ?>"></i>
                                </div>
                            <?php endif; ?>
                            <h3><a href="<?php echo esc_url( $page->button_url ); ?>"><?php echo esc_html( $page->block_title ); ?></a></h3>
                            <p><?php echo esc_html( $page->block_desc ); ?></p>
                            <?php if( !empty( $page->button_text ) ){ ?>
                                <a href="<?php echo esc_url( $page->button_url ); ?>" class="btn btn-noborder">
                                    <?php echo esc_html( $page->button_text ); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif;

    }
}

do_action('cleaninglight_themes_action_service');