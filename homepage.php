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
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="./views/styles/style.css">
		<style>
			body{
				background-color:white;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Bughound</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">User Level: <?php echo $userlevel ; ?></a>
				</li>
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
				</span>
			</div>
		</nav>
		<div class='container-fluid'>
		
			
			<ul>
				<li><a href='views/bugs/addBugForm.php'>Enter NEW Bug</a></li>
				<li><a href='views/bugs/viewBugs.php'>Update EXISTING Bug</a></li>
				<li><a href='views/bugs/searchBugs.php'>Search For Bugs</a></li>
				<?php 

					if($userlevel == 3){
						echo "<li><a href='./views/dbmaintenance.php'>Database Maintenace</a></li>";
					}

					// echo "<p><i>User: ".$user.'  User Level: '.$userlevel. '</i></p>';
				?>
				
			</ul>

			<button type='button' class='btn btn-warning' onclick="window.location.href = './logout.php';">logout</button>
		</div>

	</body>
	
</html>
