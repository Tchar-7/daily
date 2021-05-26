<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}

$apply = array();
$recordID = $_POST['recordID'];
$sql1 = "select *  from apply_recording where recordID='$recordID'" ;
$result = $conn->query($sql1);

$row=mysqli_fetch_assoc($result);
$apply=$row;

echo (json_encode($apply,JSON_UNESCAPED_UNICODE));
$conn->close();
?>
