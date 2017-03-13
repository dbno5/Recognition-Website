<?php
session_start();
if($_SESSION['user_name'] == '') {
    header("Location: index.php");
    exit;
}

ini_set('display_errors', 'On');