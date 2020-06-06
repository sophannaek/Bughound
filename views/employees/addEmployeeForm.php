<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Add an Employee</title>
		<link rel="stylesheet" type="text/css" href="style.css">
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
						<a class="nav-link" href="#">Add Employee <span class="sr-only">(current)</span></a>
					</li>
					
				</ul>
				<span class="navbar-text">
				Welome back <b><i><?php  echo $user ?> </i></b> !
			</span>
			</div>
			</nav>

		<div class='container'>
			
			<form action='addEmployees.php' method='post' onsubmit="return validate(this)">
				<fieldset>
					<legend>Add an Employee: </legend>
					<label>Name </label>
					<input type='text' id='user_id' name='user_id'/><br/><br/>
					<label>User Name </label>
					<input type='text' id='user_name' name='user_name'/><br/><br/>
					<label>Password </label>
					<input type='text' id='user_password' name='user_password' /><br/><br/>
					<label>User Level </label>
					<input type='number' id='user_level' name='user_level' /><br/><br/>
					
					<button type='button' onclick="window.location.href = '../dbmaintenance.php';" class='btn btn-warning'>Cancel</button>
					<input type="submit" name="submit" value="Submit" class='btn btn-secondary'>
				</fieldset>
			</form>
		</div>

	

	</body>
	<script>
		function validate(theform){
			if(theform.user_id.value===""){
				alert("Employee Name field cannot be empty " );
				return false;
			}
			if(theform.user_name.value ===""){
				alert("Employee Username field cannot be empty " );
				return false;
			}
			if(theform.user_password.value ===""){
				alert("Employee Password field cannot be empty" );
				return false;
			}
                        if(theform.user_level.value ===""){
				alert("Employee Level field cannot be empty" );
				return false;
			}
			return true; 
		}
	</script>
	
</html>