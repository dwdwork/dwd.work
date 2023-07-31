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
<div id="entry" class="entry">
    <div class="col-8 logo">
        <img src="./assets/images/logo-gamblingame.png" />
    </div>
    <div class="col-12">
        <h1>Password required for entry</h1>
    </div>
    <div class="col-12 entry-form">
        <form method="POST" action="inc/validate-entry.php" class="form-inputs row">
            <div class="col-12 col-sm-8 pw">
                <input type="text" name="entrypw" id="entrypw" placeholder="Enter Password">
            </div>
            <div class="col-12 col-sm-4 submit">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
</div>