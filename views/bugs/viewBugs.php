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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<style>
			
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


  	echo "<center><table class='table table-striped' frame='box'><tr><th width='3%'>Bug ID</th><th width='10%'>Program</th>".
      "<th width='7%'>Report Type</th><th width='8%'>Severity</th><th width='17%'>Problem Summary</th><th width='40%'>Problem</th>".
	  "<th width='7%'>Reported By</th><th width='8%'>Reported Date</th></tr>";

			
	foreach($bugs as $bug){
		echo '<tr>';

		if($userlevel >=2 ){
			if($bug['bugStatus']!="Closed"){
				echo "<td><a href='editBugsForm.php?bid=".$bug['bug_id']."'>".$bug['bug_id'];
			}
			
		}
		else{
			if($bug['bugStatus']!="Closed"){
				echo "<td>".$bug['bug_id'];
			}
			
		}
		if($bug['bugStatus']!="Closed"){
			echo '</td><td>'.$bug['program'].' '.$bug['program_release'].','.$bug['program_version'].'</td><td>'.$bug['reportType'].'</td><td>'.$bug['severity'].'</td><td>'.$bug['problemSummary'].'</td>'
			.'<td>'.$bug['problem'].'</td><td>'.$bug['reportName'].'</td><td>'.$bug['reportedByDate'].'</td>';
		}
	}
	
	echo "</tr></table></center>";

?>


</body>
</html>
