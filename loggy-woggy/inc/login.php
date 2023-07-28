<?php 
/**
 * User logout
 */

// Exit page if accessed directly
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("Location: ../");
    exit; 
}

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user login data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the user record from the users table
    $connect = getDBConnection();
    
    $sql = "SELECT * FROM wpym_loggy_woggy_users WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $hashedPassword = $user['password'];

        // Verify the password against the hashed password stored in the database
        if (password_verify($password, $hashedPassword)) {
            // If the login is successful, set a session or token to authenticate the user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Set the values you want to store in the cookie
            $cookieName = 'username';
            $cookieValue = $username;
            $cookieExpiration = time() + (86400 * 30);
            setcookie($cookieName, $cookieValue, $cookieExpiration, '/');
            $cookieName = 'password';
            $cookieValue = $password;
            $cookieExpiration = time() + (86400 * 30);
            setcookie($cookieName, $cookieValue, $cookieExpiration, '/');
            
            // Redirect the user to the dashboard
            header('Location: ../');
            exit();
        }
    }

    // Close the database connection
    mysqli_close($connect);

    // If login is not successful, redirect the user back to the login page with an error message
    header('Location: login.php?error=1');
    exit();
}

?>