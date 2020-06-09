<?php 

require_once '../../db/dbConnection.php';
if(isset($_GET['pid'])){
	$program_id = $_GET['pid'];
	$program = getProgram($program_id);

}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Edit a program</title>
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
						<a class="nav-link" href="#">Edit Program</a>
					</li>
		
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
				</span>
			</div>
		</nav>
		<div class='container'>
			<h3>Edit a program: </h3>
			<form action='updatePrograms.php' method='POST'>
				<fieldset>
				
					<label>Program ID: </label>
					<input type='number' name='prog_id' value="<?php echo $program_id ?>" /><br/><br/>
					<label>Program name: </label>
					<input type='text' name='prog_name' value="<?php echo $program['program'] ?>" /><br/><br/>
					<label>Program release: </label>
					<input type='number' name='prog_release' value="<?php echo $program['program_release'] ?>"/><br/><br/>
					<label>Program version: </label>
					<input type='number' name='prog_version' value="<?php echo $program['program_version'] ?>" /><br/><br/>		

					<button type='button' onclick="window.location.href = '../dbmaintenance.php';" class='btn btn-warning'>Cancel</button>
					<input type='submit' name='action' Value='Delete Program' class='btn btn-danger'>
					<input type='submit' name='action' value='Update Program' class='btn btn-secondary'>
					
					
				</fieldset>
			</form>
		</div>
		
	</body>
	
</html>