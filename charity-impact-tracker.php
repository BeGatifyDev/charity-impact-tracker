<?php
/**
 * Plugin Name: Charity Impact Tracker
 * Plugin URI: https://begatifydev.github.io/html-resume/
 * Description: Advanced plugin to manage charity projects and impact reports with CPTs, shortcodes, REST API, and Gutenberg block support.
 * Version: 1.0.1
 * Author: OLUWAFEMI OLUWATOBI BEST
 * Author URI: https://begatifydev.github.io/html-resume/
 * Text Domain: charity-impact-tracker
 * Domain Path: /languages
 */
if (!defined('ABSPATH')) exit;

// Define constants
define('CIT_PATH', plugin_dir_path(__FILE__));
define('CIT_URL', plugin_dir_url(__FILE__));

// Load Init Class
require_once CIT_PATH . 'includes/class-cit-init.php';

// Initialize plugin
new CIT\Common\CIT_Init();
