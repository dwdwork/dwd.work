<?php 
/**
 * Hold main functionality for running an NFL game script
 */


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user data from the form
    $possessions = 12;
    $display_name = $_POST['display_name'];
    $title = $_POST['title'];
    $bio = $_POST['bio'];

    // Check if any values are provided or different from the existing data
    if (($display_name !== '') || ($title !== '') || ($bio !== '')) {

        if ($user_valid === true) {
            
            // Add columns for each data point if there are none
            try {
                $display_name_result = $conn->query("SELECT display_name FROM wpym_loggy_woggy_users");
            } catch (Exception $e) {
                if (strpos($e->getMessage(), "Unknown column 'display_name'") !== false) {
                    $sql = "ALTER TABLE wpym_loggy_woggy_users ADD COLUMN display_name VARCHAR(255)";
            
                    if ($conn->query($sql) === true) {
                        echo "Column display_name added successfully.";
                    } else {
                        echo "Error adding column display_name: " . $conn->error;
                    }
                } else {
                    echo "Error: " . $e->getMessage();
                }
            }
            try {
                $title_result = $conn->query("SELECT title FROM wpym_loggy_woggy_users");
            } catch (Exception $e) {
                if (strpos($e->getMessage(), "Unknown column 'title'") !== false) {
                    $sql = "ALTER TABLE wpym_loggy_woggy_users ADD COLUMN title VARCHAR(255)";
            
                    if ($conn->query($sql) === true) {
                        echo "Column title added successfully.";
                    } else {
                        echo "Error adding column title: " . $conn->error;
                    }
                } else {
                    echo "Error: " . $e->getMessage();
                }
            }
            try {
                $bio_result = $conn->query("SELECT bio FROM wpym_loggy_woggy_users");
            } catch (Exception $e) {
                if (strpos($e->getMessage(), "Unknown column 'bio'") !== false) {
                    $sql = "ALTER TABLE wpym_loggy_woggy_users ADD COLUMN bio VARCHAR(255)";
            
                    if ($conn->query($sql) === true) {
                        echo "Column bio added successfully.";
                    } else {
                        echo "Error adding column bio: " . $conn->error;
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

            if ($title !== '') {
                $user['title'] = $title;
                $updateRequired = true;
            }

            if ($bio !== '') {
                $user['bio'] = $bio;
                $updateRequired = true;
            }

            // Update the user record if necessary
            if ($updateRequired) {
                $updateSql = "UPDATE wpym_loggy_woggy_users SET display_name = '{$user['display_name']}', title = '{$user['title']}', bio = '{$user['bio']}' WHERE id = '$userId'";
                $updateResult = mysqli_query($conn, $updateSql);

                if ($updateResult) {
                    // Display success message or perform any desired actions
                    echo 'User information updated successfully.';
                    // Redirect the user to the dashboard
                    header("Location: dashboard.php");
                } else {
                    // Handle update error
                    echo 'Error updating user information.';
                }
            } else {
                // No values to update
                echo 'No changes made to user information.';
            }
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // No values provided
        echo 'No new values provided to update.';
    }
}
?>