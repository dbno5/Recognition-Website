<?php
ini_set('display_errors', 'On');

include 'includes/configdb-procedural.php';
require('PHPMailer/PHPMailerAutoload.php');

if(isset($_POST) & !empty($_POST)){
	$Username = mysqli_real_escape_string($mysqli, $_POST['Username']);
	$sql = "SELECT * FROM Users WHERE Username = '$Username'";
	$res = mysqli_query($mysqli, $sql);
	$count = mysqli_num_rows($res);
	if($count == 1){
		$r = mysqli_fetch_assoc($res);
		$UserPassword = $r['UserPassword'];
		$to = $r['Email'];
		$subject = "Your Recovered Password";

		$message = "Please use this password to login " . $UserPassword;
		$headers = "From : Pyxis Recognition";
		if(mail($to, $subject, $message, $headers)){
			echo "Your Password has been sent to your email id";
		}else{
			echo "Failed to Recover your password, try again";
		}

	}else{
		echo "User name does not exist in database";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

	<link rel="stylesheet" type="text/css" href="CSS/styles.css">
</head>
<body>
<div class="container">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Enter Username</h2>
        <div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"></span>
		  <input type="text" name="Username" class="form-control" placeholder="Username" required>
		</div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Forgot Password</button>

      </form>
</div>
<p><a class="pos_fixed" href="login.php">Login</a></p>
</body>
</html>