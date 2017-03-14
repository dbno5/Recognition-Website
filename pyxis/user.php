<?php
include('includes/header.php');
include('includes/configdb.php');

$Username = $_SESSION['user_name'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $FName=(isset($_POST['FName']) ? $_POST['FName'] : null);
  $LName=(isset($_POST['LName']) ? $_POST['LName'] : null);
  $JobTitle=(isset($_POST['JobTitle']) ? $_POST['JobTitle'] : null);
  $Location=(isset($_POST['Location']) ? $_POST['Location'] : null);

  if(!($stmt = $mysqli->prepare("UPDATE Users SET FName = ?, LName = ?, JobTitle = ?, Location = ? 
      WHERE Username = ?"))) {
      echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->bind_param("sssss", $FName, $LName, $JobTitle, $Location, $Username))) {
      echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->execute())) {
      echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
  }
  else {
      // echo "User details have been updated.";
  }
  $stmt->close();
}

if (!($stmt = $mysqli->prepare("SELECT FName, LName, JobTitle, Location FROM Users WHERE Username = ?"))) {
        echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("s", $Username))) {
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->bind_result($first, $last, $title, $loc)) {
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <script src="js/user.js"></script>
    <script src="js/signature.js"></script>

</head>
<body>
<?php include('includes/navbar.php'); ?>
<div class="container">
  <h2>Edit User Details</h2>
  <div id="user-message"></div>
  <p>Below you may edit existing details of your account, add a job title and location, as well as upload a signature which is required to create an award.</p>
  <form class="form-inline" action="user.php?update=1" method="post">
    <div class="form-group">
      <label for="FName">First Name:</label>
      <input type="text" class="form-control" id="FName" placeholder="First Name" name="FName" value="<?php echo $first; ?>" required>
    </div>
    <div class="form-group">
      <label for="LName">Last Name:</label>
      <input type="text" class="form-control" id="LName" placeholder="Last Name" name="LName" value="<?php echo $last; ?>" required>
    </div>
    <div class="form-group">
      <label for="JobTitle">Job Title:</label>
      <input type="text" class="form-control" id="JobTitle" placeholder="Job Title" name="JobTitle" value="<?php echo $title; ?>" required>
    </div>
    <div class="form-group">
      <label for="Location">Location:</label>
      <input type="text" class="form-control" id="Location" placeholder="Location" name="Location" value="<?php echo $loc; ?>" required>
    </div>
    <button type="submit" class="btn btn-default">Update</button>
  </form>
</div>
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
                        var userMessage = $('#user-message');
                        $(userMessage).text('User signature has been uploaded.');
                        $(userMessage).addClass('alert alert-info');
                    }
                };
 
                xhr.onload = function() {
 
                };
                xhr.send(fd);
            };
        </script>
</body>
</html>