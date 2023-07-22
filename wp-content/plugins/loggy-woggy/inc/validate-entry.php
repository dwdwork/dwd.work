<?php 
/**
 * Make sure password is correct
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $entrypw = $_POST['entrypw'];

    if($entrypw == 'R@mPaN_Can-2o@3') {
        header('Location: ./register.php');
    } else {
        header('Location: ../');
    }
}
?>