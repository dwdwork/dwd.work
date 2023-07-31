<?php 
/**
 * App's landing page
 */
?>

<div id="app-contents" class="app-content home-contents col-12">
    <div class="row heading-content">
        <div class="col-12 logo-banner">
            <img src="./assets/images/logo-banner.png">
        </div>
    </div>

    <div class="row body-content">
        <div class="col-12">
            <h2>Welcome <span class="username"><?php echo $_SESSION['username']; ?>!</span></h2>
            <h2>You just entered the realm of better betting. Take a look around and enjoy.</h2>
        </div>
        <div class="col-12">
        <h3>Our app compiles the averages of the latest sports stats for each simulation. This keeps all the simulations you run up to date and 100% verified. Use it to gain an edge in your betting pools!</h3>
        </div>
    </div>
</div>