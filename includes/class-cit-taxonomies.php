<?php
namespace CIT\Common;

defined('ABSPATH') || exit;

class CIT_Taxonomies {

    public function __construct() {
        add_action('init', [$this, 'register_taxonomies']);
    }

    public function register_taxonomies() {
        // Example taxonomy for Projects
        register_taxonomy('project_category', 'cit_project', [
            'labels' => [
                'name' => __('Project Categories', 'charity-impact-tracker'),
                'singular_name' => __('Project Category', 'charity-impact-tracker'),
            ],
            'public' => true,
            'hierarchical' => true,
            'rewrite' => ['slug' => 'project-category'],
            'show_in_rest' => true,
        ]);
    }
}
