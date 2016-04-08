<?php
    session_start();
    // For connecting to database
    require("../database/db.php");
    // Connect and select database
    $mysqli = ConnectToDatabase();
    $classId = $_GET['id'];

    $teams= "SELECT *
            FROM TEAM
            WHERE ClassID = id;"
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Points</title>
    <link rel="stylesheet" type="text/css" href="../resources/css/skeleton.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/style-2.css">
    <script type="text/javascript" src="../resources/js/jQuery.js"></script>

    <script type="text/javascript" src="../resources/js/angular.js"></script>

    <script>
    function startup() {

        var tbArray = [0, 0, 0, 0, 0, 0, 0, 0];
        var teams[] = <?php echo $_POST[$teams] ?>;

        // Checks to see if all text boxes are grayed out before letting a user submit points.
        $("#submitPoints").click(function() {
            var y = 1;
                for (x = 0; x < tbArray.length; x++)
                {
                    if (tbArray[x] == 1)
                    {
                        window.alert("Please click 'Done' to close all text boxes and finalize points before submitting!")
                        y = 0
                        x = tbArray.length;
                    }
                }
            if (y == 1)
            {
                window.location.href = "../classlist/index.php";
            }
            else
                return 0;
        });


    }
    $(startup)
    </script>

    <link rel="icon"
    type="image/png"
    href="../resources/images/Dragon-Logo.png">
</head>
<body>

 <?php require('../resources/pages/nav.php'); ?>

     <div class="eight columns center-column">
                        <div class="eight columns center-column">
                            <div class="row">
                                    <h2><center>Input Points</center></h2>
                            </div>

                        <div class="grouping">
<form action="../classedit/index.php/?id="<?=id ?> >
        <div class="inputs" align="center">

        <br/>
        <br/>
                    <div class="row" ng-repeat="x in teams">
                        <label class="u-pull-left">x.name;</label>
                        <input class="u-pull-right" type="text" disabled value=x.points>
                        <input class="u-pull-right" type="button" value="Change">
                        <input class="u-pull-right" type="button" value="Done">
                    </div>
            </div>

        </div>



</form>


                        <div id="footer" class="footer row">
                            <span>&copy; 2016 <a href="index.html">Discussions and Dragons.</a> All rights reserved.</span>
                        </div>
                    </div>
                </div>
    </div>
</div>
</body>
</html>

