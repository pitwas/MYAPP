<?php
if(empty($_SESSION['user_id']))
{
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="js/jquery.min.js"></script>
<script src="js/angular.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="js/bootstrap.min.js"></script>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-ruble"></span> Pp</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">&nbsp;<span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li><a href="about.php">&nbsp;<span class="glyphicon glyphicon-stats"></span> About Us</a></li>
      <li><a href="contact.php">&nbsp;<span class="glyphicon glyphicon-phone-alt"></span> Contact Us</a></li>
    </ul>
 
    <ul class="nav navbar-nav navbar-right">
      <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
<?php } else{
	/* $likes ='count(likes) as likes';
	$comments ='count(comments) as comments';
	$shares = 'count(shares) as shares';
	function fetch($cols){
		echo"select details,'$cols',created from posts where uid ='$_SESSION[user_id]'";
	$sth = $conn->prepare("select details,'$cols',created from posts where uid ='$_SESSION[user_id]'");
  $sth->execute();
  $result =  $sth->fetch(PDO::FETCH_ASSOC);
  return $result['$cols']== '' ? 0 : $result['$cols'];
	} */
?>



<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<!-- Latest compiled JavaScript -->


<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
var fid = $("#addfrndreq").val();
function addfrndreq(fid)
{
			var page='addfrndsreq';
			//alert(data1);
	 	 $.ajax({
			method: "POST",
			url: "ajax.php",
			data: { page: page,fid:fid}
		})

	.done(function(msg) {
		$('#info').html(msg);
		//alert(msg)
		//alert("Booking Successfull");
		//document.getElementById("form1").submit();
		location.reload();  
	});    
	// 
	}

function fetchchat(){ 
	
	var y = "<textarea id='screen' cols='34' rows='15' maxlength='5000' readonly></textarea>";
    document.getElementById("demo").innerHTML = y;

}


	function update()
{
    $.post("server.php", {frndid:$("#frndid").val()}, function(data){ $("#screen").val(data),$("#frndid").val();});  
 
    setTimeout('update()', 1000);
}
 
$(document).ready(function(){
     update();
	var frndid = $("#frndid").val();
 $("#btn-chat").click(function(){  
 //update();
      $.post("server.php", 
    { message: $("#message").val(),frndid:$("#frndid").val()},
    function(data){ 
    $("#screen").html(data); 
    $("#message").val("");
	 //$("#frndid").val("");
	//alert(data)
    }
    );
      }
     );
    });
 
 
	
</script>
<nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
     
    <div class="navbar-header">        
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="index.php">Pp</a>
    </div>  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	
	<form action="find_friends.php" method="post">
    <ul class="nav navbar-nav">
      <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
      <li><a href="home.php"> <span class="glyphicon glyphicon-home"></span> Home</a></li>
	  <li><a href="friends.php"> <span class="glyphicon glyphicon-user"></span> Friends</a></li>
      <li><a href="test.php">Test</a></li>
    </ul>
	<ul class="nav navbar-nav navbar-center">
      <li><input type='text' class='form-control' name='first_name' id='first_name'></li>&nbsp;
	  <li><button class='btn btn-danger glyphicon glyphicon-search' id='ok' name='ok'  title='Search' type='submit'></button>
      </li>
	   </ul>
 </form>
 
    <ul class="nav navbar-nav navbar-right">
	<li style="color:#f5f5f5">
	<span class="glyphicon glyphicon-bell btn btn-lg"  data-toggle="modal" data-target="#myModal2" title="Notifications"></span>
	<?php $msgg = "<div class='input-group'>
						<textarea id='screen' cols='38' rows='15'> </textarea> <br> 
                        <input id='message' type='text' class='form-control input-sm' placeholder='Type your message here...' />
                        <span class='input-group-btn'>
                            <button class='btn btn-warning btn-sm glyphicon glyphicon-send' id='btn-chat'>
                                Reply</button>
                        </span>
                    </div>";?>
   <!-- <SPAN class="glyphicon glyphicon-envelope btn btn-lg" data-toggle="popover" title="Messages" data-content="<?= $msgg ?>"></span>-->
	<span class="glyphicon glyphicon-envelope btn btn-lg" data-toggle="modal" data-placement="bottom" data-target="#myModal1" title="Messages"></span>
	<span class="glyphicon glyphicon-plus-sign btn btn-lg" data-toggle="modal" data-target="#myModal" title="Requests"></span>
</li>
      <li><a href="profile.php"><?= $_SESSION['email'] ?></a></li>
      <li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> LogOut</a></li>
    </ul>
  </div></div>
</nav>
<div class="row vbottom" role="navigation" style="float:right;margin-top:-11px;width:25%; position: relative;
    top: 100%;">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
					<?php $sth = $conn->prepare("select f.uid,f.status,u.first_name,u.email,u.address,u.mobile,c.city_name,s.state_name from friends as f inner join users as u on f.uid=u.user_id inner join states as s on s.id=u.states inner join cities as c on c.id=u.cities where f.fid ='$_SESSION[user_id]' and f.status=1");
					$sth->execute();
					?>
					<select name='frndid' id='frndid' onchange="fetchchat();" class="form-control" style="width:50%">
					<option value="">Select Friend</option>
					<?php while($result = $sth->fetch(PDO::FETCH_ASSOC)){
					?>
				
					<option value="<?= $result['uid'] ?>"><?= $result['first_name'] ?></option><?php  }?>
					
					
					</select>
					
                    <!-- <div class="btn-group pull-right">
                        <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <ul class="dropdown-menu slidedown">
                         <li><a href="#"><span class="glyphicon glyphicon-ok-sign">
                            </span>Available</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-remove">
                            </span>Busy</a></li>
                            <li><a href="#"><span class="glyphicon glyphicon-time"></span>
                                Away</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><span class="glyphicon glyphicon-off"></span>
                                Sign Out</a></li>
                        </ul>
                    </div>-->
                </div>
                <div class="panel-body">
				 <div class ='text-info' id="demo"></div><br> 
				<!--
                    <ul>
					
                        <li class="left clearfix"><span class="chat-img pull-left">
                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                       
                    </ul>-->
					
                </div>
                <div class="panel-footer">
                    <div class="input-group">
					
                        <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button type='submit' class="btn btn-success btn-sm glyphicon glyphicon-send" id="btn-chat">
                                Send</button>
                        </span>
                    </div>
                </div>
            </div>
			</div>
        
<?php }?>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-primary">Friend Request</h4>
        </div>
        <div class="modal-body">
		<p id='info' class='text-success'></p>
		<?php $sth = $conn->prepare("select f.uid,f.status,u.first_name,u.email,u.address,u.mobile,c.city_name,s.state_name from friends as f inner join users as u on f.uid=u.user_id inner join states as s on s.id=u.states inner join cities as c on c.id=u.cities where f.fid ='$_SESSION[user_id]' and f.status=0");
  $sth->execute();
 
