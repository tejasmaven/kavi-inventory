<div class="welcome-header clearfix">
    <div class="welcome-intro">
        <h2>
            <?php
                printf(// WPCS: XSS OK.
                    /* translators: 1-theme name, 2-theme version */
                    esc_html__('Welcome to %1$s - Version %2$s', 'cleaning-light'), $this->theme_name, $this->theme_version);
            ?>
        </h2>
        <div class="welcome-text">
            <?php
                printf(// WPCS: XSS OK.
                    /* translators: 1-theme name */
                    esc_html__('Welcome, and thank you for installing %1$s. Getting started with %1$s is a clean, beautiful, and fully customizable responsive modern WordPress theme, especially for landing pages. And of course, the premium version for additional features and better support.', 'cleaning-light'), $this->theme_name);
            ?>
        </div>
        <div class="free-pro-demos">
            <a class="button button-primary" href="<?php echo admin_url('customize.php'); ?>" target="_blank"><span class="dashicons Media dashicons-admin-settings"></span><?php esc_html_e('Customize', 'cleaning-light'); ?></a>
            <a class="button button-primary" href="<?php echo apply_filters('cleaninglight-demo-link','https://ikreatethemes.com/wordpress-theme/cleaning-wordpress-theme/'); ?>" target="_blank"><span class="dashicons dashicons-visibility"></span><?php esc_html_e('Starter Templates', 'cleaning-light'); ?></a>
            <?php echo $this->cleaninglight_setup_content(); ?>
        </div>
    </div>
    <div class="welcome-promo-banner">
        <a class="welcome-promo-offer" href="<?php echo apply_filters('cleaninglight-link', esc_url('https://ikreatethemes.com/wordpress-theme/cleaning-wordpress-theme/') );?>" target="_blank">
            <?php 
                printf(// WPCS: XSS OK.
                    /* translators: 1-theme name */
                    esc_html__('Unlock all the possibilities with %1$s Pro', 'cleaning-light'), $this->theme_name);
            ?>
        </a>
        <a href="<?php echo apply_filters('cleaninglight-link', esc_url('https://ikreatethemes.com/wordpress-theme/cleaning-wordpress-theme/') );?>" target="_blank" class="button button-primary upgrade-btn"><span class="dashicons dashicons-info"></span><?php echo esc_html__(' Upgrade for $59', 'cleaning-light'); ?></a>
    </div>
</div>
<div class="welcome-nav-wrapper clearfix">
    <?php foreach ($tabs as $section_id => $label) : ?>
        <?php
            $section = isset($_GET['section']) && array_key_exists($_GET['section'], $tabs) ? $_GET['section'] : 'getting_started';
            $nav_class = 'welcome-nav-tab';
            if ($section_id == $section) {
                $nav_class .= ' welcome-nav-tab-active';
            }
        ?>
        <a href="<?php echo esc_url(admin_url('admin.php?page=cleaninglight-welcome&section=' . $section_id)); ?>" class="<?php echo esc_attr($nav_class); ?>" >
            <?php echo esc_html($label); ?>
        </a>
    <?php endforeach; ?>
</div>