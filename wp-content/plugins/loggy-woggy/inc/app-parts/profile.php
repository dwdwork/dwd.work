<?php 
/**
 * Holds user's profile info
 */

require_once('../config.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $display_name = $_POST['display_name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $bio = $_POST['bio'];
} else {
    $username = $user_data['username'];
    $display_name = $user_data['display_name'];
    $email = $user_data['email'];
    $title = $user_data['title'];
    $bio = $user_data['bio'];
}

?>
<link href="./assets/css/profile.css" rel="stylesheet" type="text/css">
<div id="profile-contents" class="app-part col-12">
    <h1>Profile Settings</h1>
    <div class="logout-links">
        <a class="col-6 col-md-12" href="./inc/logout.php">Logout</a>
        <a onclick="revealEditingOptions();" class="col-6 col-md-12" id="edit-profile" class="btn edit-profile-btn" >Edit Profile</a>
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
                    <label for="title">Team Name</label>
                </div>
                <div class="col-12 col-md-8">
                    <?php echo $title; ?>
                    <div class="edit-profile-option" style="display: none;">
                        <input type="text" name="title" id="title" value="<?php echo $title; ?>">
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