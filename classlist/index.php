<?php

    //TODO: fix add/remove buttons to have glyphicons

    session_start();

    if(empty($_SESSION["tid"]))
    {
        header("Location: ../");
    }
    else
    {


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

        <link rel="icon" type="image/png" href="../resources/images/Dragon-Logo.png">

    </head>

    <body>
        <?php require('../resources/pages/nav.php'); ?>
        <div class="container">
            <div class="content row" ng-controller="classesCtrl as classes">

                <div class="eight columns center-column">

                    <div class="row header">
                        <h1>
                          <span id="pageFunction">
                            Welcome to your class list!
                          </span>
                        </h1>
                    </div>
                    <div class="row">

                        <div class="eight columns center-column">
                            <div class="classes">
                                <div class="row" ng-repeat="class in classList">
                                  <div class="row">
                                    <input type="button"
                                           ng-class="class.btnClass()"
                                           value="{{class.code}}"
                                           ng-click="class.handleClick(class.id,$event)">
                                    </input>
                                  </div>
                                </div>
                                <div ng-show="classList.length < 1">
                                  <span style="text-align: center">
                                  It looks like you have no classes. Oops!
                                  </span>
                                </div>
                                <div class="row">
                                  <input type="submit"
                                         class="center class-button button-lg"
                                         ng-click="classes.toRegister()"
                                         value="Add a new class" />
                                </div>
                                <div class="row">
                                  <input type="button"
                                         ng-click="processRemoval()"
                                         class="center class-button button-lg"
                                         value="{{removeBtn()}}" />
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
