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

      
      /*=======================================================================
       *
       * query to pull all students in groups associated with a course
       * 
       SELECT * FROM student
       LEFT JOIN (stud_team_int, team, class)
       ON (stud_team_int.StudID=student.StudID 
           AND team.TeamID=stud_team_int.TeamID
           AND class.ClassID=team.ClassID);
       */

      // create query to pull teams associated with course from $_GET["id"]
      $sql = "SELECT TeamID as id, NoOfStuds as stuNum, TeamName as name,
              AvatarLevel as level, AvatarColor as color, PointsEarned as points
              FROM team
              WHERE ClassID = " . $_GET["id"];


      $teams = $mysqli->query($sql);
      while($row = $teams->fetch_assoc()) {
          $myArray[] = $row;
       }
       echo json_encode($myArray);
    }
?>
