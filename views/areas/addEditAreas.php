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
	</head>
	
	<body>
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
				<button type="submit" formatted="get" value="submit">submit</button>
				</form>
			</center>
			<?php
				if ($prog_id == 0) {
					echo "<center>Select a program to show areas</center>";
				}
				else {
					echo "<center><h2>" . $prog['program'] . "-" . $prog['program_release'] . "-" . $prog['program_version'] . "</h2></center>";
					echo "<center><table frame=\"box\" style=\"border:2px solid\" border=1>";
					echo "<tr><th>Area ID</th><th>Program ID</th><th>Area</th><th></th></tr>";
					foreach ($areas as $area) {
						echo "<tr>";
						echo "<form action=\"updateArea.php\" method=\"post\">";
							echo "<td>" . $area['area_id'] . "<input type=\"hidden\" name=\"area_id\" value=" . $area['area_id'] . "> </td>";
							echo "<td>" . $area['prog_id'] . "<input type=\"hidden\" name=\"prog_id\" value=" . $area['prog_id'] . "> </td>";
							echo "<td><input type=\"text\" name=\"area\" value=\"" . $area['area'] . "\" size=50>";
							echo "<td><button type=\"submit\" name=\"update\">update</button>  <input type=\"button\" value=\"delete\" onclick=\"location.href='deleteArea.php?area_id=" . $area['area_id'] . "&prog_id=" . $area['prog_id'] . "'\"></td>";
						echo "</form>";
						echo "</tr>";
					}
					
					echo "<tr>";
					echo "<form action=\"addArea.php\" method=\"post\">";
						echo "<td>Add</td>";
						echo "<td>" . $prog_id . "<input type=\"hidden\" name=\"prog_id\" value=" . $prog_id . "> </td>";
						echo "<td><input type=\"text\" name=\"area\" size=50></td>";
						echo "<td><button type=\"submit\" formatted=\"post\" name=\"addArea\">Add Area</button></td>";
					echo "</form>";
					echo "</tr>";
					echo "</table></center>";
				}
			?>
			<br>
			<center><a href='../dbmaintenance.html'>Back to Database Maintenance</a></center>
		</div>
	</body>
</html>