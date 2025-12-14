<?php

if (!defined('WPINC')) {
    die();
}

if (!class_exists('CleaningLightElements')) {

    class CleaningLightElements {

        private static $instance = null;

        public static function get_instance() {
            
            // If the single instance hasn't been set, set it now.
            if (self::$instance == null) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct() {
            // Check if Elementor installed and activated
            if (!did_action('elementor/loaded')) {
                return;
            }
            //get_template_part( 'inc/elements/inc/widget-loader' );
            require get_template_directory() . '/inc/elements/inc/widget-loader.php';

        }

    }

}

/**
 * Returns instanse of the plugin class.
 *
 * @since  1.0.6
 * @return object
 */
if (!function_exists('cleaninglight_themes_elements')) {

    function cleaninglight_themes_elements() {
        
        return CleaningLightElements::get_instance();
    }

}
cleaninglight_themes_elements();
