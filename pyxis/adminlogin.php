<?php
 session_start();
 include('includes/configdb.php');
 if(isset($_POST['submit']))
 {
  $Email = trim($_POST['Email']);
  $UserPassword = trim($_POST['UserPassword']);
  $query = "SELECT * FROM Users WHERE Email='$Email' AND UserPassword='$UserPassword' AND UserStatus='admin' AND com_code IS NULL";
  $result = mysqli_query($mysqli,$query)or die(mysqli_error());
  $num_row = mysqli_num_rows($result);
  $row=mysqli_fetch_array($result);
  if( $num_row ==1 )
         {
   $_SESSION['user_name']=$row['Username'];
   echo '<script type="text/javascript">window.location.href="http://web.engr.oregonstate.edu/~channa/pyxis/backendIndex.php";</script>';
        die();
   exit;
  }
  else
         {
   echo 'You must verify account or create account before use';
   
   echo '<script type="text/javascript">window.location.href="index.php";</script>';
        die();
  }
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

 <form data-toggle="validator" role="form" class="form-signin" form action="adminlogin.php" method="post">
	 <legend> Pyxis Recognition Admin </legend>

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

    <p><a class="pos_fixed" href="index.php"><span class="glyphicon glyphicon-pencil"></span> Register</a>


</body>

</html>
