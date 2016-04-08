<?php

/*=========================================================
 *
 * deleteclasses.php
 *
 * deletes classes from classlist.php page
 *
 ========================================================*/

session_start();

if(empty($_SESSION["tid"]))
{
    header("Location: ../");
}
else
{
    require('../database/db.php');
    $mysqli = ConnectToDatabase();

    //$classList = $_GET['classes'];
    $classList = json_decode(file_get_contents('php://input'), true);
    $argNum = count($classList);

    // handle single or multiple class deletion
    if($argNum == 1)
    {
      $gsq = "DELETE FROM grade_scale
              WHERE ClassID=$classList[0]";
      $tsq = "DELETE FROM team
              WHERE ClassID=$classList[0]";
      $sql = "DELETE FROM class
              WHERE ClassID = $classList[0]";
    }
    else if($argNum > 1)
    {


      /*
      // determine grade_scale query
      $gsq = "DELETE FROM grade_scale
              WHERE ClassID IN(";
      $finalIndex = $argNum - 1;
      for($i = 0; $i < $argNum; $i++)
      {
        if($i != $finalIndex)
         $gsq .= $classList[$i] . ",";
        else
          $gsq .= $classList[$i] . ");";
      }

      // determine team query
      $tsq = "DELETE FROM team
              WHERE ClassID IN(";
      $finalIndex = $argNum - 1;
      for($i = 0; $i < $argNum; $i++)
      {
        if($i != $finalIndex)
         $tsq .= $classList[$i] . ",";
        else
          $tsq .= $classList[$i] . ");";
      }

      // determine class query
      $sql = "DELETE FROM class
              WHERE ClassID IN(";
      $finalIndex = $argNum - 1;
      for($i = 0; $i < $argNum; $i++)
      {
        if($i != $finalIndex)
         $sql .= $classList[$i] . ",";
        else
          $sql .= $classList[$i] . ");";

    }

    $gradeGood = false;
    $teamGood  = false;
    // run grade_scale query
    if($grade_scale = $mysqli->query($gsq))
    {
      $gradeGood = true;
    }
    else
    {
      mysqli_error($mysqli);
    }

    // run teams query
    if($teams = $mysqli->query($tsq) )
    {
      $teamGood = true;
    }
    else
    {
      mysqli_error($mysqli);
    }
*/
    // execute class query
    if($classes = $mysqli->query($sql) )
    {
      echo 'success' ;
    }
    else
    {
      echo ' failure ';
      echo $classes;
      mysqli_error($mysqli);
    }
}
?>
