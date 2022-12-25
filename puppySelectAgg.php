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

	// Select Statment for table
	$query = "SELECT Parents, COUNT(CASE WHEN UserReservingID IS NULL THEN 1 END) AS 'Number of Available Puppies'
	From Puppies JOIN (
		SELECT GROUP_CONCAT(Adult_Dogs.Name SEPARATOR ', ') as Parents, Litter.LitterID 
		FROM Litter JOIN Adult_Dogs ON Litter.MotherID = Adult_Dogs.DogID OR Litter.FatherID = Adult_Dogs.DogID 
		GROUP BY(Litter.LitterID)) AS T
		ON Puppies.LitterID = T.LitterID
	GROUP BY(Puppies.LitterID) 
	ORDER BY COUNT(CASE WHEN UserReservingID IS NULL THEN 1 END) DESC";
	
	$stmt = $mysqli -> prepare($query);
	$stmt -> execute();				
	if ($stmt) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Number of Available Puppies in Each Litter</h2>";
		echo "<h3>(Aggregate Query)</h3>";
		echo "<table>";
		echo "  <thead>";
		echo "    <tr>
			<th>Parents</th>
			<th>Count in Litter</th>
			</tr>";
		echo "  </thead>";
		echo "  <tbody>";

		// Fetch data for each row and display
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {	
			echo "<tr>";

			echo "<td style='text-align:center'>"." ".$row["Parents"]."</td>";
			echo "<td style='text-align:center'>"." ".$row["Number of Available Puppies"]."</td>";

			echo "</tr>";
		}
		echo "  </tbody>";
		echo "</table>";

		// Link to Main Page
		echo "<br /><p>&nbsp&nbsp&laquo:<a href='puppyRead.php'> Back to the Main Page</a>";
		echo "</center>";
		echo "</div>";
	}
	new_footer("Puppy Provenance ");	
	Database::dbDisconnect($mysqli);
 ?>