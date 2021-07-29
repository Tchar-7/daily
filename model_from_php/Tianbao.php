<?php
header("Content-Type: text/html;charset=utf-8");
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");
mysqli_query($conn, "SET NAMES utf8");
if($conn->connect_error){
    die("数据库连接失败".mysqli_connect_error());
}
$name=$_GET['name'];
$userID=$_GET['userID'];
$sex=$_GET['sex'];
$campus=$_GET['campus'];
$category=$_GET['category'];
$departments=$_GET['departments'];
$location1=$_GET['location1'];
$location2=$_GET['location2'];
$phone=$_GET['phone'];
$inside=$_GET['inside'];
$health=$_GET['health'];
$healthinf=$_GET['healthinf'];
$temperature=$_GET['temperature'];
$color=$_GET['color'];
$back=$_GET['back'];
$traffic1=$_GET['traffic1'];
$name2=$_GET['name2'];
$phone2=$_GET['phone2'];
$address=$_GET['address'];
$risk=$_GET['risk'];
$isolation=$_GET['isolation'];
$isolationplace=$_GET['isolationplace'];
$confirm=$_GET['confirm'];
$like=$_GET['like'];
$test=$_GET['test'];
$like2=$_GET['like2'];
$touch=$_GET['touch'];
$likeinf=$_GET['likeinf'];
$like2inf=$_GET['like2inf'];
$touchinf=$_GET['touchinf'];
$gotorisk=$_GET['gotorisk'];
$gotoriskinf=$_GET['gotoriskinf'];
$backfrom=$_GET['backfrom'];
$backfromtime=$_GET['backfromtime'];
$country=$_GET['country'];
$traffic2=$_GET['traffic2'];
$agree=$_GET['agree'];
$plane=$_GET['plane'];
$train=$_GET['train'];
$bus=$_GET['bus'];
$ship=$_GET['ship'];
$car=$_GET['car'];
$other=$_GET['other'];
$plane_inf=$_GET['plane_inf'];
$train_inf=$_GET['train_inf'];
$bus_inf=$_GET['bus_inf'];
$ship_inf=$_GET['ship_inf'];
$car_inf=$_GET['car_inf'];
$other_inf=$_GET['other_inf'];
date_default_timezone_set('PRC');
$time=date("Y-m-d H:i:s",time());
$abnormal='';
$state=0;

if(strcmp($health,'不适')==0){
    $abnormal=$abnormal.'身体或心理不适'.$healthinf.'、';

}
if(strcmp($color,'绿码')!=0){
    $abnormal=$abnormal.'健康码为：'.$color.'、';
}
if(strcmp($risk,'是')==0){
    $abnormal=$abnormal.'当前居住地点属于中高风险区'.'、';
}
if(strcmp($isolation,'是')==0){
    $abnormal=$abnormal.'已被隔离，位置：'.$isolationplace.'、';
}
if(strcmp($confirm,'已确诊')==0){
    $abnormal=$abnormal.'已确诊且未治愈'.'、';
}
if(strcmp($like,'是')==0){
    $abnormal=$abnormal.'疑似病例：'.$likeinf.'、';
}
if(strcmp($like2,'是')==0){
    $abnormal=$abnormal.'家人隔离或疑似：'.$like2inf.'、';
}
if(strcmp($touch,'是')==0){
    $abnormal=$abnormal.'14日内与确诊人员接触：'.$touchinf.'、';

}
if(strcmp($gotorisk,'是')==0){
    $abnormal=$abnormal.'14日内去过中高风险地区：'.$gotoriskinf.'、';

}

if(strcmp($back,'NaN-NaN-NaN NaN:NaN:NaN')==0){
    $back='NULL';
}
else{
    $back="'$back'";
}
if(strcmp($backfromtime,'NaN-NaN-NaN NaN:NaN:NaN')==0){
    $backfromtime='NULL';
}
else{
    $backfromtime="'$backfromtime'";
}
if(strcmp($abnormal,'')!=0){
    $state=1;
}

$sql1="insert into basis_info values('$userID','$name','$sex','$campus','$category','$departments','$location1','$location2','$phone','$time')";
$sql2="insert into back_info values('$userID','$backfrom',$backfromtime,'$country','$traffic2','$time','$plane','$train','$bus','$ship','$car','$other','$plane_inf','$train_inf','$bus_inf','$ship_inf','$car_inf','$other_inf')";
$sql3="insert into additional_info values('$userID','$name2','$phone2','$address','$risk','$isolation','$isolationplace','$confirm','$like','$likeinf','$test','$like2','$like2inf','$touch','$touchinf','$gotorisk','$gotoriskinf','$time')";
$sql4="insert into daily_info values('$userID','$inside','$health','$healthinf','$temperature','$color',$back,'$traffic1','$time',$state,'$abnormal')";

$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);

echo $sql1.$sql2.$sql3.$sql4;

$conn->close();
?>