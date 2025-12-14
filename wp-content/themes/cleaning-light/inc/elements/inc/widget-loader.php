<?php

namespace CleaningLightElements;

if (!defined('ABSPATH'))
    exit();

class cleaninglight_themes_Widget_Loader {

    private static $instance = null;
    public static $dir;
    public static $uri;

    public static function get_instance() {

        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function __construct() {

        self::$dir = get_template_directory() . '/inc/elements/';
        self::$uri = get_template_directory_uri() . '/inc/elements/';

        spl_autoload_register([$this, 'autoload']);

        $this->cleaninglight_themes_includes();

        // Elementor hooks
        $this->cleaninglight_themes_add_actions();
    }

    public function autoload($class) {

        if (0 !== strpos($class, __NAMESPACE__)) {
            return;
        }

        $has_class_alias = isset($this->classes_aliases[$class]);

        // Backward Compatibility: Save old class name for set an alias after the new class is loaded
        if ($has_class_alias) {

            $class_alias_name = $this->classes_aliases[$class];
            $class_to_load = $class_alias_name;

        } else {

            $class_to_load = $class;
        }

        if (!class_exists($class_to_load)) {

            $filename = strtolower(
                    preg_replace(
                        ['/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/'], ['', '$1-$2', '-', DIRECTORY_SEPARATOR], $class_to_load
                    )
            );

            $filename = self::$dir . $filename . '.php';

            if (is_readable($filename)) {
                include( $filename );
            }
        }

        if ($has_class_alias) {
            class_alias($class_alias_name, $class);
        }
    }

    private function cleaninglight_themes_includes() {

        require self::$dir . 'inc/module-manager.php';
    }

    public function cleaninglight_themes_add_actions() {

        add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

        //FrontEnd Scripts / Style
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles']);
    }

    function add_elementor_widget_categories( $elements_manager ) {
        
        $categories = [
            'layout' => [
                'title' => esc_html__('Layout', 'cleaning-light'),
            ], 
            'CleaningLight-elements' => [
                'title' => esc_html__('Cleaning Light Theme Element', 'cleaning-light'),
            ],
        ];
    
        $old_categories = $elements_manager->get_categories();
        $categories = array_merge($categories, $old_categories);
    
        $set_categories = function ( $categories ) {
            $this->categories = $categories;
        };
        $set_categories->call( $elements_manager, $categories );
    }

    /**
     * Enqueue Frontend Scripts
     */
    public function enqueue_frontend_scripts() {
        
        $is_rtl = (is_rtl()) ? 'true' : 'false';

        wp_enqueue_script('flipster', self::$uri . 'assets/js/jquery.flipster.min.js', array('jquery'), CLEANINGLIGHT_VERSION, true);

        wp_enqueue_script('cleaninglight-frontend', self::$uri . 'assets/js/frontend.js', array('jquery', 'elementor-frontend'), CLEANINGLIGHT_VERSION, true);
        
        wp_localize_script('cleaninglight-frontend', 'cleaninglight_themes_ele_options', array(
            'rtl' => $is_rtl
        ));
    }

    /**
     * Enqueue Frontend Styles
     */
    public function enqueue_frontend_styles() {

        wp_enqueue_style('flipster', self::$uri . 'assets/css/jquery.flipster.css', CLEANINGLIGHT_VERSION);

        wp_enqueue_style('cleaninglight-frontend', self::$uri . 'assets/css/frontend.css', CLEANINGLIGHT_VERSION);
    }

    /**
     * Check if theme has elementor Pro installed
     *
     * @return boolean
     */
    public function is_elementor_pro_installed() {

        return function_exists('elementor_pro_load_plugin') ? 'yes' : 'no';
    }

}

if (!function_exists('cleaninglight_themes_widget_loader')) {

    /**
     * Returns an instance of the plugin class.
     * @since  1.0.6
     * @return object
     */
    function cleaninglight_themes_widget_loader() {

        return cleaninglight_themes_Widget_Loader::get_instance();
    }

}
cleaninglight_themes_widget_loader();
