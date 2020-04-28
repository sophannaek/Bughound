<?php 
	require_once '../../db/dbConnection.php';
	$bugs = getBugs();
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>View Bugs</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>	
    <div class='container'>
      <center><h3>List of Bugs:</h3></center>
    </div>


<?php


  	echo "<center><table style='width:500px;text-align:center;border-bottom:1px solid lightgrey;'><tr><th>Bug ID<th>".
      "Report Type</th><th>Severity</th><th>Problem Summary</th></tr>";

			
	foreach($bugs as $bug){
	    $prog = getProgram($bug['prog_id']);
		echo '<tr>';
		echo "<td><a href='editBugsForm.php?bid=".$bug['bug_id']."'>".$bug['bug_id']
		
		.'</td><td>'.$prog['program'].'</td><td>'.$bug['reportType'].'</td><td>'.$bug['severity'].'</td><td>'.$bug['problemSummary'].'</td>';
	}
	
	echo "</tr></table></center>";

?>
<div class="container" style='margin-top:2em'>
	<center><button type='button' onclick="window.location.href = '../homepage.php';" >Homepage</button></center>
</div>

</body>
</html>
