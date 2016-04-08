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

    $sql = "SELECT CourseCode 
            FROM class 
            WHERE ClassID = " . $_GET['id'];

    $classes = $mysqli->query($sql);

    $echoString = '';
    foreach($classes as $class)
    {
        $courseCode = $class["CourseCode"];

    }
?>
    <!DOCTYPE html>
    <html ng-app="groups">

    <head>
        <title>Editing Groups <?=$courseCode?></title>
        <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="../resources/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/skeleton.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/g.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/style-2.css">
        <script type="text/javascript" src="../resources/js/angular.js"></script>
        <script>var classId = <?=$_GET['id']?></script>
        <script type="text/javascript" src="./app.js"></script>
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

            <div class="content row" ng-controller="groupCtrl as groups">
                <div class="eight columns center-column">
                    <div class="row header">
                        <h1> 
                          <span id="pageFunction"> 
                            Editing groups for <?=$courseCode?> 
                          </span>
                        </h1> 
                    </div>
                    <div class="row">

                        <div class="eight columns center-column">
                            <div class="classes">
                                <div class="row">
                                  <div class="eight columns">
                                    <label>
                                      Team Name
                                    </label>
                                  </div>
                                  <div class="four columns">
                                    <label style="font-size: 1em;">
                                      Students per Team
                                    </label>
                                  </div>
                                  <!--
                                  <div class="two columns">
                                    <label>
                                      Points
                                    </label>
                                  </div>
                                  -->
                                </div>
                                <div class="row" ng-repeat="group in teams">
                                  <div class="eight columns">
                                    <label ng-hide="group.edit()">
                                      {{group.name}}
                                    </label>
                                    <button type="button" 
                                           ng-click="group.toggleEdit()" 
                                           style="width: em; float: left; margin: 4px; padding: 2px;">
                                           <span class="glyphicon glyphicon-pencil"
                                                 style="font-size: 2em; margin: 0.3em">
                                    </button>
                                    <input type="text" 
                                           ng-show="group.edit()" 
                                           ng-model="group.name" 
                                           style="margin: auto 0.5em; float: left;">
                                  </div>
                                  <div class="four columns">
                                    <input type="text" 
                                           ng-model="group.stuNum" 
                                           style="width: 4em; margin: auto 0.5em;">
                                  </div>
                                  <!--
                                  <div class="two columns">
                                    <input type="text" 
                                           ng-model="group.points" 
                                           style="width: 4em; margin: auto 0.5em;">
                                  </div>
                                -->
                                </div>
                                <div class="row">
                                  <input type="submit" 
                                         ng-click="submit()"
                                         class="center class-button button-lg" 
                                         value="Update and Return"/>
                                </div>
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
