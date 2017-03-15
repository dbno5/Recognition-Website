<?php
 include('configdb.php');
 $passkey = $_GET['passkey'];
 $sql = "UPDATE Users SET com_code=NULL WHERE com_code='$passkey'";
 $result = mysqli_query($mysqli,$sql) or die(mysqli_error());
 if($result)
 {
   echo "Your account is now active...redirecting to login.";
   echo "<script>setTimeout(\"window.location.href = 'http://web.engr.oregonstate.edu/~hernandv/Assignment%201/Pyxis_Validation/login.php';\",1500);</script>";
}
 else
 {
  echo "Some error occurred.";
 }
?>