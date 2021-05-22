<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}

$ID = $_POST['userID'];
$now=date("Y-m-d H:i:s",time());
$firstDay = date('Y-m-01 00:00:00');

$user = array();

$sql = "select * from personal_info where ID = '$ID' and (time >'$firstDay'and time <'$now')" ;
$result = $conn->query($sql);

if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $user[]=$row;
    echo (json_encode($user,JSON_UNESCAPED_UNICODE));
}

$conn->close();
?>

