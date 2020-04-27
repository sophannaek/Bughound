<?php 
	// session check
	session_start();
	require_once '../../db/dbConnection.php';
	
	if (isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$userlevel = getUserLevel($user)['userlevel'];
	} else {
		echo '<script>alert("Error: Not logged in")</script>';
		header('Location: ../../index.php');
	}

	$programs = getPrograms();
	$employees = getEmployees();
	$areas = getAllAreas();
	
	// get post data
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
	
	// set up SQL
	$SQL = "SELECT bugs.*, programs.program FROM bugs";
	$SQL = $SQL . " INNER JOIN programs ON bugs.prog_id = programs.prog_id WHERE '1=1'";
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
	$SQL = $SQL . " ORDER BY bug_id";
	
	// get search result
	$bugs = getSearchResult($SQL);
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Bughound - Search Bugs</title>
	</head>
	
	<body>
		<center><h3>Search Bugs Result</h3></center>
		<hr/>
		<center><table width='600' frame='box' style='border:2px solid' border='1'>
			<tr>
				<th width='10%'><center>Bug ID</center></th>
				<th width='20%'><center>Program</center></th>
				<th width='70%'><center>Summary</center></th>
			</tr>
			<?php
				foreach($bugs as $bug) {
					echo "<tr>";
					// clicl bug_id can go to edit page
					echo "<td><a href='editBugs.php'>" . $bug['bug_id'] . "</a></td>";
					echo "<td>" . $bug['program'] . "</td>";
					echo "<td>" . $bug['problemSummary'] . "</td>";
					echo "</tr>";
				}
			?>
		</table></center>
		<hr/>
		<center>
			<button type='button' onclick="window.location.href = 'searchBugs.php'">Modify Search</button>
			<button type='button' onclick="window.location.href = '../../homepage.php';">Cancel</button>
		</center>
	</body>
</html>
