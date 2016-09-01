<?php include 'header.php';
/*
	@author Nikhil
	* @version 1.0
*/
?>
<div class = "login" style = "width: 500px; height: 400px; ">
	<h2>ADD EMPLOYEE</h2>
		 	<form action = "add_emp_todb.php" id = "addemp" method = "post" enctype = "multipart/form-data">
				<label>First Name</label>
				<input type = "text" name = "fname" id = "fname">
				<br>
				<label>Last Name</label>
				<input type = "text" name = "lname" id = "lname">
				<br>
				<label>Phone No.</label>
				<input type = "text" name = "phno" id = "phno">
				<br>
				<label>Email</label>
				<input type = "text" name = "email" id = "email">
				<br>
				<label>Profile Pic </label>
				<input type = "file" name = "profilepic">
				<br>
				<button onclick = "add_emp();return false;">Add empolyee</button>
				<br>
				<p id="error" name="err"></p>
			
			</form>
			
			<?php echo "<br>".$_SESSION['status']; ?>

			<script type = "text/javascript">
			/*
				javascript function for validation and call add_emp_todb.php
			*/
				function add_emp(form){
					var x = document.getElementById("fname").value;
					if(x == null || x == ""){
						document.getElementById("error").innerHTML = "Fisrt Name not entered";
						return false;							
					}
					var x = document.getElementById("lname").value;
					if(x == null || x == ""){
						document.getElementById("error").innerHTML = "Last Name not entered";
						return false;							
					}				
					var x = document.getElementById("phno").value;
					if(x == null || x == ""){
						document.getElementById("error").innerHTML = "Ph No. not entered";
						return false;							
					}
					var x = document.getElementById("email").value;
					if(x == null || x == ""){
					document.getElementById("error").innerHTML = "Email not entered";
					return false;							 
					}
					document.getElementById("addemp").submit();
					return true;
				}
			</script>
	
</div>

<?
	php include 'footer.php';
	$_SESSION[status]="";
	$_SESSION[status_emp]="";

?>