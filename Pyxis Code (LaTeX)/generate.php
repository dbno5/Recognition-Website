<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Database info
include 'storedInfo.php';
// Award info
include 'award.php';

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

// echo $awardID . "<br>";
// echo $awardType . "<br>";
// echo $recipientFName . "<br>";
// echo $recipientLName . "<br>";
// echo $recipientEmail . "<br>";
// echo $awardCreationTime . "<br>";
// echo $creatorUserID . "<br>";

if (!($stmt = $mysqli->prepare("SELECT FName, LName, JobTitle FROM Users WHERE UserID = ?"))) {
		echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("i", $creatorUserID))) {
	echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}
if (!$stmt->execute()) {
	echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
}
if (!$stmt->bind_result($userFName, $userLName, $userJobTitle)) {
	echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}
$stmt->fetch();
$stmt->close();

// echo $userFName . "<br>";
// echo $userLName . "<br>";
// echo $userJobTitle . "<br>";

$file_path = '';

if ($awardType == 'month') {
	$file_path = 'certificate_month.tex';
}
else if ($awardType == 'week') {
	$file_path = 'certificate_week.tex';
}

$temp_file = $awardID . '.tex';
$file_contents = file_get_contents($file_path);

$award_temp = "*[Recipient Name]*";
$award_replace = $recipientFName . ' ' . $recipientLName;
$file_contents = str_replace($award_temp, $award_replace, $file_contents);

$award_temp = "*[Award Date]*";
$award_replace = $awardCreationTime;
$file_contents = str_replace($award_temp, $award_replace, $file_contents);

$award_temp = "*[Authorizing User]*";
$award_replace = $userFName . ' ' . $userLName;
$file_contents = str_replace($award_temp, $award_replace, $file_contents);

$award_temp = "*[Authorizing User Job Title]*";
$award_replace = $userJobTitle;
$file_contents = str_replace($award_temp, $award_replace, $file_contents);

file_put_contents($temp_file, $file_contents);

chmod($temp_file,0755);

$output = shell_exec('./convert ' . $awardID . ' ' . $temp_file . ' 2>&1');

// echo "<p>$output</p>";

$url = "http://web.engr.oregonstate.edu/~channa/Pyxis%20Code/certificates/";
$url .= $awardID . '.pdf';

$redirect = '<script type="text/javascript">';
$redirect .= 'window.location = "' . $url . '"';
$redirect .= '</script>';

echo $redirect;
?>