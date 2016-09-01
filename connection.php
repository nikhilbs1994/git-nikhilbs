<?php
/*
	@author Nikhil
	* @version 1.0
*/
/*
	create connection to databae
	@return connection object
*/	
function db_conn(){
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$db="myproject";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 
	return $conn;
}

?>