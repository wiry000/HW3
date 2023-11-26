<?php
require('merchantModel.php');

$act=$_REQUEST['act'];
switch ($act) {
case "listJob":
  $jobs=getJobList();
  echo json_encode($jobs);
  return;  
case "addJob":
	$jsonStr = $_POST['dat'];
	$job = json_decode($jsonStr);
	addJob($job->name,$job->price,$job->content);
	return;
case "updateJob":
	$id=(int)$_REQUEST['id'];
	$jsonStr = $_POST['dat'];
	$job = json_decode($jsonStr);
	updateJob($id,$job->name,$job->price,$job->content);
	return;
case "delJob":
	$id=(int)$_REQUEST['id'];
	delJob($id);
	return;
default:
  
}

?>