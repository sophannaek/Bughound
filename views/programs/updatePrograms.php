<?php
    //get the program info
    $prog_id = $_POST['prog_id'];
    $prog_name = $_POST['prog_name'];
    $prog_release = $_POST['prog_release'];
    $prog_version = $_POST['prog_version'];
    $action = $_POST['action'];

    require_once '../../db/dbConnection.php';
  
    if($action =="Update Program"){
        updateProgram($prog_id,$prog_name, $prog_release, $prog_version);
      }else{
        $delete = deleteProgram($prog_id);
      }



    include 'viewPrograms.php';


?>
