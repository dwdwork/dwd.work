<?php
/**
 * User login
 */
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials against database records
    // Perform database query and verification here

    if ($username === 'valid_username' && $password === 'valid_password') {
        // Set session variables
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error_message = 'Invalid username or password';
    }
}

function custom_profile_plugin_register_endpoints() {
    add_rewrite_endpoint('dwd-user-dash-login', EP_ROOT);
    // Replace 'custom-login-endpoint' with your desired endpoint name

    // Flush rewrite rules to ensure the new endpoint is recognized
    flush_rewrite_rules();
}
add_action('init', 'custom_profile_plugin_register_endpoints');

function custom_profile_plugin_render_registration_form() {
    // Render your registration form HTML here
    // You can use HTML, PHP, and WordPress functions to build the form ?>
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

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <!-- Add your CSS styling here -->
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>