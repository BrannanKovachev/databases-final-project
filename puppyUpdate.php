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
echo "<h3>Update A Puppy</h3>";
echo "<label for='left-label' class='left inline'>";
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
    if ($_POST['user'] === '') {
        $user = NULL;
    }else{
        $user = $_POST['user'];
    }
    $query = "UPDATE Puppies SET Delivered = ?, Heart = ?, Eyes = ?, Ichthyosis = ?, UserReservingID = ?, Licensed = ? WHERE LitterID = ? AND CollarColor = ? AND Gender = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->execute([$_POST["delivered"], $heart, $eyes, $ichthyosis, $user, $_POST["licensed"], $_POST["litterID"], $_POST["collarColor"], $_POST["gender"]]);
    if($stmt) {
        $_SESSION["message"] = "Puppy has been successfully updated";
    } else {
        $_SESSION["message"] = "There was an error updating the puppy";
    }
    redirect("puppyRead.php");

} else {
    if (isset($_GET["litterID"]) && isset($_GET["collarColor"]) && isset($_GET["gender"])) {
        $query = "SELECT Delivered, Heart, Eyes, Ichthyosis, UserReservingID, Licensed FROM Puppies WHERE LitterID = ? AND CollarColor = ? AND Gender = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->execute([$_GET["litterID"], $_GET["collarColor"], $_GET["gender"]]);

        if ($stmt) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "<h3>Puppy Information</h3>";
            $query2 = "SELECT GROUP_CONCAT(Adult_Dogs.Name SEPARATOR ', ') as Parents FROM Litter JOIN Adult_Dogs ON Litter.MotherID = Adult_Dogs.DogID OR Litter.FatherID = Adult_Dogs.DogID WHERE Litter.LitterID = ? GROUP BY(Litter.LitterID)";
            $stmt2 = $mysqli->prepare($query2);
            $stmt2->execute([$_GET["litterID"]]);
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            //Immutable Info
            echo "<p>Parents: ".$row2["Parents"]."</p>";
            echo "<p>Collar Color: ".$_GET["collarColor"]."</p>";
            echo "<p>Gender: ".$_GET["gender"]."</p>";
            echo "<form method='POST' action='puppyUpdate.php'>";
            echo "<input type='hidden' name='litterID' value=".$_GET["litterID"]." />";
            echo "<input type='hidden' name='collarColor' value='".$_GET["collarColor"]."' />";
            echo "<input type='hidden' name='gender' value=".$_GET["gender"]." />";
            $heart = ["Good" => "", "Monitor" => "", "Bad" => "", "Undetermined" => ""];
            $eye = ["Good" => "", "Monitor" => "", "Bad" => "", "Undetermined" => ""];
            $ich = ["Positive" => "", "Negative" => "", "Undetermined" => ""];
            if($row["Heart"] === NULL){
                $heart["Undetermined"] = " selected";
            } else {
                $heart[$row["Heart"]] = " selected";
            }
            if($row["Eyes"] === NULL){
                $eye["Undetermined"] = " selected";
            } else {
                $eye[$row["Eyes"]] = " selected";
            }
            if($row["Ichthyosis"] === NULL){
                $ich["Undetermined"] = " selected";
            } else {
                $ich[$row["Ichthyosis"]] = " selected";
            }

            // Heart
			echo "<p>Heart Status:</p>
                <select name='heart'>";
                echo "<option value='Good'".$heart["Good"].">Good</option>";
                echo "<option value='Monitor'".$heart["Monitor"].">Monitor</option>";
                echo "<option value='Bad'".$heart["Bad"].">Bad</option>";
                echo "<option value=''".$heart["Undetermined"].">Undetermined</option>";
            echo "</select>";

            // Eyes
            echo "<p>Eye Health:</p>
                <select name='eyes'>";
                echo "<option value='Good'".$eye["Good"].">Good</option>";
                echo "<option value='Monitor'".$eye["Monitor"].">Monitor</option>";
                echo "<option value='Bad'".$eye["Bad"].">Bad</option>";
                echo "<option value=''".$eye["Undetermined"].">Undetermined</option>";
            echo "</select>";
            // Icthyosis
            echo "<p>Ichthyosis Status:</p>
                <select name='ichthyosis'>";
                echo "<option value='Positive'".$ich["Good"].">Positive</option>";
                echo "<option value='Negative'".$ich["Negative"].">Negative</option>";
                echo "<option value=''".$ich["Undetermined"].">Undetermined</option>";
            echo "</select>";

            //User Reserving
            echo "<p>User Reserving:</p>";
            echo "<select name='user'>";
            echo "<option value=''></option>";
            $query3 = "SELECT UserID, Name FROM Users";
            $stmt3 = $mysqli->prepare($query3);
            $stmt3->execute();
            while($row3=$stmt3->fetch(PDO::FETCH_ASSOC)){
                if($row3['UserID'] == $row['UserReservingID']) {
                    $temp = " selected";
                } else {
                    $temp = "";
                }
                echo "<option value=".$row3['UserID'].$temp.">".$row3['Name']."</option>";
            }

            if($row["Licensed"] === 0) {
                $lic0 = " checked";
                $lic1 = "";
            } else {
                $lic0 = "";
                $lic1 = " checked";
            }
            echo "</select>";
            echo "<p>Licensed:</p>";
            echo "<p><input type='radio' name='licensed' value=1 ".$lic1."/>";
            echo "<label for=1>True</label>";
            echo "<input type='radio' name='licensed' value=0 ".$lic0."/>";
            echo "<label for=0>False</label></p>";

            echo "<p>Delivered:</p>";
            echo "<p><input type='radio' name='delivered' value=1/>";
            echo "<label for=1>True</label>";
            echo "<input type='radio' name='delivered' value=0 checked/>";
            echo "<label for=0>False</label></p>";

            echo '<input type="submit" name="submit" class="button tiny round" value="Update Puppy" />';
			echo '</form>';
        } else {
            $_SESSION["message"] = "Failed to Query Puppy";
        }
    }
}





echo "<br /><p>&laquo:<a href='puppyRead.php'>Back to Main Page</a>";
echo "</label>";
echo "</div>";
new_footer("Puppy Provenance");
Database::dbDisconnect($mysqli);
?>