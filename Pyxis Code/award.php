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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="signature.js"></script>

</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" >Pyxis Recognition</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="member.php">Home</a></li>
      <li><a href="user.php">User Details</a></li>
      <li><a href="award.php">Create Award</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>


<div class="container">
  <h2>Create Award</h2>
  <p>Create an award by entering the recipient's name, email address, type of award and date awarded.</p>
  <form class="form-inline" action="award.php" method="post">
    
    <div class="form-group">
    <select id="lunch" class="selectpicker form-control" data-live-search="true" name="Type">
                <option value="month">Employee of the Month</option>
                <option value="week">Employee of the Week</option>
    </select> 
    </div>
    
    <div class="form-group">
      <label for="FName">First Name:</label>
      <input type="text" class="form-control" id="FName" placeholder="Enter First Name" name="FName">
    </div>
    <div class="form-group">
      <label for="LName">Last Name:</label>
      <input type="text" class="form-control" id="LName" placeholder="Enter Last Name" name="LName">
    </div>
    <div class="form-group">
      <label for="Email">Email:</label>
      <input type="email" class="form-control" id="Email" placeholder="Enter Email" name="Email">
    </div>
    <div class="form-group">
      <label for="AwardCreationTime">Date Awarded:</label>
      <input type="datetime-local" class="form-control" id="AwardCreationTime" name="AwardCreationTime">
    </div>
    <button type="submit" class="btn btn-default">Create</button>
  </form>
</div>



<?php
ini_set('display_errors', 'On');
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hernandv-db",$myPassword,"hernandv-db");

$con = mysqli_connect("oniddb.cws.oregonstate.edu","hernandv-db",$myPassword,"hernandv-db");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$Username=$_SESSION['user_name'];
$Type=(isset($_POST['Type']) ? $_POST['Type'] : null);
$FName=(isset($_POST['FName']) ? $_POST['FName'] : null);
$LName=(isset($_POST['LName']) ? $_POST['LName'] : null);
$Email=(isset($_POST['Email']) ? $_POST['Email'] : null);
$AwardCreationTime=(isset($_POST['AwardCreationTime']) ? $_POST['AwardCreationTime'] : null);

if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " .$mysqli->connect_errno ."".$mysqli->connect_error;
}else{
	echo "";
}

if(!$mysqli->query("INSERT INTO Award(Type, FName, LName, Email, AwardCreationTime, FK_UserID) VALUES ('$Type','$FName', '$LName', '$Email', '$AwardCreationTime',(SELECT UserID FROM Users WHERE Username = '$Username'))")){
	echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error; 
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

echo "<div class='container'>";
echo "<table class='table table-bordered'>"; 
echo "<tr><td>Award Id</td><td>Award Type</td><td>First Name</td><td>Last Name</td><td>Email</td><td>Date Awarded</td><td>Given By UserID</td></tr>";

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['AwardID'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['FName'] . "</td><td>" . $row['LName'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['AwardCreationTime'] . "</td><td>" . $row['FK_UserID'] . "</td></tr>";}

echo "</table>";
echo "</div>";

$stmt->close();
}
?>


</body>
</html>