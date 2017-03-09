<?php
 session_start();
 if($_SESSION['user_name'] == '')
 {
  header("Location: index.php");
  exit;
 }
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Pyxis Recognition Awards</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="signature.js"></script>

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" >Pyxis Recognition</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="member.php">Home</a></li>
      <li><a href="user.php">User Details</a></li>
      <li><a href="award.php">Create Award</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
	
<div class="container">
<h2>Welcome <?php echo "".$_SESSION['user_name'];?> to the Pyxis Employee Recognition website!</h2>
<p> 
 
Through this site you will be able to create recognition awards to send via email to employees. You will also be able to remove past awards given as well as view and edit your user details that were entered upon account creation. 
 
To get started please use the links above.</p>
</div>

</body>
</html>