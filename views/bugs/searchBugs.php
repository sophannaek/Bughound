<?php 
	// session check
	session_start();
	require_once '../../db/dbConnection.php';
	
	if (isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$userlevel = getUserLevel($user)['userlevel'];
	} else {
		echo '<script>alert("Error: Not logged in"); window.location.href="../../index.php";</script>';
	}

	$programs = getPrograms();
	$employees = getEmployees();
	$areas = getAllAreas();
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Bughound - Search Bugs</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Bughound</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="../../homepage.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../dbmaintenance.php">Database Maintenance</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="#">Bugs<span class="sr-only">(current)</span></a>
					</li>
					
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
			</span>
			</div>
		</nav>
		<center><h3>Search Bugs</h3></center>
		<hr/>
		<center>
			<form action='searchResult.php' method='post'>
				<label>Problem: </label>
				<input type='text' id='problem' name='problem' style='width:350'>
				<input type='submit' name='quick' value='quick search' class='btn btn-info'>
				<table width='400'>
					<tr>
						<th width='40%'></th>
						<th width='60%'></th>
					</tr><tr>
						<td>Program</td>
						<td><select id='prog_name' name='prog_id' style='width:240px'>
							<option value="All" selected>All</option>
							<?php
								foreach($programs as $program){
									echo "<option value ='".$program['prog_id']."'>".$program['program']." ".$program['program_release'].",".$program['program_version']."</option>";
								}
							?>
						</select></td>
					</tr><tr>
						<td>Report Type</td>
						<td><select id='reportType' name='reportType' style='width:240px'>
							<option value="All" selected>All</option>
							<option value="Design Issue">Design Issue</option>
							<option value="Coding Error">Coding Error</option>
							<option value='Suggestion'>Suggestion</option>
							<option value='Documentation'>Documentation</option>
							<option value='Hardware'>Hardware</option>
							<option value='Query'>Query</option>
						</select></td>
					</tr><tr>
						<td>Severity</td>
						<td><select id='severity' name='severity' style='width:240px'>
							<option value="All" selected>All</option>
							<option value='Minor'>Minor</option>
							<option value='Serious'>Serious</option>
							<option value='Fatal'>Fatal</option>
						</select></td>
					</tr><tr>
						<td>Functional Area</td>
						<td><select id='functionalArea' name='functionalArea' style='width:240px'>
							<option value="All" selected>All</option>
							<?php 
								foreach($areas as $area){
									echo "<option value ='".$area['area_id']."'>".$area['area']."</option>";
								}
							?>
						</select></td>
					</tr><tr>
						<td>Assigned To</td>
						<td><select id='assignedTo' name='assignedTo' style='width:240px'>
							<option value="All" selected>All</option>
							<?php 
								foreach($employees as $employee){
									echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
								}
							?>
						</select></td>
					</tr><tr>
						<td>Reported By</td>
						<td><select id='reportedBy' name='reportedBy' style='width:240px'>
							<option value="All" selected>All</option>
							<?php 
								foreach($employees as $employee){
									echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
								}
							?>
						</select></td>
					</tr><tr>
						<td>Status</td>
						<td><select id='status' name='status' style='width:240px'>
							<option value="All" selected>All</option>
							<option value="Open">Open</option>
							<option value='Closed or Open'>Closed or Open</option>
							<option value='Closed'>Closed</option>
							<option value='Resolved'>Resolved</option>
						</select></td>
					</tr><tr>
						<td>Priority</td>
						<td><select id='priority' name='priority' style='width:240px'>
							<option value="All" selected>All</option>
							<option value='Fix immediately'>Fix immediately</option>
							<option value='Fix as soon as possible'>Fix as soon as possible</option>
							<option value='Fix before next milestone'>Fix before next milestone</option>
							<option value='Fix before release'>Fix before release</option>
							<option value='Fix if possible'>Fix if possible</option>
							<option value='Optional'>Optional</option>
						</select></td>
					</tr><tr>
						<td>Resolution</td>
						<td><select id='resolution' name='resolution' style='width:240px'>
							<option value="All" selected>All</option>
							<option value='Pending'>Pending</option>
							<option value='Fixed'>Fixed</option>
							<option value='Irreproducible'>Irreproducible</option>
							<option value='Deferred'>Deferred</option>
							<option value='As designed'>As designed</option>
							<option value='Withdrawal by Reporter'>Withdrawal by Reporter</option>
							<option value='Need More Info'>Need More Info</option>
							<option value='Disagree with Suggestion'>Disagree with suggestion</option>
							<option value='Duplicate'>Duplicate</option>
						</select></td>
					</tr>
				</table>
				<hr/>
				<button type='reset' id='reset' class='btn btn-warning'>Reset</button>
				<input type="submit" name="submit" value="Submit" class='btn btn-secondary'>
				
			</form>
		</center>
	</body>
</html>