<?php

/** 
 * @package  Directorist - Custom Map Styles
 */

/**
 * Plugin Name:       Directorist - Custom Map Styles
 * Plugin URI:        https://wpxplore.com/tools/directorist-custom-map-styles
 * Description:       Custom Google Maps styling extension for Directorist plugin. Allows you to override default map styles and implement custom map configurations.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Author:            wpXplore
 * Author URI:        https://wpxplore.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       directorist-custom-map-styles
 * Domain Path:       /languages
 */

/**
 * This is an extension for Directorist plugin.
 * It provides custom Google Maps styling capabilities and allows overriding
 * the default Directorist map implementation with custom configurations.
 */

/**
 * Prevent direct access to this file
 * If this file is called directly, abort!
 */
if (!defined('ABSPATH')) {
    exit;                      // Exit if accessed
}

if (!class_exists('Directorist_Custom_Map_Styles')) {

    /**
     * Main plugin class for Directorist Custom Map Styles
     * 
     * This class handles the initialization and management of custom map styles
     * for the Directorist plugin, including script dequeuing and custom map loading.
     */
    final class Directorist_Custom_Map_Styles
    {
        /**
         * Plugin instance
         * 
         * @var Directorist_Custom_Map_Styles
         */
        private static $instance;

        /**
         * Get plugin instance
         * 
         * @return Directorist_Custom_Map_Styles Plugin instance
         */
        public static function instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof Directorist_Custom_Map_Styles)) {
                self::$instance = new Directorist_Custom_Map_Styles;
                self::$instance->init();
            }
            return self::$instance;
        }

        /**
         * Initialize the plugin
         * 
         * Sets up constants, includes required files, and registers hooks
         */
        public function init()
        {
            $this->define_constant();
            $this->includes();
            $this->enqueues();
        }

        /**
         * Define plugin constants
         * 
         * Sets up plugin directory and URL constants for use throughout the plugin
         */
        public function define_constant()
        {
            // Define plugin URL constant
            if ( !defined( 'DIRECTORIST_CUSTOM_MAP_STYLES_URI' ) ) {
                define( 'DIRECTORIST_CUSTOM_MAP_STYLES_URI', plugin_dir_url( __FILE__ ) );
            }

            // Define plugin directory constant
            if ( !defined( 'DIRECTORIST_CUSTOM_MAP_STYLES_DIR' ) ) {
                define( 'DIRECTORIST_CUSTOM_MAP_STYLES_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Define plugin version constant
            if ( !defined( 'DIRECTORIST_CUSTOM_MAP_STYLES_VERSION' ) ) {
                define( 'DIRECTORIST_CUSTOM_MAP_STYLES_VERSION', '1.0.0' );
            }
        }

        /**
         * Include required files
         * 
         * Loads plugin helper functions and customizations
         */
        public function includes()
        {
            include_once(DIRECTORIST_CUSTOM_MAP_STYLES_DIR . '/inc/functions.php');
        }

        /**
         * Register WordPress hooks
         * 
         * Sets up script inspection and enqueuing hooks
         */
        public function enqueues()
        {
            // Hook to inspect and dequeue scripts before they're printed
            add_action('wp_print_scripts', array($this,'dcms_inspect_scripts'));
            // Hook to enqueue our custom scripts
            add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
            add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        }

        /**
         * Dequeue and deregister default Directorist map scripts
         * 
         * This method removes the default Directorist Google Maps script
         * so we can replace it with our custom implementation
         */
        public function dcms_inspect_scripts()
        {
            // Only run on frontend, not in admin
            if ( !is_admin() ) {
                wp_dequeue_script('directorist-google-map');
                wp_deregister_script('directorist-google-map');
            }
        }

        /**
         * Enqueue custom Google Maps script
         * 
         * Loads our custom Google Maps implementation along with required dependencies
         * and localizes script with plugin options
         */
        public function enqueue_scripts()
        {
            // Enqueue Google Maps API
            wp_enqueue_script('google-map-api');
            // Enqueue marker clusterer for map markers
            wp_enqueue_script('directorist-markerclusterer');
            // Enqueue our custom Google Maps script
            wp_enqueue_script('directorist-custom-google-map', DIRECTORIST_CUSTOM_MAP_STYLES_URI . 'assets/google-map.js', array('jquery', 'google-map-api', 'directorist-markerclusterer'), DIRECTORIST_CUSTOM_MAP_STYLES_VERSION, true);
            // Localize script with plugin options
            wp_localize_script('directorist-custom-google-map', 'directorist_options', dcms_get_option_data());
        }

    }

    /**
     * Check if a plugin is active
     * 
     * @param string $plugin Plugin file path
     * @return bool True if plugin is active
     */
    if (!function_exists('dcms_is_plugin_active')) {
        function dcms_is_plugin_active($plugin)
        {
            return in_array($plugin, (array) get_option('active_plugins', array()), true) || dcms_is_plugin_active_for_network($plugin);
        }
    }

    /**
     * Check if a plugin is active for network (multisite)
     * 
     * @param string $plugin Plugin file path
     * @return bool True if plugin is network active
     */
    if (!function_exists('dcms_is_plugin_active_for_network')) {
        function dcms_is_plugin_active_for_network($plugin)
        {
            // Not multisite, so no network plugins
            if (!is_multisite()) {
                return false;
            }

            // Get network active plugins
            $plugins = get_site_option('active_sitewide_plugins');
            if (isset($plugins[$plugin])) {
                return true;
            }

            return false;
        }
    }

    /**
     * Get plugin instance
     * 
     * @return Directorist_Custom_Map_Styles Plugin instance
     */
    function Directorist_Custom_Map_Styles()
    {
        return Directorist_Custom_Map_Styles::instance();
    }

    // Initialize plugin only if Directorist is active
    if (dcms_is_plugin_active('directorist/directorist-base.php')) {
        Directorist_Custom_Map_Styles(); // Initialize the plugin
    }
}
