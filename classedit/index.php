<?php

    session_start();
    require('../database/db.php');
    $mysqli = ConnectToDatabase();

    $idString = $mysqli->real_escape_string($_GET["id"]);
    $codeString = $mysqli->real_escape_string($_GET["courseCode"]);
    // Get the class info from the CLASS table
    $sql = "SELECT *
            FROM is410.class
            WHERE ClassID = '$idString'";
    $response = $mysqli->query($sql);
    if ($response->num_rows)
    {
        // fetch_array is 1-INDEXED!! NOT 0-INDEXED!!
        // THE FIRST SLOT IS 1!??!?!???
        $currentClass = $response->fetch_array(1);
        $classID = $currentClass["ClassID"];
        $teachID = $currentClass["TeachID"];
        $courseCode = $currentClass["CourseCode"];
        $courseName = $currentClass["CourseName"];
        $noOfGroups = $currentClass["NoOfGroups"];
        $isCanvasEnabled = $currentClass["IsCanvasEnabled"];
        $world = $currentClass["World"];
    }
    else
    {
        echo '<pre style="color: white;">';
        print_r($response);
        echo '</pre>';
    }

    $textToggle = "Hi.";

    if (!empty($courseName))
    {
        $textToggle = "Welcome to your " . $courseName . " course!";
    }
    else
    {
        $textToggle = "Welcome to your " . $courseCode . " course!";
    }
?>

    <!DOCTYPE html>
    <html ng-app="login">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Class Edit</title>
        <link rel="stylesheet" type="text/css" href="../resources/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/skeleton.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/style-2.css">
        <script type="text/javascript" src="resources/js/angular.js"></script>

      <link rel="icon"
      type="image/png"
      href="../resources/images/Dragon-Logo.png">

    </head>

    <body>
      <?php require('../resources/pages/nav.php'); ?>

            <div class="content row" ng-controller="loginController as page">

                <div class="eight columns center-column">

                    <div class="row header">
                        <h1> <span id="pageFunction"> <?= $textToggle ?></span> </h1> <br/>
                        <h3 text-align="center"> What would you like to do? </h3><br/>
                    </div>
                    <div class="row">

                        <div class="two columns tall">
                            &nbsp;
                        </div>
                        <div class="eight columns">
                            <div class="classes">
                                <?= $echoString ?>
                                <div class="row">
                                    <a href="../groupedit/index.php?id=<?=$idString?>">
                                        <input type="submit" class="center class-button button-lg" value="Edit Groups"/>
                                    </a>
                                    <a href="../inputpoints/index.php?id=<?= $classID ?>">
                                        <input type="submit" class="center class-button button-lg" value="Edit Points"/>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>



        <div id="footer" class="footer row">
            <span>&copy; 2016 <a href="index.html">Discussions and Dragons.</a> All rights reserved.</span>
        </div>
    </body>

    </html>
