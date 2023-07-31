<?php
/**
 * Scripts to register user
 */

// Connect to the db
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user registration data from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to DB
    $connect = getDBConnection();

    // Handle database errors and provide appropriate feedback to the user
    if(mysqli_connect_error()) {
        exit ('Error connecting to the database ' . mysqli_connect_error());
    }
    
    if(!isset($username, $password, $email)) {
        exit('Empty Field(s)');
    }
    
    if(empty($password) || empty($email)) {
        exit('Values Empty');
    }
    
    if($stmnt = $connect->prepare('SELECT id, password FROM wpym_loggy_woggy_users WHERE username = ?')) {
        if(empty($username)) {
            $username = $email;
        }

        $stmnt->bind_param('s', $username);
        $stmnt->execute();
        $stmnt->store_result();
    
        if($stmnt->num_rows > 0) {
            echo 'Username already exists. Try again.';
        } else {
            if($stmnt = $connect->prepare('INSERT INTO wpym_loggy_woggy_users (username, email, password) VALUES (?, ?, ?)')) { 
                $password = password_hash($password, PASSWORD_DEFAULT);
                $stmnt->bind_param('sss', $username, $email, $password);
                $stmnt->execute();
                
                // Redirect the user to the dashboard
                header("Location: ./register.php");
            } else {
                echo 'Error registering user.';
            }
        }
        $stmnt->close();
    } else {
        echo 'Error with sql connection.';
    }
    
    $connect->close();
}

?>
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
</div>