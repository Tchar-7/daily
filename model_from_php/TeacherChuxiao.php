<?php
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");

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
    $sql="insert into teacher_out values('$name','$userID','$sex','$phone','$address[$i]','$start[$i]','$finish[$i]','$time')";
    $result = $conn->query($sql);
    $sql1="select max(ID) from teacher_out";
    $result1 = $conn->query($sql1);
    if($result1->num_rows>0) {
        while ($row = $result1->fetch_assoc()) {
            $ID=$row['ID'];
        }
    }
    $ID='TeaOut'.$ID;
    $sql2="insert into apply_recording values('$ID','$userID','出差','$time',0,'')";
    $result2 = $conn->query($sql2);
}


$conn->close();
?>