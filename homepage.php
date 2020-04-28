<?php
	session_start();
	require_once './db/dbConnection.php';
	if (isset($_SESSION['username'])){
		$user =$_SESSION['username'];
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
		<link rel="stylesheet" type="text/css" href="./views/styles/style.css">
		<style>
			body{
				background-color:white;
			}
		</style>
	</head>
	<body>
		<div >
		
			<h3>Welcome to Bughound Software</h3>
			<ul>
				<li><a href='views/bugs/addBugForm.php'>Enter NEW Bug</a></li>
				<li><a href='views/bugs/viewBugs.php'>Update EXISTING Bug</a></li>
				<li><a href='views/bugs/searchBugs.php'>Search For Bugs</a></li>
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
