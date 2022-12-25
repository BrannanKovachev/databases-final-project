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
	echo "<div class='row'>";
	echo "<center>";
	echo "<h3>Add a Puppy</h3>";
	// echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
		if ($_POST['heart'] === '') {
			$heart = NULL;
		}else{
			$heart = $_POST['heart'];
		}
		if ($_POST['eyes'] === '') {
			$eyes = NULL;
		}else{
			$eyes = $_POST['eyes'];
		}
		if ($_POST['ichthyosis'] === '') {
			$ichthyosis = NULL;
		}else{
			$ichthyosis = $_POST['ichthyosis'];
		}
		$color = $_POST['color'];
		$gender = $_POST['gender'];
		$locationID = $_POST['locationID'];

		// Check if Mother/Father Pair exists as a Litter
		$query = "SELECT LitterID FROM Litter WHERE MotherID = ? AND FatherID = ?";
		$stmtVerify = $mysqli->prepare($query);
		$stmtVerify -> execute([$_POST['motherID'],$_POST['fatherID']]);
		if($stmtVerify){
			if($stmtVerify -> rowCount() == 0){
				// Add new Litter Pair if it doesn't already exist
				$query = "INSERT INTO Litter (MotherID, FatherID) VALUES (?, ?)";
				$stmt = $mysqli->prepare($query);
				$stmt -> execute([$_POST['motherID'],$_POST['fatherID']]);
			}
			// Get LitterID
			$query = "SELECT LitterID FROM Litter WHERE MotherID = ? AND FatherID = ?";
			$stmt2 = $mysqli->prepare($query);
			$stmt2 -> execute([$_POST['motherID'],$_POST['fatherID']]);
			$row = $stmt2->fetch(PDO::FETCH_ASSOC);
			$litterID = (int) $row['LitterID'];

			// Validate Puppy Doesn't already Exist
			$query = "SELECT * FROM Puppies WHERE LitterID=? AND CollarColor=? AND Gender=?";
			$stmtVerify2 = $mysqli->prepare($query);
			$stmtVerify2 -> execute([$litterID,$color,$gender]);
			// $row = $stmtVerify2->fetchALL();
			if($stmtVerify2 -> rowCount() == 0){
				// Insert Into Puppies table if new Puppy
				$query = "INSERT INTO Puppies VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$stmt3 = $mysqli->prepare($query);
				$stmt3 -> execute([$litterID,$color,$gender,NULL,0,$heart,$eyes,$ichthyosis,$locationID,NULL]);
				$_SESSION["message"] = "Successfully Added Puppy";
				
			}else{
				$_SESSION["message"] = "Error Adding Puppy. Puppy exists in table.";
			}
		}else{
			$_SESSION["message"] = "Error Adding Puppy";
		}
		redirect("puppyRead.php");
	}
	else {
//////////////////////////////////////////////////////////////////////////////////////////////////
			echo "<form action='puppyCreate.php' method='post'>";

			// Color
			echo "<p>Collar Color:</p>
				<select name='color'>";
				echo "<option value='Black'>Black</option>";
				echo "<option value='Blue'>Blue</option>";
				echo "<option value='Brown'>Brown</option>";
				echo "<option value='Green'>Green</option>";
				echo "<option value='Grey'>Grey</option>";
				echo "<option value='Orange'>Orange</option>";
				echo "<option value='Pink'>Pink</option>";
				echo "<option value='Purple'>Purple</option>";
				echo "<option value='Sky Blue'>Sky Blue</option>";
				echo "<option value='White'>White</option>";
				echo "<option value='Yellow'>Yellow</option>";
			echo "</select>";

			// Gender
			echo "<p>Gender:</p>
				<select name='gender'>";
				echo "<option value='Male'>Male</option>";
				echo "<option value='Female'>Female</option>";
			echo "</select>";

			// Mother
			echo "<p>Mother:</p>
				<select name='motherID'>";
				$stmt = $mysqli -> prepare("SELECT DogID, Name FROM Adult_Dogs WHERE Gender='Female'");
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					echo "<option value = '".$row['DogID']."'>".$row['Name']."</option>";
					}
			echo "</select>";

			// Father
			echo "<p>Father:</p>
				<select name='fatherID'>";
				$stmt = $mysqli -> prepare("SELECT DogID, Name FROM Adult_Dogs WHERE Gender='Male'");
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					echo "<option value = '".$row['DogID']."'>".$row['Name']."</option>";
					}
			echo "</select>";

			// Heart
			echo "<p>Heart Status:</p>
				<select name='heart'>";
				echo "<option value='Good'>Good</option>";
				echo "<option value='Monitor'>Monitor</option>";
				echo "<option value='Bad'>Bad</option>";
				echo "<option value=''>Undetermined</option>";
			echo "</select>";

			// Eyes
			echo "<p>Eye Health:</p>
				<select name='eyes'>";
				echo "<option value='Good'>Good</option>";
				echo "<option value='Monitor'>Monitor</option>";
				echo "<option value='Bad'>Bad</option>";
				echo "<option value=''>Undetermined</option>";
			echo "</select>";
			// Icthyosis
			echo "<p>Ichthyosis Status:</p>
				<select name='ichthyosis'>";
				echo "<option value='Positive'>Positive</option>";
				echo "<option value='Negative'>Negative</option>";
				echo "<option value=''>Undetermined</option>";
			echo "</select>";

			// Location
			echo "<p>Location:</p>
				<select name='locationID'>";
				$stmt = $mysqli -> prepare("SELECT LocationID, CONCAT(Locations.Street,', ',Locations.City,', ',Locations.State,' ',Locations.Zip) AS Address FROM Locations");
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					echo "<option value = '".$row['LocationID']."'>".$row['Address']."</option>";
					}
			echo "</select>";
			
			echo "<p><input type='submit' name='submit' value='Add' class='button tiny round'/>";		
			echo "</form>";				
	}
	// echo "</label>";
	echo "</center>";
	echo "</div>";
	echo "<center>";
	echo "<br /><p>&nbsp&nbsp&laquo:<a href='puppyRead.php'> Back to the Main Page</a>";
	echo "</center>";

	new_footer("Puppy Provenance ");	
	Database::dbDisconnect($mysqli);
?>