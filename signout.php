<?php
     session_start();
    // Because you are checking if(isset($_SESSION['loggedin'])), use the below:
    unset($_SESSION['user_id']);
    $_SESSION = array();
    session_destroy();
	header("location:signin.php");
	echo "<h3 class='text-success text-center'><b>Successfully Logged Out !!!</b></h3>";
?>