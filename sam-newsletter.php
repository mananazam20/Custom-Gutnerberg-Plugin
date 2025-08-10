<?php
/**
 * Plugin Name: SAM Newsletter
 * Description: A Gutenberg block plugin created by Manan
 * Version: 1.0
 * Author: Manan
 */

defined('ABSPATH') || exit;


function sam_newsletter_register_block() {
    register_block_type(__DIR__);
}
add_action('init', 'sam_newsletter_register_block');


require_once plugin_dir_path(__FILE__) . 'includes/db.php';
require_once plugin_dir_path(__FILE__) . 'includes/ajax-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-page.php';

// DB table creation/removal
register_activation_hook(__FILE__, 'sam_create_table');
register_deactivation_hook(__FILE__, 'sam_delete_table');


function sam_enqueue_frontend_assets() {
    if (!is_admin()) {
        wp_enqueue_script(
            'sam-newsletter-frontend',
            plugin_dir_url(__FILE__) . 'assets/frontend.js',
            [],
            '1.0',
            true
        );
    }


    wp_localize_script('sam-newsletter-frontend', 'samData', [
        'restUrl' => esc_url_raw(rest_url('sam/v1/subscribe')),
        'nonce'   => wp_create_nonce('wp_rest'),
    ]);
}
add_action('wp_enqueue_scripts', 'sam_enqueue_frontend_assets');
