<?php
/**
 * Login functions
 */

function custom_profile_plugin_register_endpoints() {
    add_rewrite_endpoint('dwd-user-dash-login', EP_ROOT);
    // Replace 'custom-login-endpoint' with your desired endpoint name

    // Flush rewrite rules to ensure the new endpoint is recognized
    flush_rewrite_rules();
}
add_action('init', 'custom_profile_plugin_register_endpoints');

function custom_profile_plugin_render_registration_form() { ?>
    // Render your registration form HTML here
    // You can use HTML, PHP, and WordPress functions to build the form
    <form method="POST" action="">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
<?php }
add_action('template_redirect', 'custom_profile_plugin_render_registration_form');

?>