<?php 
/**
 * User dashboard
 */
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// Get user information from the database
// Perform database query to fetch user details here

// Update user information on form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $bio = $_POST['bio'];

    // Update user information in the database
    // Perform database query to update user details here
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <!-- Add your CSS styling here -->
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <h2>Update Your Information</h2>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>" required><br>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?php echo $title; ?>" required><br>
        <label for="bio">Bio:</label>
        <textarea name="bio" id="bio"><?php echo $bio; ?></textarea><br>
        <input type="submit" value="Update">
    </form>
    <a href="logout.php">Logout</a>
</body>
</html>