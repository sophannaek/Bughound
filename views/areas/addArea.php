<?php 
	require_once '../../db/dbConnection.php';
	$prog_id = $_POST['prog_id'];
	$area = $_POST['area'];
	
	$exe = addArea($prog_id, $area);
	if ($exe) {
		header("location: addEditAreas.php?program=" . $prog_id);
	}
	else {
		echo "fail";
	}
?>