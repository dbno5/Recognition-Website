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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pyxis Sign Up</title>
<link rel="stylesheet" type="text/css" href="styles.css" />


<script type="text/javascript" src="http://web.engr.oregonstate.edu/~hernandv/jquery/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#Username').keyup(username_check);
});
	
function username_check(){	
var Username = $('#Username').val();
if(Username == "" || Username.length < 4){
$('#Username').css('border', '3px #CCC solid');
$('#tick').hide();
$('#cross').hide();
$('.field1').hide();
$('.field4').fadeIn();
}else{

jQuery.ajax({
   type: "POST",
   url: "check.php",
   data: 'Username='+ Username,
   cache: false,
   success: function(response){
if(response == 1){
	$('#Username').css('border', '3px #C33 solid');	
	$('#tick').hide();
	$('.field4').hide();
	$('#cross').fadeIn();
	$('.field1').fadeIn();

	}else{
	$('#Username').css('border', '3px #090 solid');
	$('#cross').hide();
	$('.field1').hide();
	$('#tick').fadeIn();
	$('.field4').hide();
	     }

}
});
}
}

$(document).ready(function(){
$('#Email').keyup(email_check);
});
	
function email_check(){	
var Email = $('#Email').val();
if(Email == "" || Email.length < 1){
$('#Email').css('border', '3px #CCC solid');
$('#tick1').hide();
$('#cross1').hide();
$('.field2').hide();

}else{

jQuery.ajax({
   type: "POST",
   url: "check1.php",
   data: 'Email='+ Email,
   cache: false,
   success: function(response){
if(response == 1){
	$('#Email').css('border', '3px #C33 solid');	
	$('#tick1').hide();
	$('#cross1').fadeIn();
	$('.field2').fadeIn();
	}else{
	$('#Email').css('border', '3px #090 solid');
	$('#cross1').hide();
	$('.field2').hide();
	$('#tick1').fadeIn();
	     }
}
});
}
}

$(document).ready(function(){
$('#UserPassword').keyup(password_check);
});
	
function password_check(){	
var UserPassword = $('#UserPassword').val();
if(UserPassword == "" || UserPassword.length < 1){
$('#UserPassword').css('border', '3px #CCC solid');
$('#tick2').hide();
$('#cross2').hide();
$('.field3').hide();
}else if(UserPassword.length < 8){
	$('#UserPassword').css('border', '3px #C33 solid');	
	$('#tick2').hide();
	$('#cross2').fadeIn();
	$('.field3').fadeIn();
}else{
	$('#UserPassword').css('border', '3px #090 solid');
	$('#cross2').hide();
	$('.field3').hide();
	$('#tick2').fadeIn();
	}
}
</script>

</head>

</head>
<body>

<div id="carbonForm">
    <h1>Pyxis Recognition Awards - Signup</h1>

    <form action="register.php" method="post" id="signupForm">

        <div class="fieldContainer">
            <div class="formRow">
				<div class="label">
					<label for="name">Username:</label>
				</div>

				<div class="field">
					<input type="text" name="Username" id="Username" />
					<img id="tick" src="tick.png" width="16" height="16"/>
					<img id="cross" src="cross.png" width="16" height="16"/>
				</div>
					<div class="field1">
						<p>Username Taken</p>
					</div>
					<div class="field4">
						<p>Username must be 4 characters</p>
					</div>
			
			</div>
            
            
            <div class="formRow">
				<div class="label">
					<label for="name">First Name:</label>
				</div>

				<div class="field">
					<input type="text" name="FName" id="FName" />
				</div>
			
			
			</div>
			
			            <div class="formRow">
				<div class="label">
					<label for="name">Last Name:</label>
				</div>

				<div class="field">
					<input type="text" name="LName" id="LName" />
				</div>
			
			
			</div>
            
            <div class="formRow">
				<div class="label">
					<label for="name">Email:</label>
				</div>

				<div class="field">
					<input type="text" name="Email" id="Email" />
					<img id="tick1" src="tick.png" width="16" height="16"/>
					<img id="cross1" src="cross.png" width="16" height="16"/>
				</div>
					<div class="field2">
						<p>Email Already In Use</p>
					</div>
			
			
			</div>
		
            <div class="formRow">
				<div class="label">
					<label for="name">Password:</label>
				</div>

				<div class="field">
					<input type="password" name="UserPassword" id="UserPassword" />
					 <img id="tick2" src="tick.png" width="16" height="16"/>
					 <img id="cross2" src="cross.png" width="16" height="16"/>
				</div>
					<div class="field3">
						<p>Password needs 8 characters</p>
					</div>
			
			</div>
       
        
        </div>

        <div class="signupButton">
            <input type="submit" name="submit" id="submit" value="Signup" />
        </div>
   
    </form>

</div>
<div id="carbonForm">

 <p>Username must be at least 4 characters. Password must be at least 8 characters.</p>

</div>

<p><a class="pos_fixed" href="login.php">Login</a></p>

</body>
</html>