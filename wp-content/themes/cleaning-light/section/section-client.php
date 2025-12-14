<?php
if (! function_exists( 'cleaninglight_themes_costruction_light_clients' ) ):

    function cleaninglight_themes_costruction_light_clients(){ 

        $client_logo_options = get_theme_mod('cleaninglight_client_disable','disable');
        if( !empty( $client_logo_options ) && $client_logo_options == 'enable' ){
            $service_class = array(
                'section',
                'client-section',
            );
        ?>
            <section id="client-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>">
                <div class="section-wrap">
                    <div class="container">
                        <div class="inner-section-wrap">
                            <?php 
                                $supertitle  = get_theme_mod('cleaninglight_client_super_title');
                                $title       = get_theme_mod('cleaninglight_client_title');
                                $titlestyle  = get_theme_mod('cleaninglight_client_title_align', 'text-center');
                                $designstyle = get_theme_mod('cleaninglight_client_title_style','style1');

                                cleaninglight_themes_section_title( $supertitle, $title, $titlestyle, $designstyle);

                                $displaystyle = get_theme_mod('cleaninglight_logo_style', 'style1');
                                if( !empty( $displaystyle ) && $displaystyle == 'style2' ){ ?>
                                    <div class="client-logo-list d-grid d-grid-column-4">
                                <?php }else{ 
                                    $controls = json_encode(array(
                                        'item' => 5
                                    ));
                                    $controls = json_decode($controls, true);
                                    $data = cleaninglight_themes_get_data_attribute($controls);
                                ?>
                                    <div class="client-logo-slider owl-carousel carouseldots" <?php echo ( $data ); ?>>
                                <?php  }
                            
                                    $client_images = get_theme_mod('cleaninglight_client');
                                    if (!empty($client_images)) :

                                    $client_images = json_decode($client_images);
                                    foreach ($client_images as $image) {
                                ?>
                                    <div class="client-block-item">
                                        <a href="<?php echo esc_url( $image->client_link ); ?>">
                                            <img src="<?php echo esc_url( $image->client_image ); ?>" class="img-fluid">
                                        </a>
                                    </div>
                                <?php } endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php } }
endif;
add_action('cleaninglight_themes_costruction_light_action_clients', 'cleaninglight_themes_costruction_light_clients', 80);

do_action('cleaninglight_themes_costruction_light_action_clients');