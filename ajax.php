<?php
include'connect.php';
$data=@$_POST['sid'];
$page=@$_POST['page'];
if($page=='city'){
$sth =$conn->prepare("Select city_name,id from cities where state_id='$data'");
   $sth->execute();?>
   <div class="col-sm-12 form-group">
<label>City</label>
   <select name='cities' id='cities' class='form-control'>
   <option value=''>Select City</option>
   <?php while($result = $sth->fetch(PDO::FETCH_ASSOC)){
  echo $city=$result['city_name'].'</br>';
  ?>
  <option value="<?=$result['id']?>">
   <?=$result['city_name'] ?></option>
   <?php } ?>
</select>
</div>	
<?php }
elseif($page=='addfrnds')
{
	$uid=$_SESSION['user_id'];
	$fid=$_POST['fid'];
	@$sql="INSERT INTO friends(uid,fid) VALUES ($uid,$fid)";
	$conn->exec($sql);
	$sql1="INSERT INTO friends(uid,fid) VALUES ($fid,$uid)";
	$conn->exec($sql1);
	echo "<div class='alert alert-success'>Request Successfully Sent !!!</div>";
	//echo 'testing';
	}
	elseif($page=='addfrndsreq')
{
	$uid=$_SESSION['user_id'];
	$fid=$_POST['fid'];
	$sql="update friends set status = 1 Where uid=$uid and fid= $fid";
	$conn->exec($sql);
	 $sql1="update friends set status = 1 Where uid=$fid and fid= $uid";
	$conn->exec($sql1); 
	echo "<div class='alert alert-success'>Successfully Added !!!</div>";
	//echo 'testing';
	}
	elseif($page=='likes' || $page=='comments' || $page=='shares')
{
	$uid = $_SESSION['user_id'];
	$msg=$_POST['msg'];
	$sql="update posts set likes = 1,comments='$msg',shares = $uid Where uid=$uid";
	$conn->exec($sql);
	echo "<div class='alert alert-success'>You Like This Post !!!</div>";
	}
	elseif($page=='rmvfrnds')
{

	$uid=$_SESSION['user_id'];
	$fid=$_POST['fid'];
	@$sql ="update friends set status = 0 Where uid=$uid and fid= $fid";
	$conn->exec($sql);
	@$sql1 = "update friends set status = 0 Where uid=$fid and fid= $uid";
	$conn->exec($sql1);
	echo "<div class='alert alert-danger'>Unfriend Successfully  !!!</div>";
	//echo 'testing';
	}
	elseif($page=='sendmsgs')
{
	$uid=$_SESSION['user_id'];
	$fid=$_POST['fid'];
	$msg=$_POST['msg'];
	 @$sql="INSERT INTO messages(uid,fid,message) VALUES ($uid,$fid,'$msg')";
	$conn->exec($sql);
	 $sql1="INSERT INTO chats(uid,fid,text) VALUES ($uid,$fid,'$msg')";
	$conn->exec($sql1); 
	echo "<div class='alert alert-success'>Message Successfully Sent !!!</div>";
	//echo 'testing';
	}
	elseif($page=='forgotpw')
{
	$sth = $conn->prepare("SELECT user_id,email FROM users where email='$_POST[email]'");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
if(!empty($_POST['email']) && $_POST['email']==$result['email']){
$uid=$result['user_id'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
 @$sql="UPDATE `users` SET `password`='".$password."' WHERE user_id='$uid'";
$conn->exec($sql);
echo "<h3 class='text-success text-center'><b>Successfully Done !!!</b></h3>";
}
else{
	echo "<h3 class='text-danger text-center'><b>Invalid Credentials !!!</b></h3>";
}
	$uid=$_SESSION['user_id'];
	$fid=$_POST['uid'];
	@$sql="INSERT INTO friends(`fid`,uid) VALUES ($fid,$uid)";
	$conn->exec($sql);
	echo "<div class='alert alert-success'>Request Successfully Sent !!!</div>";
	//echo 'testing';
	}
?>