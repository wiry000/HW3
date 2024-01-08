<?php
require('dbconfig.php');
function getOrderList() //列出客戶訂單
{
	global $db;
	$sql = "select * from `order` where status='已送達' or status='寄送中' or status='已寄送';";
	$stmt = mysqli_prepare($db, $sql ); //precompile sql指令，建立statement 物件，以便執行SQL
	mysqli_stmt_execute($stmt); //執行SQL
	$result = mysqli_stmt_get_result($stmt); //取得查詢結果

	$rows = array(); //要回傳的陣列
	while($r = mysqli_fetch_assoc($result))
    {
		$rows[] = $r; //將此筆資料新增到陣列中
	}
	return $rows;
}
function markOrderDelivered($id) //已送達
{
    global $db;
    $status = '已送達';
    $sql = "UPDATE `order` SET status=? WHERE id=?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    mysqli_stmt_execute($stmt);
    return true;
}
function markOrderShipped($id) //已寄送
{
    global $db;
    // 先檢查是否已經是已送達
    $currentStatus = getCurrentStatus($id);
    if ($currentStatus !== '已送達') {
        $status = '已寄送';
        $sql = "UPDATE `order` SET status=? WHERE id=?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        mysqli_stmt_execute($stmt);
        return true;
    }
    return false;
}

function getCurrentStatus($id) {
    global $db;
    $sql = "SELECT status FROM `order` WHERE id = ?";
    $stmt = mysqli_prepare($db, $sql);
    if (!$stmt) {
        die('SQL 錯誤: ' . mysqli_error($db));
    }
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (!mysqli_stmt_execute($stmt)) {
        die('執行 SQL 錯誤: ' . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_bind_result($stmt, $status);
    if (mysqli_stmt_fetch($stmt)) {
        return $status;
    }
    return null;
}
?>