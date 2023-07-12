<?php
/**
 *  Plugin Name: Loggy Woggy App
 *  Version: 1.0.0
 *  Author: danwilderdesign
 *  Description: So you two uhm, hm. Dig up, dig up dinosaurs? Hahahrawrrahaha
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// if ( ! class_exists( 'LW' ) ) {

//     class LW {
//         private static $instance;

//         private function __construct() {
//             // Initialize your plugin here
//         }

//         public static function get_instance() {
//             if (null === self::$instance) {
//                 self::$instance = new self();
//             }
//             return self::$instance;
//         }

//         public function init() {
//             // Plugin initialization code
//         }

//         public static function activate() {
//             // Perform activation tasks here
//         }

//         public static function deactivate() {
//             // Perform deactivation tasks here
//         }      
//     }

//     // Activate the plugin
//     register_activation_hook(__FILE__, array('LW', 'activate'));

//     // Deactivate the plugin
//     register_deactivation_hook(__FILE__, array('LW', 'deactivate'));

//     // Instantiate the plugin
//     $my_plugin = LW::get_instance();
//     $my_plugin->init();
// }

// require plugin_dir_path(__FILE__) . 'inc/database.php';

// function clever_girl_plugin_activation() {
//     // Generate db files if there are none.
//     CleverGirlDatabase::clever_girl_db_setup();

//     // Retrive db files as an object
//     CleverGirlDatabase::clever_girl_db_object();
// }

// function clever_girl_plugin_deactivation() {
//     // Perform deactivation tasks here if needed.
// } 

// register_activation_hook(__FILE__, 'clever_girl_plugin_activation');
// register_deactivation_hook(__FILE__, 'clever_girl_plugin_deactivation');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(plugin_dir_path(__FILE__) . 'inc/config.php');

// Plugin activation hook
register_activation_hook(__FILE__, 'your_plugin_activation');

// Plugin deactivation hook
register_deactivation_hook(__FILE__, 'your_plugin_deactivation');

// Plugin activation function
function your_plugin_activation() {
    // Perform activation tasks here
    loggy_woggy_table();
}

// Plugin deactivation function
function your_plugin_deactivation() {
    // Perform deactivation tasks here
    // e.g., remove database tables, clean up options, etc.
}

function myplugin_enqueue_styles() {
    // Enqueue the CSS file
    wp_enqueue_style('dwd-bootstrap', plugin_dir_path(__FILE__) . 'assets/css/bootstrap-grid.css');
    // wp_enqueue_style('clever-girl-style', plugins_url('assets/css/bootstrap-grid.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'myplugin_enqueue_styles');

// db_table_as_obj();

// require_once(plugin_dir_path(__FILE__) . 'inc/register.php');
// require_once(plugin_dir_path(__FILE__) . 'inc/login.php');
// require_once(plugin_dir_path(__FILE__) . 'inc/dashboard.php');
// registerUser('john123', 'password123', 'john@example.com', 'John Doe');
?>