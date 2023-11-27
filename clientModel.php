<?php
require('dbconfig.php');

function getItemList() //賣家清單
{
    global $db;
    $sql = "select * from sell;";
    $stmt = mysqli_prepare($db, $sql); //建立statement 物件，以便執行SQL
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); //取得查詢結果

    $rows = array(); //要回傳的陣列
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r; //將此筆資料新增到陣列中
    }
    return $rows;
}

function getItemList1() //買家購物車
{
    global $db;
    $sql = "select * from buy;";
    $stmt = mysqli_prepare($db, $sql); //建立statement 物件，以便執行SQL
    mysqli_stmt_execute($stmt); //執行SQL
    $result = mysqli_stmt_get_result($stmt); //取得查詢結果

    $rows = array(); //要回傳的陣列
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r; //將此筆資料新增到陣列中
    }
    return $rows;
}

function addItem($name, $price, $content, $number)
global $db;
    $sql = "select number from buy where name=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 0){
        $total = $number * $price;
        $sql = "insert into buy (name, price, content, number, total) values (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "sisii", $name, $price, $content, $number, $total);
        mysqli_stmt_execute($stmt);
        return true;
    } else {
        $row = mysqli_fetch_assoc($result);
        $newNumber = $row['number'] + $number;
  $total = $newNumber * $price;
        $sql = "update buy set number=?, total=? where name=?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, "iis", $newNumber, $total, $name);
        mysqli_stmt_execute($stmt);
        return true;}
}

function delItem($id)
{
    global $db;

    $sql = "delete from buy where id=?;"; //SQL中的 ? 代表未來要用變數綁定進去的地方
    $stmt = mysqli_prepare($db, $sql); //prepare sql statement
    mysqli_stmt_bind_param($stmt, "i", $id); //bind parameters with variables, with types "sss":string, string ,string
    mysqli_stmt_execute($stmt);  //執行SQL
    return True;
}

?>