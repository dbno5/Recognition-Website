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
	<title>Sign Up</title>
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
</head>
<body>

  <div class="container">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      <form class="form-signin" form action="register.php" method="post" id="signupForm">
        <h2 class="form-signin-heading">Pyxis Awards Login</h2>
        <div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"></span>
		  <input type="text" name="Username" class="form-control" placeholder="Username" id="Username" required>
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"></span>
		  <input type="text" name="FName" class="form-control" placeholder="First Name" id="FName" required>
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"></span>
		  <input type="text" name="LName" class="form-control" placeholder="Last Name" id="LName" required>
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"></span>
		  <input type="email" name="Email" class="form-control" placeholder="Email" id="Email" required>
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"></span>
		  <input type="password" name="UserPassword" class="form-control" placeholder="Password" id="UserPassword" required>
		</div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign Up</button>

      </form>
</div> 


<p><a class="pos_fixed" href="login.php">Login</a></p>

</body>
 

</html>