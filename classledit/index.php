<?php

    session_start();

    if(empty($_SESSION["tid"]))
    {
        header("Location: ../");
    }
    else
    {
    require('../database/db.php');
    $mysqli = ConnectToDatabase();

    $sql = "SELECT * FROM class where TeachID = " . $_SESSION["tid"];

    $classes = $mysqli->query($sql);

    $echoString = '';
    if($classes->num_rows == 0)
    {
        $echoString .=  '<h3 style="text-align: center">Hello! <br/>
        It seems that you have no classes registered. <br/> <br/> Oops! </h3>';
    }
    else
    {
        foreach($classes as $class)
        {
            $courseCode = htmlspecialchars($class["CourseCode"]);
            $courseId = htmlspecialchars($class["ClassID"]);
            $echoString .= '<div class="row">';
            $echoString .= '<input type="button"
                            ng-class="classes.btnClass()"
                            value="' . $courseCode . '"
                            id="' . $courseId . '"
                            ng-click="classes.handleClick(' . $courseId . ', $event)"/>';
            $echoString .= '</div>';
        }
    }
?>
    <!DOCTYPE html>
    <html ng-app="classList">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Class List</title>
        <link rel="stylesheet" type="text/css" href="../resources/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/skeleton.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/style-2.css">
        <script type="text/javascript" src="../resources/js/angular.js"></script>
        <script type="text/javascript" src="app.js"></script>
        <style>
            .register-only {
                display: none;
            }
        </style>

      <link rel="icon"
      type="image/png"
      href="../resources/images/Dragon-Logo.png">

    </head>

    <body>
      <?php require('../resources/pages/nav.php'); ?>

            <div class="content row" ng-controller="classesCtrl as classes">

                <div class="eight columns center-column">

                    <div class="row header">
                        <h1> <span id="pageFunction"> Welcome to your class list! </span> </h1>
                    </div>
                    <div class="row">

                        <div class="eight columns center-column">
                            <div class="classes">
                                <?= $echoString ?>
                                <div class="row">
                                    <input type="submit" class="center class-button button-lg" ng-click="classes.toRegister()" value="Add A Class"/>
                                </div>
                                <div class="row">
                                    <input type="button" ng-click="classes.beginRemove()" class="center class-button button-lg" value="Remove A Class"/>
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
<?php
    }
?>
