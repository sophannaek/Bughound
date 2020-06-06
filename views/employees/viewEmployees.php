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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	</head>
	<body>	
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<a class="navbar-brand" href="#">Bughound</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarText">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="../../homepage.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../dbmaintenance.php">Database Maintenance</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="#">Employee<span class="sr-only">(current)</span></a>
						</li>
						
					</ul>
					<span class="navbar-text">
					Welome back <b><i><?php  echo $user ?> </i></b> !
				</span>
				</div>
			</nav>
    <div class='container'>
      <center><h3>List of all Employees:</h3></center>
    </div>


<?php


  	echo "<center><table class='table table-striped' style='width:500px;text-align:center;border-bottom:1px solid lightgrey;'><tr><th>ID<th>".
      "Name</th><th>Username</th><th>Password</th><th>Level</th></tr>";

			
	foreach($employees as $employee){
		echo '<tr>';
		echo "<td><a href='editEmployeeForm.php?eid=".$employee['emp_id']."'>".$employee['emp_id'].'</td><td>'. $employee['name']

		.'</td><td>'.$employee['username'].'</td><td>'.$employee['password'].'</td><td>'.$employee['userlevel'].'</td><td>';
	}

	echo "</tr></table></center>";

?>

</body>
</html>