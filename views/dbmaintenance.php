<?php 
	session_start();
	require_once '../db/dbConnection.php';
	
	if (isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$userlevel = getUserLevel($user)['userlevel'];
	}else{
		echo "not logged in";
	}

	$programs = getPrograms();
	$employees = getEmployees();
	$areas = getAllAreas();

	
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Database Maintenace </title>
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="./styles/style.css">
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
					<a class="nav-link" href="../homepage.php">Home</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="#">Database Maintenance</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">User Level: <?php echo $userlevel ; ?></a>
				</li>
		
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
				</span>
			</div>
		</nav>
		<div class='container-fluid'>
			<ul>
				<li><a href='areas/addEditAreas.php'>Edit/Add Areas</a></li>
				<li><a href='programs/addProgramForm.php'>Add Programs</a></li>
				<li><a href='programs/viewPrograms.php'>Edit Programs</a></li>
				<li><a href='employees/addEmployeeForm.php'>Add Employees</a></li>
				<li><a href='employees/viewEmployees.php'>Edit Employees</a></li>
				<li><a href='export/exportForm.php'>Export Areas</a></li>
			</ul>
		</div>
	
		
		
		
	</body>
	
</html>
