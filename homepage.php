<?php
	session_start();
	require_once './db/dbConnection.php';
	if (isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$userlevel = getUserLevel($user)['userlevel'];
		
	}else{
		header("location: ./index.php");
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Bughound Homepage</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h3>Welcome to Bughound</h3>
		<ul>
			<li><a href=''>Enter NEW Bug</a></li>
			<li><a href=''>Update EXISTING Bug</a></li>
			<?php 

				if($userlevel == 3){
					echo "<li><a href='dbmaintenance.php'>Database Maintenace</a></li>";
				}

				echo "<p><i>User: ".$user.'User Level: '.$userlevel. '</i></p>';
			?>
			
		</ul>
		
		<a href="./logout.php">logout</a>
	</body>
	
</html>