<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Add a program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class='container'>
			<h3>List of all programs: </h3>
			<!-- extract from the database --> 
			<h3>Add a program: </h3>
			
			<form action='addPrograms.php' method='post' onsubmit="return validate(this)">
				<fieldset>
					<legend>Add a program:</legend>
					<label>Program name: </label>
					<input type='text' id='prog_name' name='prog_name'/><br/><br/>
					<label>Program release: </label>
					<input type='number' id='prog_release' name='prog_release'/><br/><br/>
					<label>Program version: </label>
					<input type='number' id='prog_version' name='prog_version' /><br/><br/>
					<input type="submit" name="submit" value="Submit">
					<button type='button'>Cancel</button>
				</fieldset>
			</form>
		</div>

	<div class="container" style='margin-top:2em'>
		<center><a href='../dbmaintenance.html'>dbmaintenance</a></center>
	</div>

	</body>
	<script>
		function validate(theform){
			if(theform.prog_name.value===""){
				alert("Program name field cannot be empty " );
				return false;
			}
			if(theform.prog_release.value ===""){
				alert("Program release field cannot be empty " );
				return false;
			}
			if(theform.prog_version.value ===""){
				alert("Program version field cannot be empty" );
				return false;
			}
			return true; 
		}
	</script>
	
</html>