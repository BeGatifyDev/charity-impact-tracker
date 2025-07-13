<?php
namespace CIT\Common;

defined('ABSPATH') || exit;

class CIT_Gutenberg_Block {

    public function __construct() {
        add_action('init', [$this, 'register_block']);
    }

    public function register_block() {
        // Automatically load dependencies and version from the block's build if using build tools
        // For simplicity, using static registration here

        // Register block script
        wp_register_script(
            'cit-block',
            CIT_URL . 'assets/js/cit-block.js',
            ['wp-blocks', 'wp-editor', 'wp-element', 'wp-components'],
            filemtime(CIT_PATH . 'assets/js/cit-block.js')
        );

        // Register block type
        register_block_type('charity-impact-tracker/project-list', [
            'editor_script' => 'cit-block',
            'render_callback' => [$this, 'render_project_list'],
        ]);
    }

    public function render_project_list($attributes) {
        ob_start();
        $query = new \WP_Query(['post_type' => 'cit_project']);
        if ($query->have_posts()) {
            echo '<ul class="cit-project-list">';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>' . __('No projects found.', 'charity-impact-tracker') . '</p>';
        }
        wp_reset_postdata();
        return ob_get_clean();
    }
}
