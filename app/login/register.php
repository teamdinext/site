<?php
 session_start();

	// For connecting to database
	require("../database/db.php");
    // Connect and select database
	$mysqli = ConnectToDatabase();

    // Get submitted data and verify it wasn't left blank
    $first = trim($mysqli->real_escape_string($_POST['fName']));
    $last  = trim($mysqli->real_escape_string($_POST['lName']));
    $email  = trim($mysqli->real_escape_string($_POST['email']));
	$username = trim($mysqli->real_escape_string($_POST['username']));
	$password = trim($mysqli->real_escape_string($_POST['password']));
    $passwordConfirm = trim($mysqli->real_escape_string($_POST['passwordConfirm']));

    if ($username == '')
		ShowError("Please enter a username.");

    // Don't allow short usernames or usernames with non-alphanumeric characters
	if (strlen($username) < 3 || !ctype_alnum($username))
        ShowError("Please enter a username that is at least 3 characters 
                   and only composed of letters and numbers.");

    if ($password == '')
        ShowError("Please enter a password.");

	// Get the MD5 hash of the password for inserting into the database
	$password_hash = hash('sha256', $password);

	// Insert record into the database
	$sql = "INSERT INTO Teacher 
            VALUES (null, '$first', '$last', '5551234567', '$email', '$username', '$password_hash')";
    
	if ($mysqli->query($sql))
	{
		print "<h1>Account Created</h1>\n" .
		  "<div style='margin: 0pt 10pt 10px 10px;'>" .
		  "<h2>$username</h2></p>\n".
		  "<p><a href='edit_account.php'>Edit Account</a></p>\n";

		// Set session variable for use in other pages
		$_SESSION['username'] = $username;
	}
	else
		ShowError("\n\nError ($mysqli->errno) $mysqli->error<br>SQL = $sql\n");

	$sql = "SELECT * 
            FROM teacher";

	$teachers = $mysqli->query($sql);

	foreach($teachers as $teacher)
    {
        echo $teachers["FName"] . " " . $teachers["LName"] . "<br>";
    }

    function ShowError($error)
    {
        echo "<br><br><br>" . $error . "<br><br><br>";
    }
    ?>