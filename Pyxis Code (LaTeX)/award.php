<?php
 session_start();
 if($_SESSION['user_name'] == '')
 {
  header("Location: index.php");
  exit;
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pyxis Recognition Awards</title>
	<link rel="stylesheet" type="text/css" href="TableCSSCode.css" />

</head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: rgba(4, 118, 155, 0.95);
}
</style>
<body>
			<div id="menu">
				<ul>
					<li><a  href="member.php" title="">Home</a></li>
					<li><a  href="user.php" title="">Edit User Details</a></li>
					<li><a  href="award.php"  title="">Create Award</a></li>
					<li><a  href="logout.php" title="">Logout</a></li>
				</ul>
			</div>
	
<h2> 
 
Create an award by entering the recipient's name, email address, type of award and date awarded.
 
</h2>
		<form action="award.php" method="post">
			Type of Award: <select name="Type">
                <option value="month">Employee of the Month</option>
                <option value="week">Employee of the Week</option>
        	</select>
			First Name: <input type="text" name="FName">
			Last Name: <input type="text" name="LName">
			Email: <input type="email" name="Email">
			Time and Date: <input type="datetime-local" name="AwardCreationTime">
			<input type="submit" value="Submit Award">
		</form>


<?php
ini_set('display_errors', 'On');
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","channa-db",$myPassword,"channa-db");

$con = mysqli_connect("oniddb.cws.oregonstate.edu","channa-db",$myPassword,"channa-db");

$Username=$_SESSION['user_name'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$Type=(isset($_POST['Type']) ? $_POST['Type'] : null);
$FName=(isset($_POST['FName']) ? $_POST['FName'] : null);
$LName=(isset($_POST['LName']) ? $_POST['LName'] : null);
$Email=(isset($_POST['Email']) ? $_POST['Email'] : null);
$AwardCreationTime=(isset($_POST['AwardCreationTime']) ? $_POST['AwardCreationTime'] : null);

if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " .$mysqli->connect_errno ."".$mysqli->connect_error;
}else{
	echo "Award Submitted!!!";
}

if(!$mysqli->query("INSERT INTO Award(Type, FName, LName, Email, AwardCreationTime, FK_UserID) VALUES ('$Type','$FName', '$LName', '$Email', '$AwardCreationTime',(SELECT UserID FROM Users WHERE Username = '$Username'))")){
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error; 
}
}

if (!($stmt = $mysqli->prepare("SELECT AwardID, Type, FName, LName, Email, AwardCreationTime FROM Award"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$out_Type = NULL;
$out_FName = NULL;
$out_LName = NULL;
$out_Email = NULL;
$out_AwardCreationTime = NULL;
$out_FK_UserID = NULL;
if (!$stmt->bind_result($out_Type, $out_FName, $out_LName, $out_Email, $out_AwardCreationTime, $out_FK_UserID)) {
    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

$result = mysqli_query($con,"SELECT * FROM Award WHERE FK_UserID = (SELECT UserID FROM Users WHERE Username = '$Username') ORDER BY AwardID DESC");

echo "<div class='CSSTableGenerator'>";
echo "<table>";
echo "<tr><td>Award Id</td><td>Award Type</td><td>First Name</td><td>Last Name</td><td>Email</td><td>Date Awarded</td><td>Given By UserID</td><td></td></tr>";

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['AwardID'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['FName'] . "</td><td>" . $row['LName'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['AwardCreationTime'] . "</td><td>" . $row['FK_UserID'] . "</td>
<td><a href='generate.php?id=" . $row['AwardID'] . "'>Generate Award</a></td></tr>";
}

echo "</table>";
echo "</div>";

$stmt->close();
?>

</body>
</html>