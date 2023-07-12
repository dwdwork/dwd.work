<?php 
/**
 * User dashboard
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// Connect to the db
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <script src="../assets/js/scripts.js"></script>
    <!-- Add your CSS styling here -->
</head>
<body>    
    <div id="loggy-woggy">
        <div class="gray-bg container dashboard-form">
            <a href="logout.php">Logout</a>
            <div class="row">
                <div class="col col-12 col-sm-3 logo">
                    <div class="yellow-bg logo-image">
                        <div class="gray-bg image">
                            <img src="../assets/images/logo-clever_girl.svg" />
                        </div>
                    </div>
                </div>
                <div class="col col-12 col-sm-9">
                    <div class="logo-text yellow-bg">
                        <div class="logo-text-image gray-bg">
                            <div class="image">
                                <img src="../assets/images/logotype-clever_girl.svg" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
            <div id="dashboard-inputs" class="col col-12 dashboard-inputs">
                <div class="row">
                    <div class="col-12 col-md-6 profile-title">
                        <h2>Clever Girl Profile</h2>
                    </div>
                    <div class="col-12 col-md-6 profile-logout">
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
                <form method="POST" action="../inc/update-profile.php" class="form-inputs">
                    <div class="row col">
                        <div class="col-12 col-md-4">
                            <label for="username">Username</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" name="username" id="username" value="<?php echo $username; ?>">
                        </div>
                    </div>
                    <div class="row col">
                        <div class="col-12 col-md-4">
                            <label for="display_name">Display Name</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" name="display_name" id="display_name" placeholder="Enter a custom name to display" value="<?php echo $display_name; ?>">
                        </div>
                    </div>
                    <div class="row col">
                        <div class="col-12 col-md-4">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                        </div>
                    </div>
                    <div class="row col">
                        <div class="col-12 col-md-4">
                            <label for="title">Clever Title</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <input type="text" name="title" id="title" value="<?php echo $title; ?>">
                        </div>
                    </div>
                    <div class="row col">
                        <div class="col-12 col-md-4">
                            <label for="bio">Clever Bio</label>
                        </div>
                        <div class="col-12 col-md-8">
                            <textarea name="bio" id="bio"><?php echo $bio; ?></textarea>
                        </div>
                    </div>
                    <div class="row col submit">
                        <input type="submit" value="Update" class="col-12">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>