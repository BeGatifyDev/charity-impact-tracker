<?php
namespace CIT\Common;

defined('ABSPATH') || exit;

class CIT_Meta_Boxes {

    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_meta_boxes']);
    }

    public function add_meta_boxes() {
        // Project Details Meta Box
        add_meta_box(
            'cit_project_details',
            __('Project Details', 'charity-impact-tracker'),
            [$this, 'render_project_meta_box'],
            'cit_project',
            'normal',
            'default'
        );

        // Impact Report Details Meta Box
        add_meta_box(
            'cit_impact_details',
            __('Impact Report Details', 'charity-impact-tracker'),
            [$this, 'render_impact_meta_box'],
            'impact_report',
            'normal',
            'default'
        );
    }

    public function render_project_meta_box($post) {
        wp_nonce_field('cit_save_project_details', 'cit_project_nonce');
        $location = get_post_meta($post->ID, '_cit_project_location', true);
        ?>
        <p>
            <label for="cit_project_location"><?php _e('Project Location', 'charity-impact-tracker'); ?></label><br>
            <input type="text" name="cit_project_location" id="cit_project_location" value="<?php echo esc_attr($location); ?>" style="width:100%;">
        </p>
        <?php
    }

    public function render_impact_meta_box($post) {
        wp_nonce_field('cit_save_impact_details', 'cit_impact_nonce');
        $summary = get_post_meta($post->ID, '_cit_impact_summary', true);
        ?>
        <p>
            <label for="cit_impact_summary"><?php _e('Impact Summary', 'charity-impact-tracker'); ?></label><br>
            <textarea name="cit_impact_summary" id="cit_impact_summary" rows="5" style="width:100%;"><?php echo esc_textarea($summary); ?></textarea>
        </p>
        <?php
    }

    public function save_meta_boxes($post_id) {
        // Save Project Details
        if (isset($_POST['cit_project_nonce']) && wp_verify_nonce($_POST['cit_project_nonce'], 'cit_save_project_details')) {
            if (isset($_POST['cit_project_location'])) {
                update_post_meta($post_id, '_cit_project_location', sanitize_text_field($_POST['cit_project_location']));
            }
        }

        // Save Impact Report Details
        if (isset($_POST['cit_impact_nonce']) && wp_verify_nonce($_POST['cit_impact_nonce'], 'cit_save_impact_details')) {
            if (isset($_POST['cit_impact_summary'])) {
                update_post_meta($post_id, '_cit_impact_summary', sanitize_textarea_field($_POST['cit_impact_summary']));
            }
        }
    }
}
