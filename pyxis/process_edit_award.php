<?php
include 'includes/header.php';
include 'includes/configdb-oop.php';

if(!($stmt = $mysqli->prepare("UPDATE Award SET Type = ?, FName = ?, LName = ?, Email = ?, AwardCreationTime = ? 
    WHERE AwardID = ?"))) {
    echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sssssi", $_POST['Type'], $_POST['FName'], $_POST['LName'], 
    $_POST['Email'], $_POST['AwardCreationTime'], $_POST['AwardID']))) {
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->execute())) {
    echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
}
else {
    echo "Award has been updated.";
}
$stmt->close();