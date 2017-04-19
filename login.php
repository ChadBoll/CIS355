<?php
session_start(); 
require 'database.php';
if ( !empty($_POST)) { 
	
	$email = $_POST['email']; 
	$password = $_POST['password'];
	$passwordhash = MD5($password);

		
	
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM customers WHERE email = ? AND password = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($email,$password));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	
	if($data) { 
		echo "success!";
		$_SESSION['email'] = $data['email'];
		$sessionid = $data['id'];
		Database::disconnect();
		header("Location: tutorial.php?id=$sessionid ");
	
		exit();
	}
	else { 
		Database::disconnect();
		header("Location: login_error.html");
	}
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
        <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
        <div class="container">

                
        <div class="row">
                <h3>Login</h3>

                
        <form method="post" action="login.php">
                <table>
        <tr>
           <td>Email : </td>
           <td><input type="text" name="email" class="textInput"></td>
        </tr>
        <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
        </tr>
        <tr>
           <td></td>
           <td><input type="submit" name="login_btn" class="Log In"></td>
		   
        </tr>
        <a href="register.php">Register new account</a>
        </div> <!-- /row -->
    </div> <!-- /container -->
  </body>
</html>