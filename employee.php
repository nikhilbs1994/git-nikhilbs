<?php 
/*
	@author Nikhil
	* @version 1.0
*/
include 'header.php'; ?>

<div class = "login" id = "login" style = "width: 900px; height: 600px;">
	<h2>EMPLOYEE DETAILS</h2>
	<div id = "sel_emp">
	<?php
		/*
			Diaplay employee details in table 
		*/
		include 'connection.php';
		$conn = db_conn();
		$sql = "SELECT * FROM employee;";
		$result = $conn->query($sql);
 		if($result->num_rows>0){
 			echo "<table>
 					<tr>
 						<th>Emplyee ID</th>
 						<th>First Name</th>
 						<th>Last Name</th>
 						<th>Phone No.</th>
 						<th>Email</th>
 						<th>Profile Pic</th>
 						<th>options</th>
 					</tr>";
 				while($row = $result->fetch_assoc()){
 				echo "<tr>
 						<td>".$row["empid"]."</td>
 						<td>".$row["fname"]."</td>
 						<td>".$row["lname"]."</td>
 						<td>".$row["phno"]."</td>
 						<td>".$row["email"]."</td>
 						<td><img src=".$row["image_path"]."></td>";
 						/*
							Create button to edit employee details.
							On click button call javascript function upd()  

 						*/

 						echo "<td><button onclick=";
 						$str='"upd(';
 						$str1= ');"';
						echo htmlspecialchars($str,ENT_NOQUOTES);
						echo $row["empid"].",'".$row["fname"]."','".$row["lname"]."','".$row["phno"]."','".$row["email"]."','".$row["image_path"]."'";
 						echo htmlspecialchars($str1,ENT_NOQUOTES);
 						/*
							Create button to delete employee details.
							On click button call javascript function del()  

 						*/
 						echo ">Edit</button><button onclick=";  
 						$str='"del(';
 						$str1= ');"';
 						echo htmlspecialchars($str,ENT_NOQUOTES);
 						echo $row["empid"];
 						echo htmlspecialchars($str1,ENT_NOQUOTES);
 						echo ">Delete</button></td>";


	 			echo "</tr>";	
 				}
 			echo "</table>";
    
 		}else
 		{
 			echo "No Employee Details";
 		}
 		if($_SESSION['status_emp']!= ""){
 			echo $_SESSION['status_emp'];
 		}
	?>

	</div>
	<br>
	<a href="employee_add.php">Add Employee</a>
	<label id="err" name="err"></label>
</div>

<script type="text/javascript">
	/* 
		Javascript function to del employee using  ajax.
		ajax call del_emp.php file
	*/
	function del(empid){
		
					$.ajax({
							url:"del_emp.php",
							type:"POST",
							data: ({empid: empid}),
							success:function(result){
							
									if(result==1){
									//alert("Employee Deleted")
									$('#sel_emp').fadeOut(1000);
									$('#sel_emp').load('sel_emp.php',function(){
        									$('#sel_emp').fadeIn(1000);});
									//$('#se_emp').fadeIn();
									}
						
							}
					});
	}
	/* 
		Javascript function to update employee.
		ajax call upd_emp.php file
	*/
	function upd(empid,fname,lname,phno,email,image_path){
				open("/myproject/upd_emp.php?empid="+empid+"&fname="+fname+"&lname="+lname+"&phno="+phno+"&email="+email+"&profilepic="+image_path,"_self");
	}
</script>

<?php 
	include 'footer.php';
	$_SESSION['status']="";
	$_SESSION['status_emp']="";
	?>