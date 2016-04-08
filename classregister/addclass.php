<?php

/*=========================================================
 *
 * addclass.php
 *
 * adds classes from classregister/index.php page
 * takes in a JSON object and performs inserts into the
 * class, grade_scale, and team tables
 *
 ========================================================*/

session_start();
if(!empty($_SESSION['tid']))
{
    require('../database/db.php');
    $mysqli = ConnectToDatabase();

    $data = json_decode(file_get_contents('php://input'), true);

    if(!empty($data))
    {
        /*
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        */
        $teachID = $_SESSION['tid'];
        $courseCode = $data['CourseCode'];
        $courseName = $data['CourseName'];
        $noOfGroups = $data['NoOfGroups'];
        $isCanvasEnabled = $data['IsCanvasEnabled'];
        $world = $data['World'];

        $sql = "INSERT INTO is410.class
                VALUES(0, $teachID, '$courseCode', '$courseName', $noOfGroups, $isCanvasEnabled, '$world');";

        $result = $mysqli->query($sql);
        $classId = $mysqli->insert_id;

        // addScale
        $scale = $data['scale'];
        $IsCanvasEnabled = $data[''];

        $sql = "INSERT INTO is410.grade_scale
                VALUES(0, $classId, $scale[0], $scale[1], $scale[2], $scale[3], $scale[4], $scale[5], $scale[6], $scale[7])";

        $result = $mysqli->query($sql) or die('error: ' . mysqli_error($mysqli));

        // addGroups
        $groups = $noOfGroups;

        $sql = "INSERT INTO is410.TEAM
                VALUES(0, $classId, 0, '', 0, null, 0)";

        for($i = 0; $i < $groups; $i++)
          $result = $mysqli->query($sql) or die('error: ' . mysqli_error($mysqli));
        echo "success";
    }
    else
    {
        echo 'Failure: nothing received';
    }
}
else
{
    header('Location: ../');
}
?>
