<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Database info
include 'storedInfo.php';

// Delete from database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","channa-db",$myPassword,"channa-db");

if ($mysqli->connect_errno) {
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if(!($stmt = $mysqli->prepare("DELETE FROM Award WHERE AwardID = ?"))) {
    echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_POST['id']))) {
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->execute())) {
    // echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
    echo 'Award could not be deleted.';
}
else {
    // Delete from storage
    $file = '/nfs/stak/students/c/channa/public_html/pyxis/certificates/' . $_POST['id'] . '.pdf';
    if (file_exists($file)) {
        unlink($file);
    }
    echo 'Award has been deleted.';
}

$stmt->close();