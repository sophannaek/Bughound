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
	</head>
	<body>
		<center><h3>New Bug Report Entry Page</h3></center>
		<hr/>
		<form action='addBugs.php' method='post'>
			<label>Program</label>
			<select id='prog_name'>
				<!-- need to retrieve data from program table --> 
				<?php
					foreach($programs as $program){
						echo "<option value ='".$program['prog_id']."'>".$program['program']."</option>";
					}

				?>
			
			</select>
			<label> Report Type</label>
			<select id='reportType' name='reportType'>
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
				<input type='text' id='prob_summary' name='prob_summary' size='50' />
			<label>Reproducible? </label>
			<input type='checkbox' id='reproducible' name='reproducible' value=''>
			
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
				<input type='date' id='reportedByDate' name='reportedByDate' min="2018-01-01" max="2018-12-31"/>
			</p>
			<hr/>
			<p>
				<label> Functional Area</label>
				<select id='functional_area'>
					<option></option>
					<?php 
						foreach($areas as $area){
							echo "<option value ='".$area['area_id']."'>".$area['area']."</option>";
						}
					?>
				</select>
				<label>Assigned To </label>
				<select id='assignedTo'>
				<!-- extract to the database -->
					<option></option>
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
				<select id='status'>
					<option value="Open">Open</option>
					<option value='Closed or Open'>Closed or Open</option>
					<option value='Closed'>Closed</option>
					<option value='Resolved'>Resolved</option>
				</select>
				
				<label>Priority</label>
				<select id='priority'>
					<!-- assigned by manager only  -->
					<option value=''></option>
					<?php 
						if ($userlevel == 3){
							echo "<option value='Fix immediately'>Fix immediately</option>
							<option value='Fix as soon as possible'>Fix as soon as possible</option>
							<option>Fix before next milestone</option>
							<option>Fix before release</option>
							<option>Fix if possible</option>
							<option>Optional</option>";
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
				<input type='number' id='resolutionVersion' name='resolutionVersion'/>

				
			</p>
			<p>
				<label>Resolved By</label>
				<select>
					<option></option>
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='text' id='resolvedByDate' name='resolvedByDate'/>
				<label>Tested by</label>
				<select>
					<option></option>
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='text' id='date' name='testedByDate'/>
				<label>Treat as Deferred ?</label>
				<input type='checkbox' id='deferred' name='deferred' value=''>
			</p>
			<p>
				<input type="submit" name="submit" value="Submit">
				<button type='button' id='reset'>Reset</button>
				<button type='button' onclick="window.location.href = '../../homepage.php';">Cancel</button>
			</p>
		</form>
		
	</body>
	<script>
		document.getElementById("reset").addEventListener("click", function(){
			document.getElementById("prog_name").selectedIndex='0';
			document.getElementById("reportType").selectedIndex='0';
			document.getElementById("severity").selectedIndex='0';
			document.getElementById('reproducible').checked = false;
			document.getElementById("prob_summary").value = "";
			document.getElementById('problem').value ="";
			document.getElementById("reportedBy").selectedIndex='0';
			document.getElementById('reportedByDate').value ='';		
			document.getElemnetById('functional_area').selectedIndex ='0';
			document.getElemnetById('assignedTo').selectedIndex ='0';
			document.getElementById('comments').value ="";
			document.getElemnetById('status').selectedIndex ='0';
			document.getElemnetById('priority').selectedIndex ='0';
			document.getElemnetById('resolution').selectedIndex ='0';
			document.getElementById('resolutionVersion').value='';
			document.getElementById('resolvedBy').selectedIndex='0';
			document.getElementById('resolvedByDate').value='';
			document.getElementById('testedBy').selectedIndex = '0';
			document.getElementById('testedByDate').value = '';

			document.getElementById('deferred').checked = false;


		});

	</script>
	
</html>