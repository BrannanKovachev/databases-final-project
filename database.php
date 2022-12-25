<?php
class Database {
  public function __construct() {
    die('Init function error');
  }

  public static function dbConnect() {
	$mysqli = null;
	//try connecting to your database
	try{
    require_once('/home/bekovach/DBkovachev.php');
    $mysqli = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME,USERNAME,PASSWORD);
    // echo "Suucessful Connection REMOVE THIS!!!";
  }
	
	//catch a potential error, if unable to connect
  catch(PDOException $e){
    echo "Error!: ". $e->getMessage()."<br />";
    die("Could not connect to server ".DBNAME.".<br />");
  }
 
    return $mysqli;
  }

  public static function dbDisconnect() {
    $mysqli = null;
  }
}
?>
