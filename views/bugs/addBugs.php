<?php 
 //get the input value from addProgramForm
  $prog_id = $_POST['prog_id'];
  $reportType = $_POST['reportType'];
  $serverity = $_POST['serverity'];
  $problem_summary = $_POST['prob_summary'];
  $problem = $_POST['problem'];
  // $reproducible = $_POST['reproducible'];
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
  // $resolvedByDate = $_POST['resolvedByDate'];
  $testedBy = $_POST['testedBy'];
  // $testedByDate = $_POST['testedByDate'];
  $deferred = $_POST['deferred'];
  if(!empty($_POST['reproducible'])){
     $reproducible =1 ;
    // echo "not empty";
  }else{
    $reproducible =0; 
  }
  if(!empty($_POST['deffered'])){
    $deffered = 1;
  }else{
    $deferred = 0; 
  }
  if(!$_POST['assignedTo'] === ''){
    $assignedTo =$_POST['assignedTo'] ;
   // echo "not empty";
  }else{
   $assignedTo = 0;  
  }
  if(!$_POST['resolvedBy'] === ''){
    $resolvedBy =$_POST['resolvedBy'] ;

  }else{
   $resolvedBy = 0; 
  }
  if($_POST['resolvedByDate'] === ''){
    $resolvedByDate = NULL; 
  }else{
   $resolvedByDate = $_POST['resolvedByDate'] ;
   echo "resolvedbydate:....".$resolvedByDate."<br/>";
  }
  if(!$_POST['assignedTo'] === ''){
    $testedBy =$_POST['testedBy'] ;
   
  }else{
   $testedBy = 0;  
  }

  if($_POST['testedByDate'] === ''){
    $testedByDate = NULL; 
  }else{
   $testedByDate = $_POST['testedByDate'] ;
   
  }
  echo "testedbydate:....".$testedByDate."<br/>";
  //connect the database
  require_once '../../db/dbConnection.php'; 

  


   //21 parameters
   $bug_id = addBug($reportType, $serverity,$problem_summary,$reproducible,$problem, $suggestedFix, $reportedBy, $reportedByDate,
   $functionalArea,$assignedTo, $comments, $status,$priority, $resolution, $resolutionVersion, $resolvedBy,$resolvedByDate, $testedBy, 
   $testedByDate, $deferred,$prog_id);

  // include 'viewBugs.php';
?>
