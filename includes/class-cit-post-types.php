<?php
namespace CIT\Common;

defined('ABSPATH') || exit;

class CIT_Post_Types {

    public function __construct() {
        add_action('init', [$this, 'register_post_types']);
    }

    public function register_post_types() {
        // Example for 'Project' CPT
        register_post_type('cit_project', [
            'labels' => [
                'name' => __('Projects', 'charity-impact-tracker'),
                'singular_name' => __('Project', 'charity-impact-tracker'),
            ],
            'public' => true,
            'has_archive' => true,
            'rewrite' => ['slug' => 'projects'],
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
        ]);
    }
}
