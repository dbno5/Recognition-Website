<?php
 include('includes/header.php');
 include('includes/configdb-procedural.php');
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <script src="js/signature.js"></script>

</head>
<body>
<?php include('includes/navbar.php'); ?>
<div class="container">
  <h2>Edit User Details</h2>
  <p>Below you may edit existing details of your account, add a job title and location, as well as upload a signature which is required to create an award.</p>
  <form class="form-inline" action="user.php" method="post">
    <div class="form-group">
      <label for="FName">First Name:</label>
      <input type="text" class="form-control" id="FName" placeholder="Enter First Name" name="FName">
    </div>
    <div class="form-group">
      <label for="LName">Last Name:</label>
      <input type="text" class="form-control" id="LName" placeholder="Enter Last Name" name="LName">
    </div>
    <div class="form-group">
      <label for="JobTitle">Job Title:</label>
      <input type="text" class="form-control" id="JobTitle" placeholder="Enter Job Title" name="JobTitle">
    </div>
    <div class="form-group">
      <label for="Location">Location:</label>
      <input type="text" class="form-control" id="Location" placeholder="Enter Location" name="Location">
    </div>
    <button type="submit" class="btn btn-default">Update</button>
  </form>
</div>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $Username=$_SESSION['user_name'];
  $FName=(isset($_POST['FName']) ? $_POST['FName'] : null);
  $LName=(isset($_POST['LName']) ? $_POST['LName'] : null);
  $JobTitle=(isset($_POST['JobTitle']) ? $_POST['JobTitle'] : null);
  $Location=(isset($_POST['Location']) ? $_POST['Location'] : null);

  if(!mysqli_query($mysqli,"UPDATE Users SET FName = '$FName', LName ='$LName', JobTitle = '$JobTitle', Location = '$Location' WHERE Username ='$Username'")){
      echo "Update failed: (" . $mysqli->errno . ") " . $mysqli->error; 
  }

  $result = mysqli_query($mysqli,"SELECT * FROM Users WHERE Username = '$Username' ORDER BY UserID DESC");

  echo "<div class='container'>";
  echo "<table class='table table-bordered'>"; 
  echo "<tr><td>User ID</td><td>Email</td><td>First Name</td><td>Last Name</td><td>Username</td><td>Job Title</td><td>Location</td><td>Signature Path</td></tr>";

  while($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
  echo "<tr><td>" . $row['UserID'] . "</td><td>" . $row['Email'] . "</td><td>" . $row['FName'] . "</td><td>" . $row['LName'] . "</td><td>" . $row['Username'] . "</td><td>" . $row['JobTitle'] . "</td><td>" . $row['Location'] . "</td><td>" . $row['Signature'] . "</td></tr>";}

  echo "</table>";
  echo "</div>";
}
?>
        <div><p></p></div>
        <div class="container">
        <div id="canvas">
            <canvas class="roundCorners" id="newSignature"
            style="position: relative; margin: 0; padding: 0; border: 1px solid #c4caac;"></canvas>
        </div>

        <script>
            signatureCapture();
        </script>

        <button type="button" onclick="signatureClear()" class="btn btn-default">
            Clear signature
        </button>

        <div>
            <input type="button" onclick="uploadEx()" value="Upload" class="btn btn-default"/>
        </div>
 
        <form method="post" accept-charset="utf-8" name="form1">
            <input name="hidden_data" id='hidden_data' type="hidden"/>
        </form>
        </div>
        <script>
            function uploadEx() {
                var canvas = document.getElementById("newSignature");
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden_data').value = dataURL;
                var fd = new FormData(document.forms["form1"]);
 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload_data.php', true);
 
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');
                        alert('Succesfully uploaded');
                    }
                };
 
                xhr.onload = function() {
 
                };
                xhr.send(fd);
            };
        </script>
</body>
</html>