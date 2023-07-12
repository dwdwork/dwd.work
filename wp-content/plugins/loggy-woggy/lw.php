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

if ( ! class_exists( 'LW' ) ) {

    class LW {
        private static $instance;

        private function __construct() {
            // Initialize your plugin here
        }

        public static function get_instance() {
            if (null === self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function init() {
            // Plugin initialization code
        }

        public static function activate() {
            // Perform activation tasks here
        }

        public static function deactivate() {
            // Perform deactivation tasks here
        }      
    }

    // Activate the plugin
    register_activation_hook(__FILE__, array('MyPlugin', 'activate'));

    // Deactivate the plugin
    register_deactivation_hook(__FILE__, array('MyPlugin', 'deactivate'));

    // Instantiate the plugin
    $my_plugin = MyPlugin::get_instance();
    $my_plugin->init();
}

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
