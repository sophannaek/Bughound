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
$areas = getAreas($bug['prog_id']);
$progid=$bug['prog_id'];
$prog = getProgram($progid);
$attachments = getAttachments($bug_id);

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
		<form action='updateBugs.php' method='post' >
			<input type="hidden" id='bug_id' name='bug_id' value='<?php echo $bug_id; ?>'>
			<label>Program</label>
			<select id='prog_id' name='prog_id'>
				<option value="<?php echo $prog['prog_id']; ?>" selected hidden> <?php echo $prog['program'].' '. $prog['program_release'].' '.$prog['program_version'];?> </option> 
				<?php
					foreach($programs as $program){
						echo "<option value ='".$program['prog_id']."'>".$program['program'].' '.$program['program_release'].' '.$prog['program_version']."</option>";
					}
				?>
			
			</select>
			<label> Report Type</label>
			<select id='reportType' name="reportType">
				<option value="<?php echo $bug['reportType']; ?>" selected hidden> <?php echo $bug['reportType']; ?> </option> 
				<option value="Design Issue">Design Issue</option>
				<option value="Coding Error">Coding Error</option>
				<option value='Suggestion'>Suggestion</option>
				<option value='Documentation'>Documentation</option>
				<option value='Hardware'>Hardware</option>
				<option value='Query'>Query</option>
			</select>
			<label>Severity</label>
			<select id='severity' name='serverity' value="<?php echo $reportType ?>">
				<option value="<?php echo $bug['severity']; ?>" selected hidden> <?php echo $bug['severity']; ?> </option> 		
				<option value='Minor'>Minor</option>
				<option value='Serious'>Serious</option>
				<option value='Fatal'>Fatal</option>
				
			</select>
			<p>
			<label>Problem Summary: </label>
				<input type='text' id='prob_summary' name='prob_summary' size='50' value='<?php echo $bug['problemSummary'] ?>'/>
			<label>Reproducible? </label>
			<select id='reproducible' name='reproducible'>
					<option value="<?php echo $bug['reproducible'] ;?>" selected hidden><?php echo $bug['reproducible']; ?></option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option>
			</select>
			
			</p>
			<p>
				<label>Problem: </label>
				<!-- <?php echo $bug['problem']; ?> -->
				<textarea name='problem' id='problem' style="margin-bottom:-20px; width:300px" value=''><?php echo $bug['problem'] ?></textarea>
		
			</p>
			<p>
				<label>Reported By</label>
				<!-- extract employees from the database --> 
				<select id="reportedBy" name='reportedBy'>
					<option value="<?php echo $bug['reportedBy']; ?>" selected hidden><?php if ($bug['reportedBy']!=0) echo $bug['reportName']; ?></option> 
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='date' placeholder='YYYY-MM-DD' name='reportedByDate' min="2018-01-01" max="2022-12-31" value='<?php echo $bug['reportedByDate'] ?>'/>
			</p>
			<hr/>
			<p>
				<label> Functional Area</label>
				<select id='functional_area' name='functionalArea'>
					<option value="<?php echo $bug['functionalArea']; ?>" selected hidden> <?php if ($bug['functionalArea']!=null) echo $bug['area']; ?> </option> 
					<?php 
						foreach($areas as $area){
							echo "<option value ='".$area['area_id']."'>".$area['area']."</option>";
						}
					?>
				</select>
				<label>Assigned To </label>
				<select id='assignedTo' name='assignedTo'>
				<!-- extract to the database -->
					<option value="<?php echo $bug['assignedTo']; ?> " selected hidden> <?php if ($bug['assignedTo']!=0) echo $bug['assignName']; ?> </option> 
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
			</p>

			<p>
				<label>Suggested Fix: </label>
				<textarea name='suggestedFix' id='suggestedFix' style="margin-bottom:-10px; width:300px"><?php echo $bug['suggestedFix'] ?></textarea>
			
			</p>
			<p>
				<label>Comments: </label>
				<textarea name='comments' id='comments' style="margin-bottom:-10px; width:300px"><?php echo $bug['comments']; ?></textarea>
			
			</p>
			<p>
				<label>Status</label>
				<select id='status' name='status'>
					<option value="<?php echo $bug['bugStatus']; ?>" selected hidden> <?php echo $bug['bugStatus']; ?> </option> 					
					<option value="Open">Open</option>
					<option value='Closed or Open'>Closed or Open</option>
					<option value='Closed'>Closed</option>
					<option value='Resolved'>Resolved</option>
				</select>
				
				<label>Priority</label>
				<select id='priority' name='priority'>
					<!-- assigned by manager only  -->
					<option value="<?php echo $bug['priority']; ?>" selected hidden> <?php echo $bug['priority']; ?> </option> 
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
					<option value="<?php echo $bug['resolution']; ?>" selected hidden> <?php echo $bug['resolution']; ?> </option> 
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
					<option value="<?php echo $bug['resolvedBy']; ?>" selected hidden> <?php if ($bug['resolvedBy']!=0) echo $bug['resolveName'] ?> </option> 
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='text' id='resolvedByDate' name='resolvedByDate' <?php if($bug['resolvedByDate']!='') echo "value='".$bug['resolvedByDate']."'" ?> placeholder='YYYY-MM-DD'/>
				<label>Tested by</label>
				<select name='testedBy'>
					<option value="<?php echo $bug['testedBy']; ?> " selected hidden> <?php if ($bug['testedBy']!=0) echo $bug['testName']; ?> </option> 
					<?php 
						foreach($employees as $employee){
							echo "<option value ='".$employee['emp_id']."'>".$employee['name']."</option>";
						}
					?>
				</select>
				<label>Date</label>
				<input type='text' id='testedByDate' name='testedByDate' <?php if($bug['testedByDate']!='') echo "value='".$bug['testedByDate']."'" ?> placeholder='YYYY-MM-DD'/>
				<label>Treat as Deferred ?</label>
				<!-- <input type='checkbox' id='deferred' name='deferred' <?php if($bug['treatAsDeferred'] == 1) echo "checked"  ?>  /> -->
				<select id='deferred' name='deferred'>
					<option value="<?php echo $bug['treatAsDeferred'] ;?>" selected hidden><?php echo $bug['treatAsDeferred']; ?></option>
					<option value='Yes'>Yes</option>
					<option value='No'>No</option>
			</select>
			</p>
			<p>
				<input type="submit" name="action" value="Submit">
				<button type='button' onclick="window.location.href = '../../homepage.php';">Cancel</button>
			</p>
		</form>
		
		<hr/>
		
		<form action='uploadAttachment.php' method='POST' enctype="multipart/form-data">
			<p>
				<label>Attachments</label>
				<select name='attachments' id='attachments'>
					<?php
						if (count($attachments)==0) {
							echo "<option value =''>None</option>";
						}
						else {
							foreach($attachments as $attachment) {
								echo "<option value='".$attachment['attachment_id']."'>".$attachment['name']."</option>";
							}
						}
					?>
				</select>
				<button type='submit' formaction='openAttachment.php'>Open</button>
			</p>
			<hr/>
			<p>
				<input type="hidden" id='bug_id' name='bug_id' value='<?php echo $bug_id; ?>'>
				<input type="file" name="attachment" />
				<input type='submit' value="Add Attachment" />
			</p>
		</form>
	</body>	
</html>
