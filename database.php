<?php
class Database
{
    private static $dbName = 'crbollma' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'crbollma';
    private static $dbUserPassword = '579788';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
	
	public function displayListTableContents(){
		
		$pdo = Database::connect();
		$sql = 'SELECT * FROM events2 ORDER BY id DESC';
		foreach ($pdo->query($sql) as $row){
			echo '<tr>';
			echo '<td>'. $row['event_time'] . '<td>';
			echo '<td>'. $row['event_date'] . '<td>';
			echo '<td>'. $row['event_location'] . '<td>';
			echo '<td><a class="btn" href="read.php?id = ' .$row['event_id']. '">Read</a></td>';
			echo '</tr>';
		}
		
		Database::disconnect();
	}
	
	public function displayListHeading(){
		echo '<div class=container><div class=row><h3>PHP CRUD GRID</h3></div><div class=row><p><a class= "btn btn-sucess"href=create.php>Create</a><table class="table table-bordered table-striped"><thread><tr><th>Name<th>Email<th>Mobile<th>Action<tbody>';
	}
	
    public function importBootstrap() 
    { 
        echo '<!DOCTYPE html><html lang=en><meta charset=utf-8><link href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css rel=stylesheet><script src=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js></script>'; 
    } 
    
	public function displayListFooting() 
    { 
        echo '</tbody></table></div></div></body></html>'; 
    } 
     
    public function displayListScreen()  
    { 
        Database::importBootstrap(); 
        Database::displayListHeading(); 
        Database::displayListTableContents(); 
        Database::displayListFooting(); 
    }
}
?>