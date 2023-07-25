<?php
/**
 * Register Loggy Woggy users
 */

// Exit page if accessed directly
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("Location: ../"); 
    exit; // Stop further execution of the script
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <script src="../assets/js/scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Add your CSS styling here -->
</head>
<body>
    <div id="app" class="app">
        <div id="loggy-woggy">
            <div class="blue-bg container register-form">
                <div class="col col-12 col-md-9 logo">
                    <div class="logo-image">
                        <div class="blue-bg image">
                            <img src="../assets/images/logo-nfl.svg" />
                        </div>
                    </div>
                </div>
                <div class="col col-14 logo-text white-bg">
                    <div class="logo-text-image blue-bg">
                        <div class="image">
                            <h1>Simulator</h1>
                        </div>
                    </div>
                </div>
                <h2>Register With Loggy Woggy!</h2>
                <div id="register-choices" class="col col-12 register-choices" style="display: flex;">
                    <button id="reveal-register">Register</button>
                    <button id="reveal-login">Login</button>
                </div>
                <div id="register-inputs" class="col col-12 register-inputs" style="display: none;">
                    <a class="back-to-landing">&larr; Back</a>
                    <form method="POST" action="./register-user.php" class="form-inputs">
                        <div class="col col-12">
                            <label for="username" class="col-12 col-md-4">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" class="col-12 col-md-8">
                        </div>
                        <div class="col col-12">
                            <label for="email" class="col-12 col-md-4">Email</label>
                            <input type="email" name="email" id="email" placeholder="test@example.com" class="col-12 col-md-8" required>
                        </div>
                        <div class="col col-12">
                            <label for="password" class="col-12 col-md-4">Password</label>
                            <input type="password" name="password" id="password" class="col-12 col-md-8" required>
                        </div>
                        <div class="col col-12 submit">
                            <input type="submit" value="Register" class="col-12">
                        </div>
                    </form>
                </div>
                <div id="login-inputs" class="col col-12 login-inputs" style="display: none;">
                    <a class="back-to-landing">&larr; Back</a>
                    <form method="POST" action="../inc/login.php" class="form-inputs">
                        <div class="col col-12">
                            <label for="username" class="col-12 col-md-4">Username</label>
                            <input type="text" name="username" id="username" placeholder="john123" class="col-12 col-md-8">
                        </div>
                        <div class="col col-12">
                            <label for="password" class="col-12 col-md-4">Password</label>
                            <input type="password" name="password" id="password" class="col-12 col-md-8" required>
                        </div>
                        <div class="col col-12 submit">
                            <input type="submit" value="Login" class="col-12">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>