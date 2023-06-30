<?php
/**
 * Functions to set up database
 */

// function dwd_user_dash_create_tables() {
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'custom_profiles'; // Replace 'custom_profiles' with your desired table name

//     $charset_collate = $wpdb->get_charset_collate();

//     $sql = "CREATE TABLE $table_name (
//         id INT(11) NOT NULL AUTO_INCREMENT,
//         name VARCHAR(255) NOT NULL,
//         PRIMARY KEY (id)
//     ) $charset_collate;";

//     require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//     dbDelta($sql);
// }
// dwd_user_dash_create_tables();

// function custom_profile_plugin_insert_test_data() {
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'custom_profiles'; // Replace 'custom_profiles' with your table name

//     $data = array(
//         'name' => 'John Doe',
//     );

//     $wpdb->insert($table_name, $data);
// } custom_profile_plugin_insert_test_data();