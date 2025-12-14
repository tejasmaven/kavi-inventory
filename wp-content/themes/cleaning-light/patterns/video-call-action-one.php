<?php
/**
 * Title: Video Call To Action One
 * Slug: cleaninglight/video-call-action-one
 * Categories: cleaninglight
 * Keywords: Video, video cta, cta, one video area
 */
?>
<!-- wp:group {"tagName":"section","metadata":{"name":"Video Call To Action One","categories":["cleaninglight"],"patternName":"cleaninglight/video-call-action-one"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|xl","bottom":"var:preset|spacing|xl","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"primary","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-primary-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--xl);padding-right:0;padding-bottom:var(--wp--preset--spacing--xl);padding-left:0">
    <!-- wp:group {"metadata":{"name":"Section Title"},"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|md"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--md)">
        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} -->
            <p class="has-text-align-center has-white-color has-text-color has-link-color" style="font-style:normal;font-weight:500"><?php esc_html_e( 'Fully Customization Theme', 'cleaning-light' ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:heading {"textAlign":"center","align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} -->
            <h2 class="wp-block-heading alignfull has-text-align-center has-white-color has-text-color has-link-color"><?php esc_html_e( 'We Are A Professional Best WordPress Theme Agency', 'cleaning-light' ); ?></h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} -->
            <p class="has-text-align-center has-white-color has-text-color has-link-color" style="margin-top:0;margin-bottom:0"><?php esc_html_e( 'Welcome and thank you for installing the free WordPress theme. Cleaning is a clean, beautiful, and fully customizable responsive modern free WordPress cleaning theme, especially for App-related landing pages.', 'cleaning-light' ); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"metadata":{"name":"Video Area"},"align":"full","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0">
        <!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/slider-img.webp","id":2448,"dimRatio":50,"align":"wide","layout":{"type":"constrained"}} -->
        <div class="wp-block-cover alignwide">
            <span aria-hidden="true" class="wp-block-cover__background has-background-dim"></span>
            <img class="wp-block-cover__image-background wp-image-2448" alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/slider-img.webp" data-object-fit="cover"/>
            <div class="wp-block-cover__inner-container">
                <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
                <div class="wp-block-group">
                    <!-- wp:buttons {"className":"box-shadow-ripples","layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons box-shadow-ripples">
                        <!-- wp:button {"className":"is-style-video"} -->
                        <div class="wp-block-button is-style-video">
                            <a class="wp-block-button__link wp-element-button" href="#" target="_blank" rel="noreferrer noopener">
                                <span class="dashicons dashicons-video-alt3"></span>
                            </a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->
            </div>
        </div>
        <!-- /wp:cover -->
    </div>
    <!-- /wp:group -->
</section>
<!-- /wp:group -->