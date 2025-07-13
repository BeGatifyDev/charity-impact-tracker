<?php
namespace CIT\Common;

defined('ABSPATH') || exit;

class CIT_Settings {

    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_settings_page() {
        add_options_page(
            __('Charity Impact Tracker Settings', 'charity-impact-tracker'),
            __('Charity Impact Tracker', 'charity-impact-tracker'),
            'manage_options',
            'charity-impact-tracker-settings',
            [$this, 'render_settings_page']
        );
    }

    public function register_settings() {
        register_setting('cit_settings_group', 'cit_settings_options');

        add_settings_section(
            'cit_settings_section',
            __('General Settings', 'charity-impact-tracker'),
            null,
            'charity-impact-tracker-settings'
        );

        add_settings_field(
            'default_currency',
            __('Default Currency', 'charity-impact-tracker'),
            [$this, 'currency_field_callback'],
            'charity-impact-tracker-settings',
            'cit_settings_section'
        );
    }

    public function currency_field_callback() {
        $options = get_option('cit_settings_options');
        $currency = isset($options['default_currency']) ? esc_attr($options['default_currency']) : '';
        ?>
        <input type="text" name="cit_settings_options[default_currency]" value="<?php echo $currency; ?>" placeholder="e.g. USD" />
        <p class="description"><?php esc_html_e('Set the default currency symbol for donations and impact reports.', 'charity-impact-tracker'); ?></p>
        <?php
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('Charity Impact Tracker Settings', 'charity-impact-tracker'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('cit_settings_group');
                do_settings_sections('charity-impact-tracker-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
