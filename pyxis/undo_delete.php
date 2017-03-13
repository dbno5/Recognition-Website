<?php
include 'includes/header.php';
include 'includes/configdb.php';

$Username=$_SESSION['user_name'];

// Get data from AJAX request
$award = json_decode($_POST['award']);
// echo $award->id;
// echo $award->type;
// echo $award->fName;
// echo $award->lName;
// echo $award->email;
// echo $award->date;
// echo $award->author;

if(!$mysqli->query("INSERT INTO Award(AwardID, Type, FName, LName, Email, AwardCreationTime, FK_UserID) VALUES ('$award->id', '$award->type','$award->fName', '$award->lName', '$award->email', '$award->date',(SELECT UserID FROM Users WHERE Username = '$Username'))")) {
    // echo "Insert failed: (" . $mysqli->errno . ") " . $mysqli->error; 
    echo 'Action could not be undone.';
}
else {
    echo "Action has been undone.";
}