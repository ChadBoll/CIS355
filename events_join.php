
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
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $emailError = null;
        $numberError = null;
         
        // keep track post values
        $join_email = $_POST['join_email'];
        $join_number = $_POST['join_number'];
        
		// validate input
        $valid = true;
        if (empty($join_email)) {
            $emailError = 'Please enter date';
            $valid = false;
        }
         
        if (empty($join_number)) {
            $numberError = 'Please enter number';
            $valid = false;
        } 		
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO join_event (join_email, join_number) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($join_email, $join_number));
            Database::disconnect();
            header("Location: tutorial.php");
        }
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
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Join an Event</h3>
                    </div>
             
                    <form class="form-horizontal" action="events_join.php" method="post">
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="join_email" type="text"  placeholder="email" value="<?php echo !empty($join_email)?$join_email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($numberError)?'error':'';?>">
                        <label class="control-label">Time</label>
                        <div class="controls">
                            <input name="join_number" type="text" placeholder="number" value="<?php echo !empty($join_number)?$join_number:'';?>">
                            <?php if (!empty($numberError)): ?>
                                <span class="help-inline"><?php echo $numberError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="tutorial.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>


