<?php
include 'connect.php';
include 'header.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST['details']))
	echo "<h3 class='text-danger text-center'><b>Please Post Something !!!</b></h3>"; 
else{
	@$sql="INSERT INTO `posts`( `uid`, `details`) VALUES  ('".$_SESSION[user_id]."','".$_POST[details]."')";
$conn->exec($sql);
echo "<h3 class='text-success text-center'><b>New Post Posted successfully !!!</b></h3>";
}
}

?>
<script type="text/javascript" src="js/jquery.wallform.js"></script>
<script type="text/javascript">

var luid = $('#like').val();
function comments(cuid){
	
var cuid = $('#comment').val();
	var msg = prompt("Please enter your Message", "Hello MyFriend");
     if (msg) {
        //document.getElementById("demo").innerHTML =" " + msg + "! How are you today?";
    
 $.ajax({
			type: 'POST',  
			url: "ajax.php", 
	  data: {uid:cuid,page:'comments',msg:msg},
		
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
//alert(msg)
	}
function shares(suid)
	{
		var suid = $('#share').val();
$.ajax({
			type: 'POST',  
			url: "ajax.php", 
	  data: {uid:suid,page:'shares'},
		
	  success: function(result){
        $("#pp").html(result); 
		 //$("#fid").hide('slow'); 
		//location.reload();
    }
}); 

	}
//var lk = $("#like").val();
	function likes(luid)
	{
		//alert(lk)
		$.ajax({
			type: 'POST',  
			url: "ajax.php", 
	  data: {uid:luid,page:'likes'},
		
	  success: function(result){
        $("#pp").html(result); 
		 $("#like").hide('slow'); 
		//alert(page)
		
    }
	  });  
		
	}
$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "upload.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
	</script>
<div class="container">
<div class="row well">

    <h2 class="text-info">Dashboard </h2>
<p class='text-center text-info' id='pp'></p>
	<form method="post">
	<div class="col-md-3">
	<h4 class="text-danger">New Post</h4>
							
							<div class="bg-warning "></br>
							<textarea value="" name='details' class='form-group' id='details'  placeholder="Enter Here.." style="width:100%;height:25%;"></textarea></br>
							<button class='btn btn-danger glyphicon glyphicon-share' name='okk' id='okk'> Post</button>
							
	 <button type="button" class="btn btn-info glyphicon glyphicon-picture" data-toggle="modal" data-target="#myModal3"> Image</button>
	
	</div></div></form>
	<div class='col-md-6'>
	<?php 
//$cond="f.uid ='$_SESSION[user_id]'";
	$sth = $conn->prepare("select u.user_id,u.profile_img,p.details,p.created from posts as p inner join users as u on p.uid=u.user_id where p.uid ='$_SESSION[user_id]'");
  $sth->execute();

				//count(likes) as likes,count(comments) as comments,count(shares) as shares,?>
	<div class="bg-primary text-white">MyPosts</div>
							
							<div class="bg-info text-white">
							<?php while($result = $sth->fetch(PDO::FETCH_ASSOC)){
								$time =explode(" ",$result['created'])[1];
								?>
							<div class = "alert alert-success"><img class="image-preview" class="media-object" style="width:100px" src="<?php echo "uploads/".$result['user_id']."/img/".$result['profile_img']; ?>" class="upload-preview" /><?= $result['details'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$time ?>&nbsp;&nbsp;&nbsp;<button class='btn btn-info glyphicon glyphicon-hand-up' onclick="likes()" id="like" value = "<?= $_SESSION['user_id'] ?>" name="like" title="Like"><span class='badge'><?php ?></span></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class=' btn btn-warning glyphicon glyphicon-comment' onclick="comments(<?= $_SESSION['user_id'] ?>)" title="Comment" value = "<?= $_SESSION['user_id'] ?>" id="comment" name="comment"><span class='badge'><?php ?></span></button>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger glyphicon glyphicon-share' id="share" name="share" onclick="shares(<?= $_SESSION['user_id'] ?>)" value="<?= $_SESSION['user_id'] ?>" title="Share"><span class="badge"><?php ?></span></button></div>
							
							<?php } ?>
							

							</div>
	</div>
	</div></div>

  <!-- Modal -->
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Post Image</h4>
        </div>
        <div class="modal-body">
          
<div class="bgColor">
<form id="uploadForm" action="upload.php" method="post">
<div id="targetLayer">No Image</div>
<div id="uploadFormLayer">
<input name="userImage" type="file" class="inputFile" /><br/>
<input type="submit" value="Submit"  class="btn btn-success btnSubmit" />
</form>
</div>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

	

