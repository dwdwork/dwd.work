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
    <div id="app" class="app">
        <div id="loggy-woggy">
            <div class="blue-bg container dashboard-form">
                <div class="row">
                    <div class="col col-12 col-sm-3 logo">
                        <div class="logo-image">
                            <div class="image">
                                <img src="../assets/images/logo-nfl.svg" />
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-sm-9  logotype">
                        <div class="logo-text white-bg">
                            <div class="logo-text-image blue-bg">
                                <div class="image">
                                    <h1>Simulator</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dashboard-inputs" class="col col-12 dashboard-inputs">
                    <div class="row profile-title">
                        <div class="col-12 col-md-8">
                            <h2><?php echo $_SESSION['username']; ?>'s NFL Simulator</h2>
                        </div>
                        <div class="col-12 col-md-4 profile-logout">
                            <a href="logout.php">Logout</a>
                            <a href="#" id="edit-profile" class="btn edit-profile-btn">Edit Profile</a>
                        </div>
                    </div>
                    <form method="POST" action="../inc/update-profile.php" class="form-inputs">
                        <div class="row col">
                            <div class="col-12 col-md-4">
                                <label for="username">Username</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <?php echo $username; ?>
                                <div class="edit-profile-option" style="display: none;">
                                    <input type="text" name="username" id="username" value="<?php echo $username; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row col">
                            <div class="col-12 col-md-4">
                                <label for="display_name">Display Name</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <?php echo $display_name != null ? $display_name : 'Enter a custom name to display'; ?>
                                <div class="edit-profile-option" style="display: none;">
                                    <input type="text" name="display_name" id="display_name" placeholder="Enter a custom name to display" value="<?php echo $display_name; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row col">
                            <div class="col-12 col-md-4">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <?php echo $email; ?>
                                <div class="edit-profile-option" style="display: none;">
                                    <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row col">
                            <div class="col-12 col-md-4">
                                <label for="title">Team Name</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <?php echo $title; ?>
                                <div class="edit-profile-option" style="display: none;">
                                    <input type="text" name="title" id="title" value="<?php echo $title; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row col">
                            <div class="col-12 col-md-4">
                                <label for="bio">Personal Bio</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <?php echo $bio; ?>
                                <div class="edit-profile-option" style="display: none;">
                                    <textarea name="bio" id="bio"><?php echo $bio; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row col">
                            <div class="col-12 col-md-4">
                                <label for="bio">Game Simulator Settings</label>
                            </div>
                            <div class="col-12 col-md-8">
                                <span>Coming Soon!</span>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="row game-options" style="display: none;">
                                    <div class="col-12 col-md-4">Run %</div>
                                    <div class="col-12 col-md-4">Pass %</div>
                                    <div class="col-12 col-md-4">4th Att %</div>
                                    <div class="col-12 col-md-4">Turnover %</div>
                                    <div class="col-12 col-md-4">Defense %</div>
                                    <div class="col-12 col-md-4">Team Select</div>
                                </div>
                            </div>
                        </div>
                        <div class="row col">
                            <div class="col-12">
                                <button id="run-nfl-game" class="col-12">Run Simulator</button>
                            </div>
                        </div>
                        <div id="game-results" class="row col">
                        </div>
                        <div class="edit-profile-option" style="display: none;">
                            <div class="row col submit edit-profile-option">
                                <input type="submit" value="Update" class="col-12">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>