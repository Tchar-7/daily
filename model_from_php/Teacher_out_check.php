<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}
$time=date("Y-m-d H:i:s",time());
$ID = $_POST['userID'];

$sql="select * from teacher_out where to_days($time)>=to_days(start_time) and to_days($time)<=to_days(end_time)";