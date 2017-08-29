<?php
include'connect.php';
include'header.php';
 ?>
 <script type="text/javascript" src="js/jquery.wallform.js"></script>
 <link href="css/styles.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/jquery.min.js"></script>
 <script type="text/javascript">
 var fid = $('#addfrnd').val();
 function addfrnd(fid){
 //alert(fid)
	    $.ajax({
			type: 'POST',  
			url: "ajax.php", 
	  data: {fid:fid,page:'addfrnds'},
		
	  success: function(result){
        $("#pp").html(result); 
		 $("#addfrnd").hide('slow'); 
		//alert(page)
		
    }
	  });  
    
}
 </script>
<div class="container">
<p id="pp"></p>
<h1 class="text-info">Find Friends </h1>
<div class="row well">
<?php   
	if(!empty($_POST['first_name']))
	  {
	 $sth = $conn->prepare("SELECT user_id,`mobile`,address,`email`,profile_img,`states`,s.state_name,c.city_name, `cities`,first_name FROM users as u inner join states as s on u.states=s.id inner join cities as c on u.cities=c.id where first_name like '%$_POST[first_name]%' and user_id NOT IN(  
SELECT fid  FROM chats)");
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
	  <button class="btn btn-info" onclick="addfrnd(<?= $result['user_id']?>)" id="addfrnd" value="">
          <span class="glyphicon glyphicon-plus-sign"></span> Add Friend 
        </button>
    </div>
  </div>

<?php 
}
}?> 

	</div> </div>    
	

  