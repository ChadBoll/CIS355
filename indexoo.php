<?php
session_start();
require 'database.php';
if (empty($_SESSION['userid'])){ 
	login();
	exit();
}


function login(){
	echo '<form action= "demo_form.php" method="post">';
	echo '<p>Username:';
	echo '<input type= "text" name="email"><br>';
	echo '<p>Password:';
	echo '<input type= "password" name="password"><br>';	
	echo '<input type="sumbit" value ="Submit">';
	echo '</form>'
}	
	
	
include 'database.php';
include 'customer.php';
Customer::displayListScreen();
?>