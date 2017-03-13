<?php
include 'includes/header.php';
include 'includes/configdb.php';

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
    echo "Award has been deleted. <a id='undo-link'>Undo</a>";
}

$stmt->close();