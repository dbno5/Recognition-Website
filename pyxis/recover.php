<?php
ini_set('display_errors', 'On');
include('includes/configdb.php');
require('PHPMailer/PHPMailerAutoload.php');

if(isset($_POST) & !empty($_POST)){
	$Email = mysqli_real_escape_string($mysqli, $_POST['Email']);
	$sql = "SELECT * FROM Users WHERE Email = '$Email'";
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
			echo "Your Password has been sent to your email";
		}else{
			echo "Failed to Recover your password, try again";
		}

	}else{
		echo "Email does not exist in database";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- jQuery -->
	<script
	src="http://code.jquery.com/jquery-3.1.1.min.js"
	integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	crossorigin="anonymous"></script>

	<!-- Bootstrap -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- Bootstrap Validator -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
	<script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js"></script>

	<link rel="stylesheet" type="text/css" href="CSS/styles.css">
</head>
<body>
    
 <div class="container">

 <form data-toggle="validator" role="form" class="form-signin" form action="recover.php" method="post">
	 <legend> Pyxis Password Recovery </legend>

  <div class="form-group has-feedback">

    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" name="Email" id="Email" placeholder="Email" data-error="Email address is invalid" required>
    </div>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    <div class="help-block with-errors"></div>
  </div>


  <div class="form-group">
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </div>
</form>
</div> 

<a class="pos_fixed" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
</body>
</html>