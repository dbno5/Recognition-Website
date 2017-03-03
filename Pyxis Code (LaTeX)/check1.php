<?php
include('configdb.php');

$Email = trim(strtolower($_POST['Email']));

$query1 = "SELECT Email FROM Users WHERE Email = '$Email' LIMIT 1";

$result1 = mysqli_query($mysqli,$query1);

$num1 = mysqli_num_rows($result1);

echo $num1;

mysqli_close();
?>