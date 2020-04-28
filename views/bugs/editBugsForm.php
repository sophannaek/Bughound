<?php
    session_start();
    require_once '../../db/dbConnection.php';
    
    if (isset($_SESSION['username'])){
        $user=$_SESSION['username'];
        $userlevel = getUserLevel($user)['userlevel'];
    }else{
        echo "not logged in";
    }
  
    if(isset($_GET['bid'])){
        $bug_id = $_GET['bid'];
        $bug = getBug($bug_id);
    }

    $programs = getPrograms();
    $employees = getEmployees();
    $areas = getAllAreas();
    $progid=$bug['prog_id'];
    $prog = getProgram($progid);

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Bug Update</title>
		<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>
	<body>
		<center><h3>Update Bug Page for bug #<?php echo $bug_id ?></h3></center>
		<hr/>
		<form action='updateBugs.php' method='post'>
			<label>Program</label>
			<select id='prog_name' name='prog_id'>
				<option value="none" selected disabled hidden> <?php echo $prog['program'] ?> </option> 
				<?php
					foreach($programs as $program){
						echo "<option value ='".$program['prog_id']."'>".$program['program']."</option>";
					}

				?>
			
			</select>
			<label> Report Type</label>
			<select id='reportType' name="reportType">
				<option value="none" selected disabled hidden> <?php echo $bug['reportType'] ?> </option> 
				<option value="Design Issue">Design Issue</option>
				<option value="Coding Error">Coding Error</option>
				<option value='Suggestion'>Suggestion</option>
				<option value='Documentation'>Documentation</option>
				<option value='Hardware'>Hardware</option>
				<option value='Query'>Query</option>
			</select>
			<label>Severity</label>
			<select id='severity' name='serverity' value="<?php echo $reportType ?>">
				<option value="none" selected disabled hidden> <?php echo $bug['severity'] ?> </option> 		
				<option value='Minor'>Minor</option>
				<option value='Serious'>Serious</option>
				<option value='Fatal'>Fatal</option>
				
			</select>
			<p>
			<label>Problem Summary: </label>
				<input type='text' id='prob_summary' name='prob_summary' size='50' value='<?php echo $bug['problemSummary'] ?>'/>
			<label>Reproducible? </label>
			<input type='checkbox' id='reproducible' name='reproducible' value='<?php echo $bug['reproducible'] ?>'>
			
			</p>
			<p>
				<label>Problem: </label>
				<textarea name='problem' id='problem' style="margin-bottom:-10px; width:300px" value='<?php echo $bug['problem'] ?>'></textarea>
		
			</p>
			<p>
				<label>Reported By</label>
				<!-- extract employees from the database --> 
				<select id="assigner" name='reportedBy'>
					<option value="none" selected disabled hidden> <?php echo $bug['reportedBy'] ?> </option> 
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='date' placeholder='YYYY-MM-DD' name='reportedByDate' min="2018-01-01" max="2022-12-31" value='<?php echo $bug['problem'] ?>'/>
			</p>
			<hr/>
			<p>
				<label> Functional Area</label>
				<select id='functional_area' name='functionalArea'>
					<option value="none" selected disabled hidden> <?php echo $bug['functionalArea'] ?> </option> 
					<?php 
						foreach($areas as $area){
							echo "<option value ='".$area['area_id']."'>".$area['area']."</option>";
						}
					?>
				</select>
				<label>Assigned To </label>
				<select id='assignedTo' name='assignedTo'>
				<!-- extract to the database -->
					<option value="none" selected disabled hidden> <?php echo $bug['assignedTo'] ?> </option> 
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
			</p>
			<p>
				<label>Comments: </label>
				<textarea name='comments' id='comments' style="margin-bottom:-10px; width:300px" value='<?php echo $bug['comments'] ?>'></textarea>
			
			</p>
			<p>
				<label>Status</label>
				<select id='status' name='status'>
					<option value="none" selected disabled hidden> <?php echo $bug['bugStatus'] ?> </option> 					
					<option value="Open">Open</option>
					<option value='Closed or Open'>Closed or Open</option>
					<option value='Closed'>Closed</option>
					<option value='Resolved'>Resolved</option>
				</select>
				
				<label>Priority</label>
				<select id='priority' name='priority'>
					<!-- assigned by manager only  -->
					<option value="none" selected disabled hidden> <?php echo $bug['priority'] ?> </option> 
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
					<option value="none" selected disabled hidden> <?php echo $bug['resolution'] ?> </option> 
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
				<input type='text' id='resolutionVersion' name='resolutionVersion' value='<?php echo $bug['resolutionVersion'] ?>'/>

				
			</p>
			<p>
				<label>Resolved By</label>
				<select name='resolvedBy'>
					<option value="none" selected disabled hidden> <?php echo $bug['resolvedBy'] ?> </option> 
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='text' id='resolvedByDate' name='resolvedByDate' value='<?php echo $bug['resolvedByDate'] ?>'/>
				<label>Tested by</label>
				<select name='testedBy'>
					<option value="none" selected disabled hidden> <?php echo $bug['testedBy'] ?> </option> 
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='text' id='date' name='testedByDate' value='<?php echo $bug['testedByDate'] ?>'/>
				<label>Treat as Deferred ?</label>
				<input type='checkbox' id='deferred' name='deferred' value='<?php echo $bug['treatedAsDeferred'] ?>' />
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
