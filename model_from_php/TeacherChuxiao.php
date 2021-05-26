<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}

$num=$_GET['num'];
$name=$_GET['name'];
$sex=$_GET['sex'];
$userID=$_GET['userID'];
$start=$_GET['start'];
$finish=$_GET['finish'];
$categor=$_GET['categor'];
$left=$_GET['left'];
$address=$_GET['address'];
$phone=$_GET['phone'];
$time=date("Y-m-d H:i:s",time());

for($i=0;$i<$num;$i++){
    $sql="insert into teacher_out values(ID,'$name','$userID','$sex','$phone','$address[$i]','$start[$i]','$finish[$i]','$time',state)";
    $result = $conn->query($sql);
    $sql2="select max(ID) from teacher_out";
    $result2 = $conn->query($sql2);
    $row = $result2->fetch_assoc();
    $ID=$row['max(ID)'];
    $detail="手机:".$phone."<br>"."出差地址:".$address[$i]."<br>"."开始时间:".$start[$i]."<br>"."结束时间:".$finish[$i]."<br>";


    $sql3="insert into apply_recording values(recordID,$ID,'$userID','$name','教师出差','$time','$detail',0,'');";
    $result3 = $conn->query($sql3);
    echo $sql.$sql2.$sql3.$row;
}


$conn->close();
?>