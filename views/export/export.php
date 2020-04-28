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

	if (isset($_POST['type']) && isset($_POST['table'])) {
		switch ([$_POST['type'], $_POST['table']]) {
			case ['ASCII', 'empl']:
				$employees = getEmployees();
				exportASCIIFile($employees, "employees.txt");
			break;
			case ['ASCII', 'prog']:
				$programs = getPrograms();
				exportASCIIFile($programs, "programs.txt");
			break;
			case ['ASCII', 'area']:
				$allAreas = getAllAreas();
				exportASCIIFile($allAreas, "areas.txt");
			break;
			case ['XML', 'empl']:
				$employees = getEmployees();	
				$table = 'employees';
				exportXMLFile($employees, $table);
			break;
			case ['XML', 'prog']:
				$programs = getPrograms();
				$table = 'programs';
				exportXMLFile($programs, $table);
			break;
			case ['XML', 'area']:
				$allAreas = getAllAreas();
				$table = 'areas';
				exportXMLFile($allAreas, $table);
			break;
		}
		
		header("Location: exportForm.php");
	}
?>