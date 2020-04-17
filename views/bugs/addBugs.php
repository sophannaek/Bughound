<?php 
 //get the input value from addProgramForm
  $prog_name = $_POST['prog_name'];
  $reportType = $_POST['reportType'];
  $severity = $_POST['serverity'];
  $problem_summary = $_POST['problem_summary'];
  $problem = $_POST['problem'];
  $reproducible = $_POST['reproducible'];
  $reportedBy =$_POST['reportedBy'];
  $reportedByDate = $_POST['reportedByDate'];
  $functionalArea = $_POST['functionalArea'];
  $assignedTo = $_POST['assignedTo'];
  $comments = $_POST['comments'];
  $status = $_POST['status'];
  $priority = $_POST['priority'];
  $resolution = $_POST['resolution'];
  $resolutionVersion = $_POST['resolutionVersion'];
  $resolvedBy =$_POST['resolvedBy'];
  $resolvedByDate = $_POST['resolvedByDate'];
  $testedBy = $_POST['testedBy'];
  $testedByDate = $_POST['testedByDate'];
  $deferred = $_POST['deferred'];
  

  //connect the database
  require_once '../../db/dbConnection.php'; 
  echo "adding bugs ...";
 // $prog_added_id = addProgram($prog_name, $prog_release,$prog_version);
 // echo "the program id is";echo $prog_added_id;
 // $programs = getPrograms();


  // $bugs= getBugs();
  // include 'viewBugs.php';
?>
