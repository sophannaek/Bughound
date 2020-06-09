<?php
$bug_id = $_POST['bug_id'];
$prog_id = $_POST['prog_id'];
$reportType = $_POST['reportType'];
$severity = $_POST['serverity'];
$problem_summary = addslashes($_POST['prob_summary']);
$problem = addslashes($_POST['problem']);
$suggestedFix = addslashes($_POST['suggestedFix']);
$reportedBy = $_POST['reportedBy'];
$reportedByDate = $_POST['reportedByDate'];
$functionalArea = $_POST['functionalArea'];
$assignedTo = $_POST['assignedTo'];
$comments = addslashes($_POST['comments']);
$status = $_POST['status'];
$priority = $_POST['priority'];
$resolution = $_POST['resolution'];
$resolutionVersion = $_POST['resolutionVersion'];
$resolvedBy =$_POST['resolvedBy'];
$testedBy = $_POST['testedBy'];
$reproducible =$_POST['reproducible'];
$deferred = $_POST['deferred'];


if($_POST['resolvedByDate'] === ''){
    $resolvedByDate = NULL;
}else{
    $resolvedByDate = $_POST['resolvedByDate'] ;
}
if($_POST['testedByDate'] === ''){
    $testedByDate = NULL;
}else{
    $testedByDate = $_POST['testedByDate'] ;
    
}



require_once '../../db/dbConnection.php';


if (isset($_POST['action'])) $action = $_POST['action'];
if($action =="Submit"){
    updateBug($bug_id,$reportType ,$severity, $problem_summary,$reproducible,$problem, $suggestedFix,$reportedBy,
        $reportedByDate, $functionalArea, $assignedTo, $comments, $status, $priority, $resolution, $resolutionVersion,
        $resolvedBy, $resolvedByDate, $testedBy, $testedByDate, $deferred,$prog_id);
    
}

include 'viewBugs.php';


?>