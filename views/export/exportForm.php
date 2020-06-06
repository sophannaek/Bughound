<?php
	session_start();
	require_once '../../db/dbConnection.php';
	
	if (isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$userlevel = getUserLevel($user)['userlevel'];
	} else {
		echo '<script>alert("Error: Not logged in"); window.location.href="../../index.php";</script>';
	}
	
	include 'exportASCII.php';
	include 'exportXML.php';
	
	if (isset($_POST['type'])) $type = $_POST['type'];
		else $type = null;
	if (isset($_POST['table'])) $table = $_POST['table'];
		else $table = null;
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Export</title>
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
						<a class="nav-link" href="#">Export<span class="sr-only">(current)</span></a>
					</li>
					
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
			</span>
			</div>
		</nav>
		<div class="container">
			<br>
			<center><h2>Export</h2></center>
			<center><form action="export.php" method="post">
				<select name="table">
					<option value="empl" <?php if(strcmp($table, 'empl')==0) echo 'selected'; ?>>Employees</option>
					<option value="prog" <?php if(strcmp($table, 'prog')==0) echo 'selected'; ?>>Programs</option>
					<option value="area" <?php if(strcmp($table, 'area')==0) echo 'selected'; ?>>Areas</option>
					<option value="bug" <?php if(strcmp($table, 'bug')==0) echo 'selected'; ?>>Bugs</option>
					<option value="attachment" <?php if(strcmp($table, 'attachment')==0) echo 'selected'; ?>>Attachments</option>
				</select>
				<select name="type">
					<option value="ASCII" <?php if(strcmp($type, 'ASCII')==0) echo 'selected'; ?>>ASCII</option>
					<option value="XML" <?php if(strcmp($type, 'XML')==0) echo 'selected'; ?>>XML</option>
				</select>
				<button type="submit" formatted="post" class='btn btn-light'>download</button>
				<button type="submit" formaction="#" formatted="post" class='btn btn-info'>display</button>
		
			</form><center>
		</div>
		<br>
		<div class="export">
			<?php
				if (isset($_POST['type']) && isset($_POST['table'])) {
					switch ([$_POST['type'], $_POST['table']]) {
						case ['ASCII', 'empl']:
							$employees = getEmployees();
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
						case ['ASCII', 'bug']:
							$allBugs = getBugs();
							exportASCII($allBugs);
						break;
						case ['ASCII', 'attachment']:
							$allAttachments = getAllAttachments();
							exportASCII($allAttachments);
						break;
						case ['XML', 'empl']:
							$employees = getEmployees();
							$table = 'employees';
							displayXML($employees,$table);
						break;
						case ['XML', 'prog']:
							$programs = getPrograms();
                           	$table = 'programs';
							displayXML($programs,$table);
							break;
						case ['XML', 'area']:
							$allAreas = getAllAreas();
							$table = 'areas';
							displayXML($allAreas,$table);
						break;
						case ['XML', 'bug']:
							$allBugs = getBugs();
							$table = 'bugs';
							displayXML($allBugs,$table);
						break;
						case ['XML', 'attachment']:
							$allAttachments = getAllAttachments();
							$table = 'attachments';
							displayXML($allAttachments,$table);
						break;
					}
					exit(0);
				}
			?>
		</div>
	</body>
</html>


