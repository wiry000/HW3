<?php
require('merchantModel.php');
$act=$_REQUEST['act'];
switch ($act) {
case "listItem":
  $items=getItemList();
  echo json_encode($items);
  return;  
case "addItem":
	$jsonStr = $_POST['dat'];
	$item = json_decode($jsonStr);
	addItem($item->name,$item->price,$item->content);
	return;
case "updateItem":
	$id=(int)$_REQUEST['id'];
	$jsonStr = $_POST['dat'];
	$item = json_decode($jsonStr);
	updateItem($id,$item->name,$item->price,$item->content);
	return;
case "delItem":
	$id=(int)$_REQUEST['id'];
	delItem($id);
	return;
default:
}
?>