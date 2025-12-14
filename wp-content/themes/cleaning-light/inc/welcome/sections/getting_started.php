<div class="welcome-getting-started">
    <div class="welcome-demo-import">
        <h3><?php echo esc_html__('Manual Setup', 'cleaning-light'); ?></h3>
        <div class="free-pro-demos livepreview">
            <a class="button button-primary" href="https://ikreatethemes.com/wordpress-theme/cleaning-wordpress-theme/" target="_blank"><span class="dashicons dashicons-visibility"></span><?php echo esc_html__('Live Preview', 'cleaning-light'); ?></a>      
            <div class="documentation">
                <a href="<?php echo esc_url('https://docs.ikreatethemes.com/docs/cleaning-light/'); ?>" target="_blank" ><?php echo esc_html__('Text Documentation', 'cleaning-light'); ?></a> |
                <a href="<?php echo esc_url('https://docs.ikreatethemes.com/docs/cleaning-light/'); ?>" target="_blank" ><?php echo esc_html__('Video Documentation', 'cleaning-light'); ?></a>
            </div>
        </div>
        <p><?php echo esc_html__('You can set up the home page sections either from Customizer Panel or from Elementor Pagebuilder', 'cleaning-light'); ?></p>
        <p><strong><?php echo esc_html__('FROM CUSTOMIZER', 'cleaning-light'); ?></strong></p>
        <ol>
            <li><?php echo esc_html__('Go to Appearance &gt; Customize', 'cleaning-light'); ?></li>
            <li><?php echo esc_html__('Click on ', 'cleaning-light'); ?><strong>"<a href="<?php echo esc_url(admin_url('customize.php?autofocus[section]=static_front_page')); ?>"><?php echo esc_html__('Enable Front Page', 'cleaning-light'); ?></a>"</strong> <?php echo esc_html__('and turn on the option for "Enable FrontPage" Setting.', 'cleaning-light'); ?></li>
            <li><?php echo sprintf( esc_html__('Now go back to %s and set up the FrontPage Section', 'cleaning-light'), '<a href="'.esc_url(admin_url('customize.php?autofocus[panel]=cleaninglight_frontpage_settings')).'">' . esc_html__('Home Sections', 'cleaning-light') . '</a>'); ?></li>
        </ol>
        <p><strong><?php echo esc_html__('FROM ELEMENTOR', 'cleaning-light'); ?></strong></p>
        <ol>
            <li><?php echo esc_html__('Firstly install and activate "Elementor Website Builder" plugin from', 'cleaning-light'); ?> <a href="<?php echo esc_url(admin_url('themes.php?page=tgmpa-install-plugins')); ?>"><?php echo esc_html__('Recommended Plugin page.', 'cleaning-light'); ?></a></li>
            <li><?php echo esc_html__('Create a new page and edit with Elementor. Drag and drop the elements in the Elementor to create your own design.', 'cleaning-light'); ?></li>
            <li><?php echo esc_html__('Now go to Appearance &gt; Customize &gt; Homepage Settings and choose "A static page" for "Your latest posts" and select the created page for "Home Page" option.', 'cleaning-light'); ?></li>
        </ol>
        <p><strong><?php echo esc_html__('For detailed documentation, please visit', 'cleaning-light'); ?> <a href="<?php echo esc_url('https://docs.ikreatethemes.com/docs/cleaning-light/'); ?>" target="_blank"><?php echo esc_html__('Documentation Page.', 'cleaning-light'); ?></a></strong></p>
    </div>
    <div class="welcome-demo-import">
        <h3><?php echo esc_html__('Demo Importer', 'cleaning-light'); ?></h3>
        <div class="free-pro-demos livepreview">
            <?php echo $this->cleaninglight_setup_content(); ?>
        </div>
        <div class="welcome-demo-import-text">
            <p><?php echo sprintf(esc_html__('Click on the above button to install and activate the Demo Importer plugin. For more detailed documentation on how the demo importer works, click %s.', 'cleaning-light'), '<a href="https://docs.ikreatethemes.com/docs/cleaning-light/" target="_blank">' . esc_html__('here', 'cleaning-light') . '</a>'); ?></p>
        </div>
        <div class="welcome-theme-thumb">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.png'); ?>" alt="<?php printf(esc_attr__('%s Demo', 'cleaning-light'), esc_html($this->theme_name)); ?>">
        </div>
    </div>
</div>