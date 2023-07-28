<?php 
/**
 * Holds user's profile info
 */

require_once('../config.php');
?>
<link href="./assets/css/schedule.css" rel="stylesheet" type="text/css">
<div id="schedule-contents" class="app-part col-12">
    <h1>NFL Schedule</h1>
    <div class="row schedule-contents-settings">
        <div class="col-12 col-md-6 profile-settings-item-label">
            <label for="game-settings">Schedule Settings</label>
        </div>
        <div class="col-12 col-md-6">
            <span>Coming Soon!</span>
        </div>
        <div class="col-12">
            <div class="row game-options" style="display: none;">
                <div class="col-12 col-md-4 profile-settings-item-label">Run %</div>
                <div class="col-12 col-md-4 profile-settings-item-label">Pass %</div>
                <div class="col-12 col-md-4 profile-settings-item-label">4th Att %</div>
                <div class="col-12 col-md-4 profile-settings-item-label">Turnover %</div>
                <div class="col-12 col-md-4 profile-settings-item-label">Defense %</div>
                <div class="col-12 col-md-4 profile-settings-item-label">Team Select</div>
            </div>
        </div>
    </div>
    <div class="row schedule-button">
        <div class="col-12">
            <button id="get-schedule" onclick="getSchedule()">See Schedule</button>
        </div>
    </div>
    <div id="display-schedule" class="game-results"></div>
</div>