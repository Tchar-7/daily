<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}
$time=date("Y-m-d H:i:s",time());
$ID = $_POST['userID'];
$inf=array();

$sql0="select * from additional_info where ID='$ID' and to_days(apply_date)=to_days('$time')";
$result0 = $conn->query($sql0);
if($result0->num_rows>0) {
    while ($row = $result0->fetch_assoc()) {
        echo '今日已经打卡';
    }
}
else{
    $sql1="select * from basis_info where ID='$ID' and to_days(apply_data)=(select max(to_days(apply_date)) from daily_info)";
    $sql2="select * from back_info where ID='$ID' and to_days(apply_data)=(select max(to_days(apply_date)) from daily_info)";
    $sql3="select * from additional_info where ID='$ID' and to_days(apply_data)=(select max(to_days(apply_date)) from daily_info)";
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);
    $row1 = $result1->fetch_assoc();
    $row2 = $result2->fetch_assoc();
    $row3 = $result3->fetch_assoc();
    $inf=array_merge($row1,$row2,$row3);
}
//echo $sql0.$sql1.$sql2.$sql3;
echo (json_encode($inf,JSON_UNESCAPED_UNICODE));
