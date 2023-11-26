<?php
require('clientModel.php');
$act=$_REQUEST['act'];
switch ($act){
case "listItem":
  $items=getItemList();
  echo json_encode($items);
  return;
case "addItem":
	$jsonStr = $_POST['dat'];
	$item = json_decode($jsonStr);
	addItem($item->name,$item->price,$item->content,$item->number);
	return;
case "delItem":
	$id=(int)$_REQUEST['id'];
	delItem($id);
	return;
case "listItem1":
	$items=getItemList1();
	echo json_encode($items);
	return;
default:
}
?>