while($result = $sth->fetch(PDO::FETCH_ASSOC)){ 

?>
         <div class="media">
    <div class="media-left">
	<img class="image-preview" class="media-object" style="width:100px" src="<?php echo "uploads/".$result['user_id']."/img/".$result['profile_img']; ?>" class="upload-preview" />
    </div>
    <div class="media-body">
      <h4 class="text-warning"><b><?=  print $result['first_name']?></h4>
      <h5 class='text-primary'><?=  print "<span class='glyphicon glyphicon-envelope'></span>".''.$result['email'].','."<span class='glyphicon glyphicon-phone'></span>" .$result['mobile'].'<br>'."<span class='glyphicon glyphicon-map-marker'></span>".''.$result['address'].','.$result['city_name'].','.$result['state_name']?></b></h5><br>
	  <button class="btn btn-success" onclick="addfrndreq(<?= $result['uid']?>)" id="addfrndreq1" value="<?= $result['uid']?>">
          <span class="glyphicon glyphicon-ok"></span> Confirm 
        </button>
    </div>
</div>
<?php }
/* }  
else{
	echo"<h4 class='text-warning'>No Friend Requests</h4>";
} */?>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-info">Messages</h4>
        </div>
        <div class="modal-body">
		<?php echo "SELECT c.`Text`,c.time FROM `chats` as c inner join messages as m on c.uid=m.uid where c.uid = '$_SESSION[user_id]' and c.fid != '$_SESSION[user_id]' ORDER BY c.`Id` DESC"; 
		$sth = $conn->prepare("SELECT c.`Text`,c.time,m.message FROM `chats` as c inner join messages as m on c.uid = m.uid where c.uid = '$_SESSION[user_id]' and c.fid != '$_SESSION[user_id]'");
//echo "<div classs='row'>";
  $sth->execute();
   ?>
<div class="input-group">
<textarea id="screen1" cols="30" rows="15"> <?php while($result = $sth->fetch(PDO::FETCH_ASSOC)){ echo $result['Text']."\n".$result['message']."\n".$result['time']."\n"; }?></textarea> <br>

                        <input id="message" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                       
                            <button class="btn btn-warning btn-sm glyphicon glyphicon-send" id="btn-msg">
                              </button>
                      
                    </div>
      
<?php //}?>
        </div>
      </div>
    </div>
  </div></div>
<!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-warning">Notifications</h4>
        </div>
        <div class="modal-body">
		<?php $sth = $conn->prepare("SELECT user_id,`mobile`,address,`email`,profile_img,`states`,s.state_name,c.city_name, `cities`,first_name FROM users as u inner join states as s on u.states=s.id inner join cities as c on u.cities=c.id");
//echo "<div classs='row'>";
  $sth->execute();
//while($result = $sth->fetch(PDO::FETCH_ASSOC)){ 
?>
         <div class="media">
    <div class="media-left">
	<img class="image-preview" class="media-object" style="width:100px" src="<?php echo "uploads/".$result['user_id']."/img/".$result['profile_img']; ?>" class="upload-preview" />
    </div>
    <div class="media-body">
      <h4 class="text-warning"><b><?=  print $result['first_name']?></h4>
      <h5 class='text-primary'><?=  print "<span class='glyphicon glyphicon-envelope'></span>".''.$result['email'].','."<span class='glyphicon glyphicon-phone'></span>" .$result['mobile'].'<br>'."<span class='glyphicon glyphicon-map-marker'></span>".''.$result['address'].','.$result['city_name'].','.$result['state_name']?></b></h5><br>
    </div>
</div>
<?php ?>
        </div>
        
      </div>
    </div>
  </div></div>
