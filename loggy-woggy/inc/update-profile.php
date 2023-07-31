<?php 
/**
 * Update db with user settings
 */

// Connect to the db
require_once 'config.php';

// Retrieve the user record from the users table
$connect = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user data from the form
    $display_name = $_POST['display_name'];
    $fav_team = $_POST['fav_team'];
    $bio = $_POST['bio'];

    // Check if any values are provided or different from the existing data
    if (($display_name !== '') || ($fav_team !== '') || ($bio !== '')) {
            
        // Add columns for each data point if there are none
        try {
            $display_name_result = $connect->query("SELECT display_name FROM wpym_loggy_woggy_users");
        } catch (Exception $e) {
            if (strpos($e->getMessage(), "Unknown column 'display_name'") !== false) {
                $sql = "ALTER TABLE wpym_loggy_woggy_users ADD COLUMN display_name VARCHAR(255)";
        
                if ($connect->query($sql) === true) {
                    echo "Column display_name added successfully.";
                } else {
                    echo "Error adding column display_name: " . $connect->error;
                }
            } else {
                echo "Error: " . $e->getMessage();
            }
        }
        try {
            $fav_team_result = $connect->query("SELECT fav_team FROM wpym_loggy_woggy_users");
        } catch (Exception $e) {
            if (strpos($e->getMessage(), "Unknown column 'fav_team'") !== false) {
                $sql = "ALTER TABLE wpym_loggy_woggy_users ADD COLUMN fav_team VARCHAR(255)";
        
                if ($connect->query($sql) === true) {
                    echo "Column fav_team added successfully.";
                } else {
                    echo "Error adding column fav_team: " . $connect->error;
                }
            } else {
                echo "Error: " . $e->getMessage();
            }
        }
        try {
            $bio_result = $connect->query("SELECT bio FROM wpym_loggy_woggy_users");
        } catch (Exception $e) {
            if (strpos($e->getMessage(), "Unknown column 'bio'") !== false) {
                $sql = "ALTER TABLE wpym_loggy_woggy_users ADD COLUMN bio VARCHAR(255)";
        
                if ($connect->query($sql) === true) {
                    echo "Column bio added successfully.";
                } else {
                    echo "Error adding column bio: " . $connect->error;
                }
            } else {
                echo "Error: " . $e->getMessage();
            }
        }

        // Check if the values need to be updated
        $updateRequired = false;

        if ($display_name !== '') {
            $user['display_name'] = $display_name;
            $updateRequired = true;
        }

        if ($fav_team !== '') {
            $user['fav_team'] = $fav_team;
            $updateRequired = true;
        }

        if ($bio !== '') {
            $user['bio'] = $bio;
            $updateRequired = true;
        }

        // Update the user record if necessary
        if ($updateRequired) {
            $userId = $_SESSION['user_id'];
            $updateSql = "UPDATE wpym_loggy_woggy_users SET display_name = '{$user['display_name']}', fav_team = '{$user['fav_team']}', bio = '{$user['bio']}' WHERE id = '$userId'";
            $updateResult = mysqli_query($connect, $updateSql);

            if ($updateResult) {
                // Display success message or perform any desired actions
                echo 'User information updated successfully.';
                // Redirect the user to the dashboard
                header("Location: ../");
            } else {
                // Handle update error
                echo 'Error updating user information.';
            }
        } else {
            // No values to update
            echo 'No changes made to user information.';
        }

        // Close the database connection
        mysqli_close($connect);
    } else {
        // No values provided
        echo 'No new values provided to update.';
    }
}