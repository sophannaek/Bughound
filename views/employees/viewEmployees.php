<?php 
	require_once '../../db/dbConnection.php';
	$employees = getEmployees();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Edit an Employee</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>	
    <div class='container'>
      <center><h3>List of all Employees:</h3></center>
    </div>


<?php

//E-add employee level
  	echo "<center><table style='width:500px;text-align:center;border-bottom:1px solid lightgrey;'><tr><th>ID<th>".
      "Name</th><th>Username</th><th>Password</th><th>Level</th></tr>";

			
	foreach($employees as $employee){
		echo '<tr>';
		echo "<td><a href='editEmployeeForm.php?eid=".$employee['emp_id']."'>".$employee['emp_id'].'</td><td>'. $employee['name']

		.'</td><td>'.$employee['username'].'</td><td>'.$employee['password'].'</td><td>'.$employee['userlevel'].'</td><td>';
	}

	echo "</tr></table></center>";

?>
<div class="container" style='margin-top:2em'>
	<center><a href='../dbmaintenance.html'>dbmaintenance</a></center>
</div>
</body>
</html>