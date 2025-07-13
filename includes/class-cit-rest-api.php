<?php
namespace CIT\Common;

defined('ABSPATH') || exit;

class CIT_REST_API {

    public function __construct() {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() {
        register_rest_route('cit/v1', '/projects', [
            'methods'  => 'GET',
            'callback' => [$this, 'get_projects'],
            'permission_callback' => '__return_true',
        ]);

        register_rest_route('cit/v1', '/impact-reports', [
            'methods'  => 'GET',
            'callback' => [$this, 'get_impact_reports'],
            'permission_callback' => '__return_true',
        ]);
    }

    public function get_projects() {
        $query = new \WP_Query([
            'post_type' => 'cit_project',
            'posts_per_page' => -1,
        ]);

        $projects = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $projects[] = [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'link' => get_permalink(),
                ];
            }
            wp_reset_postdata();
        }

        return $projects;
    }

    public function get_impact_reports() {
        $query = new \WP_Query([
            'post_type' => 'impact_report',
            'posts_per_page' => -1,
        ]);

        $reports = [];
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $reports[] = [
                    'id' => get_the_ID(),
                    'title' => get_the_title(),
                    'summary' => get_post_meta(get_the_ID(), '_cit_impact_summary', true),
                    'link' => get_permalink(),
                ];
            }
            wp_reset_postdata();
        }

        return $reports;
    }
}
