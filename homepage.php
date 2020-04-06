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
<html style='background-color:white'>
	<head>
		<meta charset="UTF-8">
		<title>Bughound Homepage</title>
		<link rel="stylesheet" type="text/css" href="./views/styles/style.css">
	</head>
	<body>
		<div>
		
			<h3>Welcome to Bughound</h3>
			<ul>
				<li><a href=''>Enter NEW Bug</a></li>
				<li><a href=''>Update EXISTING Bug</a></li>
				<?php 

					if($userlevel == 3){
						echo "<li><a href='./views/dbmaintenance.html'>Database Maintenace</a></li>";
					}

					echo "<p><i>User: ".$user.'  User Level: '.$userlevel. '</i></p>';
				?>
				
			</ul>

			<button type='button' onclick="window.location.href = './logout.php';">logout</button>
			</div>

	</body>
	
</html>