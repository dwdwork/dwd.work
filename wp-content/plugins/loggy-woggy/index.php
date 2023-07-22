<?php 
/**
 * Landing content for page
 */

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="./assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <script src="./assets/js/scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Add your CSS styling here -->
</head>
<body>
    <div id="app" class="app">
        <div id="loggy-woggy">
            <div class="blue-bg container register-form">
                <div class="col col-12 col-md-9 logo">
                    <div class="logo-image">
                        <div class="blue-bg image">
                            <img src="./assets/images/logo-nfl.svg" />
                        </div>
                    </div>
                </div>
                <div class="col col-14 logo-text white-bg">
                    <div class="logo-text-image blue-bg">
                        <div class="image">
                            <h1>Simulator</h1>
                        </div>
                    </div>
                </div>
                <p class="h2">Password Required For Entry</p>
                <div id="entry" class="col col-12 entry" style="display: flex;">
                    <form method="POST" action="inc/validate-entry.php" class="form-inputs">
                        <div class="row">
                            <div class="col-8">
                                <input type="text" name="entrypw" id="entrypw" placeholder="Enter Password">
                            </div>
                            <div class="col-4">
                                <input type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>