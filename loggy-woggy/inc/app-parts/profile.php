<?php 
/**
 * Holds user's profile info
 */

// Get config 
require_once('../config.php');

// Get user data
$user_data = getUserData();

// Check for updated values in HTML form
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $display_name = $_POST['display_name'];
    $email = $_POST['email'];
    $fav_team = $_POST['fav_team'];
    $bio = $_POST['bio'];
} else {
    $username = $user_data['username'];
    $display_name = $user_data['display_name'];
    $email = $user_data['email'];
    $fav_team = $user_data['fav_team'];
    $bio = $user_data['bio'];
}

?>
<link href="./assets/css/profile.css" rel="stylesheet" type="text/css">
<div id="profile-contents" class="app-part col-12">
    <h1>Profile Settings</h1>
    <div class="logout-links">
        <a href="./inc/logout.php">Logout</a>
        <a onclick="revealEditingOptions();" id="edit-profile" class="btn edit-profile-btn">Edit Profile</a>
    </div>
    <div id="profile-contents-form-container">
        <form method="POST" action="./inc/update-profile.php" class="profile-settings-form form-inputs">
            <div class="row profile-settings-item">
                <div class="col-12 col-md-4 profile-settings-item-label">
                    <label for="username">Username</label>
                </div>
                <div class="col-12 col-md-8">
                    <?php echo $username; ?>
                    <div class="edit-profile-option" style="display: none;">
                        <input type="text" name="username" id="username" value="<?php echo $username; ?>">
                    </div>
                </div>
            </div>
            <div class="row profile-settings-item">
                <div class="col-12 col-md-4 profile-settings-item-label">
                    <label for="display_name">Display Name</label>
                </div>
                <div class="col-12 col-md-8">
                    <?php echo $display_name != null ? $display_name : 'Enter a custom name to display'; ?>
                    <div class="edit-profile-option" style="display: none;">
                        <input type="text" name="display_name" id="display_name" placeholder="Enter a custom name to display" value="<?php echo $display_name; ?>">
                    </div>
                </div>
            </div>
            <div class="row profile-settings-item">
                <div class="col-12 col-md-4 profile-settings-item-label">
                    <label for="email">Email</label>
                </div>
                <div class="col-12 col-md-8">
                    <?php echo $email; ?>
                    <div class="edit-profile-option" style="display: none;">
                        <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                    </div>
                </div>
            </div>
            <div class="row profile-settings-item">
                <div class="col-12 col-md-4 profile-settings-item-label">
                    <label for="title">Favorite Team</label>
                </div>
                <div class="col-12 col-md-8">
                    <?php echo $fav_team; ?>
                    <div class="edit-profile-option" style="display: none;">
                        <select id="fav_team" name="fav_team"></select>
                    </div>
                </div>
            </div>
            <div class="row profile-settings-item">
                <div class="col-12 col-md-4 profile-settings-item-label">
                    <label for="bio">Personal Bio</label>
                </div>
                <div class="col-12 col-md-8">
                    <?php echo $bio; ?>
                    <div class="edit-profile-option" style="display: none;">
                        <textarea name="bio" id="bio"><?php echo $bio; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="edit-profile-option" style="display: none; width: 100%;">
                <div class="row submit">
                    <input type="submit" value="Update Profile" class="col-12">
                </div>
            </div>
        </form>
    </div>
</div>