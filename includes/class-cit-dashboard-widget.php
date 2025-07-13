<?php
namespace CIT\Common;

defined('ABSPATH') || exit;

class CIT_Dashboard_Widget {

    public function __construct() {
        add_action('wp_dashboard_setup', [$this, 'register_dashboard_widget']);
    }

    public function register_dashboard_widget() {
        wp_add_dashboard_widget(
            'cit_dashboard_widget',
            __('Charity Impact Summary', 'charity-impact-tracker'),
            [$this, 'render_dashboard_widget']
        );
    }

    public function render_dashboard_widget() {
        $project_count = wp_count_posts('cit_project')->publish;
        $impact_count = wp_count_posts('impact_report')->publish;

        echo '<div style="padding:10px;">';
        echo '<h3>' . esc_html__('Charity Impact Tracker Overview', 'charity-impact-tracker') . '</h3>';
        echo '<p><strong>' . esc_html__('Total Projects:', 'charity-impact-tracker') . '</strong> ' . intval($project_count) . '</p>';
        echo '<p><strong>' . esc_html__('Total Impact Reports:', 'charity-impact-tracker') . '</strong> ' . intval($impact_count) . '</p>';
        echo '<p>' . esc_html__('View and manage your charity projects and impact reports under the respective menu items.', 'charity-impact-tracker') . '</p>';
        echo '</div>';
    }
}
