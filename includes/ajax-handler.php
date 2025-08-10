<?php
add_action('rest_api_init', function () {
    register_rest_route('sam/v1', '/subscribe', [
        'methods' => 'POST',
        'callback' => 'sam_handle_subscription',
        'permission_callback' => '__return_true',
    ]);
});

function sam_handle_subscription($request) {
    global $wpdb;

    $name = sanitize_text_field($request['name']);
    $email = sanitize_email($request['email']);

    if (empty($name) || empty($email) || !is_email($email)) {
        return new WP_Error('invalid_input', 'Invalid input.', ['status' => 400]);
    }

    $table = $wpdb->prefix . 'sam_newsletter';
    $inserted = $wpdb->insert($table, ['name' => $name, 'email' => $email]);

    if (!$inserted) {
        return new WP_Error('db_error', 'Email may already exist.', ['status' => 500]);
    }

    return ['message' => 'Thank you for subscribing!'];
}
