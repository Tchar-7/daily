<?php
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");

if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}
$ID = $_GET["userID"];
$password = $_GET["password"];
$identity = $_GET["identity"];
$user = array();

$sql = "select * from login_info where ID = '$ID' and psw = '$password' and identity =$identity";
$result = $conn->query($sql);

if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $user[]=$row;
    echo (json_encode($user));
}
else{
    echo '用户名或密码错误';
}
$conn->close();
?>