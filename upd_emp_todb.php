<?php
	/*
	@author Nikhil
	* @version 1.0
	update employee details in database 
	*/
	include 'connection.php';
	session_start();
	$conn=db_conn();
	/*Server side validation of input text*/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
			if(empty($_POST['fname'])){
				$_SESSION[status] = "Enter First name";
				header('Location:/myproject/upd_emp.php'); die();
				//header("location:javascript://window.history.back()");die();
			}
			if(empty($_POST['lname'])){
				$_SESSION[status] = "Enter Last name";
				header('Location:/myproject/upd_emp.php'); die();
				//header("location:javascript://window.history.back()");die();
			}
			if(empty($_POST['phno'])){
				$_SESSION[status] = "Enter Phone number";
				header('Location:/myproject/upd_emp.php'); die();
			}else{
				$mobval="/^[1-9][0-9]*$/";
				$phno=$_POST['phno'];
				if(!preg_match($mobval,$phno) || strlen($phno) !== 10){
						$_SESSION[status] = "Invalid Phone number";
						header('Location:/myproject/upd_emp.php'); die();
				}
			}
			if(empty($_POST['email'])){
				echo"dsff";
				$_SESSION[status]= "Enter Email";
				header('Location:/myproject/upd_emp.php'); die();
			}else{
				$email = $_POST["email"];
				echo $email;
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  	$_SESSION[status] = "Invalid email format";
  					echo ($_SESSION[status]);
					header('Location:/myproject/upd_emp.php'); die();
				}
			}

		$_SESSION[status]="";
		$_SESSION[status_emp]="";	

	}
	/*Server side validation of input image*/
	$target_file = basename($_FILES["profilepic"]["name"]);
	if(strcmp($target_file,"") != 0){	
		$target_dir = "uploads/";
		$target_file =$target_dir . basename($_FILES["profilepic"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["profilepic"]["tmp_name"]);
	    if(file_exists($target_file)){
    		$uploadOk = 0;
    		$_SESSION[status] = "File already exists";
    		//header("location:javascript://history.go(-2)");
    	 	header('Location:/myproject/upd_emp.php');die();
   		 }
 		if($check == false) {
			$uploadOk = 0;
    		$_SESSION[status] = "File Not an image";
    	 	header('Location:/myproject/upd_emp.php');
    	}	 
    	if($imageFileType !== "jpg" && $imageFileType !== "jpeg" && $imageFileType !== "png" && $imageFileType !== "gif"){
    		$uploadOk = 0;
    	 	$_SESSION[status] = "Image Format Not Supported";
    	 	header('Location:/myproject/upd_emp.php');die();
    	}
    	if($uploadOk == 0){
		 	$_SESSION[status] = "Image not uploaded";
		 	header('Location:/myproject/upd_emp.php');
		}
		else{
		 	if(move_uploaded_file($_FILES['profilepic']['tmp_name'], $target_file)){
		 		/*Updation of data to database*/
		 	 	$_SESSION[status] = "Image Uploaded";
		 	 	$sql ="select image_path as img from employee where empid='".$_SESSION[empid]."';";
				$result =$conn->query($sql);
 				$data = $result->fetch_assoc();
				$image_path="".$data['img'];
				unlink(ltrim($image_path,"/myproject/"));
		 		$sql="UPDATE employee SET fname = '".$_POST['fname']."',lname='".$_POST['lname']."',phno='".$_POST['phno']."',email='".$_POST['email']."',image_path='/myproject/".$target_file."' WHERE empid = ".$_SESSION[empid].";";
	
 				if ($conn->query($sql) === TRUE) {
    				echo "record created successfully";
    				$_SESSION[status_emp]="Successfully updated";
    				$_SESSION[status]="";
					header('Location:/myproject/employee.php');die();
				} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;die();
    				header('Location:/myproject/upd_emp.php');die();
				}
		
			}else{
		 	 	$_SESSION[status] = "Image not uploaded";
		 	 	header('Location:/myproject/upd_emp.php');die();
		 	}
    	} 
	}else{
		/*Updation of data to database*/
		$sql = "UPDATE employee SET fname = '".$_POST['fname']."',lname='".$_POST['lname']."',phno='".$_POST['phno']."',email='".$_POST['email']."' WHERE empid = ".$_SESSION[empid].";";
 		if ($conn->query($sql) === TRUE) {
    		echo "record created successfully";
    		$_SESSION[status]="";
    		$_SESSION[status_emp] = "Successfully updated";
    		header('Location:/myproject/employee.php');die();
    		//header('Location:/myproject/employee_add.php');die();
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;die();
    		header('Location:/myproject/upd_emp.php');die();
		}
	}
?>

