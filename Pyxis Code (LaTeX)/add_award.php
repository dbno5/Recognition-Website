<?php
ini_set('display_errors', 'On');
include 'storedInfo.php';

session_start();
if($_SESSION['user_name'] == '') {
    header("Location: index.php");
    exit;
}

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","channa-db",$myPassword,"channa-db");

$Username=$_SESSION['user_name'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
$Type=(isset($_POST['Type']) ? $_POST['Type'] : null);
$FName=(isset($_POST['FName']) ? $_POST['FName'] : null);
$LName=(isset($_POST['LName']) ? $_POST['LName'] : null);
$Email=(isset($_POST['Email']) ? $_POST['Email'] : null);
$AwardCreationTime=(isset($_POST['AwardCreationTime']) ? $_POST['AwardCreationTime'] : null);
}

if($mysqli->connect_errno){
  echo "Connection error " .$mysqli->connect_errno ."".$mysqli->connect_error;
}

if(!$mysqli->query("INSERT INTO Award(Type, FName, LName, Email, AwardCreationTime, FK_UserID) VALUES ('$Type','$FName', '$LName', '$Email', '$AwardCreationTime',(SELECT UserID FROM Users WHERE Username = '$Username'))")) {
    echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error; 
}

if (!($stmt = $mysqli->prepare("SELECT AwardID, Type, FName, LName, Email, AwardCreationTime FROM Award"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->execute()) {
    // echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
    echo 'Award could not be added.';
}
else {
    echo "Award has been added.";
}

$stmt->close();