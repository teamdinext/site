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

      // create query to update the TEAM table to reflect inputPoints changes
      $sql =    "UPDATE TEAM
                SET NoOfStuds=$data[stuNum], TeamName='$data[name]',
                PointsEarned=$data[points]
                WHERE TeamID=$data[id];";
      echo $sql;

      echo("SQL statement declared. \n");
      $teams = $mysqli->query($sql) or die(mysqli_error($mysqli));

      echo("Exit query run. \n");
      echo '<pre>';
      print_r($teams);
      echo '</pre>';
    }
?>
