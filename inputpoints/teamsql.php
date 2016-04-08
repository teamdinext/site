<?php
    session_start();
    if(empty($_SESSION["tid"]))
    {
        header("Location: ../");
    }
    else if(empty($_GET["id"]))
    {}
    else
    {
      require('../database/db.php');
      $mysqli = ConnectToDatabase();

        // create query to pull teams associated with course from $_GET["id"]
      $sql = "SELECT TeamID AS teamId, TeamName AS name, PointsEarned AS points
              FROM team
              WHERE ClassID = " . $_GET["id"];


      $teams = $mysqli->query($sql);
      while($row = $teams->fetch_assoc()) {
          $myArray[] = $row;
       }
       echo json_encode($myArray);
    }
?>