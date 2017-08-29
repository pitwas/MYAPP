<?php
include 'connect.php';
if(is_array($_FILES)) {
	$data = $_SESSION['user_id'];
	$folder= 'img';
	if(!is_dir("uploads/$data/$folder/")) {
	$path=@mkdir( "uploads/$data/$folder/", 0777, true);
}
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "uploads/$data/$folder/".$_FILES['userImage']['name'];

if(move_uploaded_file($sourcePath,$targetPath)) {
	
	 @$sql="UPDATE `users` SET profile_img='".$_FILES['userImage']['name']."' WHERE user_id='$_SESSION[user_id]'";
$conn->exec($sql);
	
?>
<img class="image-preview" src="<?php echo $targetPath; ?>" class="upload-preview" />
<?php
}
echo "<p class='text-success'>Successfully Done!!!";
}

}
?>