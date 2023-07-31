<?php 
/**
 * Holds user's profile info
 */

// Get config 
require_once('../config.php');

// Get user data
$user_data = getUserData();
?>
<link href="./assets/css/stats.css" rel="stylesheet" type="text/css">
<div id="stats-contents" class="app-part col-12">
    <h1><?php echo $user_data['username']; ?> Stats</h1>
    <div id="stats-container">
        <div class="row col team"></div>
    </div>
</div>