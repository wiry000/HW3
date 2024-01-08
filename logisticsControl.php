<?php
// 引入 logisticsModel.php 檔案，其中可能包含了處理訂單相關資料的函式
require('logisticsModel.php');
// 從前端 JavaScript 中取得動作類型（act）
$act = $_REQUEST['act'];
// 根據動作類型進行不同的處理
switch ($act)
{
    case "listOrder": //列出客戶訂單
    // 呼叫 getOrderList 函式取得訂單列表
        $jobs=getOrderList();
        echo json_encode($jobs);
        return; 
    case "markDelivered": //已送達
        $id = (int)$_REQUEST['id'];     // 從請求中取得訂單識別編號（id）
        markOrderDelivered($id);        // 呼叫 markOrderDelivered 函式標記訂單為已送達
        break;
    case "markShipped": //已寄送
        $id = (int)$_REQUEST['id'];
        markOrderShipped($id);          // 呼叫 markOrderShipped 函式標記訂單為已寄送
        break;
    default:
}
?>
