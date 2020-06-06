<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Add a program</title>
		<link rel="stylesheet" type="text/css" href="style.css">
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
					<li class="nav-item">
						<a class="nav-link" href="../../homepage.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../dbmaintenance.php">Database Maintenance</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="#">Add Program</a>
					</li>
		
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
				</span>
			</div>
		</nav>
		<div class='container'>
		
		
			
			<form action='addPrograms.php' method='post' onsubmit="return validate(this)">
				<fieldset>
					<legend>Add a program:</legend>
					<label>Program name: </label>
					<input type='text' id='prog_name' name='prog_name'/><br/><br/>
					<label>Program release: </label>
					<input type='number' id='prog_release' name='prog_release'/><br/><br/>
					<label>Program version: </label>
					<input type='number' id='prog_version' name='prog_version' /><br/><br/>
					<button type='button' class='btn btn-warning' onclick="window.location.href = '../dbmaintenance.php';">Cancel</button>
					<input type="submit" name="submit" value="Submit" class='btn btn-secondary' >
					
				</fieldset>
			</form>
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