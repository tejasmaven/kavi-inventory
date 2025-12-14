<?php
/**
 * Functions and definitions
 *
 * @package Cleaning Light
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function cleaninglight_themes_body_classes( $classes ) {
    
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }
    
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no';
    }
    
    $header_layout = get_theme_mod( 'cleaninglight_header_layout', 'layout_one' );
    if ( ! empty( $header_layout ) ) {
        $classes[] = sanitize_html_class( $header_layout );
    }
    
    // Add RTL-specific body class for better CSS targeting
    if ( is_rtl() ) {
        $classes[] = 'cleaninglight-rtl';
    }
    
    return $classes;
}
add_filter( 'body_class', 'cleaninglight_themes_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function cleaninglight_themes_pingback_header() {
    
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'cleaninglight_themes_pingback_header' );

/**
 * Adds a meta box to the side column on the Post and Page edit screens.
 */
function cleaninglight_themes_sidebar_layout_meta_box() {

    $screens = array( 'post', 'page' );

    foreach ( $screens as $screen ) {
        add_meta_box(
            'cleaninglight_themes_sidebar_layout',
            esc_html__( 'Page Layout', 'cleaning-light' ),
            'cleaninglight_themes_sidebar_layout_meta_box_callback',
            $screen,
            'side',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'cleaninglight_themes_sidebar_layout_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function cleaninglight_themes_sidebar_layout_meta_box_callback( $post ) {

    // Add a nonce field for security.
    wp_nonce_field( 'cleaninglight_themes_sidebar_layout_save_meta_box', 'cleaninglight_themes_sidebar_layout_meta_box_nonce' );

    // Get existing value from database.
    $cleaninglight_themes_sidebar_layout = get_post_meta( $post->ID, 'cleaninglight_themes_sidebar_layout', true );

    if ( empty( $cleaninglight_themes_sidebar_layout ) ) {
        $cleaninglight_themes_sidebar_layout = 'no';
    }

    $layouts = array(
        'no' => array(
            'value' => 'no',
            'label' => esc_html__( 'No Sidebar', 'cleaning-light' ),
            'image' => get_template_directory_uri() . '/inc/customizer/images/no-sidebar.png',
        ),
        'right' => array(
            'value' => 'right',
            'label' => esc_html__( 'Right Sidebar', 'cleaning-light' ),
            'image' => get_template_directory_uri() . '/inc/customizer/images/right-sidebar.png',
        ),
        'left' => array(
            'value' => 'left',
            'label' => esc_html__( 'Left Sidebar', 'cleaning-light' ),
            'image' => get_template_directory_uri() . '/inc/customizer/images/left-sidebar.png',
        ),
    );

    echo '<div class="cleaninglight-sidebar-layouts">';
    
    foreach ( $layouts as $layout ) {
        printf(
            '<label class="cleaninglight-layout-option">' .
            '<input type="radio" name="cleaninglight_themes_sidebar_layout" value="%s" %s />' .
            '<img src="%s" alt="%s" />' .
            '</label>',
            esc_attr( $layout['value'] ),
            checked( $cleaninglight_themes_sidebar_layout, $layout['value'], false ),
            esc_url( $layout['image'] ),
            esc_attr( $layout['label'] )
        );
    }
    
    echo '</div>';
}

/**
 * Saves the meta box data.
 *
 * @param int $post_id The ID of the post being saved.
 * @return void
 */
function cleaninglight_themes_sidebar_layout_save_meta_box( $post_id ) {

    // Check if nonce is set.
    if ( ! isset( $_POST['cleaninglight_themes_sidebar_layout_meta_box_nonce'] ) ) {
        return;
    }

    // Verify nonce.
    if ( ! wp_verify_nonce( sanitize_key( $_POST['cleaninglight_themes_sidebar_layout_meta_box_nonce'] ), 'cleaninglight_themes_sidebar_layout_save_meta_box' ) ) {
        return;
    }

    // If this is an autosave, don't save.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check user permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Save the data.
    if ( isset( $_POST['cleaninglight_themes_sidebar_layout'] ) ) {
        $cleaninglight_themes_data = sanitize_key( wp_unslash( $_POST['cleaninglight_themes_sidebar_layout'] ) );
        update_post_meta( $post_id, 'cleaninglight_themes_sidebar_layout', $cleaninglight_themes_data );
    }
}
add_action( 'save_post', 'cleaninglight_themes_sidebar_layout_save_meta_box' );

/**
 * Displays single post meta.
 */
if ( ! function_exists( 'cleaninglight_themes_single_post_meta' ) ) {
    function cleaninglight_themes_single_post_meta() {
        do_action( 'cleaninglight_themes_post_meta' );
    }
}

/**
 * Displays single post content.
 */
if ( ! function_exists( 'cleaninglight_themes_single_content' ) ) {
    function cleaninglight_themes_single_content() {
        echo '<div class="cleaninglight-article-wrap">';
        
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cleaning-light' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post( get_the_title() )
            )
        );
        
        echo '</div>';
    }
}

