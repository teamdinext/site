<?php
    header("Access-Control-Allow-Origin: *");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    session_start();
    require('../database/db.php');
    $mysqli = ConnectToDatabase();
    $searchString = $mysqli->real_escape_string($_POST["username"]);
    // Get the user's info from the Users table
    echo $searchString;
    $sql = "SELECT *
            FROM is410.teacher
            WHERE username = '$searchString'";

    echo 'users selected<br>';
    $result = $mysqli->query($sql) or die("Error");
    $row = $result->fetch_assoc();

    $password = $_POST['password'];
    $password_hash = hash('sha256', $password);
    if ($result->num_rows == 0 || $password_hash != $row["PW"])
    {
        echo "<pre>";
        print_r($row);
        echo "</pre>";
        echo "Your username and password combination is invalid.<br>";
        echo $password_hash . '<br>\n';
        echo $row["PW"];
    }

    else
    {
        session_start();
        $user = $_POST["username"];
        echo $user;
        $_SESSION["login"] = $user;
        //header("Location: index.php");
    }

?>
