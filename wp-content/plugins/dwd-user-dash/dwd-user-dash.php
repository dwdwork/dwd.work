<?php
/**
 *  Plugin Name: dwd User Dashboard
 *  Version: 1.0.0
 *  Author: danwilderdesign
 *  Description: Custom portfolio project that creates a user dashboard 
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

include plugin_dir_path(__FILE__) . 'inc/database.php';
include plugin_dir_path(__FILE__) . 'inc/database.php';
register_activation_hook(__FILE__, 'custom_profile_plugin_activate');
register_deactivation_hook(__FILE__, 'custom_profile_plugin_deactivate');

function custom_profile_plugin_activate() {
    // Perform activation tasks here if needed.
}

function custom_profile_plugin_deactivate() {
    // Perform deactivation tasks here if needed.
}