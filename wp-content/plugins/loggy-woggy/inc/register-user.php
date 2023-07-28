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
    
    if($stmnt = $conn->prepare('SELECT id, password FROM wpym_loggy_woggy_users WHERE username = ?')) {
        if(empty($username)) {
            $username = $email;
        }

        $stmnt->bind_param('s', $username);
        $stmnt->execute();
        $stmnt->store_result();
    
        if($stmnt->num_rows > 0) {
            echo 'Username already exists. Try again.';
        } else {
            if($stmnt = $conn->prepare('INSERT INTO wpym_loggy_woggy_users (username, email, password) VALUES (?, ?, ?)')) { 
                $password = password_hash($password, PASSWORD_DEFAULT);
                $stmnt->bind_param('sss', $username, $email, $password);
                $stmnt->execute();
                
                // Redirect the user to the dashboard
                header("Location: ../");
            } else {
                echo 'Error registering user.';
            }
        }
        $stmnt->close();
    } else {
        echo 'Error with sql connection.';
    }
    
    $conn->close();
}
?>