<?php 
require_once("session.php"); 
require_once("included_functions.php");
require_once("database.php");

new_header("Puppy Provenance"); 
$mysqli = Database::dbConnect();
$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (($output = message()) !== null) {
	echo $output;
}

  	if ((isset($_GET["litterID"]) && $_GET["litterID"] !== "") && (isset($_GET["gender"]) && $_GET["gender"] !== "") && (isset($_GET["collarColor"]) && $_GET["collarColor"] !== "")) {
//////////////////////////////////////////////////////////////////////////////////////				
		$query = "DELETE FROM Puppies WHERE LitterID = ? AND CollarColor = ? AND Gender = ?";
		$stmt = $mysqli->prepare($query);
		$stmt -> execute([$_GET["litterID"],$_GET["collarColor"],$_GET["gender"]]);

		if ($stmt) {
			$_SESSION["message"] = "The Puppy was Successfully Deleted!";

		}
		else {
			$_SESSION["message"] = "That Puppy could not be Deleted!";

		}
		redirect("puppyRead.php");
		
//////////////////////////////////////////////////////////////////////////////////////				
	}
	else {
		$_SESSION["message"] = "Puppy could not be found!";
		redirect("puppyRead.php");

	}

new_footer("Puppy Provenance ");	
Database::dbDisconnect($mysqli);

?>