<?php
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");

if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}
$name=$_GET["name"];
$identity=$_GET["identity"];
$sex=$_GET["sex"];
$userID=$_GET["userID"];
$start=$_GET["start"];
$finish=$_GET["finish"];
$category=$_GET["category"];
$left=$_GET["left"];
$reason=$_GET["reason"];
$other=$_GET["other"];
$stay=$_GET["stay"];
$address=$_GET["address"];
$phone=$_GET["phone"];
$color=$_GET["color"];
$time=date("Y-m-d H:i:s",time());

if(strcmp($category,"其他")==0){
    $category=$other;
}


$sql1="insert into apply_for_out values('$userID','$name','$sex','$identity','$phone','$start','$finish','$left','$reason','$stay','$color','$time')";
$sql2="insert into apply_recording values(recordID,'$userID','外出','$time',0,'')";

$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);
$conn->close();
?>