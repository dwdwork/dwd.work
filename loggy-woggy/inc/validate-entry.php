<?php 
/**
 * Make sure password is correct
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Set variable to receive form input
    $entrypw = $_POST['entrypw'];

    // Set the values you want to store in the cookie
    $cookieName = 'entrypw';
    $cookieValue = $entrypw;
    $cookieExpiration = time() + (86400 * 30);

    if($entrypw == 'R@mPaN_Can-2o@3' || $_COOKIE['entrypw'] == 'R@mPaN_Can-2o@3') {
        // Store the values in the cookie
        setcookie($cookieName, $cookieValue, $cookieExpiration, '/');
        header('Location: ./register.php');
    } else {
        header('Location: ../');
    }
}
?>