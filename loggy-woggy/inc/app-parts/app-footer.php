<?php 
/**
 * Set up the app's footer menu
 */

if($_SESSION) { ?>

    <footer id="app-footer" class="app-footer app-menu">
        <ul>
            <li id="app-menu-schedule" class="app-menu-item"><a id="schedule-button"><i class="fa-solid fa-calendar"></i><span>NFL Schedule</span></a></li>
            <li id="app-menu-simmulator" class="app-menu-item"><a id="game-simulator-button"><i class="fa-solid fa-gamepad"></i><span>Game Simulator</span></a></li>
            <li id="app-menu-past-sims" class="app-menu-item"><a id="stats-button"><i class="fa-solid fa-server"></i><span>Stats</span></a></li>
        </ul>
    </footer>

<?php } ?>