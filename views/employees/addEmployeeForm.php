<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Add an Employee</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class='container'>

			<h3>Add an Employee: </h3>
			
			<form action='addEmployees.php' method='post' onsubmit="return validate(this)">
				<fieldset>
					<legend>Add an Employee</legend>
					<label>Name </label>
					<input type='text' id='user_id' name='user_id'/><br/><br/>
					<label>User Name </label>
					<input type='text' id='user_name' name='user_name'/><br/><br/>
					<label>Password </label>
					<input type='text' id='user_password' name='user_password' /><br/><br/>
                                        <label>User Level </label>
                                        <input type='number' id='user_level' name='user_level' /><br/><br/>
					<input type="submit" name="submit" value="Submit">
					<button type='button' onclick="window.location.href = '../dbmaintenance.html';">Cancel</button>
				</fieldset>
			</form>
		</div>

	<div class="container" style='margin-top:2em'>
		<center><a href='../dbmaintenance.html'>dbmaintenance</a></center>
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