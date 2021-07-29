<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
date_default_timezone_set('PRC');
$time=date("Y-m-d H:i:s",time());
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}
$ID = $_POST['userID'];

$sql="select * from apply_for_out where start_time<= '$time' and end_time>= '$time' and userID='$ID'";
$result = $conn->query($sql);
if($result->num_rows>0) {
    echo "在假期中";
}
?>