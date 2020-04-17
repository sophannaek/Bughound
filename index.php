
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
	</head>
	<body>
		<div class='container' id='login-form' style='margin-top:3em;width:40%; margin-left:20%' >
		
			<form action='index.php'  method='post'>
					<center><h3>Bughound Software</h3></center>
			
					<input type='text' id='username' placeholder='  username' name='username'/><br/><br/>
					<p>

					<input type='text' id='password' placeholder='  password' name='password'/></p>
					<p><?php echo $error; ?></p>
					<p><input type="submit" id='submit-btn' name="submit"  value="Submit"></p>
					</center>
					<center>
					<p style='color:#0B4C5F'>Forgot Password?</p>
						
						
					</center>
				<!-- </fieldset> -->
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

