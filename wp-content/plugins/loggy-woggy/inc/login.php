<?php 
/**
 * User logout
 */

 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user login data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the user record from the users table
    $sql = "SELECT * FROM wpym_loggy_woggy_users WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $hashedPassword = $user['password'];

        // Verify the password against the hashed password stored in the database
        if (password_verify($password, $hashedPassword)) {
            // If the login is successful, set a session or token to authenticate the user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // Redirect the user to the dashboard
            header('Location: dashboard.php');
            exit();
        }
    }

    // Close the database connection
    mysqli_close($conn);

    // If login is not successful, redirect the user back to the login page with an error message
    header('Location: login.php?error=1');
    exit();
}

?>