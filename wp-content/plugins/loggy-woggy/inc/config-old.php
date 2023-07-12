<?php
/**
 * Functions to set up database
 */

class CleverGirlDatabase {

    public static function clever_girl_db_setup() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'clever_girl';

        // Check if the table exists
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
            // Table exists, do something
            // echo "Table '$table_name' exists.";
            // Perform your desired actions here
        } else {
            // Table does not exist
            // echo "Table '$table_name' does not exist.";
            // Perform other actions if needed
            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE $table_name (
                id INT(11) NOT NULL AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    public static function clever_girl_db_object() {
        // Database configuration
        $host = 'localhost';
        $dbName = 'local';
        $username = 'local';
        $password = 'root';

        try {
            // Create a new PDO instance
            $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
            // SQL query to retrieve the table
            $tableName = 'clever_girl';
            $query = "SELECT * FROM $tableName";
          
            // Execute the query and fetch the results
            $statement = $pdo->query($query);
            $tableData = $statement->fetchAll(PDO::FETCH_OBJ);
          
            // Close the database connection
            $pdo = null;
          
            // Return the table data as an object
            return $tableData;
        } catch (PDOException $e) {
            // Handle any database connection errors
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}

function dwd_user_dash_create_tables() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_profiles'; // Replace 'custom_profiles' with your desired table name

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
dwd_user_dash_create_tables();

function custom_profile_plugin_insert_test_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_profiles'; // Replace 'custom_profiles' with your table name

    $data = array(
        'name' => 'John Doe',
    );

    $wpdb->insert($table_name, $data);
}