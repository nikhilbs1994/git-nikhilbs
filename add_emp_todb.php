
<?php
	/*
	@author Nikhil
	* @version 1.0
	To insert employee  in databse
	*/
	include 'connection.php';
	session_start();
	$conn = db_conn();
	/*Server side validation of input text*/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
			if(empty($_POST['fname'])){
				$_SESSION[status] = "Enter First name";
				header('Location:/myproject/employee_add.php'); die();
				//header("location:javascript://window.history.back()");die();
			}
			if(empty($_POST['lname'])){
				$_SESSION[status] = "Enter Last name";
				header('Location:/myproject/employee_add.php'); die();
				//header("location:javascript://window.history.back()");die();
			}
			if(empty($_POST['phno'])){
				$_SESSION[status] = "Enter Phone number";
				header('Location:/myproject/employee_add.php'); die();
			}else{
				$mobval="/^[1-9][0-9]*$/";
				$phno=$_POST['phno'];
				if(!preg_match($mobval,$phno) || strlen($phno) !== 10){
						$_SESSION[status] = "Invalid Phone number";
						header('Location:/myproject/employee_add.php'); die();
				}
			}
			if(empty($_POST['email'])){
				echo"dsff";
				$_SESSION[status]= "Enter Email";
				header('Location:/myproject/employee_add.php'); die();
			}else{
				$email = $_POST["email"];
				echo $email;
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  	$_SESSION[status] = "Invalid email format";
  					echo ($_SESSION[status]);
					header('Location:/myproject/employee_add.php'); die();
				}
			}
			$_SESSION[status]="";
			$_SESSION[status_emp]="";

	}
	/*Server side validation of input image*/
	$target_file = basename($_FILES["profilepic"]["name"]);
	if(strcmp($target_file,"") != 0){	
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["profilepic"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$check = getimagesize($_FILES["profilepic"]["tmp_name"]);
	    if(file_exists($target_file)){
    		$uploadOk=0;
    		$_SESSION[status]= "File already exists";
    		//header("location:javascript://history.go(-2)");
    	 	header('Location:/myproject/employee_add.php');die();
    	}
 	 	if($check == false) {
			$uploadOk=0;
    		 $_SESSION[status]= "File Not an image";
    	 	header('Location:/myproject/employee_add.php');
   		}	 
    	if($imageFileType!=="jpg" && $imageFileType!=="jpeg" && $imageFileType!=="png" && $imageFileType!=="gif"){
    		$uploadOk=0;
    	 	$_SESSION[status]= "Image Format Not Supported";
    	 	header('Location:/myproject/employee_add.php');die();
    	}
    
		if($uploadOk==0){
			 $_SESSION[status]= "Image not uploaded";
		 	header('Location:/myproject/employee_add.php');
		}else{
			 if(move_uploaded_file($_FILES['profilepic']['tmp_name'], $target_file)){
			 	/*Insertion of data to database*/
		 		$_SESSION[status]= "Image Uploaded";
		 		$sql="INSERT INTO employee(fname,lname,phno,email,image_path) VALUES('".$_POST['fname']."','".$_POST['lname']."','".$_POST['phno']."','".$_POST['email']."','/myproject/".$target_file."');";
				if ($conn->query($sql) === TRUE) {
    				echo "record created successfully";
    				$_SESSION[status]="";
    				$_SESSION[status_emp]="Successfully Added";
    				header('Location:/myproject/employee.php');die();
			} else {
    				echo "Error: " . $sql . "<br>" . $conn->error;die();
    				header('Location:/myproject/employee_add.php');die();
				}
		
			}else{
				$_SESSION[status]= "Image not uploaded";
				header('Location:/myproject/employee_add.php');die();
				}

		 
    		} 
	}else{
			$_SESSION[status] ="No image added";
			header('Location:/myproject/employee_add.php');die();
		}
	
?>





