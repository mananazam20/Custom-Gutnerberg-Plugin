<?php
add_action('admin_menu', function () {
    add_menu_page('SAM Newsletter', 'Newsletter', 'manage_options', 'sam-newsletter', 'sam_render_admin_page', 'dashicons-email');
});

function sam_render_admin_page() {
    global $wpdb;
    $table = $wpdb->prefix . 'sam_newsletter';
    $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
    $query = "SELECT * FROM $table";

    if ($search) {
        $query .= $wpdb->prepare(" WHERE name LIKE %s OR email LIKE %s", '%' . $search . '%', '%' . $search . '%');
    }

    $query .= " ORDER BY created_at DESC";
    $results = $wpdb->get_results($query);

    echo '<div class="wrap"><h1>SAM Newsletter Submissions</h1>';
    echo '<form method="get"><input type="hidden" name="page" value="sam-newsletter" />';
    echo '<input type="search" name="s" value="' . esc_attr($search) . '" placeholder="Search..." />';
    echo '<input type="submit" class="button" value="Search" /></form>';
    echo '<table class="wp-list-table widefat"><thead><tr><th>Name</th><th>Email</th><th>Date</th></tr></thead><tbody>';
    foreach ($results as $row) {
        echo '<tr><td>' . esc_html($row->name) . '</td><td>' . esc_html($row->email) . '</td><td>' . esc_html($row->created_at) . '</td></tr>';
    }
    echo '</tbody></table></div>';

 
}
