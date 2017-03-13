<?php
$Username = $_SESSION['user_name'];

if (!($stmt = $mysqli->prepare("SELECT Signature, JobTitle, Location FROM Users WHERE Username = ?"))) {
        echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s", $Username))) {
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->bind_result($Signature, $JobTitle, $Location)) {
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

$stmt->fetch();
$stmt->close();

if ($Signature == '' || $JobTitle == '' || $Location == '') {
    header("Location: user.php?redirect=1");
}