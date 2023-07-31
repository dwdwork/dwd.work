<?php 
/**
 * Holds user's profile info
 */

?>
<link href="./assets/css/game-simulator.css" rel="stylesheet" type="text/css">

<div id="game-simulator-contents" class="app-part col-12">
    <h1>Game Simulator</h1>
    <div id="game-simulator-container">
        <div class="row game-simulator-settings">
            <div class="col-12 col-md-6 profile-settings-item-label">
                <label for="game-settings">Game Settings</label>
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
        <div class="row game-simulator-button">
            <div class="col-12">
                <button id="run-nfl-game" class="col-12" onclick="calculateNFLGame()">Run Simulator</button>
            </div>
        </div>
        <div id="game-results" class="game-results"></div>
    </div>
</div>