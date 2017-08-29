<?php
include'connect.php';
include'header.php';
 ?>
 <script type="text/javascript">
$(document).ready(function (e){
	var profile_img = new FormData();
$("#uploadForm").load('submit',(function(e){
e.preventDefault();
$.ajax({
url: "upload.php",
type: "POST",
data: {profile_img:profile_img} ,
/* contentType: false,
cache: false,
processData:false, */
success: function(res){
	//alert(profile_img)
$("#targetLayer").html(res);
},
error: function(){} 	        
});
}));
});
</script>
<form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">

<div id="targetLayer">No Image</div>
<div id="uploadFormLayer">
<input name="profile_img" type="file" class="inputFile" /><br/>
<input type="submit" value="Submit" class="btnSubmit" />
</form>