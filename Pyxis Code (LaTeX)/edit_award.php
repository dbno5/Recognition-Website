<?php
ini_set('display_errors', 'On');
session_start();
if($_SESSION['user_name'] == '') {
    header("Location: index.php");
    exit;
}
include 'storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","channa-db",$myPassword,"channa-db");

// Connect to database
if ($mysqli->connect_errno) {
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

if (!($stmt = $mysqli->prepare("SELECT AwardID, Type, FName, LName, Email, AwardCreationTime, FK_UserID FROM Award WHERE AwardID = ?"))) {
        echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_GET['id']))) {
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->bind_result($awardID, $awardType, $recipientFName, $recipientLName, $recipientEmail, $awardCreationTime, $creatorUserID)) {
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pyxis Recognition Awards</title>
    <!-- jQuery -->
    <script
    src="http://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="form_stylesheet.css" />
</head>
<body>

<div class="form_container">
    <h3>User Form</h3>
    <form id="input_form" action="edit_award.php" method="post">
    <label class='form_label'>Type of Award</label>
    <select name="Type">
        <option value="month">Employee of the Month</option>
        <option value="week">Employee of the Week</option>
    </select>
    <label class='form_label'>First Name</label>
    <input name='FName' type='text' value="<?php echo $recipientFName; ?>"/>
    <label class='form_label'>Last Name</label>
    <input name='LName' type='text' value="<?php echo $recipientLName; ?>"/>
    <label class='form_label'>Email</label>
    <input name='Email' type='email' value="<?php echo $recipientEmail; ?>"/>
    <label class='form_label'>Date and Time</label>
    <input name="AwardCreationTime" type="datetime-local" value="<?php echo $awardCreationTime; ?>"/>
    <input class='btn btn-primary' type='submit' value='Update' />
    </form>
</div>

</body>
</html>