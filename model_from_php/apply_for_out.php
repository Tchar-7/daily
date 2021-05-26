<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
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


$sql1="insert into apply_for_out values(ID,'$userID','$name','$sex','$identity','$phone','$start','$finish','$left','$reason','$stay','$color','$time')";
$conn->query($sql1);
$sql2="select max(ID) num from apply_for_out";
$result2 = $conn->query($sql2);

$row = $result2->fetch_assoc();
$ID=$row['num'];


$detail="手机:".$phone."<br>"."开始时间:".$start."<br>"."结束时间:".$finish."<br>"."是否离开杭州:".$left."<br>"."外出原因:".$reason."<br>"."是否在外留宿:".$stay."<br>"."健康码:".$color;


$sql3="insert into apply_recording values(recordID,$ID,'$userID','$name','外出','$time','$detail',0,'');";
$conn->query($sql3);
$conn->close();
?>