<?php

session_start();
//connect to database
$db=mysqli_connect("localhost","crbollma","579788","crbollma");
if(isset($_POST['register_btn']))
{
    $name=($_POST['name']);
    $email=($_POST['email']);
	$mobile=($_POST['mobile']);
    $password=($_POST['password']);
    $password2=($_POST['password2']);  
     if($password==$password2)
     {           //Create User
            $sql="INSERT INTO customers(name,email,mobile,password) VALUES('$name','$email','$mobile','$password')";
            mysqli_query($db,$sql);  
            $_SESSION['message']="You are now logged in"; 
            $_SESSION['email']=$email;
            header("location:login.php");  
    }
    else
    {
      $_SESSION['message']="The two password do not match";   
     }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register a new account</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header">
    <h1>Register a new account</h1>
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<form method="post" action="register.php">
  <table>
     <tr>
           <td>Name : </td>
           <td><input type="text" name="name" class="textInput"></td>
     </tr>
     <tr>
           <td>Email : </td>
           <td><input type="email" name="email" class="textInput"></td>
     </tr>
     <tr>
           <td>mobile : </td>
           <td><input type="text" name="mobile" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td>Password again: </td>
           <td><input type="password" name="password2" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="register_btn" class="Register"></td>
     </tr>
  
</table>
</form>
</body>
</html>