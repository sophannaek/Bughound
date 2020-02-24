<?php 

require_once '../../db/dbConnection.php';
if(isset($_GET['pid'])){
//	echo "yes";
	$program_id = $_GET['pid'];
	echo $program_id;
	$program = getProgram($program_id);
	echo $program['program'];
}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Edit a program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>		
		<!-- extract from the database --> 
		<h3>Edit a program: </h3>
		<form action='updatePrograms.php' method='POST'>
			<fieldset>
				<legend>Edit a program:</legend>
				<label>Program ID: </label>
				<input type='number' name='prog_id' value="<?php echo $program_id ?>" /><br/><br/>
				<label>Program name: </label>
				<input type='text' name='prog_name' value="<?php echo $program['program'] ?>" /><br/><br/>
				<label>Program release: </label>
				<input type='number' name='prog_release' value="<?php echo $program['program_release'] ?>"/><br/><br/>
				<label>Program version: </label>
				<input type='number' name='prog_version' value="<?php echo $program['program_version'] ?>" /><br/><br/>		
				<input type='submit' name='action' value='Update Program'>
				<input type='submit' name='action' Value='Delete Program'>
				<input type='submit' name='action' value='Cancel'>
			</fieldset>
		</form>
	</body>
	
</html>