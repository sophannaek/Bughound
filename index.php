
<?php 

	if(isset($_POST['username'])){
		$user = $_POST['username'];
		$pass = $_POST['password'];
		
		if($user =="" || $pass==""){
			$error="<span style='color:red'>Not all fields were entered!</span> "; 
			
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
		<link rel="stylesheet" type="text/css" href="./views/styles/style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<div class='container' id='login-form' style='margin-top:3em;width:50%; margin-left:25%' >
			<form action='index.php' method='post'>
				<h2 style="color: #14415C">Bughound Software</h2>
				<div class="form-group" >
					
					<input type="text" class="form-control" id='username' name='username' placeholder="Username">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name='password' id='password' placeholder="Password" >
				</div>
				<p><?php if (isset($error)) echo $error; ?></p>
			
				<input type="submit" name='submit' class="btn btn-dark" value='Submit' />
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

