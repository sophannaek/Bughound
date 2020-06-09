<?php 

require_once '../../db/dbConnection.php';
if(isset($_GET['eid'])){
	$employee_id = $_GET['eid'];
	$employee = getEmployee($employee_id);
}

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
						<a class="nav-link" href="#">Edit Employee</a>
					</li>
		
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
				</span>
			</div>
		</nav>
		<div class='container'>

			<h3>Edit an Employee: </h3>
			<form action='updateEmployees.php' method='POST'>
				<fieldset>
					<legend>Edit an Employee:</legend>
					<label>Employee ID: </label>
					<input type='number' name='emp_id' value="<?php echo $employee_id ?>" /><br/><br/>
					<label>Employee name: </label>
					<input type='text' name='user_id' value="<?php echo $employee['name'] ?>" /><br/><br/>
					<label>Employee username: </label>
					<input type='text' name='user_name' value="<?php echo $employee['username'] ?>"/><br/><br/>
					<label>Employee password: </label>
					<input type='text' name='user_password' value="<?php echo $employee['password'] ?>" /><br/><br/>	
									<label>Employee level: </label>
					<input type='number' name='user_level' value="<?php echo $employee['userlevel'] ?>" /><br/><br/>	
									
					
					<button type='button' onclick="window.location.href = '../dbmaintenance.php';" class='btn btn-warning'>Cancel</button>
					<input type='submit' name='action' Value='Delete Employee' class='btn btn-danger'>
					<input type='submit' name='action' value='Update Employee' class='btn btn-secondary'>
					
					
				</fieldset>
			</form>
	</div>
	</body>
	
</html>