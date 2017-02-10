
<?php
	$pageTitle = "Users";
	include("includes/header.php");
?>

<?php
$address = '"users.php"';

ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","jib-db","jHLU2F6vTofAqsoU","jib-db");
if(empty($_POST) == false && isset($_POST['add']))
{

	if(!($stmt = $mysqli->prepare("INSERT INTO User(FName, LName, CreationTime, Username, UserPassword, Signature, JobTitle, UserStatus) VALUES (?,?,?,?,?,?,?,?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ssssssss",$_POST['FName'],$_POST['LName'],$_POST['CreationTime'],$_POST['Username'],$_POST['UserPassword'],$_POST['Signature'],$_POST['JobTitle'],$_POST['UserStatus']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	}
}
else if(empty($_POST) == false && isset($_POST['edit']))
{
	if(!($stmt = $mysqli->prepare("UPDATE User SET FName=?, LName=?, CreationTime=?, Username=?, UserPassword=?, Signature=?, JobTitle=?, UserStatus=? WHERE UserID=?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("ssssssssi",$_POST['FName'],$_POST['LName'],$_POST['CreationTime'],$_POST['Username'],$_POST['UserPassword'],$_POST['Signature'],$_POST['JobTitle'],$_POST['UserStatus'],$_POST['edit']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

else if(isset($_GET['del']))
{
	if(!($stmt = $mysqli->prepare("DELETE FROM User WHERE UserID=?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("i",$_GET['del']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	}
}

?>
	<link rel="stylesheet" href="css/form_stylesheet.css" />
	<script src="DeleteButton.js"></script>
    <script src="Navigation.js"></script>
	<div class="form_container">
		<h3>User Form</h3>
		<form id="input_form" action="users.php" method="post">
            <?php
			if(empty($_GET) == false && empty($_GET['edit']) == false)
			{
				if(!($stmt = $mysqli->prepare("SELECT FName, LName, CreationTime, Username, UserPassword, Signature, JobTitle, UserStatus FROM User WHERE UserID=?"))){
					echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!($stmt->bind_param("i",$_GET['edit']))){
					echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->execute()){
					echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
				}

				if(!$stmt->bind_result($fname, $lname, $ctime, $username, $password, $signature, $jobtitle, $userstatus))
				{
					echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}

				$stmt->fetch();

echo "<label class='form_label'>First Name</label>\n";
				echo "<input maxlength='255' name='FName' type='text' value='" . $fname . "'/>\n";
				echo "<label class='form_label'>Last Name</label>\n";
				echo "<input maxlength='255'name='LName' type='text' value='" . $lname .  "'/>\n";
				echo "<label class='form_label'>CreationTime</label>\n";
				echo "<input name='CreationTime' type='datetime-local' value='" . $ctime . "'/>\n";
				echo "<label class='form_label'>Username</label>\n";
				echo "<input maxlength='255' name='Username' type='text' value='" . $username . "'/>\n";
				echo "<label class='form_label'>UserPassword</label>\n";
				echo "<input maxlength='255' name='Password' type='text' value='" . $password . "'/>\n";
				echo "<label class='form_label'>Signature</label>\n";
				echo "<input maxlength='255' name='Signature' type='text' value='" . $signature . "'/>\n";
				echo "<label class='form_label'>Job Title</label>\n";
				echo "<input maxlength='255' name='JobTitle' type='text' value='" . $jobtitle . "'/>\n";
				echo "<label class='form_label'>UserStatus</label>\n";
				echo "<input maxlength='255' name='UserStatus' type='text' value='" . $userstatus . "'/>\n";
				echo "<input type='hidden' name='edit' value='" . $_GET['edit'] . "' />\n";
				echo "<br />\n";
				echo "<input type='submit' value='submit' />\n";
			}
			else
			{
				echo	"<label class='form_label'>First Name</label>\n";
				echo	"<input name='FName' type='text' />\n";
				echo	"<label class='form_label'>Last Name</label>\n";
				echo	"<input name='LName' type='text' />\n";
				echo	"<label class='form_label'>Creation Time</label>\n";
							echo	"<input name='CreationTime' type='datetime-local' />\n";
	
				echo	"<label class='form_label'>Username</label>\n";
				echo	"<input name='Username' type='text' />\n";
				echo	"<label class='form_label'>Password</label>\n";
				echo	"<input name='UserPassword' type='text' />\n";
				echo	"<label class='form_label'>Signature</label>\n";
				echo	"<input name='Signature' type='text' />\n";
				echo	"<label class='form_label'>JobTitle</label>\n";
				echo	"<input name='JobTitle' type='text' />\n";
				echo	"<label class='form_label'>UserStatus</label>\n";
				echo	"<input name='UserStatus' type='text' />\n";
				echo	"<input type='hidden' name='add' value='0' />\n";
				echo	"<br />";
				echo	"<input class='btn btn-primary' type='submit' value='submit' />";
			}
            ?>
		</form>
	</div>


<!-- Patient selection -->
<?php
if((empty($_POST) == true && empty($_POST['edit']) == false) || empty($_GET['edit']) == true)
{
?>

<table class="data_table">
	<tbody>
		<tr>
			<th>ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Creation Time</th>
			<th>Username</th>
			<th>Password</th>
	        <th>Signature</th>		
    	    <th>Job Title</th>
			<th>User Status('Admin' or 'Normal')</th>
			<th></th>
		</tr>

        <?php
	$stmt = $mysqli->prepare("SELECT UserID, FName, LName, CreationTime, Username, UserPassword, Signature, JobTitle, UserStatus FROM User");
	if(!$stmt->execute())
	{
		echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

	if(!$stmt->bind_result($id, $fname, $lname, $ctime, $username, $password, $signature, $jobtitle, $userstatus))
	{
		echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	$counter = 0;
	while($stmt->fetch())
	{
		echo "<tr id='" . $id . "'>\n<td>\n" . $id . "</td>\n<td>\n" . $fname . "</td>\n<td>\n" . $lname . "</td>\n<td>\n" . $ctime . "</td>\n <td>\n" . $username . "</td>\n <td>\n" . $password . "</td>\n <td>\n" . $signature . "</td>\n <td>\n" . $jobtitle . "</td>\n <td>\n" . $userstatus . "</td>\n";
/*        echo "<td>\n<input class='btn btn-default'onclick='GotoPatientGenes(" . $id . ")' type='button'  value='Genes'/></td>\n";
        echo "<td>\n<input class='btn btn-secondary'onclick='GotoPatientDiseases(" . $id . ")' type='button'  value='Diseases'/></td>\n";
        echo "<td>\n<input class='btn btn-info' onclick='GotoPatientDrugs(" . $id . ")' type='button'  value='Drugs'/></td>\n";
	*/	echo "<td>\n<input class='btn btn-warning' onclick='EditRequest(". $id ."," . $address . ")' type='button' value='Edit'/>\n";
        echo "<input class='btn btn-danger' onclick='DeleteRequest(" . $id . "," . $address . ")' type='button' value='Delete'/>\n</td>\n</tr>\n";
		}
        ?>
	</tbody>
</table>

<?php
}
	unset($_GET);
	unset($_POST);
	include("includes/footer.php");
?>


