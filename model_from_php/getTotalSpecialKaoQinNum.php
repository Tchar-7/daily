<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}

$department = $_POST['department'];
$grade = $_POST['grade'];
$date=date("Y-m-d",time());
//$date = '2021-5-22';

$where1 = '';
$where2 = '';
if($department != null){
    $where1 = "department in ('$department[0]'";
    for($t= 1; $t<count($department);$t++){
        $where1 .=",'$department[$t]'";
    }
    $where1 .=") and";
}
if($grade != null){
    $where2 ="(ID like'$grade[0]%'";
    for($t= 1; $t<count($grade);$t++){
        $where2 .=" or ID like'$grade[$t]%'";
    }
    $where2 .=") and";
}
$sql1="select count(*) num from personal_info where $where1 $where2
ID in(select ID from daily_info  where date(apply_date)='$date' and state = 1);";
$result1=$conn->query($sql1);

$number = mysqli_fetch_assoc($result1)['num'];
echo $number;

$conn->close();
?>