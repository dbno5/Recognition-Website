<?php
include('configdb.php');

$UserPassword = trim($_POST['UserPassword']);

$query2 = "SELECT UserID FROM Users WHERE UserPassword = '$UserPassword' LIMIT 1";

$result2 = mysqli_query($mysqli,$query2);

$num2 = mysqli_num_rows($result2);

echo $num2;

mysqli_close();
?>