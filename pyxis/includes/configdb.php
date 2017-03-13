<?php
include 'includes/storedInfo.php';

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hernandv-db",$myPassword,"hernandv-db");

if($mysqli->connect_errno){
  echo "Connection error " .$mysqli->connect_errno ."".$mysqli->connect_error;
}