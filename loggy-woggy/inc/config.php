<?php 
/**
 * Database connections
 */

// // Get the current URL
// $currentURL = $_SERVER['REQUEST_URI'];

// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// // Test the current URL    
// $DB_HOST = 'localhost';
// $DB_USER = 'root';
// $DB_PASS = 'root';
// $DB_NAME = 'local';
// $user_valid = false;

// // Database connection
// $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
// if (!$conn) {
//     die("Database connection failed: " . mysqli_connect_error());
// }

// // Retrieve the user record from the database if session in progress
// if($_SESSION) {

//     // Set user id for db access
//     $userId = $_SESSION['user_id'];
//     $sql = "SELECT * FROM wpym_loggy_woggy_users WHERE id = '$userId'";
//     $user_result = mysqli_query($conn, $sql);

//     // If results found, put data into a variable
//     if ($user_result && mysqli_num_rows($user_result) > 0) {
//         $user_data = mysqli_fetch_assoc($user_result);
//         $user_valid = true;
//     }
// }

// // Set up DB table
// function loggy_woggy_table() {
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'loggy_woggy_users';

//     // Check if the table already exists in the database
//     if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") === $table_name) {
//         return; // Table already exists, no need to create it again
//     }

//     $charset_collate = $wpdb->get_charset_collate();

//     $sql = "CREATE TABLE $table_name (
//         id INT(11) NOT NULL AUTO_INCREMENT,
//         username VARCHAR(100) NOT NULL,
//         email VARCHAR(100) NOT NULL,
//         password VARCHAR(255) NOT NULL,
//         PRIMARY KEY (id)
//     ) $charset_collate;";

//     require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//     dbDelta($sql);
// }

// // User authentication with session
// function isUserAuthenticated() {
//     return isset($_SESSION['user_id']);
// }

// // Password hashing
// function hashPassword($password) {
//     return password_hash($password, PASSWORD_DEFAULT);
// }

// // User login
// function loginUser($username, $password) {
//     global $conn;

//     // Retrieve the user record from the users table
//     $sql = "SELECT * FROM wpym_loggy_woggy_users WHERE username = '$username' OR email = '$username'";
//     $result = mysqli_query($conn, $sql);

//     if ($result && mysqli_num_rows($result) > 0) {
//         $user = mysqli_fetch_assoc($result);

//         // Verify the password against the hashed password stored in the database
//         if (password_verify($password, $user['password'])) {
//             // Set the user_id in the session
//             $_SESSION['user_id'] = $user['id'];
//             return true;
//         }
//     }

//     return false;
// }

// function insert_loggy_woggy_user() {
//     global $wpdb;
//     $table_name = $wpdb->prefix . 'custom_profiles'; // Replace 'custom_profiles' with your table name

//     $data = array(
//         'name' => 'John Doe',
//     );

//     $wpdb->insert($table_name, $data);
// }

// function db_table_as_obj() {
//     // Database configuration
//     $host = 'localhost';
//     $dbName = 'local';
//     $username = 'local';
//     $password = 'root';

//     try {
//         // Create a new PDO instance
//         $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
//         // SQL query to retrieve the table
//         $tableName = 'loggy_woggy_users';
//         $query = "SELECT * FROM $tableName";
      
//         // Execute the query and fetch the results
//         $statement = $pdo->query($query);
//         $tableData = $statement->fetchAll(PDO::FETCH_OBJ);
      
//         // Close the database connection
//         $pdo = null;
//         // Return the table data as an object
//         return $tableData;
//     } catch (PDOException $e) {
//         // Handle any database connection errors
//         echo 'Connection failed: ' . $e->getMessage();
//     }
// }

// function loadSDSim() {
//     $xmlFile = simplexml_load_file('../assets/sims/FootballSim2000.xmile');

//     $xmlObj = $xmlFile->model;

//     $objVariables = $xmlObj->variables;

//     $objFlows = $xmlObj->variables->flow;
// }

// Get the current URL
$currentURL = $_SERVER['REQUEST_URI'];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
function getDBConnection() {
    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = 'root';
    $DB_NAME = 'local';

    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function getUserData() {
    $conn = getDBConnection();

    // Set user id for db access
    $userId = $_SESSION['user_id'];
    $sql = "SELECT * FROM wpym_loggy_woggy_users WHERE id = '$userId'";
    $user_result = mysqli_query($conn, $sql);

    // If results found, put data into a variable
    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_data = mysqli_fetch_assoc($user_result);
        $user_valid = true;
    }

    return $user_data;
}

// User login using PDO
function loginUser($username, $password) {
    $conn = getDBConnection();

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM wpym_loggy_woggy_users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password against the hashed password stored in the database
        if (password_verify($password, $user['password'])) {
            // Set the user_id in the session
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
    }

    $conn->close();
    return false;
}

?>