/**
 * Displays single post title.
 */
if ( ! function_exists( 'cleaninglight_themes_single_title' ) ) {
    function cleaninglight_themes_single_title() {
        the_title( '<h1 class="cleaninglight-single-title entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
    }
}


/**
 * Display single post pagination (prev/next).
 */
function cleaninglight_themes_single_pagination() {

    $next_post = get_next_post();
    $prev_post = get_previous_post();

    if ( empty( $next_post ) && empty( $prev_post ) ) {
        return;
    }
    ?>

    <div class="prevNextArticle d-flex box-content">
        <div class="prevnext-item previus">
            <?php if ( ! empty( $prev_post ) ) : ?>
                <a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>" title="<?php echo esc_attr( $prev_post->post_title ); ?>" class="single-navigation previous-post">
                    <?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?>
                </a>
            <?php endif; ?>
            <?php
            previous_post_link(
                    '%link',
                    '<h3><span>' . esc_html__( 'Previous article', 'cleaning-light' ) . '</span></h3><div class="title prev">%title</div>'
                );
            ?>
        </div>
        <div class="prevnext-item text-right">
            <?php
                next_post_link(
                    '%link',
                    '<h3><span>' . esc_html__( 'Next article', 'cleaning-light' ) . '</span></h3><div class="title next">%title</div>'
                );
            ?>
            <?php if ( ! empty( $next_post ) ) : ?>
                <a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>" title="<?php echo esc_attr( $next_post->post_title ); ?>" class="single-navigation next-post">
                    <?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php
}


/**
 * Displays single post comments.
 */
if ( ! function_exists( 'cleaninglight_themes_single_comment' ) ) {
    function cleaninglight_themes_single_comment() {
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    }
}



/**
 * Displays related posts on single post pages.
 */
function cleaninglight_themes_single_related_posts() {
    global $post;

    // Get related posts (excluding current post).
    $related_posts = get_posts(
        array(
            'numberposts' => 4,
            'post__not_in' => array( $post->ID ),
            'post_type'   => 'post',
            'orderby'        => 'rand',
        )
    );

    if ( ! empty( $related_posts ) ) :
        $article_wrap_class = array( 'cleaninglight-article-wrap11', 'd-grid', 'd-grid-column-2' );
    ?>
        <div class="related-posts">

            <h3 class="related-title"><?php esc_html_e( 'Related Posts', 'cleaning-light' ); ?></h3>

            <div class="<?php echo esc_attr( implode( ' ', $article_wrap_class ) ); ?>">
                <?php
                    foreach ( $related_posts as $post ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

                        setup_postdata( $post );

                        get_template_part( 'template-parts/content', 'related' );

                    endforeach;
                    wp_reset_postdata();
                ?>
            </div>

        </div>

    <?php endif;
}


/**
 * Register required plugins.
 */
if ( ! function_exists( 'cleaninglight_themes_register_required_plugins' ) ) {
    function cleaninglight_themes_register_required_plugins() {
        
        $plugins = array(
            array(
                'name'     => esc_html__( 'Elementor', 'cleaning-light' ),
                'slug'     => 'elementor',
                'required' => true,
            ),
            array(
                'name'     => esc_html__( 'Contact Form 7', 'cleaning-light' ),
                'slug'     => 'contact-form-7',
                'required' => true,
            ),
            array(
                'name'     => esc_html__( 'CookieYes', 'cleaning-light' ),
                'slug'     => 'cookie-law-info',
                'required' => false,
            ),
            array(
                'name'     => esc_html__( 'Loco Translate', 'cleaning-light' ),
                'slug'     => 'loco-translate',
                'required' => true,
            ),
            array(
                'name'     => esc_html__( 'Hash Form', 'cleaning-light' ),
                'slug'     => 'hash-form',
                'required' => false,
            ),
        );
        
        $config = array(
            'id'           => 'cleaning-light',
            'default_path' => '',
            'menu'         => 'tgmpa-install-plugins',
            'has_notices'  => true,
            'dismissable'  => true,
            'dismiss_msg'  => '',
            'is_automatic' => false,
            'message'      => '',
        );
        
        tgmpa( $plugins, $config );
    }
}
add_action( 'tgmpa_register', 'cleaninglight_themes_register_required_plugins' );