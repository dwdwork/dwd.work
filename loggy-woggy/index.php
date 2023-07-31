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
        if($_COOKIE['entrypw'] != 'R@mPaN_Can-2o@3') { ?>
            <div id="entry" class="entry">
                <div class="col-8 logo">
                    <img src="./assets/images/logo-gamblingame.png" />
                </div>
                <div class="col-12">
                    <h1>Password required for entry</h1>
                </div>
                <div class="col-12 entry-form">
                    <form method="POST" action="inc/validate-entry.php" class="form-inputs row">
                        <div class="col-12 col-sm-8 pw">
                            <input type="text" name="entrypw" id="entrypw" placeholder="Enter Password">
                        </div>
                        <div class="col-12 col-sm-4 submit">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        <?php } else { 
            include('./inc/register.php');
        } ?>
        
    <?php } else { ?>
        <?php include('./inc/app-parts/app-header.php'); ?>
        <?php include('./inc/app-parts/home.php');?>
        <?php include('./inc/app-parts/app-footer.php'); ?>
    <?php } ?>
    
</div>
<!-- END App Contents -->
    
</body>

<?php include('./inc/footer.php'); ?>