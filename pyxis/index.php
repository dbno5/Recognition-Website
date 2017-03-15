<?php
session_start();
if(isset($_SESSION['error']))
{
	echo '<p>'.$_SESSION['error']['Username'].'</p>';
	echo '<p>'.$_SESSION['error']['Email'].'</p>';
	echo '<p>'.$_SESSION['error']['FName'].'</p>';
	echo '<p>'.$_SESSION['error']['LName'].'</p>';
	echo '<p>'.$_SESSION['error']['UserPassword'].'</p>';
	unset($_SESSION['error']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Pyxis Recognition</title>

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

 <form data-toggle="validator" role="form" class="form-signin" form action="register.php" method="post">
	 <legend> Pyxis Recognition Registration </legend>

   <div class="form-group has-feedback">
 
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" pattern="^[A-Za-z]{2,}$" maxlength="15" class="form-control" name="FName" id="FName" placeholder="First Name" data-error="Only letters and at least 2 characters long" required>
    </div>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    <div class="help-block with-errors"></div>
  </div>


    <div class="form-group has-feedback">
 
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	  <input type="text" pattern="^[A-Za-z]{2,}$" maxlength="15" class="form-control" name="LName" id="FName" placeholder="Last Name" data-error="Only letters and at least 2 characters long" required>
    </div>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    <div class="help-block with-errors"></div>
  </div>


  <div class="form-group has-feedback">

    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
      <input type="text" pattern="[a-zA-Z0-9]{4,}$" maxlength="15" class="form-control" name="Username" id="Username" placeholder="Username"  data-error="Only letters and numbers and at least 4 characters" required>
    </div>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    <div class="help-block with-errors"></div>
  </div>


  <div class="form-group has-feedback">

    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" name="Email" id="Email" placeholder="Email" data-error="Email address is invalid" required>
    </div>
    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
    <div class="help-block with-errors"></div>
  </div>

  <div class="form-group has-feedback">
 
    <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
      <input type="password" class="form-control" name="UserPassword" id="UserPassword" placeholder="Password" data-minlength="8" data-error="Minimum of 8 characters" required>
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