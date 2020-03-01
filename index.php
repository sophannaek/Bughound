
<?php 

	if(isset($_POST['username'])){
		$user = $_POST['username'];
		$pass = $_POST['password'];
		
		if($user =="" || $pass==""){
			$error="<span style='color:red'>Not all fields were entered!</span> "; 
			echo $error; 
		}else{
		
			echo $user. " ".$pass;
			require_once './db/dbConnection.php';	
		 	$result= isValidUser($user,$pass);
			if($result->num_rows == 0){
				$error="Your Login Name or Password is Invalid"; 

			}else{
				//session_register("username");
				echo "login successfully";
				session_start();
				$_SESSION['username']= $user; 
				$_SESSION['password']= $pass; 
				
			 	header("location: ./homepage.php");
			 }
		}
	}
	
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class='container' style='margin-top:3em;width:60%; margin-left:20%' >
		
			<form action='index.php' method='post'>
				<fieldset>
					<center><legend>Please Log In:</legend> </center><br/>
				<center><label>Username: </label>
					<input type='text' id='username' name='username'/><br/><br/>
					<label>Password: </label>
					<input type='text' id='password' name='password'/><br/><br/>
					</center>
					<center>
						<input type="submit" name="submit"  value="Submit">
						<button type='button' id='cancel'>Cancel</button>
					</center>
				</fieldset>
			</form>
		</div>

	</body>
	<script>
		document.getElementById("cancel").addEventListener("click", function(){
			document.getElementById('username').value = ''; 
			document.getElementById('password').value='';
		});
		function validate(theform){
			if(theform.username.value===""){
				alert("Program name field cannot be empty " );
				return false;
			}
			if(theform.password.value ===""){
				alert("Program release field cannot be empty " );
				return false;
			}
			return true; 
		}
		
	</script>
	
</html>

