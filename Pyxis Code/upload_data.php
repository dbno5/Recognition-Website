<?php
 session_start();
 if($_SESSION['user_name'] == '')
 {
  header("Location: index.php");
  exit;
 }
?>
<?php
$upload_dir = "Signatures/";
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . mktime() . ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';



ini_set('display_errors', 'On');
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hernandv-db",$myPassword,"hernandv-db");

$con = mysqli_connect("oniddb.cws.oregonstate.edu","hernandv-db",$myPassword,"hernandv-db");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$Username=$_SESSION['user_name'];
$Signature=$file;


if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " .$mysqli->connect_errno ."".$mysqli->connect_error;
}else{
	echo "User Details Updated!!!";
}

if(!$mysqli->query("UPDATE Users SET Signature = '$Signature' WHERE Username ='$Username'")){
	echo "Update failed: (" . $mysqli->errno . ") " . $mysqli->error; 
}

if (!($stmt = $mysqli->prepare("SELECT Signature FROM Users"))) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $mysqli->errno . ") " . $mysqli->error;
}


$out_Signature = NULL;

if (!$stmt->bind_result($out_Signature)) {
    echo "Binding output parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}


$stmt->close();
}
?>
