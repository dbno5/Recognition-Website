<?php
 session_start();
 include('configdb.php');
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="styles.css" />

<script type="text/javascript" src="http://web.engr.oregonstate.edu/~hernandv/jquery/jquery-2.1.0.min.js"></script>
<script>
$(document).ready(function(){
$('#Email').keyup(email_check);
});
	
function email_check(){	
var Email = $('#Email').val();
if(Email == "" || Email.length < 4){
$('#Email').css('border', '3px #CCC solid');
$('#tick').hide();
$('#cross').hide();
$('.field1').hide();

}else{

jQuery.ajax({
   type: "POST",
   url: "check1.php",
   data: 'Email='+ Email,
   cache: false,
   success: function(response){
if(response == 1){
	$('#Email').css('border', '3px #090 solid');	
	$('#cross').hide();
	$('.field1').hide();
	$('#tick').fadeIn();
	}else{
	$('#Email').css('border', '3px #C33 solid');
	$('#tick').hide();
	$('#cross').fadeIn();
	$('.field1').fadeIn();
	}
}
});
}
}
</script>

<script>

$(document).ready(function(){
$('#UserPassword').keyup(password_check);
});
	
function password_check(){	
var UserPassword = $('#UserPassword').val();

if(UserPassword == "" || UserPassword.length < 4){
$('#UserPassword').css('border', '3px #CCC solid');
$('#tick1').hide();
$('#cross1').hide();
$('.field2').hide();

}else{
jQuery.ajax({
   type: "POST",
   url: "check2.php",
   data: 'UserPassword='+ UserPassword,
   cache: false,
   success: function(response){
if(response == 1){
	$('#UserPassword').css('border', '3px #090 solid');	
	$('#cross1').hide();
	$('.field2').hide();
	$('#tick1').fadeIn();
	}else{
	$('#UserPassword').css('border', '3px #C33 solid');
	$('#tick1').hide();
	$('#cross1').fadeIn();
	$('.field2').fadeIn();

	     }

}
});
}
}

</script>



</head>
<body>





<div id="carbonForm">
    <h1>Pyxis Awards Login</h1>

    <form action="login.php" method="post" id="signupForm">

        <div class="fieldContainer">
          <div class="formRow">
				<div class="label">
					<label for="name">Email:</label>
				</div>

				<div class="field">
					<input type="text" name="Email" id="Email" />
					<img id="tick" src="tick.png" width="16" height="16"/>
					<img id="cross" src="cross.png" width="16" height="16"/>
				</div>
				<div class="field1">
						<p>Invalid Email</p>
				</div>
			
			
			</div>
            
            
            <div class="formRow">
				<div class="label">
					<label for="name">Password:</label>
				</div>

				<div class="field">
					<input type="UserPassword" name="UserPassword" id="UserPassword" />
					 <img id="tick1" src="tick.png" width="16" height="16"/>
					 <img id="cross1" src="cross.png" width="16" height="16"/>
				</div>
				<div class="field2">
						<p>Incorrect Password</p>
				</div>
			</div>
        
        
        </div>

        <div class="signupButton">
            <input type="submit" name="submit" id="submit" value="Signup" />
        </div>

    </form>
    <p><a class="pos_fixed" href="index.php">Home</a></p>

</div>
<div id="carbonForm">

 <p>In order to login you must click on the verification email sent to your email account</p>

</div>
</body>

</html>







