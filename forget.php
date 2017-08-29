<?php
include 'connect.php';
include 'header.php';     
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty($_POST['first_name']))
	echo "<h3 class='text-danger text-center'><b>Please Fill The credentials !!!</b></h3>";
}

?>
<script type="text/javascript">
 var mob = $('#mobile').val();
 var email = $('#email').val();
 function forgetpw(mob,email){
 //alert(uid)
	    $.ajax({
			type: 'POST',  
			url: "ajax.php", 
	  data: {mob:mob,page:'forgetpw'},
		
	  success: function(result){
        $("#pp").html(result); 
		 $("#hd").hide('slow');
		$("#pw").show('slow');		 
		//alert(page)
		//alert(result)
		/* alert("The paragraph was clicked.");
		 */
    }
	  });  
    
}
 </script>
<div class="container">
    <h1 class="well">Update Password </h1>
	

	<div class="col-lg-12 well">
	<div class="row">
				<form method="post">
					<div class="col-sm-12">
						<div class="row" id='hd'>
							<div class="col-sm-6 form-group">
								<label>Mobile No.</label>
								<input type="text"  name='mobile' id='mobile' placeholder="Enter Mobile No. Here.." class="form-control">
							</div>
							<div class="col-sm-6 form-group">
								<label>Email</label>
								<input type="text"  name='email' id='email' placeholder="Enter Email Id Here.." class="form-control">
							</div>
						</div>	
							<div class="row" id='pw' style='display:none'>
							<div class="col-sm-6 form-group">
								<label>Password</label>
								<input type='password'  name='password' id='password' placeholder='Enter Password Here..' class='form-control'>
							</div>
							<div class="col-sm-6 form-group">
								<label>Confirm Password</label>
								<input type='password'  name='cpassword' id='cpassword' placeholder='Enter Confirm Password Here..' class='form-control'>
							</div>
						</div>	
												
			<input type="button" id='ok' name='ok' onclick="forgetpw()" class="btn btn-danger" value="Reset Password">
				</form> 
				</div>
	</div>
	</div>    
	
 
  