<?php 
	session_start();
	require_once '../../db/dbConnection.php';
	
	if (isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$userlevel = getUserLevel($user)['userlevel'];
	}else{
		echo "not logged in";
	}

	$programs = getPrograms();
	$employees = getEmployees();
	$areas = getAllAreas();

	
?>


<html>
	<head>
		<meta charset="UTF-8">
		<title>Bughound New Bug Page</title>
		<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
				<li class="nav-item active">
					<a class="nav-link" href="../../homepage.php">Home</a>
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
		<center><h3>New Bug Report Entry Page</h3></center>
		<hr/>
		<form action='addBugs.php' method='post'  onsubmit="return validate(this)">
			<label>Program</label>
			<select id='prog_name' name='prog_id'>
				<?php
					foreach($programs as $program){
						echo "<option value ='".$program['prog_id']."'>".$program['program']." ".$program['program_release'].",".$program['program_version']."</option>";
					}
				?>
			
			</select>
			<label> Report Type</label>
			<select id='reportType' name="reportType">
				<option value="Design Issue">Design Issue</option>
				<option value="Coding Error">Coding Error</option>
				<option value='Suggestion'>Suggestion</option>
				<option value='Documentation'>Documentation</option>
				<option value='Hardware'>Hardware</option>
				<option value='Query'>Query</option>
			</select>
			<label>Severity</label>
			<select id='severity' name='serverity'>
				<option value='Minor'>Minor</option>
				<option value='Serious'>Serious</option>
				<option value='Fatal'>Fatal</option>
				
			</select>
			<p>
			<label>Problem Summary: </label>
				<input type='text' id='prob_summary' name='prob_summary' size='100' />
			<label>Reproducible? </label>
			<!-- <input type='checkbox' id='reproducible' name='reproducible'> -->
			<select id='reproducible' name='reproducible'>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option>
			</select>
			
			</p>
			<p>
				<label>Problem: </label>
				<textarea name='problem' id='problem' style="margin-bottom:-10px; width:300px"></textarea>
		
			</p>
			<p>
				<label>Reported By</label>
				<!-- extract employees from the database --> 
				<select id="assigner" name='reportedBy'>
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='date' placeholder='YYYY-MM-DD' name='reportedByDate' min="2020-01-01" max="2050-12-31"/>
			</p>
			<hr/>
			<p>
				<label> Functional Area</label>
				<select id='functional_area' name='functionalArea'>
					<option></option>
					<?php 
						foreach($areas as $area){
							echo "<option value ='".$area['area_id']."'>".$area['area']."</option>";
						}
					?>
				</select>
				<label>Assigned To </label>
				<select id='assignedTo' name='assignedTo'>
				<!-- extract to the database -->
					<option value=''></option>
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
			</p>
			<p>
				<label>Comments: </label>
				<textarea name='comments' id='comments' style="margin-bottom:-10px; width:300px" ></textarea>
			
			</p>
			<p>
				<label>Status</label>
				<select id='status' name='status'>
					<option value="Open">Open</option>
					<option value='Closed or Open'>Closed or Open</option>
					<option value='Closed'>Closed</option>
					<option value='Resolved'>Resolved</option>
				</select>
				
				<label>Priority</label>
				<select id='priority' name='priority'>
					<!-- assigned by manager only  -->
					<option value=''></option>
					<?php 
						if ($userlevel == 3){
							echo "<option value='Fix immediately'>Fix immediately</option>
							<option value='Fix as soon as possible'>Fix as soon as possible</option>
							<option value='Fix before next milestone'>Fix before next milestone</option>
							<option value='Fix before release'>Fix before release</option>
							<option value='Fix if possible'>Fix if possible</option>
							<option value='Optional'>Optional</option>";
						}
					?>
					
				</select>
				<label>Resolution</label>
				<select id='resolution' name='resolution'>
					<option></option>
					<option value='Pending'>Pending</option>
					<option value='Fixed'>Fixed</option>
					<option value='Irreproducible'>Irreproducible</option>
					<option value='Deferred'>Deferred</option>
					<option value='As designed'>As designed</option>
					<option value='Withdrawal by Reporter'>Withdrawal by Reporter</option>
					<option value='Need More Info'>Need More Info</option>
					<option value='Disagree with Suggestion'>Disagree with suggestion</option>
					<option value='Duplicate'>Duplicate</option>
				</select>
				<label>Resolution Version</label>
				<input type='text' id='resolutionVersion' name='resolutionVersion'/>

				
			</p>
			<p>
				<label>Resolved By</label>
				<select name='resolvedBy'>
					<option></option>
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='text' id='resolvedByDate' name='resolvedByDate' placeholder='YYYY-MM-DD'/>
				<label>Tested by</label>
				<select name='testedBy'>
					<option value=null></option>
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='text' id='testedByDate' name='testedByDate' placeholder='YYYY-MM-DD'/>
				<label>Treat as Deferred ?</label>
				<!-- <input type='checkbox' id='deferred' name='deferred' value=''> -->
				<select id='deferred' name='deferred'>
					<option value=''></option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option>
			</select>
			</p>
			<p><?php if (isset($error)) echo $error; ?></p>
			<p>
				<button type='button' onclick="window.location.href = '../../homepage.php';" class='btn btn-danger'>Cancel</button>
				<button type='reset' class='btn btn-warning'>Reset</button>
				<input type="submit" class='btn btn-dark' name="submit" value="Submit">
			</p>
		</form>
		
	</body>
	<script>
		function validate(theform){
			if(theform.prob_summary.value===""){
				alert("Problem Summary field cannot be empty " );
				return false;
			}
			if(theform.problem.value ===""){
				alert("Program cannot be empty " );
				return false;
			}
			if(theform.reportedByDate.value ===""){
				alert("Please enter today's date for this report! " );
				return false;
			}

			
			return true; 
		}
		</div>
	
	</script>
	
</html>