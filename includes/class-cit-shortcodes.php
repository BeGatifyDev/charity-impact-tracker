<?php
namespace CIT\Common;

defined('ABSPATH') || exit;

class CIT_Shortcodes {

    public function __construct() {
        add_shortcode('cit_projects', [$this, 'render_projects']);
        add_shortcode('cit_impact_reports', [$this, 'render_impact_reports']);
    }

    public function render_projects() {
        $query = new \WP_Query(['post_type' => 'cit_project']);
        ob_start();
        if ($query->have_posts()) {
            echo '<ul class="cit-projects-list">';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No projects found.</p>';
        }
        wp_reset_postdata();
        return ob_get_clean();
    }

    public function render_impact_reports() {
        $query = new \WP_Query(['post_type' => 'impact_report']);
        ob_start();
        if ($query->have_posts()) {
            echo '<ul class="cit-impact-reports-list">';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No impact reports found.</p>';
        }
        wp_reset_postdata();
        return ob_get_clean();
    }
}
