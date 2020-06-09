<?php 
 //get the input value from addProgramForm
  $prog_name = $_POST['prog_name'];
  $prog_release = $_POST['prog_release'];
  $prog_version = $_POST['prog_version'];

  //connect the database
  require_once '../../db/dbConnection.php'; 
  $prog_added_id = addProgram($prog_name, $prog_release,$prog_version);
  $programs = getPrograms();
  include 'viewPrograms.php';
?>

