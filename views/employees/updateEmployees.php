<?php
    //get the program info
    $emp_id = $_POST['emp_id'];
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_level = $_POST['user_level'];
    $action = $_POST['action'];

    require_once '../../db/dbConnection.php';
  
    if($action =="Update Employee"){
        //echo "updating the program";
        updateEmployee($emp_id, $user_id, $user_name, $user_password, $user_level);

      }else{
        
       // echo "deleting the program<br/>";
        $delete = deleteEmployee($emp_id);
      }



    include 'viewEmployees.php';


?>
