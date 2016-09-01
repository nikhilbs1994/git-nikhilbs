<?php
	/*
	@author Nikhil
	* @version 1.0
	*/
	include 'header.php';
	include 'connection.php';

	$_SESSION['status']="";
	$_SESSION['status_emp']="";
	$GLOBALS['status'] = "";

	/*
		Check user is valid
	*/	
	function login(){
 	
		$conn = db_conn();
		$sql = "SELECT COUNT(*) as total FROM users WHERE username='".$_POST['username']."' AND password='".$_POST['password']."';";
	 	$result=$conn->query($sql);
 		$data=$result->fetch_assoc();
 		//echo $data[total];
 		echo $GLOBALS['status'];
 		if($data['total']==1){
 			$_SESSION['username']=$_POST['username'];
 			header('Location:/myproject/employee.php');
 		}else{
 		
 			$GLOBALS['status'] = "Invalid username and password!";
 		}	
 	
	}

	if(isset($_POST['username'])|| isset($_POST['Password'])){
  	
  		login();
	}

?>

<div class = "login" style = "width:400px; height:300px;">
	<h2>LOG IN</h2>
	<hr>
	<form action = ""  method = "post" >
		Username
		<input type = "text" name = "username" value = "<?php if(isset($_POST['username'])) echo $_POST['username'];  ?>">
		<br><br>
		Password  
		<input type = "password" name = "password" value = "<?php if(isset($_POST['password'])) echo $_POST['password'];  ?>">
		<br>
		<input type = "submit" name = "login" value = "Login">
		<br>
		<label><?php echo $GLOBALS['status'];?></label>
	</form>
</div>

<?php include 'footer.php';

	
 ?>