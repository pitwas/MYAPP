<?php
session_start();//136211
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=mydb;host=127.0.0.1';
$user = 'root';
$password = '';

try {
   $conn = new PDO($dsn, $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo 'ok';
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?> 