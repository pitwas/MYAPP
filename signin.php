<?php
ob_start();
include'connect.php';
include'header.php';

 if($_SERVER["REQUEST_METHOD"] == "POST"){
    
$sth = $conn->prepare("SELECT first_name,password, last_name,user_id,email,count(email) as one FROM users where mobile='$_POST[mobile]'");
$sth->execute();

/* Exercise PDOStatement::fetch styles
print("PDO::FETCH_ASSOC: ");
print("Return next row as an array indexed by column name\n"); */

//echo $dd="SELECT first_name,password, last_name,user_id,email FROM users where mobile='$_POST[mobile]'";
$result = $sth->fetch(PDO::FETCH_ASSOC);
$pass=md5($_POST['pass']);
$_SESSION['user_id'] = $result['user_id'];
$_SESSION['email']   = $result['email'];
@$_SESSION['mobile'] = $result['mobile'];

if($result['one']<=0)
{	

echo "<h3 class='text-danger text-center'><b>Please Register & Login !!!</b></h3>";

}

elseif(empty($_POST['mobile']) && $_POST['pass'])
{	

echo "<h3 class='text-danger text-center'><b>Please Fill The credentials !!!</b></h3>";

}
else if($result['password']!=$pass)
{	

echo "<h3 class='text-danger text-center'><b>Password Incorrect !!!</b></h3>";

}
else{
	header("location:dashboard.php");

}
 }
/*print_r($result);
print("\n");
 
print("PDO::FETCH_BOTH: ");
print("Return next row as an array indexed by both column name and number\n");
$result = $sth->fetch(PDO::FETCH_BOTH);
print_r($result);
print("\n");

print("PDO::FETCH_LAZY: ");
print("Return next row as an anonymous object with column names as properties\n");
$result = $sth->fetch(PDO::FETCH_LAZY);
print_r($result);
print("\n");

print("PDO::FETCH_OBJ: ");
print("Return next row as an anonymous object with column names as properties\n");
$result = $sth->fetch(PDO::FETCH_OBJ);

print("\n"); */
ob_end_flush();
?>
<style>
.wrapper {    
	margin-top: 80px;
	margin-bottom: 20px;
}

.form-signin {
  max-width: 420px;
  padding: 30px 38px 66px;
  margin: 0 auto;
  background-color: #eee;
  border: 3px dotted rgba(0,0,0,0.1);  
  }

.form-signin-heading {
  text-align:center;
  margin-bottom: 30px;
}

.form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
}

input[type="text"] {
  margin-bottom: 0px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

input[type="password"] {
  margin-bottom: 20px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.colorgraph {
  height: 7px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}
</style>
 <div class = "container">
	<div class="wrapper">
		<form action="" method="post"class="form-signin">       
		    <h3 class="form-signin-heading text-primary"><b>Welcome User! <br>Please Sign In</b></h3>
			  <hr class="colorgraph"><br> 
			  <input type="text" class="form-control" name="mobile" id="mobile" maxlength ="10" placeholder="Mobile No" required="" autofocus="" />
			  <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required=""/>     		  
			 <button class="btn btn-lg btn-success btn-block"  name="Submit" value="Login" type="Submit">Login</button>  			
			<a href='forget.php'><p class='text-danger'>Forgot Password ?</p></a>
		</form>			
	</div>
</div>