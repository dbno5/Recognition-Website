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
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script src="http://getbootstrap.com/dist/js/bootstrap.js"></script>
	<script src="http://1000hz.github.io/bootstrap-validator/dist/validator.min.js"></script>
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