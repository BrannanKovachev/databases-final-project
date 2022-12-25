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
	$query = "SELECT Puppies.LitterID, Parents, Puppies.CollarColor, Puppies.Gender, CONCAT(Users.Name,': ',Users.Email)as UserReserving, Puppies.Licensed, Puppies.Heart, Puppies.Eyes, Puppies.Ichthyosis, CONCAT(Locations.Street,', ',Locations.City,', ',Locations.State,' ',Locations.Zip) AS Address, Price
	FROM Puppies JOIN (
		SELECT GROUP_CONCAT(Adult_Dogs.Name SEPARATOR ', ') as Parents, Litter.LitterID 
		FROM Litter JOIN Adult_Dogs ON Litter.MotherID = Adult_Dogs.DogID OR Litter.FatherID = Adult_Dogs.DogID 
		GROUP BY(Litter.LitterID)) AS T      
		ON Puppies.LitterID = T.LitterID JOIN Locations ON Puppies.LocationID = Locations.LocationID
	LEFT JOIN (
		SELECT DISTINCT Price, Puppies.Licensed AS PL, Puppies.Gender AS PG, Puppies.Ichthyosis AS PICH
		FROM Puppies LEFT JOIN Pricing ON Puppies.Licensed = Pricing.Licensed and Puppies.Ichthyosis = Pricing.Ichthyosis and Puppies.Gender = Pricing.Gender) AS Q 
		ON Puppies.Licensed = PL and Puppies.Ichthyosis = PICH and Puppies.Gender = PG
	LEFT JOIN Users ON Puppies.UserReservingID = Users.UserID
	WHERE Delivered = false
	ORDER BY Address";
	
	$stmt = $mysqli -> prepare($query);
	$stmt -> execute();				
	if ($stmt) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Puppies in our Possession</h2>";
		echo "<table>";
		echo "  <thead>";
		echo "    <tr>
			<th></th>
			<th>Parents</th>
			<th>Collar Color</th>
			<th>Gender</th>
			<th>Reserved By</th>
			<th>Licensed</th>
			<th>Heart</th>
			<th>Eyes</th>
			<th>Ichthyosis</th>
			<th>Location</th>
			<th>Price</th>
			<th></th>
			</tr>";
		echo "  </thead>";
		echo "  <tbody>";

		// Fetch data for each row and display
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {	
			echo "<tr>";
			echo "<td> 
				<a href='puppyDelete.php?litterID=".urlencode($row['LitterID'])."&collarColor=".urlencode($row['CollarColor'])."&gender=".urlencode($row['Gender'])."' onclick='return confirm(\"Are you sure?\");' style = 'color: red'> X </a>
				</td>";
			echo "<td style='text-align:center'>"." ".$row["Parents"]."</td>";
			echo "<td style='text-align:center'>"." ".$row["CollarColor"]."</td>";
			echo "<td style='text-align:center'>"." ".$row["Gender"]."</td>";
			echo "<td style='text-align:center'>"." ".$row["UserReserving"]."</td>";
			if($row["Licensed"]==1){
				echo "<td style='text-align:center'>Yes</td>";

			}else{
				echo "<td style='text-align:center'>No</td>";

			}
			echo "<td style='text-align:center'>"." ".$row["Heart"]."</td>";
			echo "<td style='text-align:center'>"." ".$row["Eyes"]."</td>";
			echo "<td style='text-align:center'>"." ".$row["Ichthyosis"]."</td>";
			echo "<td style='text-align:center'>"." ".$row["Address"]."</td>";
			echo "<td style='text-align:center'>"." $".$row["Price"]."</td>";
			echo "<td>
				<a href='puppyUpdate.php?litterID=".urlencode($row['LitterID'])."&collarColor=".urlencode($row['CollarColor'])."&gender=".urlencode($row['Gender'])."'> Edit </a>
			</td>";

			echo "</tr>";
		}
		echo "  </tbody>";
		echo "</table>";

		// Link to Create Page
		echo "<a href='puppyCreate.php'> Add a Puppy </a>";
		echo "<br></br>";
		echo "<br><a href='puppySelectAgg.php'> Show Count of Available Puppies in Each Litter (Aggregate Query) </a></br>";
		echo "<br><a href='puppySelectNested.php'> Show  all puppies from a litter that was fathered by the dog 'Oscar' (Nested Query) </a></br>";
		echo "<br><a href='puppySelectDavidsonKovachev.php'> List all Customers of a Female Adult Dog (Davidson Query: Brannan Kovachev) </a></br>";
		echo "<br><a href='puppySelectDavidsonHughes.php'> List All User Names who Purchased a Puppy at each Price (Davidson Query: Robert Hughes) </a></br>";

		echo "</center>";
		echo "</div>";
	}
	new_footer("Puppy Provenance ");	
	Database::dbDisconnect($mysqli);
 ?>