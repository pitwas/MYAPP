<?php
include'connect.php';
include'header.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST['first_name']))
	echo "<h3 class='text-danger text-center'><b>Please Fill The credentials !!!</b></h3>"; 
elseif($_POST['password']!=$_POST['pass'])
	echo "<h3 class='text-danger text-center'><b>Password Not Match Try Again !!!</b></h3>";
else{
	@$sql="INSERT INTO users(`first_name`, `last_name`,`mobile`,`email`,`address`, `states`, `cities`, `pin_code`, `password`) VALUES ('".$_POST[first_name]."','".$_POST[last_name]."','".$_POST[mobile]."','".$_POST[email]."','".$_POST[address]."','".$_POST[states]."','".$_POST[cities]."','".$_POST[pin_code]."',md5('$_POST[password]'))";
$conn->exec($sql);
echo "<h3 class='text-success text-center'><b>New User created successfully !!!</b></h3>";
}
}
 ?>
 <script>
function findcity(){
	 
	  var sid = $('#states :selected').val();
	    $.ajax({
			type: 'POST',  
			url: "ajax.php", 
	  data: {sid:sid,page:'city'},
		
	  success: function(result){
        $("#pp").html(result); 
		/* alert(sid)
		alert(result) */
    }
	  });  
 }
</script>
<div class="container">
    <h1 class="well">Registration Form</h1>
	<div class="col-lg-12 well">
	<div class="row">
				<form method="post">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<input type="text" name='first_name' id='first_name' placeholder="Enter First Name Here.." class="form-control">
							</div>
							<div class="col-sm-6 form-group">
								<label>Last Name</label>
								<input type="text" name='last_name' id='last_name' placeholder="Enter Last Name Here.." class="form-control">
							</div>
						</div>	
							<div class="row">
							<div class="col-sm-6 form-group">
								<label>Password</label>
								<input type="password" name='password' maxlength='8' id='password' placeholder="Enter Password Here.." class="form-control">
							</div>		
							<div class="col-sm-6 form-group">
								<label>Confirm Password</label>
								<input type="password" name='pass' id='pass' maxlength='8' placeholder="Enter Confirm Password Here.." class="form-control">
							</div>	
						</div>	
						<div class="row">
						<div class="col-sm-6 form-group">
						<label>Phone Number</label>
						<input type="text" name='mobile' maxlength='10' id='mobile' placeholder="Enter Phone Number Here.." class="form-control">
					</div>		
					<div class="col-sm-6 form-group">
						<label>Email Address</label>
						<input type="text" name='email' id='email' placeholder="Enter Email Address Here.." class="form-control">
					</div>	
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea name='address' id='address' placeholder="Enter Address Here.." rows="3" class="form-control"></textarea>
						</div>	
						<div class="row">
						<div class="col-sm-4 form-group">
								<label>State</label>
								<select id='states' name='states' onchange="findcity()" class="form-control">
								<option value=''>Please Select State</option>
								<?php
$sth = $conn->prepare("SELECT id,state_name FROM states");
$sth->execute();
while($result = $sth->fetch(PDO::FETCH_ASSOC)){
				?>
<option  value="<?= $result['id']?>"><?= $result['state_name'] ?></option>

<?php }?>
</select>
								<!--<input type="text" name='states' id='states' placeholder="Enter states Name Here.." class="form-control">-->
							</div>	
							<div class="col-sm-4 form-group" id='pp'>
								<label>City</label>
								<input type="text" name='cities' id='cities' placeholder="Enter cities Name Here.." class="form-control">
							</div>	
				 			
							<div class="col-sm-4 form-group">
								<label>Zip</label>
								<input type="text" name='pin_code' id='pin_code' placeholder="Enter Zip Code Here.." class="form-control">
							</div>		
						</div>
												
			<input type="submit" id='ok' name='ok' class="btn btn-success" value="Submit">
				</form> 
				</div>
	</div>
	</div>
	
