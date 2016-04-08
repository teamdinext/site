<?php

session_start();
if(!empty($_SESSION['tid']))
{
    require('../database/db.php');
    $mysqli = ConnectToDatabase();

    $data = json_decode($_POST);

    /*
     *
     *
     */
    $data = json_decode(file_get_contents('php://input'), true);

    if(!empty($data))
    {
        $classID = $data['id'];
        $scale = $data['data'];
        $IsCanvasEnabled = $data[''];

        $sql = "INSERT INTO is410.grade_scale
                VALUES(0, $classID, $scale[0], $scale[1], $scale[2], $scale[3], $scale[4], $scale[5], $scale[6], $scale[7])";

        $result = $mysqli->query($sql) or die('error');
        echo $classID;
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
