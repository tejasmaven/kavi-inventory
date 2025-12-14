<?php
if (!class_exists('cleaninglight_Welcome')) :
    class cleaninglight_Welcome {

        public $tab_sections = array();
        public $theme_name = ''; // For storing Theme Name
        public $theme_version = ''; // For Storing Theme Current Version Information
        public $free_plugins = array(); // For Storing the list of the Recommended Free Plugins
        
        /**
		 * @var array
		 *
		 * @since 1.0.6
		 */
		private $package = array(
			'slug'   => 'ikreate-demo-importer',
			'name'   => 'Ikreate Demo Importer',
			'source' => 'https://ikreatethemes.com/ikreate-demo-importer.zip'
		);

		/**
		 * @var Cleaninglight_Demo_Importer
		 *
		 * @since 1.0.6
		 */
		private $plugin = null;

		/**
		 * Redirect.
		 *
		 * @param $url
		 *
		 * @since 1.0.6
		 *
		 */
		private static function cleaninglight_redirect( $url ) {

			if ( headers_sent() ) {
				echo "<meta http-equiv='refresh' content='0;URL=$url' />";
			} else {
				wp_redirect( $url );
			}
			exit();
		}


        /**
         * Constructor for the Welcome Screen
        */
        public function __construct() {

            /** Useful Variables */
            $theme = wp_get_theme();
            $this->theme_name = $theme->Name;
            $this->theme_version = $theme->Version;

            /** Define Tabs Sections */
            $this->tab_sections = array(
                'getting_started' => 'Getting Started',
                'recommended_plugins' => 'Recommended Plugins',
                'support' => 'Support',
                'free_vs_pro' => 'Free Vs Pro'
            );

            /** List of Recommended Free Plugins **/
            $this->free_plugins = array(
                'elementor' => array(
                    'name' => 'Elementor Page Builder',
                    'slug' => 'elementor',
                    'filename' => 'elementor',
                    'thumb_path' => 'https://ps.w.org/elementor/assets/icon-256x256.gif'
                ),
                'contact-form-7' => array(
                    'name' => 'Contact Form 7',
                    'slug' => 'contact-form-7',
                    'filename' => 'contact-form-7',
                    'thumb_path' => 'https://ps.w.org/contact-form-7/assets/icon.svg'
                ),
                'menu-icons' => array(
                    'name' => 'Menu Icons',
                    'slug' => 'menu-icons',
                    'filename' => 'menu-icons',
                    'thumb_path' => 'https://ps.w.org/menu-icons/assets/icon-128x128.png'
                ),
                'loco-translate' => array(
                    'name' => 'Loco Translate',
                    'slug' => 'loco-translate',
                    'filename' => 'loco-translate',
                    'thumb_path' => 'https://ps.w.org/loco-translate/assets/icon-256x256.png'
                ),
                'hash-form' => array(
                    'name' => 'Hash Form(Drag & Drop)',
                    'slug' => 'hash-form',
                    'filename' => 'hash-form',
                    'thumb_path' => 'https://ps.w.org/hash-form/assets/icon-256x256.gif'
                ),
                'cookie-law-info' => array(
                    'name' => 'CookieYes(GDPR/CCPA)',
                    'slug' => 'cookie-law-info',
                    'filename' => 'cookie-law-info',
                    'thumb_path' => 'https://plugins.svn.wordpress.org/cookie-law-info/assets/icon-256x256.png'
                )
            );
            
            /* Create a Welcome Page */
            add_action('admin_menu', array($this, 'welcome_register_menu'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'welcome_styles_and_scripts'));

            /* Adds Footer Rating Text */
            add_filter('admin_footer_text', array($this, 'admin_footer_text'));

            /* Hide Notice */
            add_filter('wp_loaded', array($this, 'hide_admin_notice'), 10);

            /* Create a Welcome Page */
            add_action('wp_loaded', array($this, 'admin_notice'), 20);

            add_action('after_switch_theme', array($this, 'erase_hide_notice'));

            add_action('wp_ajax_cleaninglight_activate_plugin', array($this, 'activate_plugin'));

			add_action( 'wp_ajax_thim_core_installer', array( $this, 'cleaninglight_ajax_install' ) );
			
			add_action( 'cleaninglight_installer_step_start', array( $this, 'cleaninglight_prepare_installation' ) );
			add_action( 'cleaninglight_installer_step_install', array( $this, 'cleaninglight_step_install' ) );
			add_action( 'cleaninglight_installer_step_activate', array( $this, 'cleaninglight_step_activate' ) );
        }

        /** Trigger Welcome Message Notification */
        public function admin_notice($hook) {
            $hide_notice = get_option('cleaninglight_hide_notice');
            if (!$hide_notice) {
                add_action('admin_notices', array($this, 'admin_notice_content'));
            }
        }

        /** Welcome Message Notification */
        public function admin_notice_content() {
                $screen = get_current_screen();
                if ('appearance_page_cleaninglight-welcome' === $screen->id || (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) || 'theme-install' === $screen->id) {
                    return;
                }
                $slug = $filename = 'elementor';
            ?>
                <div class="updated notice cleaninglight-welcome-notice">
                    <div class="cleaninglight-welcome-notice-wrap">
                        <h2><?php esc_html_e('Congratulations!', 'cleaning-light'); ?></h2>
                        <p><?php printf(esc_html__('%1$s is now installed and ready to use. You can start either by importing the ready-made demo or get started by customizing it your self.', 'cleaning-light'), $this->theme_name); ?></p>
                        <div class="cleaninglight-welcome-info">
                            <div class="cleaninglight-welcome-thumb">
                                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.png'); ?>" alt="<?php echo esc_attr__('Cleaning Light Demo', 'cleaning-light'); ?>">
                            </div>
                            <div class="cleaninglight-welcome-import">
                                <h2><?php esc_html_e('Import Demo', 'cleaning-light'); ?></h2>
                                <p><?php esc_html_e('Click below to install and activate the Ikreate Demo Importer Plugin.', 'cleaning-light'); ?></p>
                                <p><?php echo $this->cleaninglight_setup_content(); ?></p>
                            </div>
                            <div class="cleaninglight-welcome-getting-started">
                                <h2><?php esc_html_e('Get Started', 'cleaning-light'); ?></h2>
                                <p><?php printf(esc_html__('Here you will find all the necessary features, and information about %s theme.', 'cleaning-light'), $this->theme_name); ?></p>
                                <p><a href="<?php echo esc_url(admin_url('admin.php?page=cleaninglight-welcome')); ?>" class="button button-primary"><span class="dashicons dashicons-admin-settings"></span> <?php esc_html_e('Go to Setting Page', 'cleaning-light'); ?></a></p>
                            </div>
                        </div>
                        <a href="<?php echo wp_nonce_url(add_query_arg('cleaninglight_hide_notice', 1), 'cleaninglight_hide_notice_nonce', '_cleaninglight_notice_nonce'); ?>" class="notice-close"></a>
                    </div>
                </div>
            <?php 
        }

        /** Hide Admin Notice */
        public function hide_admin_notice() {
            if (isset($_GET['cleaninglight_hide_notice']) && isset($_GET['_cleaninglight_notice_nonce']) && current_user_can('manage_options')) {
                if (!wp_verify_nonce(wp_unslash($_GET['_cleaninglight_notice_nonce']), 'cleaninglight_hide_notice_nonce')) {
                    wp_die(esc_html__('Action Failed. Something is Wrong.', 'cleaning-light'));
                }
                update_option('cleaninglight_hide_notice', true);
            }
        }

        /** Register Menu for Welcome Page */
        public function welcome_register_menu() {
            add_menu_page( esc_html__('Welcome', 'cleaning-light'), sprintf(esc_html__('%s', 'cleaning-light'),  'Cleaning Light' ), 'manage_options', 'cleaninglight-welcome', array($this, 'welcome_screen'), 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0nMjAnIGhlaWdodD0nMjAnIHZpZXdCb3g9JzAgMCA2MCA2MCcgZmlsbD0nbm9uZScgeG1sbnM9J2h0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnJyB4bWxuczp4bGluaz0naHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayc+PHBhdGggZD0nTTQ2Ljc2NDcgNy44ODAxM0wxMS40NzA2IDcuOTM0MzlDOS4wMzQwMyA3LjkzODE0IDcuMDYxODYgOS45MTYzOSA3LjA2NTYxIDEyLjM1MjlMNy4xMTk4NyA0Ny42NDdDNy4xMjM2MSA1MC4wODM2IDkuMTAxODYgNTIuMDU1NyAxMS41Mzg0IDUyLjA1Mkw0Ni44MzI1IDUxLjk5NzdDNDkuMjY5IDUxLjk5NCA1MS4yNDEyIDUwLjAxNTcgNTEuMjM3NSA0Ny41NzkyTDUxLjE4MzIgMTIuMjg1MUM1MS4xNzk1IDkuODQ4NTYgNDkuMjAxMiA3Ljg3NjM5IDQ2Ljc2NDcgNy44ODAxM1onIGZpbGw9JyM5NUY5RUYnIGZpbGwtb3BhY2l0eT0nMC4zNSc+PC9wYXRoPjxwYXRoIGQ9J001Ny4xMTA1IDM3LjM3ODJMNDMuMjA4NCA0LjkzNzQ1QzQyLjI0ODYgMi42OTc4OCAzOS42NTUxIDEuNjYwMzggMzcuNDE1NSAyLjYyMDEzTDQuOTc0NyAxNi41MjIzQzIuNzM1MTQgMTcuNDgyMSAxLjY5NzY0IDIwLjA3NTYgMi42NTczOCAyMi4zMTUyTDE2LjU1OTYgNTQuNzU2QzE3LjUxOTMgNTYuOTk1NSAyMC4xMTI5IDU4LjAzMyAyMi4zNTI0IDU3LjA3MzNMNTQuNzkzMiA0My4xNzExQzU3LjAzMjggNDIuMjExNCA1OC4wNzAzIDM5LjYxNzggNTcuMTEwNSAzNy4zNzgyWicgZmlsbD0nIzk1RjlDOSc+PC9wYXRoPjxwYXRoIHN0eWxlPSdtaXgtYmxlbmQtbW9kZTpkYXJrZW4nIGQ9J001NS4zNTQ1IDE4LjYzNjdMMjQuMTg5NyAyLjA3MDc0QzIyLjAzODIgMC45MjcxMDMgMTkuMzY3IDEuNzQ0MTIgMTguMjIzNCAzLjg5NTZMMS42NTc0MyAzNS4wNjA0QzAuNTEzNzg5IDM3LjIxMTkgMS4zMzA4MSAzOS44ODMxIDMuNDgyMjkgNDEuMDI2N0wzNC42NDcxIDU3LjU5MjdDMzYuNzk4NiA1OC43MzYzIDM5LjQ2OTggNTcuOTE5MyA0MC42MTM0IDU1Ljc2NzhMNTcuMTc5NCAyNC42MDNDNTguMzIzIDIyLjQ1MTUgNTcuNTA2IDE5Ljc4MDMgNTUuMzU0NSAxOC42MzY3WicgZmlsbD0ndXJsKCNwYWludDBfbGluZWFyXzFfMiknPjwvcGF0aD48cGF0aCBkPSdNNDAuNTg4MiAxNi43NjQ3SDE4LjUyOTRWNDMuMjM1M0g0MC41ODgyVjE2Ljc2NDdaJyBmaWxsPSd1cmwoI3BhdHRlcm4wKSc+PC9wYXRoPjxkZWZzPjxwYXR0ZXJuIGlkPSdwYXR0ZXJuMCcgcGF0dGVybkNvbnRlbnRVbml0cz0nb2JqZWN0Qm91bmRpbmdCb3gnIHdpZHRoPScxJyBoZWlnaHQ9JzEnPjx1c2UgeGxpbms6aHJlZj0nI2ltYWdlMF8xXzInIHRyYW5zZm9ybT0nbWF0cml4KDAuMDE3ODU3MSAwIDAgMC4wMTQ4ODEgMCAtMC4wMDU5NTIzOCknPjwvdXNlPjwvcGF0dGVybj48bGluZWFyR3JhZGllbnQgaWQ9J3BhaW50MF9saW5lYXJfMV8yJyB4MT0nNDMuNzA3NycgeTE9JzEzLjk2NTUnIHgyPScxOS4wNjQ3JyB5Mj0nNDkuMzA5NycgZ3JhZGllbnRVbml0cz0ndXNlclNwYWNlT25Vc2UnPjxzdG9wIG9mZnNldD0nMC4zNTM0ODMnIHN0b3AtY29sb3I9JyNCRDk1RjknPjwvc3RvcD48c3RvcCBvZmZzZXQ9JzAuNzUnIHN0b3AtY29sb3I9JyM3QkFDREEnPjwvc3RvcD48L2xpbmVhckdyYWRpZW50PjxpbWFnZSBpZD0naW1hZ2UwXzFfMicgd2lkdGg9JzU2JyBoZWlnaHQ9JzY4JyB4bGluazpocmVmPSdkYXRhOmltYWdlL3BuZztiYXNlNjQsaVZCT1J3MEtHZ29BQUFBTlNVaEVVZ0FBQURnQUFBQkVDQVlBQUFEVVp2YWtBQUFBQVhOU1IwSUFyczRjNlFBQUUzVkpSRUZVYUVQZFdnbDRYVlcxWG11ZmMrY3h1VWw2ay9SbXV2Y21hZEkyTFMxRks1U3ZQS0FNK2hTZW9BeWluNGhWUkNZSGhvZFlDNGdJV0trSVJaNGdUeEFWOUlFTUFsSUNNaGJ5b0duSTBDUnQwc3hEa3p1UFo5alBmVTVPN2ttYXRPV1o4UFZ6ZnhudVBXZWZ2ZGUvNXJYMlFmZ1hIL2h4NER1UUdGcVRiM1NkeFNPM2dTQjZLS1d4TEJYZkRBbVI1L2JITzVzM0ZtMk1MeFlkaXdxd09kWmNWR3VwdnBNUTdoSUVCQXBVd2NFK3M4RytDN0w0YkU5cThQcDZSN0IxTVVBdUdzRDNZNjExeTYzQlZ4QmhpUXBxNWxDaHFvTlNTQXlrRHA1YlpTOTVhYUZCTGdyQU44TXQvcldPNnI5eVNJS2FwUFFnR1RoMVkwMlNEQ1FOOWFZR1Q2bTJWKzVlU0pBTERyQ1Z0aHJMaGNxSFRMemhJcWFFT1Joc0swMUpOUWpxTlUxOUJWbDh6TXBiTHo2bUFiNGUydFZ3Z25OMUV5THdlcnZMUWNyeGxNSFY1cWovQVJvbmRwV2VYbmppMEVLQlhIQUpqcVhIdnAxdnpOcytsNnltYlc3cWczNXpWVzBSRHFiREYzaXRoYjgvSmdFMlVzcXZFV0wzV1huTFphcDBEajgwVzlUL1QwcXBXMTBHMXcrT1NZQi9iRzAxbmwxVC9pc2pNWDU1Tm9GemdkVjdVbTIrSUlsM1dRM1c3eDJUQUJsUmtVemtWcXZCOHArYWM1a0x4S0hnY3pFeUphVy83elE0N3p4bUFYYkc5bStvdFBsZVU3Mmo1a2ZuSjFlYm96bVpmYWw5eDlmYWFwdU9XWUJ2OWI5bFdWT3k1ZzJDNUxqNTRHbnFxcGN1QXloVDJ2L3dCM3Y4bTlldUZZNVpnSXl3MGRUQlMvSk56a2ZtQ2hPekE3NzZYUTBSVVRHeDJXTjAvMnFod09uM1dzZzFsYlZpUXV3V00yZTZhYjZGWjRlSWpKUzkyMjZ3ZjNlaENUbVNKLytuOWt1SXNRZU54UFMxM0NKektTZEFWczdjYitNZGwvOVRtODN6OEtJQ1pIc09KSWJQOXBqY054b0l2ejZYZzZyV0tWR3Bienc3ZWFQUFV2TFlZb0JiVkJXZFJURHVpYmN2ZHhIclJpdXgzaVBJMGowWk9mWENSSGJpN2JYNWF5T0xCZTdqQkFoTmsvdGNMZ04vdWdUaUg5TlN0b2NRL3FLVnp1RGJpd251WXdYWVJTZWNKSkYrUnBERkRRWmlBS1Q4eVZXT29yLy95d0JzRHg5WVkrQzR1d0h3WkVRQ0FQeEZmbnZoNy81bEFQYkVSeTdnT2Z5U0xOTXpKU3JIS0tYYkR0TG85aE9jeXlZV0UrU2llMUVXeHh1alRaNHlydWp6Q05LNUJqU2Voa0RpQXBYdjZvc04vemxoRUEvMDkvQ3BoY3hlOUF6RDVsaDNVUW5udWRESTg0SUVBcFZsSUlTQVJJRUlCSWpFbkxuMmdBeEFBSkF4QlRtMTM0Q1NialZVcnNuc09rR1o0MlNnSm9xeWdRZVN6eE4rSlFWNnV0cHdVcXJGdHlVcXRWRktCMlFLVVNRMFJZQmtLVkNKYlVvb2xRRTRXVTFuMlM0Y0N5eksyZ0Fjb3JLUXNwZmlTMlJBSGtFMkFCQktBR2hhbEtOeU9QMFhiSXUwZlNMbzBIc3pKVnFOQVFEN1RRQ0FxQzB5dFF2YmlRT2c3RDh6SmdYbzFCeU5BUVFCT1FyVUNBQVdCUEN3KzdQajRGU2lIVVhBZ3hRbzI0dmxvRFA2VVFBd0JWSzV6dlpqKy9JQVlHQy9iQThFTUNOZ0hnVmduNmNYQ0dWRFoyTkxwT1hzV2tmdHMzTmsveWtBWkp0TzBhWHNhNTlhZUM0UHpOaWN5VEZEd2N6K01HWVlFUkQxYlVQMXMwSk9kdW81OWp3RHcwQTRqbUNYS1cwdWd1cXhwcGc1L1JnVGNGaVlQQWZiNCswWEJLeUIzK2taaDRBVWdPNmpBQ3dJNnhtdkxNWkFvc3BCb3FydGpERnQxK3JtTWcrQWJnUTBxNkxSK2pDYVRDRUpBSEVFU0ZJQUJuWjJDY20rTStEc1YyTWF6L2FYUWVuN2NBQXkwMG9EQWxlZ2tjc2VDZ3NURjJGbm9uTnpwYVZ5aDE2Q0ZHZ21Mc2F1blJCQ2J4TWdUQ1dBQWs4cFVJb2dUb2xHdFVXTklQVitscXE0R1dwQ1JGRWtUT3RNUnBQZHhibk9Rb0FOQVBSNEFNeFNLaitha2pMUHhpRXp4QmhCcUNUSXdFa3lsWmtoVFlNVUFOQUlpQ0t6dXR4Z0pxaDhaelN4WjUyYzFlTTI1VDhEZ0V6TGxCRVZZNWZoaDVFUHI2bHhWUDlNWlkyNkJnVjZjQ0k3ZWFuWDdQM0xFVlRscUc2L085SGlxN0FWWDhjaitSUUFyQUtBbEVTbFI4SkMrQmRCUjdEdHFCWTV3cVRkeWQybDllYTZEeEN3VURPRmlCaTlBanZpSGRmNXJmNmZ6TlFNSEJyTmpuNTlxWG5wY3d1eCtXc2p6WlgxZVdWYkNjVk5nTFNRQ1VPbTh1TWoyWWxiNnhjSVlFdThaVW10dFhvM0F2RnE5aDNKaHE3Q1BlSGQxeTl6MXQ4K0xUdFZ6U2VIVW1OZktiZVZQck1nQU1mYWdpdGNwZHNJNGtreWxaMVQydlp5VDNMNGh1UGNDOU9lMkJQdXJGcm1yUGdBQUp5YU5rYXlvYXV4TGRyeXZhQzk5cWZUMFduS2pnZFN3NTk3YitTZFY0czl0V1E4UGtZTXhEMXRBNEpzbzRWMlFSYXBSRk55Um5iS2JpclFYTHcwSUljbkZ0YkdOT2E4TzlGVlgrUHc3cUJBMXdCUUN6TUdTdW51M3NUd0ZhdnphOS9VNXJGMlIvZGtqRlNWbEJPQkRsT0FJbUJyRFVYakpFRmlHTWp6WUNJV3h5UW1rZEZqa0N4eU5KdVNMSlpod1cvemx3WWRnVTU5STFrQjJCSHZ1TnB2OVcrYnBhSWd5SmsvcEtSTUZ3ZG9BR1JCVkltNlN1eEQ5Z01zbmdLaFFGbk0wK0toUUlGbUNlRkpiM3owVHczdXdDdU0rRGNudTVldnNIc2ZveURYSUtDSm1ia01kTjlJWXZMcnRYa1ZqZXFjNXVVcmJKVVhDSmkxYzhBejc0Z3l5Q3paWU42VGZWYjJJRXA4WlM2VnlnZ2tpNVJta0tEQUkvRVlpZW55WEVtTkVNbUdyc1MyV052bFFWdndsN2tiT1M4OXU2MCtVMTIxWHJUR21wbmZJMExzZW84eDd5NUVsQmpBbFE3dmt4VGtpaW1BekFiN2h6S1RseXh6Vkw3SzFoMU9qbjIrd094K1F1Y29aMFdvd3hsTDdsaE9IMnVqWXZpYjJCNXQvMHJBN245WTFkdmNtSytmT1Y4amFhWVhCcGpNUmk1ZllpNjRuMTEvNitEZTJwWHUwdWVCMGpJMThDT1R3TkQrMk5nWFZ1WDczMkJ6K2hQOVoza3QzdWRtK29JamV3RE44ODkxc0JNUkkxL0c5bGo3dVFGYjRFOHpiVkMvc0M1N25PNkE1VTZOWnFkZjJwUGhUT3pyaFJiUGcrejdHK01kTmF2Y3ZwMEl0RlM3THdNZDYwdU4vVWU5VXdWNElIM2d0QkpqOFdIT0IvVkoyUHpBYzZHT0JmcndoZGdhM1h0UzBGYkpDczhrQzUyVUtwRmF5eHhZK3NSeVVTMk5taUZZUkxDeTlHMTJTY0ltaFRMaHJ4VlppbjdOU0hsOWZGLzFjVzd2VzREZ1lSdXdHRTBwUkEra1JzN1dBUGFtQms0cE5SWHQxRFJKdDFFU0tJYlVjMUptZDBoa2tMbnBEQVlKVzR6bHdEekxaZ0NRMGNzU2dYQmNqSDhiS2FWY1c3aDN4YUE0T09ZeUdUSko0TkFLRXJYSUZwbEREdU1ZUnplNE1RWXhrRUNpSExneEpXY2tyOHVTbENKU2lkOVp0WCttdk5XY0tDeEdOeGNhUFVxUFV3Vll2QXVSdXFjelVJcnB2dlRFR2NzY3JBc09NSmdlUExYSVdQZzNsVm01Vm41ditzRDZTWEd5RTlOb2tLbUZadVdRYkxWWkthTkZ2eStqTVlFSjVYR1ptSG1EYkpRYUhJSHgyY3cvc3RMclpyVEdXNzNWMXVDd1JwVGVEc0ppNUJ1RnhzSUgyUFRYRG5ZdU85NjlkQmNDT0hKbmdpRDNwTWRQcjdlWEsxTHJpL2R0S3JaNlg1Z3BRWVMrV0YrMTMrWHYra2lFNlNiL1V3QS9qTzl0cUxaVzdNNFp1cGFjenBUZ094TmRkU3RkUzVzUXdLTDN1WVBwMFRPQzlzb1hwNXpNbVY3TGt1ZHozbHlGT3BRZE9xM2NYUDd5eHc1d01EMTZXb0hCOWQ4RWlWY3ovNXg2QVlTenNXOFdtdk4zS0JJY2FWcXhycUQrSFVCcTFid3dNOFhoek5pbi9iWUtKUjBjVEE5K3BzaFk5QmY5a1RhN3pnd3ZLaVN1R2d6M1BkVGdiV0RsMjBjYUgxbUNqYlNSYjhnMmZNL08yMzVNbFBpdUZVRzVNd1pLYVU5Lzl1QWxma3VKNGlIZm0yeGJ2c0pWOVM0Rm1SVy9ha0NpeUFCK3J0Slc5alM3MHAzc1hlOHpGZitXSUtuS3FXa3V2Z215K09MK1dQLzFZc2JaMWVEMUhqWFFqd1N3S2RGVVhHK3FlNG9uaG5XejZzZXAxd3NRUkZsOGNTZzVjYVhmdVpUWmpVTGhPeE90ZGF2Yy92OEZvT1ljK3hIMkp3Yk9xWE1HbnRLdU5VV2JDdXFzZFE4YmllSFRNc2lzNUZKdTZZL0R3OW5JZDRmQ1F6dU9WcHBIRGJBMTBoMEkySDNzMVpEQVhDLzBNTlg3UjgvemxjNWs1K1VOem9hOWVqMVNBVmExVEtWMDA4d1l5SXlmRzdENi9rYy90ekhVNkY1clgvc2pNMmU2VWp0MW1sMERKOFhVUGU4bjN0K3lNVzlqVkZjSXo2bTZSd1V3SkVSdXRuUFdIeDBxTlpXL2JJUXk0VXVMTEVVc0l6b2tDV3FKZFM0TFdzdmFabWRLL2NuUjg0S084aWZub214UHVIMU5qYVBxSVlKa3BYcTRwaW11S2xGS1lhdzMyWHRldGFQNjljT2RzeDRXNEo3d25yd3FhOVY5SnQ3MFJjMzQ5VGFuMnBJOE1Kb1pQNy9MMHZYZVJ0eW9OYWltYVc0TWZlQ3VOL3UrNHpJNnBvN1NjdmlqVW16YjYyUE50NTI3OU5RNWU2T05ZNDMyNC9PUGY5QkUxUDIxb1U4WFkwTDg5b1F4Y1lzUGZheFBjOGlZRjJCbitrQlZtV0hKRXp4eXgrbmZaMUg1cUFiaWZ6UnhkM1hHQjY1WW9kalhvWkpybmR4WFZ1YjAzbWhBN2tJQ3FNUkE3WG1GTjVSQ1NrcnYyQlBwM3JxaGNPM3dYQVN5RXFxaTBQL2xRbVBlTHhDUXovVjF0TzRMUWtiS1BOZVY2cjkybFhOWjUrdzE1Z1FZRnNMWDJ6amI3UnJOczEra1k0UXlPMmdkYmIxaHZXLzlJWnhqUkMzSksvMVVxV1hKblFqb1JVQVcvMXo2elRXbUFVQ2FVdGpkblI2NXFmVkEvUFh6Nit0WjQrbVEwUlpxSzY5MFZEN09FLzZUT2JweUlHVktZekVwY2JYSG1QZVEvdUZEQUNiRXhDK054SGk1dmdtbGoyOEFOQk1Ua2pkUEdNZnZDV0pRYXhOT2EwL1RaS3N2WUN1OXdzcGJ6cG5xWVRMaE9nQ0lYWkNGVjZKUzlENGJaL3VXbVpqUEJLQ3NEeHBUdTJsMFBDRW1mLzlFeXhOM2JsNjdlYzR6ZXRiYnFYYjZMclJ4MXA5b0hTUmRacVFvVVZZV2Z0TWEyWC96T3MrSy9tbXJiZXpwTWRkNGJldnlqYzZmODhpdHpuRlgxNzFrN29yRnQ4VElsM1oyanI4N3U5VysvZm5uVGFlZlhMT2l6RlI4RjQvY0trU1NBSkJacXpCTUtTU1RVdkxCb2RUUW8vV3Urc2tYK3QvS1gxTlU4eTBYNzJBdkRCa1F3UXdVTXl5TVNGUit1eVBSY2VWcTErcDUwN1BSOU9ocExvUHJmZzQ1djFaZTZmTlhTdW5lbnNUZ1pUWE9xdGVWKyszaHZ0TUR6dUlYV092OTBGZXdWQjhteWRKVDc4WGYrK3BKN3BOWVpqOWpOSStNMkNyeUxOZVplZk0xQk5GQ1ZjbXc1OElVYUh0SHZPY2JjOW5IKzZHOURYV09zdTBFY1JraXNWRFdsVlRTT1p3OG1KMjg2cG5XcDUrWVQ1ck1BUWJzZ1VjTXhQQ1orVXhwT0R0eUp1NktEbmdLT1hxT3orSjljUFpFemZhaVl1eWVuUWQyM1haKzhLenhHWGJFS3BGNFg2M1A1TG5HekJrdm5lcGNNbjR3TzRwa1plRzVsb245TjN4aXlZclJ1ZXlLWGRzYjNWdFFiQ20rMFVKTVg2QUFWa1JrWFcyT1VpcGxhUGJYWGFIQkh4MVhXRHZueTNrUE5EVVp6bThJM21Bamxtc0pvaXZueEZRRFM0alJ6ZmpZdm5lQ0p4ZFhuTDNFbkw5dGRxbENLVTJNWjBlLzNSUHZlL0xFd2hPbm0waU1NQmFRbDF1WG4rbmtuYmNTUkNXOW1ocUNST1c5MFd4MFc1R2xhSWJCendlU1hSOU9qNTNsTWJodUFZQVZpS2gyajlWei9OYmg1TWdWTCsyZGVIT2VFeWpTbGVoYVZXWmF1b01RN3ZoY1dZd1F6azUrQjE4Wi9iQ2h4dUhaVkdUMjNESHRLUUJCcEdKblY2VHR2TUhFK01BWnZqTW10WHVzZm54N290bTcwaDNZYWtUalY1bFNUMVVUckVqT0NMTDQvSEJ5K0VhLzAzK0l5ejRjUUUyYVBxdnZ2d3lFLyt4TVRRR0lpWWxiM2h0ci8va1p2dlhUdE9qbnRFWmFBOVdPb001dUVXSlM3RHA4Y2FUNWhIS2I3ZFNBcmZ6V3FSeEJpWFNUUXVqaSs3dnZmMkpML1pacHQvMzh4RHZPYXZPU1Uzem00aTBFU1lPdUtTVkxWTnFia2JPUHRrVkg3LzJFSjhoU3FQLzNHRXROWEpwbmN0d05BRE5DaXlDTHI0MGtELzZncVQrMmEzWTRhVWwyKzJyTlpYdFpTSnJ1YkV2Um0vRFpvZGFUR3ZJS1R2R2E4cll3aWpTaWg5TWpYeXl6bHYxQm8vS044VGNjOWM3NnErMEcyOVpabEV1VTBwYVI5T2hsWmJheUJYdkhyRGZadTc3WVZQd3dRYXpXYTVaTWFXWWtQWDcrcTkwZjdyeWtZZE4wVmRFVDcvRXV0WmEycXdjOXFqZUpDdUVmNHM2aC9Sc0NMc3UvbFZnOE4rc0pIMGlQWEZocExYdWNoUkNYTzF1enpMSDBEcDRZTnFsTVVQK3lReHBSbG40em1CcThPZUFJc1BQRUJSMS9ILzU3NFpyQ05UODFFc05YY2d1cjVDZmwxSDNONDgxYk5oUnZVQnhmODBUejBycTh1aFlBY0d0cFpVaVkzSXBQSCtqKzFNb0MyMmxMTFo0ZjZxdnA0ZlRJaGIyUjNwY3IzVFdibGhqemZrdFlvMGozQnFGRTVaNjRHUDl1Z2FtQWxUdmEwZGFDQXRRVzY0bjNiQ3ExbE80Z2lCWDZkRStrWXN0UWR2eGJsV2JmV3gzaERsL0E1VzlGUU5ZSVUyaE5DUEhiY09kdy96cS9rOTlVYXZGczFVVExic2FGNkFVYzhwKzA4dllyWjZlWkVraC82MCtOWGhlMEtXY0JIOHRnRXFwMVZmK0JFSDU5THJncnNrcUd4ZkExWVRtOHM4SlkvaUVBS0RXbmVnQWErZ24rYmJCMWRiVXJiMU9KdGVEMm1aNUxIa01rUlhxN1pHMkdqSnpaMGg1cWYyQmQwYnFSandXWmJwT084UTZIMSsyOXdrb3NQMFJVamdDbUJvcWluTjNKVEVqZmpRK0prOXZ3ejMyTnkwOG9xRDJyeUZ4d2g1Wi9hbW1QZnJKTTVmM2o2ZEExejdZUC9IV3gzb2c0V29iMXBrWk9LVGJrM1VFSVdhdFB2RlhWekRuS21CaTlGNS9wZnkyNDJ1UC90TmU4NUdkenAya3NnYzArMGgzWmQxT0RwMkhnYUlsWTdIbTdvcnM4eTYwcnRocUpZYW93VUExTVgyMUh4T2gyM0RuMGZubWwyL1B2UG5QSmRxMXkxcW8yU3VWNEtCditadHRJOHNtTmxaWHB4U2I2bzY3ZlJidE10b3hyWTRIQnZRMFJhbFVOSk5Nd28wTHNMbnhwL0kyU1dxdi9zOFdXZ3Z2MHVhaEVwWmJPU05mRjdjT2tZNzRhN2FNU3RGanpXUmJqZC9qdjVZRGJsSE9JQ0JFaGRBZitlZUJsejlxOHV2T0tMWVhLU1JDcnNoTkM0anN0b1piZmJpamV3Rm9KaXhvQ0ZnbzBTeUhEWXZncU8yZG4rYXdTS2lKQzZNZjR6RkJUd1VySDBndEtiUVhiSlNwMURxZUhyeDZhSEhwMXJrcDlvWWhaekhYNjQwTm5GSnJ6N3VXSndSOFJJOWNpYXkvNDhvTVhPdzNtVXdjVC9kK3Z5NnZyTzF5WGFqR0pXNkMxc1MzV1hWOWhLYmt0S1NlZlZHTG1TK01kSlM1VEpIT0M4NFJGZmZOdmdRQWNjUm5XZllmZUNwNDV4djhENUVET0JCQVhIc3dBQUFBQVNVVk9SSzVDWUlJPSc+PC9pbWFnZT48L2RlZnM+PC9zdmc+', 2);
        }

        /** Welcome Page */
        public function welcome_screen() {
            $tabs = $this->tab_sections; ?>
            <div class="welcome-wrap">
                <div class="welcome-main-content">
                    <?php require_once get_template_directory() . '/inc/welcome/sections/header.php'; ?>
                    <div class="welcome-section-wrapper">
                        <?php $section = isset($_GET['section']) && array_key_exists($_GET['section'], $tabs) ? $_GET['section'] : 'getting_started'; ?>

                        <div class="welcome-section <?php echo esc_attr($section); ?> clearfix">
                            <?php require_once get_template_directory() . '/inc/welcome/sections/' . $section . '.php'; ?>
                        </div>
                    </div>
                </div>

                <div class="welcome-footer-content">
                    <?php require_once get_template_directory() . '/inc/welcome/sections/footer.php'; ?>
                </div>
            </div>
            <?php
        }

        /** Enqueue Necessary Styles and Scripts for the Welcome Page */
        public function welcome_styles_and_scripts($hook) {
            if ('theme-install.php' !== $hook) {
                $importer_params = array(
                    'installing_text' => esc_html__('Installing Demo Importer Plugin', 'cleaning-light'),
                    'activating_text' => esc_html__('Activating Demo Importer Plugin', 'cleaning-light'),
                    'importer_page' => esc_html__('Go to Demo Importer Page', 'cleaning-light'),
                    'importer_url' => admin_url('themes.php?page=elementor'),
                    'error' => esc_html__('Error! Reload the page and try again.', 'cleaning-light'),
                );
                wp_enqueue_style('cleaninglight-welcome', get_template_directory_uri() . '/inc/welcome/css/welcome.css', array());
                wp_enqueue_script('cleaninglight-welcome', get_template_directory_uri() . '/inc/welcome/js/welcome.js', array('plugin-install', 'updates'), '', true);
                wp_localize_script('cleaninglight-welcome', 'importer_params', $importer_params);
            }
        }

        /* Check if plugin is installed */
        public function check_plugin_installed_state($slug, $filename) {
            return file_exists(ABSPATH . 'wp-content/plugins/' . $slug . '/' . $filename . '.php') ? true : false;
        }

        /* Check if plugin is activated */
        public function check_plugin_active_state($slug, $filename) {
            return is_plugin_active($slug . '/' . $filename . '.php') ? true : false;
        }

        /** Generate Url for the Plugin Button */
        public function plugin_generate_url($status, $slug, $file_name) {
            switch ($status) {
                case 'install':
                    return wp_nonce_url(add_query_arg(array(
                        'action' => 'install-plugin',
                        'plugin' => esc_attr($slug)
                                    ), network_admin_url('update.php')), 'install-plugin_' . esc_attr($slug));
                    break;

                case 'inactive':
                    return add_query_arg(array(
                        'action' => 'deactivate',
                        'plugin' => rawurlencode(esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                        'plugin_status' => 'all',
                        'paged' => '1',
                        '_wpnonce' => wp_create_nonce('deactivate-plugin_' . esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                            ), network_admin_url('plugins.php'));
                    break;

                case 'active':
                    return add_query_arg(array(
                        'action' => 'activate',
                        'plugin' => rawurlencode(esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                        'plugin_status' => 'all',
                        'paged' => '1',
                        '_wpnonce' => wp_create_nonce('activate-plugin_' . esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                            ), network_admin_url('plugins.php'));
                    break;
            }
        }

        /** Ajax Plugin Activation */
        public function activate_plugin() {
            $slug = isset($_POST['slug']) ? $_POST['slug'] : '';
            $file = isset($_POST['file']) ? $_POST['file'] : '';
            $success = false;
            if (!empty($slug) && !empty($file)) {
                //patterns-plugin-activate
                //activate_plugin('patterns-kit/plugins.php');
                $result = activate_plugin($slug . '/' . $file . '.php');
                update_option('cleaninglight_hide_notice', true);
                if (!is_wp_error($result)) {
                    $success = true;
                }
            }
            echo wp_json_encode(array('success' => $success));
            die();
        }

        /** Adds Footer Notes */
        public function admin_footer_text($text) {
            $screen = get_current_screen();
            if ('toplevel_page_cleaninglight-welcome' == $screen->id) {
                $text = sprintf(esc_html__('Please leave us a %s rating if you like our theme . A huge thank you from ikreate themes in advance!', 'cleaning-light'), '<a href="https://wordpress.org/support/theme/cleaning-light/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a>');
            }
            return $text;
        }

        public function erase_hide_notice() {
            delete_option('cleaninglight_hide_notice');
        }

		private function cleaninglight_get_thim_core() {
			if ( $this->plugin === null ) {
				$plugin = new cleaninglight_Plugin();
				$plugin->set_args( $this->package );
				$this->plugin = $plugin;
			}
			return $this->plugin;
		}

		private function cleaninglight_get_link_step( $step = '' ) {
			return add_query_arg( array( 'step' => $step ) );
		}

		public function cleaninglight_ajax_install() {
            
			$plugin = $this->cleaninglight_get_thim_core();

			$result = $plugin->install();

			if ( ! $result ) {
				wp_send_json_error( $plugin->get_messages() );
			}

			wp_send_json_success( $plugin->get_messages() );
		}

		private function cleaninglight_setup_content() {
			
			$thim_core   = $this->cleaninglight_get_thim_core();
			$status      = $thim_core->get_status();
			$step        = isset( $_REQUEST['step'] ) ? $_REQUEST['step'] : 'start';

			do_action( "cleaninglight_installer_step_$step" );
		}

		/**
		 * Prepare installation Thim Core.
		 *
		 * @since 1.0.6
		 */
		public function cleaninglight_prepare_installation() {

			$thim_core = $this->cleaninglight_get_thim_core();

			$status    = $thim_core->get_status();

			$step = ( $status == 'inactive' ) ? 'activate' : 'install';

			$link = $this->cleaninglight_get_link_step( $step );
			
			if ( $status == 'inactive' ) {
				$import_class = 'button button-primary';
				$import_button_text = esc_html__('Activate Demo Importer Plugin', 'cleaning-light');
			} elseif ( $status == 'active' ) {
				$import_class = 'button button-primary';
				$import_button_text = esc_html__('Go to Demo Importer Page', 'cleaning-light');
				$link =  admin_url( '/themes.php?page=ikreate-demo-importer' );
			} else {
				$import_class = 'thim-button-link button button-primary';
				$import_button_text = esc_html__('Install Demo Importer Plugin', 'cleaning-light');	
			}

			?>
				<a class="<?php echo esc_attr( $import_class ); ?>" data-href="<?php echo esc_url( $link ) ?>" href=<?php echo esc_url( $link ) ?>>
					<?php echo esc_attr( $import_button_text ); ?>
				</a>
			<?php

		}

		/**
		 * Step install.
		 *
		 * @since 1.0.6
		 */
		public function cleaninglight_step_install() {

			$link = $this->cleaninglight_get_link_step( 'activate' );

			$plugin = $this->cleaninglight_get_thim_core();

			$status = $plugin->get_status();

			if ( $status != 'not_installed' ) {
				self::cleaninglight_redirect( $link );
			}

			$result = $plugin->install();
			$messages = $plugin->get_messages();
			$notice   = $result ? 'success' : 'error';
			
            ?>
                <a class="button button-primary" data-href="<?php echo esc_url( $link ) ?>" href=<?php echo esc_url( $link ) ?>>
					<?php esc_html_e('Activate Demo Importer Plugin', 'cleaning-light') ?>
				</a>
            <?php
			if ( $result ) {
				self::cleaninglight_redirect( $link );
			}
		}

		/**
		 * Step active.
		 *
		 * @since 1.0.6
		 */
		public function cleaninglight_step_activate() {

			$plugin = $this->cleaninglight_get_thim_core();

			if ( $plugin->activate( true ) || $plugin->is_active() ) {

				$this->cleaninglight_redirect_dashboard();

				return;
			}

		}

		/**
		 * Reload to redirect to theme dashboard.
		 *
		 * @since 1.0.6
		 */
		private function cleaninglight_redirect_dashboard() {

			$url = admin_url( 'themes.php?page=ikreate-demo-importer' );

			self::cleaninglight_redirect( $url );
		}

    }
    new cleaninglight_Welcome();
endif;
