<?php 
/**
 * Leave the app
 */

// Clear all session variables
$_SESSION = array();

// Destroy the session
// session_unset();
session_destroy();

// Remove session from the server
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Redirect the user to the login page
header("Location: ../");

// Exit script
exit();

?>