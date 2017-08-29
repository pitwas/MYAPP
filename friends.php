<?php
include'connect.php';
include'header.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST['first_name']))
	echo "<h3 class='text-danger text-center'><b>Please Fill The credentials !!!</b></h3>"; 
}
 ?>
 <script type="text/javascript" src="js/jquery.wallform.js"></script>
 <link href="css/styles.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript">
 var fid = $('#fid').val();
 function rmvfrnd(fid){
 if(confirm('Are You Sure ???')){
	    $.ajax({
			type: 'POST',  
			url: "ajax.php", 
	  data: {fid:fid,page:'rmvfrnds'},
		
	  success: function(result){
        $("#pp").html(result); 
		 $("#fid").hide('slow'); 
		location.reload();
    }
	  });  
    } else {
    saveData.error(function() {alert("Something went wrong"); });// Do nothing!
}
  
}
function sendmsg(fid){
	var msg = prompt("Please enter your Message", "Hello MyFriend");
    if (msg) {
        //document.getElementById("demo").innerHTML =" " + msg + "! How are you today?";
    
 $.ajax({
			type: 'POST',  
			url: "ajax.php", 
	  data: {fid:fid,page:'sendmsgs',msg:msg},
		
	  success: function(result){
        $("#pp").html(result); 
		 //$("#fid").hide('slow'); 
		//location.reload();
    }
}); 

	}
	else {
    saveData.error(function() {alert("Something went wrong"); });// Do nothing!
}
	}
 </script>

<div class="container">
<p class='text-warning'id="pp"></p>

	<div class="row well">
				<?php 
$cond="f.uid ='$_SESSION[user_id]'";
	$sth = $conn->prepare("select u.user_id,f.fid,f.status,u.first_name,u.email,u.address,u.mobile,c.city_name,s.state_name,u.profile_img from friends as f inner join users as u on f.fid=u.user_id inner join states as s on s.id=u.states inner join cities as c on c.id=u.cities where $cond and f.status=1");
  $sth->execute();
				?>
	<h1 class="text-info">Friends</h1>
 
		 			<div class="media">
	<?php 
	$i=0;
	while($result = $sth->fetch(PDO::FETCH_ASSOC)){
	 ?>
    <div class="media-left">
	<img class="image-preview" class="media-object" style="width:100px" src="<?php echo "uploads/".$result['user_id']."/img/".$result['profile_img']; ?>" class="upload-preview" />
    </div>
    <div class="media-body">
      <h4 class="text-warning"><b><?=   $result['first_name']?></h4>
      <h5 class='text-primary'><?=  ''."<span class='glyphicon glyphicon-envelope'></span>".''.$result['email'].','."<span class='glyphicon glyphicon-phone'></span>" .$result['mobile'].'<br>'."<span class='glyphicon glyphicon-map-marker'></span>".''.$result['address'].','.$result['city_name'].','.$result['state_name']?></b></h5><br>
	  <button class="btn btn-danger" title='Click to Unfriend' onclick="rmvfrnd(<?= $result['fid']?>)" id='fid' value="<?= $result['fid']?>">
          <span class="glyphicon glyphicon-ok"></span> Friend 
        </button><button class="btn btn-primary" title='Click to Send message' onclick="sendmsg(<?= $result['fid']?>)" id='fid' value="<?= $result['fid']?>">
          <span class="glyphicon glyphicon-envelope"></span> Send message 
        </button>
    </div>
  </div>
											
  <?php $i++; } ?> 
</div>  </div>   