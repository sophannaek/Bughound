<?php 
	require_once '../../db/dbConnection.php';
	$area_id = $_GET['area_id'];
	$prog_id = $_GET['prog_id'];
	
	$exe = deleteArea($area_id);
	if ($exe) {
		header("location: addEditAreas.php?program=" . $prog_id);
	}
	else {
		echo "fail";
	}
?>