<?php
include('configdb.php');

$Username = trim(strtolower($_POST['Username']));

$query = "SELECT Username FROM Users WHERE Username = '$Username' LIMIT 1";

$result = mysqli_query($mysqli,$query);

$num = mysqli_num_rows($result);

echo $num;

mysqli_close();
?>
