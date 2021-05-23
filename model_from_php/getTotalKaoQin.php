<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}

$ID = $_POST['userID'];
//$date =$_POST['date'];
$date = '2021-5-22';
$users = array();

$day =date("d",time());

$sql1="select count(*) from daily_info  where date(apply_date)='$date'";
$sql2 = "select p.ID ,name from daily_info d, personal_info  p where date(apply_date)='$date' and d.ID= p.ID";
$result1=$conn->query($sql1);
$result2 = $conn->query($sql2);

echo mysqli_fetch_assoc($result1);

$Num = mysqli_num_rows($result2);
for($t = 0;$t<$Num;$t++){
    $row=mysqli_fetch_assoc($result2);
    $users[$t]=$row;
}

$conn->close();
?>