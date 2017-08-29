<?php
include'connect.php';
//include'header.php';
@$message = $_POST['message'];
@$fid = $_POST['frndid'];
$uid = $_SESSION['user_id'];
 if(!empty($message))
{
  $sql = "INSERT INTO `chats`(text,uid,fid) VALUES('$message',$uid,$fid)";
 $conn->exec($sql);
 }

 //echo"SELECT id,`Text`,time FROM `chats` where uid = $uid and fid = $fid ORDER BY `Id` DESC";
$sth = $conn->prepare("SELECT `Text`,u.first_name,time FROM `chats`as c inner join users as u on c.uid=u.user_id where uid = $uid and fid = $fid ORDER BY `Id` DESC");
$sth->execute();
while($result = $sth->fetch(PDO::FETCH_ASSOC))
{
	$time = explode(" ",$result['time'])[1];
 echo $result['first_name']."\n".$result['Text']."\n".'    '.$time;
}
$sth1 = $conn->prepare("SELECT `Text`,u.first_name,time FROM `chats`as c inner join users as u on c.uid=u.user_id where uid = $fid and fid = $uid ORDER BY `Id` DESC");
$sth1->execute();
while($result1 = $sth->fetch(PDO::FETCH_ASSOC))
{
	$time = explode(" ",$result['time'])[1];
 echo $result1['first_name']."\n".$result1['Text']."\n".'    '.$time;
}
 ?>