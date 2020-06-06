<?php 
	require_once '../../db/dbConnection.php';
	$programList = getPrograms();
	
	if (isset($_GET['program'])) {
		$prog_id = $_GET['program'];
		$areas = getAreas($prog_id);
		$prog = getProgram($prog_id);
	}
	else {
		$prog_id = 0;
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Add/Edit Areas</title>
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
						<a class="nav-link" href="#">Add/Edit Area <span class="sr-only">(current)</span></a>
					</li>
					
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
			</span>
			</div>
		</nav>
		<div class="container">
			<br>
			<center><h2>Add/Edit Area</h2></center>
			<center>
				<form action="addEditAreas.php" method="get">
				<select name = "program">
					<option value="">Select Program</option>
					<?php
						foreach ($programList as $program) {
							echo "<option value=" . $program['prog_id'] . ">" . $program['program'] . "-" . $program['program_release'] . "-" . $program['program_version'] . "</option>\n";
						}
					?>
				</select>
				<button type="submit" formatted="get" value="submit" class='btn btn-dark'>submit</button>
				</form>
			</center>
			<?php
				if ($prog_id == 0) {
					echo "<center>Select a program to show areas</center>";
				}
				else {
					echo "<center><h2>" . $prog['program'] . "-" . $prog['program_release'] . "-" . $prog['program_version'] . "</h2></center>";
					echo "<center><table class='table table-striped' frame=\"box\" style=\"border:2px solid\" border=1>";
					echo "<tr><th>Area ID</th><th>Program ID</th><th>Area</th><th></th></tr>";
					foreach ($areas as $area) {
						echo "<tr>";
						echo "<form action=\"updateArea.php\" method=\"post\" onsubmit=\"return checkValue(this)\">";
							echo "<td>" . $area['area_id'] . "<input type=\"hidden\" name=\"area_id\" value=" . $area['area_id'] . "> </td>";
							echo "<td>" . $area['prog_id'] . "<input type=\"hidden\" name=\"prog_id\" value=" . $area['prog_id'] . "> </td>";
							echo "<td><input type=\"text\" name=\"area\" value=\"" . $area['area'] . "\" size=50 id=\"area\">";
							echo "<td><button class='btn btn-warning' type=\"submit\" name=\"update\">update</button>  <input type=\"button\"  class='btn btn-danger'
							value=\"delete\" onclick=\"location.href='deleteArea.php?area_id=" . $area['area_id'] . "&prog_id=" . $area['prog_id'] . "'\"></td>";
						echo "</form>";
						echo "</tr>";
					}
					
					echo "<tr>";
					echo "<form action=\"addArea.php\" method=\"post\" onsubmit=\"return checkValue(this)\">";
						echo "<td>Add</td>";
						echo "<td>" . $prog_id . "<input type=\"hidden\" name=\"prog_id\" value=" . $prog_id . "> </td>";
						echo "<td><input type=\"text\" name=\"area\" size=50 id=\"area\"></td>";
						echo "<td><button type=\"submit\" formatted=\"post\" name=\"addArea\" class='btn btn-dark'>Add Area</button></td>";
					echo "</form>";
					echo "</tr>";
					echo "</table></center>";
				}
			?>
			
		</div>
	</body>
</html>

<script>
	function checkValue(form) {
		if (form.area.value == "") {
			alert("Warning: area description cannot be empty.");
			return false;
		}
		return true;
	}
</script>
