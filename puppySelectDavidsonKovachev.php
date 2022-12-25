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
	$query = "SELECT Adult_Dogs.Name, GROUP_CONCAT(DISTINCT Users.Name SEPARATOR ', ') AS Names
	FROM Users JOIN Puppies on Puppies.UserReservingID = Users.UserID NATURAL JOIN Litter 
	join Adult_Dogs on Litter.MotherID = Adult_Dogs.DogID
	Group BY(Adult_Dogs.DogID)";
	
	$stmt = $mysqli -> prepare($query);
	$stmt -> execute();				
	if ($stmt) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Customers of Each Mother</h2>";
		echo "<h3>(Davidson Query: Brannan Kovachev)</h3>";
		echo "<table>";
		echo "  <thead>";
		echo "    <tr>
			<th>Mother</th>
			<th>Customers</th>
			</tr>";
		echo "  </thead>";
		echo "  <tbody>";

		// Fetch data for each row and display
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {	
			$litterID = $row['LitterID'];
			echo "<tr>";

			echo "<td style='text-align:center'>"." ".$row["Name"]."</td>";
			echo "<td style='text-align:center'>"." ".$row["Names"]."</td>";

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