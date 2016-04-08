<?php
header("Access-Control-Allow-Origin: *");
require('../database.php');
$mysqli = ConnectToDatabase();

    $sql = "SELECT * FROM class";

    $classes = $mysqli->query($sql);

    foreach($classes as $class)
    {
        echo $class["CourseCode"] . "<br>";
    }


?>
