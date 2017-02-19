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
					<li><a  href="#" title="">Edit User Details</a></li>
					<li><a  href="award.php"  title="">Create Award</a></li>
					<li><a  href="logout.php" title="">Logout</a></li>
				</ul>
			</div>
	
<h2> 
 
Edit your user details below.
 
</h2>
<form action="user.php" method="post">
			First Name: <input type="text" name="FName">
			Last Name: <input type="text" name="LName">
			<input type="submit" value="Update">
		</form>


<?php
ini_set('display_errors', 'On');
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hernandv-db",$myPassword,"hernandv-db");

$con = mysqli_connect("oniddb.cws.oregonstate.edu","hernandv-db",$myPassword,"hernandv-db");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$Username=$_SESSION['user_name'];
$FName=(isset($_POST['FName']) ? $_POST['FName'] : null);
$LName=(isset($_POST['LName']) ? $_POST['LName'] : null);

if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " .$mysqli->connect_errno ."".$mysqli->connect_error;
}else{
	echo "User Details Updated!!!";
}

if(!$mysqli->query("UPDATE Users SET FName = '$FName', LName ='$LName' WHERE Username ='$Username'")){
	echo "Update failed: (" . $mysqli->errno . ") " . $mysqli->error; 
}

if (!($stmt = $mysqli->prepare("SELECT FName, LName FROM Users"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
}


$out_FName = NULL;
$out_LName = NULL;
if (!$stmt->bind_result($out_FName, $out_LName)) {
    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

$result = mysqli_query($con,"SELECT * FROM Users WHERE Username = '$Username' ORDER BY UserID DESC");

echo "<div class='CSSTableGenerator'>";
echo "<table>"; 
echo "<tr><td>User ID</td><td>Email</td><td>First Name</td><td>Last Name</td><td>Username</td></tr>";

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['UserID'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['FName'] . "</td><td>" . $row['LName'] . "</td><td>" . $row['Username'] . "</td></tr>";}

echo "</table>";
echo "</div>";

$stmt->close();
}
?>


</body>
</html>