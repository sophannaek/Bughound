<?php
	require_once '../../db/dbConnection.php';
	include 'exportASCII.php';
	include 'exportXML.php'
	// include exportXML.php
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Export</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div class="container">
			<br>
			<center><h2>Export</h2></center>
			<center><form action="#" method="post">
				<select name="table">
					<option value="empl">Employees</option>
					<option value="prog">Programs</option>
					<option value="area">Areas</option>
				</select>
				<select name="type">
					<option value="ASCII">ASCII</option>
					<option value="XML">XML</option>
				</select>
				<button type="submit" formatted="post">submit</button>
				<button type="button" onclick="window.location.href = '../dbmaintenance.html';">cancel</button>
			</form><center>
			<br>
			<center>
				<?php
					if (isset($_POST['type']) && isset($_POST['table'])) {
						switch ([$_POST['type'], $_POST['table']]) {
							case ['ASCII', 'empl']:
								$employees = getEmployees();	// I do not find getEmployees function, please check it, thanks.
								exportASCII($employees);
							break;
							case ['ASCII', 'prog']:
								$programs = getPrograms();
								exportASCII($programs);
							break;
							case ['ASCII', 'area']:
								$allAreas = getAllAreas();
								exportASCII($allAreas);
							break;
							case ['XML', 'empl']:
								$employees = getEmployees();	
                                                                $table = 'employees';
								exportXML($employees,$table);
							break;
							case ['XML', 'prog']:
<<<<<<< HEAD
								// programs for XML
								$programs = getPrograms(); 
								exportXML($programs,1);
=======
								$programs = getPrograms();
                                                                $table = 'programs';
								exportXML($programs,$table);
>>>>>>> fdafa4876b216803ab01011cadbf71dd5b5e2e6e
							break;
							case ['XML', 'area']:
								$allAreas = getAllAreas();
                                                                $table = 'areas';
								exportXML($allAreas,$table);
							break;
						}
						exit(0);
					}
				?>
			</center>
		</div>
	</body>
</html>


<a href = "./new.php">chech this</a>