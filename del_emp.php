<?php
/*
	@author Nikhil
	* @version 1.0
	Delete employee row from table
	*/
	include 'connection.php';
	session_start();
	$_SESSION[status] = "";
	$conn = db_conn();
	$sql ="select image_path as img from employee where empid='".$_POST[empid]."';";
	$result =$conn->query($sql);
 	$data = $result->fetch_assoc();
	$image_path="".$data['img'];
	unlink(ltrim($image_path,"/myproject/"));
	$sql = "delete FROM employee where empid='".$_POST[empid]."';";
	$result = $conn->query($sql);
 	echo $result;

?>