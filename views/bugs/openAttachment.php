<?php
	session_start();
	require_once '../../db/dbConnection.php';
	
	if (isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$userlevel = getUserLevel($user)['userlevel'];
	} else {
		echo '<script>alert("Error: Not logged in"); window.location.href="../../index.php";</script>';
	}
	
	$bug_id = $_POST['bug_id'];
	
	if (isset($_POST['attachments']) && $_POST['attachments']!='') {
		$attachment_id = $_POST['attachments'];
		$attachment = getAttachment($attachment_id);
		echo "<script type='text/javascript' language='Javascript'>window.open('".$attachment['attachment']."');</script>";
	}
	else {
		echo '<script>alert("Error: Cannot open file"); window.location.href="editBugsForm.php?bid='.$bug_id.'";</script>';
	}
?>