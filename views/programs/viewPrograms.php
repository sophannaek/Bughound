<?php 
	require_once '../../db/dbConnection.php';
	$programs = getPrograms();
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
							<a class="nav-link" href="#">Edit Programs <span class="sr-only">(current)</span></a>
						</li>
						
					</ul>
					<span class="navbar-text">
					Welome back <b><i><?php  echo $user ?> </i></b> !
				</span>
				</div>
			</nav>
		<div class='container'>
		<center><h3>List of all programs:</h3></center>
		</div>


	<?php


		echo "<center><table class='table table-striped' frame='box'><tr><th>Program ID<th>".
		"Program Name</th><th>Program Release</th><th>Program Version</th></tr>";

				
		foreach($programs as $program){
			echo '<tr>';
			echo "<td><a href='editProgramForm.php?pid=".$program['prog_id']."'>".$program['prog_id'].'</td><td>'. $program['program']

			.'</td><td>'.$program['program_release'].'</td><td>'.$program['program_version'].'</td><td>';
		}

		echo "</tr></table></center>";

	?>
	
</body>
</html>