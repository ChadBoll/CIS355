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
                <h3>Upcoming Events</h3>
            </div>
            <div class="row">
                <p>
					<a href="user.php" class="btn btn-success">View users</a>
					<a href="logout.php" class="btn btn-danger">Logout</a>
                </p>
				<table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Time</th>
                      <th>location</th>
					  <th>Availability</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM events2 ORDER BY event_id';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['event_date'] . '</td>';
                            echo '<td>'. $row['event_time'] . '</td>';
                            echo '<td>'. $row['event_location'] . '</td>';
							echo '<td width=250>';
                            echo '<a class="btn" href="events_read.php?id='.$row[$event_id].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="events_join.php?id='.$row[$event_id].'">Join</a>';
                            echo ' ';
							echo '<a class="btn btn-success" href="events_delete.php?id='.$row[$event_id].'">Delete</a>';
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