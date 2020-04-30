<?php
	session_start();
	require_once '../../db/dbConnection.php';
	
	if (isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$userlevel = getUserLevel($user)['userlevel'];
	} else {
		echo '<script>alert("Error: Not logged in"); window.location.href="../../index.php";</script>';
	}

	if (isset($_FILES['attachment']) && isset($_POST['bug_id'])) {
		$dir = '../attachments/';
		$name = $_FILES['attachment']['name'];
		$file = $dir . basename($name);
		$bug_id = $_POST['bug_id'];
		
		if (move_uploaded_file($_FILES['attachment']['tmp_name'], $file)) {
			addAttachment($bug_id, $name, $file);
			header("location: editBugsForm.php?bid=" . $bug_id);
		}
		else {
			echo '<script>alert("Error: Cannot upload file"); window.location.href="editBugsForm.php?bid='.$bug_id.'";</script>';
		}
	}
	else {
		echo '<script>alert("Error: Cannot upload file"); window.location.href="editBugsForm.php?bid='.$bug_id.'";</script>';
	}
?>