<?php 
/**
 * User dashboard
 */

if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// Connect to the db
require_once 'config.php';

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
<script>

// function printStats(attempts) {

//     function calculateStats(attempts) {
//         const S = 0.30; // Probability of success (30%)
//         const F = 0.70; // Probability of failure (70%)
//         const SS = 0.05; // Probability of scoring on a successful attempt (5%)
//         const FT = 0.01; // Probability of a turnover on a failed attempt (1%)
//         const NP = 0.99; // Probability of a punt on a failed attempt (99%)

//         // Calculate the number of scores, turnovers, and punts per attempt
//         const numScoresPerAttempt = S * SS;
//         const numTurnoversPerAttempt = F * FT;
//         const numPuntsPerAttempt = F * NP;

//         // Calculate the total number of scores, turnovers, and punts over all attempts
//         const totalScores = attempts * numScoresPerAttempt;
//         const totalTurnovers = attempts * numTurnoversPerAttempt;
//         const totalPunts = attempts * numPuntsPerAttempt;
//     }

//     let results = calculateStats(attempts);
//     console.log(results);
//     document.getElementById('clever-stats-results').innerHTML = results;   
// }
// const attempts = 12;
// const S = 0.30; // Probability of success (30%)
// const F = 0.70; // Probability of failure (70%)
// const SS = 0.05; // Probability of scoring on a successful attempt (5%)
// const FT = 0.01; // Probability of a turnover on a failed attempt (1%)
// const NP = 0.99; // Probability of a punt on a failed attempt (99%)

// let totalScores = 0;
// let totalTurnovers = 0;
// let totalPunts = 0;

// for(let i = 0; i < attempts; i++) {
//     // Check if the attempt is successful or not
//     const isSuccess = Math.random() <= S;
//     console.log(isSuccess);
//     if(isSuccess) {
//         // Check if the successful attempt results in a score or not
//         const isScore = Math.random() <= SS;
//         if(isScore) {
//             totalScores++;
//         }
//     } else {
//         // Check if the failed attempt results in a turnover or a punt
//         const isTurnover = Math.random() <= FT;
//         if(isTurnover) {
//             totalTurnovers++;
//         } else {
//             totalPunts++;
//         }
//     }
// }

// Calculate the total number of scores, turnovers, and punts over all attempts
// const totalScores = attempts * numScoresPerAttempt;
// const totalTurnovers = attempts * numTurnoversPerAttempt;
// const totalPunts = attempts * numPuntsPerAttempt;

// const results = 'Score: ' + totalScores + '\n' + 'Turnovers: ' + totalTurnovers + '\n' + 'Punts: ' + totalPunts;
// console.log(results);
</script>

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
                    <div class="row col">
                        <div class="col-12 col-md-4">
                            <label for="bio">Clever Stats</label>
                        </div>
                        <div class="col-12 col-md-8 clever-stats">
                            <table id="resultTable">
                                <script>
                                    
                                </script>
                            </table>

                            <button onclick="newNFLApp()">Run the Script!</button>
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