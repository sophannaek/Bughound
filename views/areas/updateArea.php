<?php 
	require_once '../../db/dbConnection.php';
	$area_id = $_POST['area_id'];
	$prog_id = $_POST['prog_id'];
	$area = $_POST['area'];
	
	$exe = updateArea($area_id, $area);
	if ($exe) {
		header("location: addEditAreas.php?program=" . $prog_id);
	}
	else {
		echo "fail";
	}
?>