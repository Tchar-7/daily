<?php
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");

if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}
$ID = $_POST["userID"];

$user = array();

$sql = "select * from pensonal_info where ID = '$ID'";
echo $sql;

$result = $conn->query($sql);

if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    $user[]=$row;
    echo (json_encode($user));
}

$conn->close();
?>
