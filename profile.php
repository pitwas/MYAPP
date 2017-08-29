<?php
include'connect.php';
include'header.php';
  
$sth = $conn->prepare("SELECT `first_name`, `last_name`, `mobile`,profile_img, `email`,`states`,s.state_name,c.city_name, `cities`, `address`, `pin_code` FROM users as u inner join states as s on u.states=s.id inner join cities as c on u.cities=c.id where user_id='$_SESSION[user_id]'");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);
$first_name=$result['first_name'];
$last_name=$result['last_name'];
$mobile=$result['mobile'];
$email=$result['email'];
$address=$result['address'];
$state=$result['states'];
$city=$result['cities'];
$states=$result['state_name'];
$cities=$result['city_name'];
$pin_code=$result['pin_code'];
$profile_img=$result['profile_img'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST['first_name']))
	echo "<h3 class='text-danger text-center'><b>Please Fill The credentials !!!</b></h3>"; 
/* elseif($_POST['password']!=$_POST['pass'])
	echo "<h3 class='text-danger text-center'><b>Password Not Match Try Again !!!</b></h3>";
 */
 else{
	 @$sql="UPDATE `users` SET `first_name`='".$_POST[first_name]."',`last_name`='".$_POST[last_name]."',`mobile`='".$_POST[mobile]."',`email`='".$_POST[email]."',`states`='".$_POST[states]."',`cities`='".$_POST[cities]."',`address`='".$_POST[address]."',`pin_code`='".$_POST[pin_code]."' WHERE user_id='$_SESSION[user_id]'";
$conn->exec($sql);
echo "<h3 class='text-success text-center'><b>Successfully Done !!!</b></h3>";
}
}
 ?>
 <script type="text/javascript" src="js/jquery.wallform.js"></script>
 <link href="css/styles.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
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
function findcity(){
	 
	  var sid = $('#states :selected').val();
	    $.ajax({
			type: 'POST',  
			url: "ajax.php", 
	  data: {sid:sid,city:'city'},
		
	  success: function(result){
        $("#pp").html(result); 
		/* alert(sid)
		alert(result) */
    }
	  });  
 }
});
		
</script>
<div class="container">
    <h1 class="text-info">Update Profile </h1>
	

	
	<div class="row well">
				<form method="post">
					
						<div class="row">
							<div class="col-sm-3 form-group">
								<label>First Name</label>
								<input type="text" value="<?= $first_name ?>" name='first_name' id='first_name' placeholder="Enter First Name Here.." class="form-control">
							</div>
							<div class="col-sm-3 form-group">
								<label>Last Name</label>
								<input type="text" value="<?= $last_name ?>" name='last_name' id='last_name' placeholder="Enter Last Name Here.." class="form-control">
							</div>
						
						<div class="col-sm-3 form-group">
						<label>Phone Number</label>
						<input type="text" value="<?= $mobile ?>" name='mobile' maxlength='10' id='mobile' placeholder="Enter Phone Number Here.." class="form-control">
					</div>		
					<div class="col-sm-3 form-group">
						<label>Email Address</label>
						<input type="text" value="<?= $email ?>" name='email' id='email' placeholder="Enter Email Address Here.." class="form-control">
					</div>	
						
						<div class=" col-sm-3 form-group">
							<label>Address</label>
							<textarea name='address' id='address' placeholder="Enter Address Here.." rows="3" class="form-control">
							<?= $address ?>
							</textarea>
						</div>	
						 
	<div class="col-sm-3 form-group">
	 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal3">Upload Image</button>
	 <img class="image-preview" src="<?php echo "uploads/".$_SESSION['user_id']."/img/".$profile_img; ?>" class="upload-preview" />
 	   </div>
		    
		   
		 
	
	
						<div class="col-sm-3 form-group">
								<label>State</label>
							<select id='states' name='states' onchange="findcity()" class="form-control">
								<option value=''>Please Select State</option>
								<?php
$sth = $conn->prepare("SELECT id,state_name FROM states");
$sth->execute();
while($result = $sth->fetch(PDO::FETCH_ASSOC)){
	$selected = $result['id']==$state ? 'selected' : "";?>
				
<option  value="<?= $result['id']?>" <?= $selected ?>><?= $result['state_name'] ?></option>

<?php }?>
</select>	
								<!--<input type="text" name='states' id='states' placeholder="Enter states Name Here.." class="form-control">-->
							</div>	
							<div class="col-sm-3 form-group" id='pp'>
								<label>City</label>
								
						<select name='cities' id='cities' class='form-control'>
   <option value=''>Select City</option>
   <?php
$sth =$conn->prepare("Select city_name,id from cities");
   $sth->execute();
   while($result = $sth->fetch(PDO::FETCH_ASSOC)){
	   $selected = $result['id']==$city ? 'selected' : "";
  //echo $city=$result['city_name'].'</br>';
  ?>
  <option value="<?=$result['id']?>"<?= $selected ?>>
  <?=$result['city_name']?></option>
 <?php }
?>
</select>
							</div>	
				 			
							<div class="col-sm-3 form-group">
								<label>Pin Code</label>
								<input type="text" value="<?= $pin_code ?>"name='pin_code' id='pin_code' placeholder="Enter Zip Code Here.." class="form-control">
							</div>		
						</div>
												
			<input type="submit" id='ok' name='ok' class="btn btn-success" value="Submit">
				</form> 
				</div>
	</div>
	</div>    
	
 
  <!-- Modal -->
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Image Upload</h4>
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

	

