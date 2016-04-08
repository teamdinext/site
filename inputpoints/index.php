<?php

    session_start();

    if(empty($_SESSION["tid"]))
    {
        header("Location: ../");
    }
    else
    {

?>
    <!DOCTYPE html>
    <html ng-app="teamPoints">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Input Points</title>
        <link rel="stylesheet" type="text/css" href="../resources/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/skeleton.css">
        <link rel="stylesheet" type="text/css" href="../resources/css/style-2.css">
        <script type="text/javascript" src="../resources/js/angular.js"></script>
        <script>var id = <?=$_GET['id']?></script>
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

            <div class="content row" ng-controller="teamsCtrl as teams">

                <div class="eight columns center-column">

                    <div class="row header">
                        <h1> <span id="pageFunction"> Edit the points for each group. </span> </h1>
                    </div>
                    <div class="row">

                        <div class="eight columns center-column">
                            <div class="classes">

                                <div class="row" ng-repeat="team in teams.list">
                                    <label class="points full" height="2.3em">
                                        {{team.name}}
                                    </label>
                                    <input type="button"
                                                 class="inline-sm"
                                                 style="float: right"
                                                 value="Change"
                                                 ng-click="team.prototype.enableEdit()"/>
                                    <input type="button"
                                                 class="inline-sm"
                                                 style="float: right"
                                                 value="Done"
                                                 ng-click="team.prototype.disableEdit()"
                                                 />
                                    <input type="text"
                                                 name="pointsbox"
                                                 class="inline-md numeric"
                                                 maxlength="4"
                                                 style="float: right"
                                                 ng-disabled="team.prototype.notEditing"
                                                 ng_model="team.points"/>

                               </div>

                                <div class="row">
                                    <div class="row">
                                        <center>
                                            <input type="button" value="Submit and return to Class Edit page" id="submitPoints" ng-click="teams.buttonSubmit()"/>
                                        </center>
                                    </div>
                                </div>
                                    <div class="row"> <center>

                                        <input type="submit" value="Return without submitting" ng-click="teams.return()"/>
                                    </form>
                                        </center> </div>
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
