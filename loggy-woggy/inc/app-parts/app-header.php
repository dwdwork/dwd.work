<?php 
/**
 * Set up the app's menu
 */

if($_SESSION) { ?>
    
    <header id="app-header" class="app-header app-menu">
        <div class="header">
            <div class="dashboard-link">
                <a id="dashboard-button"><i class="fa-solid fa-house"></i><span>Dashboard</span></a>
            </div>
            <div class="logo">
                <a href="./"><img src="./assets/images/logo-gamblingame.svg" alt="NFL Logo" width="92" height="100" /></a>
            </div>
            <div class="profile-link">
                <a id="profile-button"><i class="fa-regular fa-user"></i><span>Profile</span></a>
            </div>
        </div>
    </header>

    <div class="desktop-profile-link">
        <a id="desktop-profile-button"><i class="fa-regular fa-user"></i><span>Profile</span></a>
    </div>

<?php } ?>
