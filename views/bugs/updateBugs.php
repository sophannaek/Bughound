<?php
$bug_id = $_POST['bug_id'];
echo $bug_id;
$prog_id = $_POST['prog_id'];
$reportType = $_POST['reportType'];
$severity = $_POST['serverity'];
$problem_summary = $_POST['prob_summary'];
$problem = $_POST['problem'];
$suggestedFix = $_POST['suggestedFix'];
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
$testedBy = $_POST['testedBy'];
$deferred = $_POST['deferred'];
if(!empty($_POST['reproducible'])){
    $reproducible =1 ;
    // echo "not empty";
}else{
    $reproducible =0;
}
if(!empty($_POST['deferred'])){
    $deferred = 1;
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



require_once '../../db/dbConnection.php';


if($action =="Submit"){
    updateBug($bug_id,$reportType ,$severity, $problem_summary,$reproducible,$problem, $suggestedFix,$reportedBy,
        $reportedByDate, $functionalArea, $assignedTo, $comments, $status, $priority, $resolution, $resolutionVersion,
        $resolvedBy, $resolvedByDate, $testedBy, $testedByDate, $deferred,$prog_id);
    
}

include 'viewBugs.php';


?>