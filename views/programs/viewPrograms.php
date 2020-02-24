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
	</head>
	<body>	
    <div class='container'>
      <center><h3>List of all programs:</h3></center>
    </div>


<?php


  	echo "<center><table style='width:500px;text-align:center;border-bottom:1px solid lightgrey;'><tr><th>Program ID<th>".
      "Program Name</th><th>Program Release</th><th>Program Version</th></tr>";

			
	foreach($programs as $program){
		echo '<tr>';
		echo "<td><a href='editProgramForm.php?pid=".$program['prog_id']."'>".$program['prog_id'].'</td><td>'. $program['program']

		.'</td><td>'.$program['program_release'].'</td><td>'.$program['program_version'].'</td><td>';
	}

	echo "</tr></table></center>";

?>
<div class="container" style='margin-top:2em'>
	<center><a href='../dbmaintenance.html'>dbmaintenance</a></center>
</div>
</body>
</html>