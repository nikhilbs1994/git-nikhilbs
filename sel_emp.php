<?php
	/*
	@author Nikhil
	* @version 1.0
	Display empyee deatils in table and used in ajax call
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
 						echo "<td><button onclick=";
 						$str='"upd(';
 						$str1= ');"';
						echo htmlspecialchars($str,ENT_NOQUOTES);
						echo $row["empid"].",'".$row["fname"]."','".$row["lname"]."','".$row["phno"]."','".$row["email"]."','".$row["image_path"]."'";
 						echo htmlspecialchars($str1,ENT_NOQUOTES);

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
 		if($_SESSION[status_emp]!= ""){
 			echo $_SESSION[status_emp];
 		}
	?>