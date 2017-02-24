<?php
// Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Database info
include 'storedInfo.php';
// Award info
# include 'award.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pyxis Recognition Awards</title>
	<link rel="stylesheet" type="text/css" href="styles.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="script.js"></script>
</head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: rgba(4, 118, 155, 0.95);
}
</style>
<body>

<?php
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
$convertedDate = DateTime::createFromFormat('Y-m-d H:i:s', $awardCreationTime);
$award_replace = $convertedDate->format('F j, Y');
$file_contents = str_replace($award_temp, $award_replace, $file_contents);

$award_temp = "*[Authorizing User]*";
$award_replace = $userFName . ' ' . $userLName;
$file_contents = str_replace($award_temp, $award_replace, $file_contents);

$award_temp = "*[Authorizing User Job Title]*";
$award_replace = $userJobTitle;
$file_contents = str_replace($award_temp, $award_replace, $file_contents);

file_put_contents($temp_file, $file_contents);

chmod($temp_file,0755);

$output = shell_exec('./convert ' . $awardID . ' 2>&1');

// echo "<p>$output</p>";

$url = "http://web.engr.oregonstate.edu/~channa/pyxis/certificates/";
$url .= $awardID . '.pdf';

$redirect = '<script type="text/javascript">';
$redirect .= 'window.location = "' . $url . '"';
$redirect .= '</script>';

echo '<form id="email-award-form" action="email_award.php" method="post">
    <input type="submit" value="Email Award" />
    <input type="hidden" name="award_type" value="' . $awardType . '" />
    <input type="hidden" name="award_id" value="' . $awardID . '" />
    <input type="hidden" name="recipient_first_name" value="' . $recipientFName . '" />
    <input type="hidden" name="recipient_last_name" value="' . $recipientLName . '" />
    <input type="hidden" name="recipient_email" value="' . $recipientEmail . '" />
	</form>';

echo '<div id="form-messages"></div>';

echo '<div class="pdf-container">
		<object width="100%" height="800px" data="'. $url . '">
		<div class="fallback">
			<p>The browser you are currently using does not support PDFs.</p>
			<p>Please download the PDF to view it.</p>
			<a href="'. $url . '">Download PDF</a>
		</div>
		</div></object>';

// echo $redirect;
?>

</body>
</html>