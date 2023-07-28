<?php
/**
 * Register Loggy Woggy users
 */

?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <script src="../assets/js/scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
    <div id="app" class="app">
        <div id="loggy-woggy">
            <div class="register-form blue-bg">
                <div class="col-8 logo">
                    <img src="../assets/images/logo-gamblingame.png" />
                </div>
                <div class="col-12">
                    <h1>Better Bets<br>Gooder Goods</h1>
                </div>
                <div id="register-choices" class="register-choices" style="display: flex;">
                    <button id="reveal-register">Register</button>
                    <button id="reveal-login">Login</button>
                </div>
                <div id="register-inputs" class="form-container register-inputs" style="display: none;">
                    <div class="col-12">
                        <a class="back-to-landing">&larr; Back</a>
                    </div>
                    <form method="POST" action="./register-user.php" class="form-inputs row">
                        <div class="col-12">
                            <label for="username" class="col-12 col-md-4">Username</label>
                            <input type="text" name="username" id="username" placeholder="Username" class="col-12 col-md-8">
                        </div>
                        <div class="col-12">
                            <label for="email" class="col-12 col-md-4">Email</label>
                            <input type="email" name="email" id="email" placeholder="test@example.com" class="col-12 col-md-8" required>
                        </div>
                        <div class="col-12">
                            <label for="password" class="col-12 col-md-4">Password</label>
                            <input type="password" name="password" id="password" class="col-12 col-md-8" required>
                        </div>
                        <div class="col-12 submit">
                            <input type="submit" value="Register" class="col-12">
                        </div>
                    </form>
                </div>
                <div id="login-inputs" class="form-container login-inputs" style="display: none;">
                    <div class="col-12">
                        <a class="back-to-landing">&larr; Back</a>
                    </div>
                    <form method="POST" action="./login.php" class="form-inputs row">
                        <div class="col-12">
                            <label for="username" class="col-12 col-md-4">Username</label>
                            <input type="text" name="username" id="username" placeholder="john123" class="col-12 col-md-8">
                        </div>
                        <div class="col-12">
                            <label for="password" class="col-12 col-md-4">Password</label>
                            <input type="password" name="password" id="password" class="col-12 col-md-8" required>
                        </div>
                        <div class="col-12 submit">
                            <input type="submit" value="Login" class="col-12">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>