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
	$query = "SELECT Pricing.Price, GROUP_CONCAT(DISTINCT Users.Name SEPARATOR ', ') AS Names
	FROM Pricing NATURAL JOIN Puppies JOIN Users ON Puppies.UserReservingID = Users.UserID
	GROUP BY(Pricing.Price)";
	
	$stmt = $mysqli -> prepare($query);
	$stmt -> execute();				
	if ($stmt) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>All User Names who Purchased a Puppy at each Price</h2>";
		echo "<h3>(Davidson Query: Robert Hughes)</h3>";
		echo "<table>";
		echo "  <thead>";
		echo "    <tr>
			<th>Price</th>
			<th>User Name</th>
			</tr>";
		echo "  </thead>";
		echo "  <tbody>";

		// Fetch data for each row and display
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {	
			$litterID = $row['LitterID'];
			echo "<tr>";

			echo "<td style='text-align:center'>"." $".$row["Price"]."</td>";
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