<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}

$ID = $_POST['userID'];

$datetime = array();

$day =date("d",time());

$sql = "select date(apply_date) apply_date from daily_info where ID = '$ID'";
$result = $conn->query($sql);

$applyNum1 = mysqli_num_rows($result);
for($t = 0;$t<$applyNum1;$t++){
    $row=mysqli_fetch_assoc($result);
    $datetime[$t]=$row;
}
echo (json_encode($datetime,JSON_UNESCAPED_UNICODE));

$conn->close();
?>
