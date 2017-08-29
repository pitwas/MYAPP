<?php
include('connect.php');
$data = $_POST['info'];
//$pp = $data[0];
$folder= $_POST['page'];
if (!is_dir("uploads/$data/$folder/")) {
	@mkdir( "/uploads/$data/$folder/", 0777, true);
}
$path="uploads/$data/$folder/";
function getExtension($str) 
{
	$i = strrpos($str,".");
	if (!$i) { return ""; } 
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP","pdf");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	if(!empty($_FILES['profile_img']['name']))
	{
		$name = $_FILES['profile_img']['name'];
		$size = $_FILES['profile_img']['size'];
		$tmp = $_FILES['profile_img']['tmp_name'];
		$ext = getExtension($name);
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$profile_img=$actual_image_name;
		unset($_FILES['profile_img']['name']);
	}
/* 	elseif(!empty($_FILES['pan_img']['name']))
	{
		$name = $_FILES['pan_img']['name'];
		$size = $_FILES['pan_img']['size'];
		$tmp = $_FILES['pan_img']['tmp_name'];
		$ext = getExtension($name);
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$pan_img=$actual_image_name;
		unset($_FILES['pan_img']['name']);
	}
	elseif(!empty($_FILES['aadhar_img']['name']))
	{
		$name = $_FILES['aadhar_img']['name'];
		$size = $_FILES['aadhar_img']['size'];
		$tmp = $_FILES['aadhar_img']['tmp_name'];
		$ext = getExtension($name);
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$aadhar_img=$actual_image_name;
		unset($_FILES['aadhar_img']['name']);				
	}
	elseif(!empty($_FILES['lic_img']['name']))
	{
		$name = $_FILES['lic_img']['name'];
		$size = $_FILES['lic_img']['size'];
		$tmp = $_FILES['lic_img']['tmp_name'];
		$ext = getExtension($name);
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$lic_img=$actual_image_name;
		unset($_FILES['lic_img']['name']);				
	}
	elseif(!empty($_FILES['truck_img']['name']))
	{
		$name = $_FILES['truck_img']['name'];
		$size = $_FILES['truck_img']['size'];
		$tmp = $_FILES['truck_img']['tmp_name'];
		$ext = getExtension($name);
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$truck_img=$actual_image_name;
		unset($_FILES['truck_img']['name']);
	}
	elseif(!empty($_FILES['driver_img']['name']))
	{
		$name = $_FILES['driver_img']['name'];
		$size = $_FILES['driver_img']['size'];
		$tmp = $_FILES['driver_img']['tmp_name'];
		$ext = getExtension($name);
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$driver_img=$actual_image_name;
		unset($_FILES['driver_img']['name']);				
	}
	elseif(!empty($_FILES['profile_img']['name']))
	{
		$name = $_FILES['profile_img']['name'];
		$size = $_FILES['profile_img']['size'];
		$tmp = $_FILES['profile_img']['tmp_name'];
		$ext = getExtension($name);
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$profile_img=$actual_image_name;
		unset($_FILES['profile_img']['name']);
	}
	elseif(!empty($_FILES['fitness_img']['name']))		
	{
		$name = $_FILES['fitness_img']['name'];		
		$size = $_FILES['fitness_img']['size'];		
		$tmp = $_FILES['fitness_img']['tmp_name'];	
		$ext = getExtension($name);		
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$fitness_img=$actual_image_name;	
		unset($_FILES['fitness_img']['name']);
		}			
	elseif(!empty($_FILES['service_tax_img']['name']))		
		{		
		$name = $_FILES['service_tax_img']['name'];	
		$size = $_FILES['service_tax_img']['size'];	
		$tmp = $_FILES['service_tax_img']['tmp_name'];	
		$ext = getExtension($name);	
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$service_tax_img=$actual_image_name;	
		unset($_FILES['service_tax_img']['name']);		
		}
		elseif(!empty($_FILES['tax_img']['name']))		
		{		
		$name = $_FILES['tax_img']['name'];	
		$size = $_FILES['tax_img']['size'];	
		$tmp = $_FILES['tax_img']['tmp_name'];	
		$ext = getExtension($name);	
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$tax_img=$actual_image_name;	
		unset($_FILES['tax_img']['name']);		
		}
		elseif(!empty($_FILES['insurance_img']['name']))		
		{		
		$name = $_FILES['insurance_img']['name'];	
		$size = $_FILES['insurance_img']['size'];	
		$tmp = $_FILES['insurance_img']['tmp_name'];	
		$ext = getExtension($name);	
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$insurance_img=$actual_image_name;	
		unset($_FILES['insurance_img']['name']);		
		}
		elseif(!empty($_FILES['decl_img']['name']))		
		{		
		$name = $_FILES['decl_img']['name'];	
		$size = $_FILES['decl_img']['size'];	
		$tmp = $_FILES['decl_img']['tmp_name'];	
		$ext = getExtension($name);	
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$decl_img=$actual_image_name;	
		unset($_FILES['decl_img']['name']);		
		}
		elseif(!empty($_FILES['spnp_img']['name']))		
		{		
		$name = $_FILES['spnp_img']['name'];	
		$size = $_FILES['spnp_img']['size'];	
		$tmp = $_FILES['spnp_img']['tmp_name'];	
		$ext = getExtension($name);	
		$actual_image_name = time().substr(str_replace(" ", "_", $ext), 5).".".$ext;
		$spnp_img=$actual_image_name;	
		unset($_FILES['spnp_img']['name']);		
		}
 */			

if(strlen($name))
{
	if(in_array($ext,$valid_formats))
	{
		if($size<(1024*1024))
		{
			if(move_uploaded_file($tmp, $path.$actual_image_name))
			{
				$data = $_SESSION['user_id'];
				$u=$_POST['pagename'];
				if($u == 'userverify')
				{
					//$eid = explode("*",$_POST['info'])[1];
					//$type = explode("*",$_POST['info'])[2];
					$columns = '';
					$columns.= !empty($profile_img) ? "profile_img='$profile_img'," : '' ;
					/* $columns.= !empty($aadhar_img) ? "aadhar_img='$aadhar_img'," : '' ;
					$columns.= !empty($pan_img) ? "pan_img='$pan_img'," : '' ;
					$columns.= !empty($service_tax_img) ? "service_tax_img='$service_tax_img'," : '' ;
				 */	
				 $columns = rtrim($columns,',');
					
					$sql="UPDATE users SET $columns WHERE user_id='$data'"; 
					/* if($type == 'customers' || $type == 'industrials' || $type == 'transporters' || $type == 'truck_owners' )
				   {
						 $sql="UPDATE $type SET $columns WHERE email='$eid'"; 
				   } */
				}
				/* elseif($u == 'atrucks'){
				$tid = explode("*",$_POST['info'])[1];
					$truck = 'trucks';
					$columns = '';
					$columns.= !empty($profile_img) ? "profile_img='$profile_img'," : '' ;
					$columns.= !empty($pan_img) ? "pan_img='$pan_img'," : '' ;
					$columns.= !empty($aadhar_img) ? "aadhar_img='$aadhar_img'," : '' ;
					$columns.= !empty($fitness_img) ? "fitness_img='$fitness_img'," : '' ;
					$columns.= !empty($tax_img) ? "tax_img='$tax_img'," : '' ;
					$columns.= !empty($insurance_img) ? "insurance_img='$insurance_img'," : '' ;
					$columns.= !empty($decl_img) ? "decl_img='$decl_img'," : '' ;
					$columns.= !empty($spnp_img) ? "spnp_img='$spnp_img'," : '' ;
					$columns.= !empty($truck_img) ? "truck_img='$truck_img'," : '' ;
					$columns = rtrim($columns,',');
					
				//@$docs1 = $profile_img.'$$$'.$pan_img.'$$$'.$aadhar_img.'$$$'.$fitness_img.'$$$'.$tax_img.'$$$'.$truck_img;
				 if($truck == 'trucks')
	   {
		$sql="UPDATE $truck SET $columns WHERE id='$tid'"; 
		//SET documents='$docs1',profile_img='".$profile_img."',pan_img='".$pan_img."',aadhar_img='".$aadhar_img."',fitness_img='".$fitness_img."',tax_img='".$tax_img."',truck_img='".$truck_img."' WHERE id='$tid'";  
	   }
									}
				elseif($u == 'adriver'){
				$did = explode("*",$_POST['info'])[1];
				$driver = 'drivers';
				$columns = '';
				$columns.= !empty($aadhar_img) ? "aadhar_img='$aadhar_img'," : '' ;
				$columns.= !empty($pan_img) ? "pan_img='$pan_img'," : '' ;
				$columns.= !empty($lic_img) ? "lic_img='$lic_img'," : '' ;
				$columns.= !empty($driver_img) ? "driver_img='$driver_img'," : '' ;
				$columns = rtrim($columns,',');
				//@$docs2 = $aadhar_img.'$$$'.$pan_img.'$$$'.$lic_img.'$$$'.$driver_img;  
		
	 if($driver == 'drivers')
	   {
   $sql="UPDATE $driver SET $columns WHERE id='$did'"; 
   //SET documents='$docs2',aadhar_img='".$aadhar_img."',pan_img='".$pan_img."',lic_img='".$lic_img."',driver_img='".$driver_img."' WHERE id='$did'"; 
	   } */
				}
	  @$result=mysql_query($sql);
/*
	  if($result)
{
echo "Sucessfully Uploaded";	
}
else
	echo "Not Updateded";
*/
   echo "Sucessfully Uploaded";
			}
			else
				echo "Fail upload folder with read access.";
		}
		else
			echo "Image file size max 1 MB";					
	}
		else
			echo "Invalid file format..";	
}
else
echo "Please select image..!";
exit;

?> 