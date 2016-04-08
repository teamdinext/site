<?php
session_start();

if(empty($_SESSION["tid"]))
{
    header("Location: ../");
}
else
{
    require('../database/db.php');
    $mysqli = ConnectToDatabase();

    $sql = "SELECT CourseCode as code, ClassID as id
            FROM class
            WHERE TeachID=$_SESSION[tid]";

    $classes = $mysqli->query($sql);
    $myArray = array();
    while($row = $classes->fetch_assoc()) {
        $myArray[] = $row;
     }
     echo json_encode($myArray);

}
?>
