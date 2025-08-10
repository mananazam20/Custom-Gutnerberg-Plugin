<?php
function sam_create_table() {
    global $wpdb;
    $table = $wpdb->prefix . 'sam_newsletter';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

function sam_delete_table() {
    global $wpdb;
    $table = $wpdb->prefix . 'sam_newsletter';
    $wpdb->query("DROP TABLE IF EXISTS $table");
}
