<?php
include 'includes/header.php';
include 'includes/configdb-oop.php';

$Username = $_SESSION['user_name'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$Type=(isset($_POST['Type']) ? $_POST['Type'] : null);
	$FName=(isset($_POST['FName']) ? $_POST['FName'] : null);
	$LName=(isset($_POST['LName']) ? $_POST['LName'] : null);
	$Email=(isset($_POST['Email']) ? $_POST['Email'] : null);
	$AwardCreationTime=(isset($_POST['AwardCreationTime']) ? $_POST['AwardCreationTime'] : null);
}

if(!$mysqli->query("INSERT INTO Award(Type, FName, LName, Email, AwardCreationTime, FK_UserID) VALUES ('$Type','$FName', '$LName', '$Email', '$AwardCreationTime',(SELECT UserID FROM Users WHERE Username = '$Username'))")) {
    // echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error; 
    echo 'Award could not be added.';
}
else {
    echo "Award has been added.";
}