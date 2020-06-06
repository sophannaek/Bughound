<?php 
	// session check
	session_start();
	require_once '../../db/dbConnection.php';
	
	if (isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$userlevel = getUserLevel($user)['userlevel'];
	} else {
		echo '<script>alert("Error: Not logged in"); window.location.href="../../index.php";</script>';
	}

	$programs = getPrograms();
	$employees = getEmployees();
	$areas = getAllAreas();
	
	// get post data
	if (isset($_POST['problem'])) {
		$problem = $_POST['problem'];
	}
	if (!isset($_POST['quick'])) {
		if (isset($_POST['prog_id'])) {
			$prog_id = $_POST['prog_id'];
		}
		if (isset($_POST['reportType'])) {
			$reportType = $_POST['reportType'];
		}
		if (isset($_POST['severity'])) {
			$severity = $_POST['severity'];
		}
		if (isset($_POST['functionalArea'])) {
			$functionalArea = $_POST['functionalArea'];
		}
		if (isset($_POST['assignedTo'])) {
			$assignedTo = $_POST['assignedTo'];
		}
		if (isset($_POST['reportedBy'])) {
			$reportedBy = $_POST['reportedBy'];
		}
		if (isset($_POST['status'])) {
			$status = $_POST['status'];
		}
		if (isset($_POST['priority'])) {
			$priority = $_POST['priority'];
		}
		if (isset($_POST['resolution'])) {
			$resolution = $_POST['resolution'];
		}
	}
	
	// set up SQL
	$SQL = "SELECT bugs.*, programs.* FROM bugs";
	$SQL = $SQL . " INNER JOIN programs ON bugs.prog_id = programs.prog_id WHERE '1=1'";
	if (strcmp($problem, '') != 0) {
		$SQL = $SQL . " AND (bugs.problemSummary LIKE '%$problem%' OR bugs.problem LIKE '%$problem%')";
	}
	if (!isset($_POST['quick'])) {
		if (strcmp($prog_id, 'All') != 0) {
			$SQL = $SQL . " AND bugs.prog_id='$prog_id'";
		}
		if (strcmp($reportType, 'All') != 0) {
			$SQL = $SQL . " AND bugs.reportType='$reportType'";
		}
		if (strcmp($severity, 'All') != 0) {
			$SQL = $SQL . " AND bugs.severity='$severity'";
		}
		if (strcmp($functionalArea, 'All') != 0) {
			$SQL = $SQL . " AND bugs.functionalArea='$functionalArea'";
		}
		if (strcmp($assignedTo, 'All') != 0) {
			$SQL = $SQL . " AND bugs.assignedTo='$assignedTo'";
		}
		if (strcmp($reportedBy, 'All') != 0) {
			$SQL = $SQL . " AND bugs.reportedBy='$reportedBy'";
		}
		if (strcmp($status, 'All') != 0) {
			$SQL = $SQL . " AND bugs.bugStatus='$status'";
		}
		if (strcmp($priority, 'All') != 0) {
			$SQL = $SQL . " AND bugs.priority='$priority'";
		}
		if (strcmp($resolution, 'All') != 0) {
			$SQL = $SQL . " AND bugs.resolution='$resolution'";
		}
	}
	
	$SQL = $SQL . " ORDER BY bug_id";
	
	// get search result
	$bugs = getSearchResult($SQL);
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Bughound - Search Bugs</title>
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
						<a class="nav-link" href="#">Bugs<span class="sr-only">(current)</span></a>
					</li>
					
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
			</span>
			</div>
			</nav>
		<center><h3>Search Bugs Result</h3></center>
		<hr/>
		<div class='container'>

			<center><table class='table table-striped' width='600' frame='box' >
				<tr>
					<th width='10%'><center>Bug ID</center></th>
					<th width='20%'><center>Program</center></th>
					<th width='70%'><center>Summary</center></th>
				</tr>
				<?php
					foreach($bugs as $bug) {
						
						echo "<tr>";
						// clicl bug_id can go to edit page
						echo "<td><a href='editBugsForm.php?bid=" . $bug['bug_id'] . "'>" . $bug['bug_id'] . "</a></td>";
						echo "<td>" . $bug['program'] . " " . $bug['program_release'] . "," . $bug['program_version'] . "</td>";
						echo "<td>" . $bug['problemSummary'] . "</td>";
						echo "</tr>";			
					
					}
				?>
			</table></center>
			<hr/>
			<center>
				<button type='button' onclick="window.location.href = '../../homepage.php';" class='btn btn-warning'>Cancel</button>
				<button type='button' onclick="window.location.href = 'searchBugs.php'" class='btn btn-secondary'>Modify Search</button>
				
			</center>
				</div>
	</body>
</html>