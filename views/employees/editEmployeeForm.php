<?php 

require_once '../../db/dbConnection.php';
if(isset($_GET['eid'])){
//	echo "yes";
	$employee_id = $_GET['eid'];
	echo $employee_id;
	$employee = getEmployee($employee_id);
	//echo $employee['employee'];
}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Edit an Employee</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>		
		<!-- extract from the database --> 
		<h3>Edit an Employee: </h3>
		<form action='updateEmployees.php' method='POST'>
			<fieldset>
				<legend>Edit an Employee:</legend>
				<label>Employee ID: </label>
				<input type='number' name='emp_id' value="<?php echo $employee_id ?>" /><br/><br/>
				<label>Employee name: </label>
				<input type='text' name='user_id' value="<?php echo $employee['name'] ?>" /><br/><br/>
				<label>Employee username: </label>
				<input type='text' name='user_name' value="<?php echo $employee['username'] ?>"/><br/><br/>
				<label>Employee password: </label>
				<input type='text' name='user_password' value="<?php echo $employee['password'] ?>" /><br/><br/>	
                                <label>Employee level: </label>
				<input type='number' name='user_level' value="<?php echo $employee['userlevel'] ?>" /><br/><br/>	
                                
				<input type='submit' name='action' value='Update Employee'>
				<input type='submit' name='action' Value='Delete Employee'>
				<input type='submit' name='action' value='Cancel'>
			</fieldset>
		</form>
	</body>
	
</html>