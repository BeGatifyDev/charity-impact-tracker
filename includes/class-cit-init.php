<?php
namespace CIT\Common;

defined('ABSPATH') || exit;

/**
 * Class CIT_Init
 * Initializes all components of the Charity Impact Tracker plugin.
 */
class CIT_Init {

    public function __construct() {
        // Register activation and deactivation hooks
        register_activation_hook(CIT_PATH . 'charity-impact-tracker.php', [$this, 'activate']);
        register_deactivation_hook(CIT_PATH . 'charity-impact-tracker.php', [$this, 'deactivate']);

        // Load plugin text domain for translations
        add_action('plugins_loaded', [$this, 'load_textdomain']);

        // Enqueue admin and frontend assets
        add_action('admin_enqueue_scripts', [$this, 'admin_assets']);
        add_action('wp_enqueue_scripts', [$this, 'frontend_assets']);

        // Load all plugin includes
        $this->includes();
    }

    /**
     * Runs on plugin activation.
     */
    public function activate() {
        flush_rewrite_rules();
    }

    /**
     * Runs on plugin deactivation.
     */
    public function deactivate() {
        flush_rewrite_rules();
    }

    /**
     * Load plugin translations.
     */
    public function load_textdomain() {
        load_plugin_textdomain('charity-impact-tracker', false, dirname(plugin_basename(CIT_PATH . 'charity-impact-tracker.php')) . '/languages');
    }

    /**
     * Enqueue admin assets.
     */
    public function admin_assets() {
        wp_enqueue_style('cit-admin-css', CIT_URL . 'assets/css/admin.css');
        wp_enqueue_script('cit-admin-js', CIT_URL . 'assets/js/admin.js', ['jquery'], null, true);
    }

    /**
     * Enqueue frontend assets.
     */
    public function frontend_assets() {
        wp_enqueue_style('cit-frontend-css', CIT_URL . 'assets/css/frontend.css');
        wp_enqueue_script('cit-frontend-js', CIT_URL . 'assets/js/frontend.js', ['jquery'], null, true);
    }

    /**
     * Load all plugin classes and instantiate them.
     */
    private function includes() {
        require_once CIT_PATH . 'includes/class-cit-post-types.php';
        require_once CIT_PATH . 'includes/class-cit-taxonomies.php';
        require_once CIT_PATH . 'includes/class-cit-meta-boxes.php';
        require_once CIT_PATH . 'includes/class-cit-shortcodes.php';
        require_once CIT_PATH . 'includes/class-cit-rest-api.php';
        require_once CIT_PATH . 'includes/class-cit-dashboard-widget.php';
        require_once CIT_PATH . 'includes/class-cit-settings.php';
        require_once CIT_PATH . 'includes/class-cit-gutenberg-block.php';

        // Instantiate each class with proper namespacing
        new \CIT\Common\CIT_Post_Types();
        new \CIT\Common\CIT_Taxonomies();
        new \CIT\Common\CIT_Meta_Boxes();
        new \CIT\Common\CIT_Shortcodes();
        new \CIT\Common\CIT_REST_API();
        new \CIT\Common\CIT_Dashboard_Widget();
        new \CIT\Common\CIT_Settings();
        new \CIT\Common\CIT_Gutenberg_Block();
    }
}
