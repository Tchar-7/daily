<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}
date_default_timezone_set('PRC');
$time=date("Y-m-d",time());
$ID = $_POST['userID'];

$sql="select * from teacher_out where state not in (1,4) and userID='$ID'";
$result = $conn->query($sql);
if($result->num_rows>0) {
    echo "正在假期中，请先销假";
}