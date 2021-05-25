<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}

$apply = array();

$sql1 = "select a.* , p.name from apply_recording a, personal_info p
where state = 0 and a.userID=p.ID" ;
$result = $conn->query($sql1);

$applyNum1 = mysqli_num_rows($result);
for($t = 0;$t<$applyNum1;$t++){
    $row=mysqli_fetch_assoc($result);
    $apply[$t]=$row;
}
echo (json_encode($apply,JSON_UNESCAPED_UNICODE));
$conn->close();
?>