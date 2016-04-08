<?php


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require('../database.php');
$mysqli = ConnectToDatabase();

	$sql = "SELECT * FROM class";

	$classes = $mysqli->query($sql);

	foreach($classes as $class)
    {
        echo $class["CourseCode"] . "\n";
    }

    print_r($_POST);
?>