<?php 
/**
 * User dashboard
 */

// Connect to the db
require_once('./inc/config.php');

// Get header
include('./inc/header.php');

?>

<!-- App Contents -->
<div id="app" class="app">
    <div id="loggy-woggy">

    <?php if(!isset($_SESSION['username'])) { 
        if(isset($_COOKIE['entrypw']) && $_COOKIE['entrypw'] != 'R@mPaN_Can-2o@3') { ?>
            <div id="entry" class="entry">
                <div class="col-8 logo">
                    <img src="./assets/images/logo-gamblingame.png" />
                </div>
                <div class="col-12">
                    <h1>Password required for entry</h1>
                </div>
                <div class="col-12 entry-form">
                    <form method="POST" action="inc/validate-entry.php" class="form-inputs row">
                        <div class="col-12 col-sm-8">
                            <input type="text" name="entrypw" id="entrypw" placeholder="Enter Password">
                        </div>
                        <div class="col-12 col-sm-4">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        <?php } else {
            header('Location: ./inc/register.php');
        } ?>
        
    <?php } else { ?>
        <?php include('./inc/app-parts/app-header.php'); ?>
        <div id="app-contents" class="app-content col-12">
            <h1>Better Bets Gamblin' Game</h1>
            <h2>Welcome to the newest and greatest betting app <span class="username"><?php echo $_SESSION['username']; ?>!</span></h2>
            <h3>Our app compiles the averages of the latest sports stats for each simulation. This keeps all the simulations you run up to date and 100% verified. Use it to gain an edge in your betting pools!</h3>
        </div>
        <?php include('./inc/app-parts/app-footer.php'); ?>
    <?php } ?>
    
</div>
<!-- END App Contents -->
    
</body>

<?php include('./inc/footer.php'); ?>