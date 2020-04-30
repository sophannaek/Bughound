<?php 
	require_once '../../db/dbConnection.php';
	session_start();
	if (isset($_SESSION['username'])){
        $user=$_SESSION['username'];
        $userlevel = getUserLevel($user)['userlevel'];

    }else{
        echo "please login";
    }
	$bugs = getBugs();
	
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>View Bugs</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<style>
			
		</style>
	</head>
	<body>
	<?php 
		if($userlevel == 1 ){
			echo "<div style='margin-top:5%'>
			<center><h3>***<i>You don't have a permission to update the bug, but you can see the full list of existing bugs 
		below:</i> </h3></center>
			<center><p>-----------------------*******------------------------</p></center>
		</div>	";
			
		}
	?>
	
	
    <div class='container'>
      <center><h3>List of Bugs</h3></center>
    </div>


<?php


  	echo "<center><table style='width:1500px;text-align:center;border-bottom:1px solid lightgrey;'><tr><th width='3%'>Bug ID</th><th width='10%'>Program</th>".
      "<th width='7%'>Report Type</th><th width='8%'>Severity</th><th width='17%'>Problem Summary</th><th width='40%'>Problem</th>".
	  "<th width='7%'>Reported By</th><th width='8%'>Reported Date</th></tr>";

			
	foreach($bugs as $bug){
		echo '<tr>';

		if($userlevel >=2 ){
			echo "<td><a href='editBugsForm.php?bid=".$bug['bug_id']."'>".$bug['bug_id'];
		}
		else{
			echo "<td>".$bug['bug_id'];
		}
		echo '</td><td>'.$bug['program'].' '.$bug['program_release'].','.$bug['program_version'].'</td><td>'.$bug['reportType'].'</td><td>'.$bug['severity'].'</td><td>'.$bug['problemSummary'].'</td>'
			.'<td>'.$bug['problem'].'</td><td>'.$bug['reportName'].'</td><td>'.$bug['reportedByDate'].'</td>';
		
	}
	
	echo "</tr></table></center>";

?>
<div class="container" style='margin-top:2em'>
	<center><button type='button' onclick="window.location.href = '../../homepage.php';" >Homepage</button></center>
</div>

</body>
</html>
