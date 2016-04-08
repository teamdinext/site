<?php
    session_start();

    if(empty($_SESSION["tid"]))
    {
        header("Location: ../");
    }
    else
    {
        ?>
    <!doctype html>
<html ng-app="classView">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Class Registration</title>
    <meta charset="utf-8">
    <link href="../resources/css/normalize.css" rel="stylesheet" type="text/css">
    <link href="../resources/css/skeleton.css" rel="stylesheet" type="text/css">
    <link href="../resources/css/style-2.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../resources/js/angular.js"></script>
    <script type="text/javascript" src="app.js"></script>
</head>


<body>
    <?php require('../resources/pages/nav.php'); ?>

    <div class="content row">

        <div class="eight columns center-column">
           <div class="eight columns center-column">
            <div class="" ng-controller="stageCtrl as stage">
               <!-- STAGE 1 -->
                <div class="row" id="stage-1" ng-show="stage.current == 1 || stage.review">
                    <div class="row header">
                        <h2> How do you want to set up this class? </h2>
                    </div>
                    <div class="inputs row" align="center">

                        <input type="button" value="Manual Setup"  ng-click="stage.setIsCanvasEnabled(false)" />
                        <input type="button" value="Link to Canvas" ng-click="stage.setIsCanvasEnabled(true)" />
                        <br/>
                        <div class="one" id="CanvasConfirm" ng-show="stage.classData.IsCanvasEnabled">Canvas Link Activated.</div>
                        <div class="one" id="ManualConfirm" ng-hide="stage.classData.IsCanvasEnabled">Manual Setup Activated.</div>
                    </div>
                    <div class="inputs row" align="center">
                        <form>
                            <div class="row">
                                <label class="u-pull-left mobile-stack">Class Title:
                                   <span style="font-size: 0.7em;">
                                        (e.g. Personal Finance)
                                    </span>
                                </label>
                                <input name="classtitle"
                                       type="text"
                                       ng-model="stage.classData.CourseName"
                                       class="u-pull-right mobile-stack"/>
                            </div>
                            <div class="row">
                                <label class="u-pull-left mobile-stack">Class Code:
                                    <span style="font-size: 0.7em;">
                                        (e.g. FIN-302)
                                    </span>
                                </label>
                                <input name="classcode"
                                       type="text"
                                       class="u-pull-right mobile-stack"
                                       ng-model="stage.classData.CourseCode"
                                       required />
                            </div>
                        </form>
                    </div>

                    <div class="inputs row" align="center">
                        <input type="button" value="Continue" ng-click="stage.next1()" ng-hide="stage.review || stage.testing">
                    </div>
                </div>

               <!-- STAGE 2 -->
                <div class="row" id="stage-2" ng-show="stage.current == 2 || stage.review">
                    <div class="">
                        <div class="row header">
                            <h3> Does your class have groups? </h3>
                        </div>

                        <div class="inputs row" align="center">
                            <input type="button" value="No" ng-click="stage.tables.disallowGroups()" />
                            <input type="button" value="Yes" ng-click="stage.tables.allowGroups()" />
                        </div>
                        <div class="row header">

                            <span ng-hide="stage.tables.hasGroups">
                              <input class="inline"
                                    type="text"
                                    name="students"
                                    ng-model="stuNum"
                                    id="stuNum"
                                    size="5px" />
                                students.
                            </span>
                            <span ng-show="stage.tables.hasGroups">
                            <input class="inline"
                                   type="text"
                                   name="numberofgroups"
                                   ng-model="groupNum"
                                   id="groupNum"
                                   size="5px" />
                            groups.
                        </span>

                        </div>
                        <!--
                        <div class="inputs row" align="center">
                            <input type="button" value="Show Roster" ng-click="stage.tables.generateTable()" />
                        </div>

                        <div ng-bind-html="stage.tables.tableText | html"> </div>
                        -->
                    </div>

                    <div class="inputs row" align="center">
                        <input type="button" value="Back" ng-click="stage.prev()" ng-hide="stage.review || stage.testing">
                        <input type="button" value="Continue" ng-click="stage.next()" ng-hide="stage.review || stage.testing">

                    </div>
                </div>

                <!-- STAGE 3 -->
                <div class="row" id="stage-3" ng-show="stage.current == 3 || stage.review">
                    <div class="row header">
                        <h3> How do you want to update points? </h3>
                    </div>

                    <div class="inputs row" align="center">
                        <input type="button" value="File Uploads" /> &emsp; <input type="button" value="Manual Point Insertion" />
                    </div>
                    <input type="button" value="Back" ng-click="stage.prev()" ng-hide="stage.review || stage.testing">
                    <input type="button" value="Continue" ng-click="stage.next()" ng-hide="stage.review || stage.testing">
                </div>

                <!-- STAGE 4 -->
                <div class="row" id="stage-4" ng-show="stage.current == 4 || stage.review">
                    <div class="row header">
                        <h3> How many points will it take for each level? </h3>
                    </div>

                    <div class="inputs row" align="center">
                        <div class="row" ng-repeat="i in scale">
                            <label>To reach level {{$index + 2}}: </label>
                            <input size="5px"
                                   ng-model="i" />
                        </div>
                    </div>
                    <div class="inputs row" align="center">
                        <input type="button" value="Back" ng-click="stage.prev()" ng-hide="stage.review || stage.testing">
                        <input type="button" value="Continue" ng-click="stage.fin()" ng-hide="stage.review || stage.testing">
                    </div>
                </div>

               <!-- STAGE 5 -->
                <div class="row" id="stage-5" ng-show="stage.current == 'fin' || stage.testing">
                    <div class="row header">
                        <h3> You're all done! </h3>
                    </div>

                    <div class="inputs row" align="center">
                        <input type="submit" value="Proceed" ng-click="stage.addClass()" />
                    </div>
                    <div id="responseBox"></div>
                </div>

            </div>
        </div>
        </div>
    </div>

    <div class="footer row">

        <span>&copy; 2016 <a href="index.html">Discussions and Dragons.</a> All rights reserved.</span>
    </div>


</body>

</html>
<?php
    }
?>
