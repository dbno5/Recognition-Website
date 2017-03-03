<?php
 session_start();
 if($_SESSION['user_name'] == '')
 {
  header("Location: index.php");
  exit;
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pyxis Recognition Awards</title>
	<link rel="stylesheet" type="text/css" href="TableCSSCode.css" />

</head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: rgba(4, 118, 155, 0.95);
}
</style>
<body>
				<div id="menu">
				<ul>
					<li><a href="member.php" title="">Home</a></li>
					<li><a href="user.php" title="">Edit User Details</a></li>
					<li><a href="award.php"  title="">Create Award</a></li>
					<li><a href="logout.php" title="">Logout</a></li>
				</ul>
			</div>
	
<h2>Welcome <?php echo "".$_SESSION['user_name'];?> to the Pyxis Employee Recognition website!</h2>
<p> 
 
Through this site you will be able to create recognition awards to send via email to employees. You will also be able to remove past awards given as well as view and edit your user details that were entered upon account creation. 
 
To get started please use the links above.</p>


</body>
</html>