<?php

    session_start();
    require('../database/db.php');
    $mysqli = ConnectToDatabase();
    

    $searchString = $mysqli->real_escape_string($_POST["username"]);
    // Get the user's info from the Users table
    echo $searchString;
    $sql = "SELECT * FROM is410.teacher WHERE username = '$searchString'";

    echo 'users selected<br>';
    $result = $mysqli->query($sql) or die("Error");
    $row = $result->fetch_assoc();

    // Enforce that the Password and Confirm Password fields match.
        $password = $_POST['password'];
        $password_hash = hash('sha256', $password . 'lol');
        $userID = '';
        if ($result->num_rows == 0 || $password_hash != $row["PW"])
        {
            header("Location: ../index.php?loginError=true");        
        }
        else
        {
            session_start();
            $user = $_POST["username"];
            echo $user;
            $_SESSION["login"] = $user;
            $_SESSION["firstName"] = $row["FName"];
            $_SESSION["lastName"] = $row["LName"];
            $_SESSION["tid"] = $row["TeachID"];
            //header("Location: index.php");

            header("Location: ../classlist/");
        }
?>
