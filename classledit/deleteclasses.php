<?php
session_start();

if(empty($_SESSION["tid"]))
{
    header("Location: ../");
}
else
{
    echo ' pre DB ';
    require('../database/db.php');
    $mysqli = ConnectToDatabase();
    echo ' post DB ';
    $classList = $_GET['classes'];
    $argNum = count($classList);
    if($argNum == 1)
    {
	echo ' single argument ';
        $sql = "DELETE FROM class where ClassID = " . $classList[0];
    }
    else if($argNum > 1)
    {
        
	echo ' multiple argument ';
        $sql = "DELETE FROM class WHERE ClassID IN(";
        $finalIndex = $argNum - 1;
        for($i = 0; $i < $argNum; $i++) 
        {
            if($i != $finalIndex)
               $sql .= $classList[$i] . ","; 
            else
                $sql .= $classList[$i] . ");";    
        }
        echo '\n' . $sql;
	echo '\n loop completed ';
    }

    if($classes = $mysqli->query($sql))
	{
		echo ' success ' ;	
	}
    else
    {
        echo ' failure ';
    }
    
    echo "<pre>";
    echo print_r($classes);
    echo "</pre>";
    
}
?>
