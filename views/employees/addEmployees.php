
<?php 
 //get the input value from addEmployeeForm
  $user_id = $_POST['user_id'];
  $user_name = $_POST['user_name'];
  $user_password = $_POST['user_password'];
  $user_level = $_POST['user_level'];

  //connect the database
  require_once '../../db/dbConnection.php'; 
  $emp_added_id = addEmployee($user_id, $user_name,$user_password,$user_level);
  $employees = getEmployees();
  include 'viewEmployees.php';
?>
