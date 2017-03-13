<?php
 session_start();
 include 'includes/configdb.php';
 if(isset($_POST['submit']))
 {
  $Email = trim($_POST['Email']);
  $UserPassword = trim($_POST['UserPassword']);
  $query = "SELECT * FROM Users WHERE Email='$Email' AND UserPassword='$UserPassword' AND com_code IS NULL";
  $result = mysqli_query($mysqli,$query)or die(mysqli_error());
  $num_row = mysqli_num_rows($result);
  $row=mysqli_fetch_array($result);
  if( $num_row ==1 )
         {
   $_SESSION['user_name']=$row['Username'];
   echo '<script type="text/javascript">window.location.href="member.php";</script>';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

	  <link rel="stylesheet" type="text/css" href="CSS/styles.css">
</head>
<body>
    
  <div class="container">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      <form class="form-signin" method="POST" form action="login.php" id="signupForm">
        <h2 class="form-signin-heading">Pyxis Awards Login</h2>
        <div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"></span>
		  <input type="email" name="Email" class="form-control" placeholder="Email" id="Email" required>
		</div>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"></span>
		  <input type="password" name="UserPassword" class="form-control" placeholder="Password" id="UserPassword" required>
		</div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Login</button>

      </form>
</div>  




<div class="container">
	<h4 class="form-signin"><a href="recover.php">Recover Password</a></h4>
</div>

    <p><a class="pos_fixed" href="index.php">Sign Up</a></p>


</body>

</html>





