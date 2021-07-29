<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}
date_default_timezone_set('PRC');

$ID = $_POST['ID'];
$userID = $_POST['userID'];

$sql1 = "update teacher_out set state = 3 where ID = $ID"; //更新out数据库
$result = $conn->query($sql1);

$sql2 = "select * from apply_recording where relativeID = '$ID'";
$result = $conn->query($sql2);

$row=mysqli_fetch_assoc($result);
$info=$row;
$name=$info['userName'];
$time=date("Y-m-d H:i:s",time());
$detail = $info['detail'];

$sql3="insert into apply_recording values(recordID,$ID,'$userID','$name','销假申请','$time','$detail',0,'');";
$conn->query($sql3);

//echo $sql3;
$conn->close();
?>