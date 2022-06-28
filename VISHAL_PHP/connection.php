<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "vishal";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if($conn)
	{
		// echo"Connection Established";
	}
	

	else
	{
	//    echo "connection Failed"; 
	}
?>