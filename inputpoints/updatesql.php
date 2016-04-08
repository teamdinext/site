<?php
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);

    if(empty($_SESSION["tid"]))
    {
        header("Location: ../");
    }
    else if (empty($data))
    {
    echo 'post empty';
    }
    else
    {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    require('../database/db.php');
    $mysqli = ConnectToDatabase();
 echo("DB connected. \n");
        // create query to update the TEAM table to reflect inputPoints changes
    $sql =    "UPDATE TEAM 
               SET PointsEarned=" . $data[points] . 
             " WHERE TeamID=" . $data[teamId];
        echo("SQL statement declared. \n");
    $teams = $mysqli->query($sql) or die(mysqli_error($mysqli));
         echo("Exit query run. \n");
    }
?>