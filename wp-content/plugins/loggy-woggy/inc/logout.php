<?php 
/**
 * Leave the app
 */


// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page
header("Location: ../src/register.html");
exit();
?>