<?php
	if(!isset($_SESSION))
	{
		session_start();
	}

	$SiteURL = "http://localhost/Point";
	$servername = "localhost";
	$username1 = "root";
	$password = "";
	// Create connection
	$conn = mysqli_connect($servername, $username1, $password);
	$db_select = mysqli_select_db($conn, 'Point');
	// Check connection
	/*if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected Successfully";
	if (!$db_select) {
	die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected Successfully";*/
?>
