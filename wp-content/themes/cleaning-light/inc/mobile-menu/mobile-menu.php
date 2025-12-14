<div class="menu-modal header-mobile-menu cover-modal header-footer-group" data-modal-target-string=".menu-modal">
    <div class="menu-modal-inner modal-inner">
        <div class="menu-wrapper section-inner">
            <div class="menu-top">

                <button class="toggle close-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".menu-modal">
                    <span class="toggle-text"><?php esc_html_e( 'Close', 'cleaning-light' ); ?></span>
                    <i class="fas fa-times"></i>
                </button>

                <div class="cleaninglight-menu-search-form widget_search">
                    <?php get_search_form(); ?>
                </div>

                <div class='cleaninglight-menu-tab-wrap'>
                    <div class="cleaninglight-menu-tabs cleaninglight-tab-area">
                        <button class="cleaninglight-tab-menu active">
                            <span><?php echo esc_html( 'Menu','cleaning-light' ) ?></span>
                        </button>
                        <button class="cleaninglight-tab-item">
                            <span><?php echo esc_html( 'Contact','cleaning-light' ) ?></span>
                        </button>
                    </div>

                    <div class="custom-tab-content cleaninglight-tab-content">
                        <div class="cleaninglight-tab-menu-content tab-content">
                            <nav class="mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'cleaning-light' ); ?>" role="navigation">
                                <ul class="modal-menu">
                                    <?php
                                        if ( has_nav_menu( 'mobile' ) ) {
                                            wp_nav_menu( array(
                                                'container'      => '',
                                                'items_wrap'     => '%3$s',
                                                'show_toggles'   => true,
                                                'theme_location' => 'mobile',
                                            ) );
                                        } else {
                                            wp_nav_menu( array(
                                                'container'      => '',
                                                'items_wrap'     => '%3$s',
                                                'show_toggles'   => true,
                                                'theme_location' => 'primary',
                                            ) );
                                        }
                                    ?>
                                </ul>
                            </nav>
                            <?php if( get_theme_mod('cleaninglight_header_button_enable', 'enable') == 'enable' ){ ?>
                                <div class="cleaninglight-menu-button menu-item-button">
                                    <?php cleaninglight_themes_header_button(); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="cleaninglight-tab-item-content tab-content hidden">
                            <?php do_action('cleaninglight_themes_quick_contact_info_header'); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>