<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}

$recordID = $_POST['recordID'];
$tongguo = $_POST['tongguo'];
$comment = $_POST['comment'];
$applyName = $_POST['applyName'];
$relativeID =$_POST['relativeID'];
$changeState ='';

$sql1 = "update apply_recording set state= $tongguo, comment = '$comment' where recordID = $recordID ";
echo $sql1;
$conn->query($sql1);
if($tongguo =='2'){ //申请通过
    if($applyName =='教师出差') {
        $changeState = "2";
    }
    elseif ($applyName =='销假申请'){
        $changeState = "4";
    }
}
else{
    if($applyName =='教师出差') {
        $changeState = "1";
    }
    elseif ($applyName =='销假申请'){
        $changeState = "2";
    }
}

if ($applyName =='教师出差' or $applyName =='销假申请') {
    $sql2= "update teacher_out set state = $changeState where ID = $relativeID ";
    echo $sql2;
    $conn->query($sql2);
}
$conn->close();
?>
