<?php
$conn = new mysqli('121.4.31.156',"sqluser","Sqluser1!","dailyCard");

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
$time=date("Y-m-d H:i:s",time());

if($isolation=='是'){
    $isolation=$isolation+':'+$isolationplace;
}
if($like=='是'){
    $like=$like+':'+$likeinf;
}
if($like2=='是'){
    $like2=$like2+':'+$like2inf;
}
if($touch=='是'){
    $touch=$touch+':'+$touchinf;
}
if($gotorisk=='是'){
    $gotorisk=$gotorisk+':'+$gotoriskinf;
}

$sql1="insert into basis_info values('$userID','$name','$sex','$campus','$category','$departments','$location1','$location2')";
$sql2="insert into back_info values('$userID','$backfrom','$backfromtime','$country','$traffic2','$time')";
$sql3="insert into additional_info values('$name2','$phone2','$address','$risk','$isolation','$confirm','$like','$test','$like2','$touch','$gotorisk','$time')";
$sql4="insert into daily_info values('$userID','$inside','$health','$temperature','$color','$back','$traffic1','$time')";

$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);

$conn->close();
?>