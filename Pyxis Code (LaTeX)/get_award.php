<?php
ini_set('display_errors', 'On');
session_start();
if($_SESSION['user_name'] == '') {
    header("Location: index.php");
    exit;
}
include 'storedInfo.php';

$Username=$_SESSION['user_name'];

$con = mysqli_connect("oniddb.cws.oregonstate.edu","channa-db",$myPassword,"channa-db");

$result = mysqli_query($con,"SELECT * FROM Award WHERE FK_UserID = (SELECT UserID FROM Users WHERE Username = '$Username') ORDER BY AwardID DESC");

echo "<table>";
echo "<tr><td>Award Id</td><td>Award Type</td><td>First Name</td><td>Last Name</td><td>Email</td><td>Date Awarded</td><td>Given By UserID</td><td></td><td></td><td></td></tr>";

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['AwardID'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['FName'] . "</td><td>" . $row['LName'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['AwardCreationTime'] . "</td><td>" . $row['FK_UserID'] . "</td>
<td><a href='generate.php?id=" . $row['AwardID'] . "'>Generate Award</a></td>
<td><a href='edit_award.php?id=" . $row['AwardID'] . "' class='btn btn-default btn-sm edit-award'>
      <span class='glyphicon glyphicon-pencil'></span> Edit
    </a></td>
<td><button type='button' class='btn btn-danger btn-sm delete-award' id='" . $row['AwardID'] . "'>
    <span class='glyphicon glyphicon-remove'></span> Delete
</button></td></tr>";
}
echo "</table>";
?>
<script src="delete_script.js"></script>