<?php 
	session_start();
		if(!isset($_SESSION['email'])) {
			session_destroy();
			header('Location: login.php');   
			exit;
		}

	$id = $_GET['email'];
	
	if(isset($_SESSION['email'])){ 
		$sessionid = $_SESSION['email'];
	}

	
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Users</h3>
            </div>
            <div class="row">
                <p>
					<a href="tutorial.php" class="btn btn-success">Events</a>
					<a href="logout.php" class="btn btn-danger">Logout</a>
                </p>
				<table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Number</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM customers ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['name'] . '</td>';
                            echo '<td>'. $row['email'] . '</td>';
                            echo '<td>'. $row['mobile'] . '</td>';
							echo '<td width=250>';
                            echo '<a class="btn" href="user_read.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo ' ';
                            echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>