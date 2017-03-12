<?php
include 'includes/header.php';
include 'includes/configdb-oop.php';

$upload_dir = "Signatures/";
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . mktime() . ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$Username=$_SESSION['user_name'];
	$Signature=$file;

	if(!$mysqli->query("UPDATE Users SET Signature = '$Signature' WHERE Username ='$Username'")){
		echo "Update failed: (" . $mysqli->errno . ") " . $mysqli->error; 
	}
}