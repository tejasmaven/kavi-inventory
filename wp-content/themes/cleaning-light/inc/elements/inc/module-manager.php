<?php

namespace CleaningLightElements;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

if (!function_exists('is_plugin_active')) {

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

final class cleaninglight_themes_Modules_Manager {

    private function get_modules() {
        $modules = [
            'heading',
            'slider-block',
            'progress-bar',
            'featured-block',
            'service-block',
            'highlight-block',
            'call-to-action-block',
            'team-block',
            'team-carousel',
            'testimonial-block',
            'testimonial-carousel',
            'testimonial-slider',
            'counter-block',
            'advance-gallery',
            'blog-section',
            'logo-carousel',
            'image-flipster',
            'video-popup',
            'contact-section',
            'working-process',
        ];
        return $modules;
    }

    public function __construct() {
        
        $this->cleaninglight_themes_register_modules();
    }

    public function cleaninglight_themes_register_modules() {

        $modules = $this->get_modules();

        foreach ($modules as $module) {

            $class_name = str_replace('-', ' ', $module);
            $class_name = str_replace(' ', '', ucwords($class_name));
            $class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

            $class_name::instance();
        }
    }

}

if (!function_exists('cleaninglight_themes_module_manager')) {

    /**
     * Returns an instance of the plugin class.
     * @since  1.0.6
     * @return object
    */
    function cleaninglight_themes_module_manager() {

        return new cleaninglight_themes_Modules_Manager();
    }

}
cleaninglight_themes_module_manager();
