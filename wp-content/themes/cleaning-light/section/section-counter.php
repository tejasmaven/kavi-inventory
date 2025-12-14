<?php

if (! function_exists( 'cleaninglight_themes_counter' ) ):

    function cleaninglight_themes_counter(){  
        $counter_options = get_theme_mod('cleaninglight_counter_disable','disable');
        $counter_style = get_theme_mod('cleaninglight_counter_style','style2');
        if( !empty( $counter_options ) && $counter_options == 'enable' ){
            $service_class = array(
                'section',
                'counter-section',
                $counter_style
            );
        ?>
            <section id="counter-section" class="<?php echo esc_attr(implode(' ', $service_class)) ?>">
                <div class="section-wrap">
                    <div class="container">
                        <div class="inner-section-wrap">
                            <?php 
                                $supertitle = get_theme_mod('cleaninglight_counter_super_title');
                                $title       = get_theme_mod('cleaninglight_counter_title');
                                $titlestyle = get_theme_mod('cleaninglight_counter_title_align', 'text-center');
                                $designstyle = get_theme_mod('cleaninglight_counter_title_style','style1');

                                cleaninglight_themes_section_title( $supertitle, $title, $titlestyle, $designstyle ); 
                                
                                $counter_col = get_theme_mod( 'cleaninglight_counter_col', 3 );
                                $counticon = get_theme_mod('cleaninglight_counter_disable','enable');
                                
                                $display_style = get_theme_mod('cleaninglight_counter_display_style','above');

                                $counter_wrap_class = array("counter-block-wrapper", "d-grid", $display_style, "d-grid-column-$counter_col");
                            ?>
                            <div class="<?php echo esc_attr(implode(' ', $counter_wrap_class)); ?>">
                                <?php
                                    $counter_page = get_theme_mod('cleaninglight_counter');
                                    if (!empty($counter_page)):
                                    $counters = json_decode($counter_page);
                                    foreach ( $counters as $counter ):
                                ?>
                                    <div class="counter-block-wrap">
                                        <?php if( !empty( $counter_style ) && $counter_style == 'style3' ){ ?>
                                            <div class="counter-shape"><span></span></div>
                                        <?php } ?>
                                        <?php if( !empty( $counticon ) && $counticon  == 'enable' && !empty( $counter->counter_icon ) ){ ?>
                                            <div class="counter-block-icon">
                                                <i class="<?php echo esc_attr( $counter->counter_icon ); ?>"></i>
                                            </div>
                                        <?php } ?>
                                        <div class="counter-block-content">
                                            <?php if(!empty( $counter->counter_number ) ){ ?>
                                                <div class="counter-block-number">
                                                    <div class="counternumber" data-durations="2000" data-tovalue="<?php echo intval( $counter->counter_number ); ?>" data-fromvalue="0" data-delimiters=",">
                                                        <?php echo intval( $counter->counter_number ); ?>
                                                    </div>
                                                    <?php if(!empty( $counter->counter_suffix )){ ?>
                                                        <div class="counter-block-suffix"><?php echo esc_html($counter->counter_suffix); ?></div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                            <h3 class="counter-block-title">
                                                <?php echo esc_html( $counter->counter_title ); ?>
                                            </h3>
                                        </div>
                                        <?php if( !empty( $counter_style ) && $counter_style  == 'style2' ){ ?>
                                            <span></span>
                                        <?php } ?>
                                    </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php } }

endif;
add_action('cleaninglight_themes_action_counter', 'cleaninglight_themes_counter', 60);


do_action('cleaninglight_themes_action_counter');