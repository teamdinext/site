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

    $sql = "SELECT * FROM class where TeachID = " . $_SESSION["tid"];

    $classes = $mysqli->query($sql);

    $echoString = '';
    if($classes->num_rows == 0)
    {
        $echoString .=  '<h3 style="text-align: center">Hello! <br/>
        It seems that you have no classes registered. <br/> <br/> Oops! </h3>';
    }
    else
    {
        $myArray = array();
        while($class = $classes->fetch_array(MYSQL_ASSOC))
        {
            $myArray[] = $class;
        }
        echo json_encode($myArray);
        print_r($classes);
        foreach($classes as $class)
        {
            $courseCode = htmlspecialchars($class["CourseCode"]);
            $courseId = htmlspecialchars($class["ClassID"]);
            $echoString .= '<div class="row">';
            $echoString .= '<input type="button"
                            ng-class="classes.btnClass()"
                            value="' . $courseCode . '"
                            id="' . $courseId . '"
                            ng-click="classes.handleClick(' . $courseId . ', $event)"/>';
            $echoString .= '</div>';
        }
    }
    echo $echoString;
    
}
?>