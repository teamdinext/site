<?php

session_start();
if(!empty($_SESSION['tid']))
{
    require('../database/db.php');
    $mysqli = ConnectToDatabase();

    $data = json_decode($_POST);
    $data = json_decode(file_get_contents('php://input'), true);

    if(!empty($data))
    {
        $classID = $data['id'];
        $groups = $data['groups'];

        $sql = "INSERT INTO is410.TEAM
                VALUES(0, $classID, 0, '', 0, null, 0)";

        for($i = 0; $i < $groups; $i++)
          $result = $mysqli->query($sql) or die('error');
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
