<?php
ini_set('display_errors', 'On');
session_start();
if($_SESSION['user_name'] == '') {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pyxis Recognition Awards</title>
    <!-- jQuery -->
    <script
    src="http://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="navbar.css" />
    <link rel="stylesheet" type="text/css" href="TableCSSCode.css" />

    <script src="get_script.js"></script>
    <script src="add_script.js"></script>
</head>
<body>
<div id="menu">
    <ul>
        <li><a  href="member.php" title="">Home</a></li>
        <li><a  href="user.php" title="">Edit User Details</a></li>
        <li><a  href="award.php"  title="">Create Award</a></li>
        <li><a  href="logout.php" title="">Logout</a></li>
    </ul>
</div>
<h2> 
Create an award by entering the recipient's name, email address, type of award and date awarded.
</h2>
<form class="form-inline" id="add-award-form" action="add_award.php" method="post">
    <div class="form-group">
        <select class="form-control" name="Type">
            <option value="" selected disabled>Type of Award</option>
            <option value="month">Employee of the Month</option>
            <option value="week">Employee of the Week</option>
        </select>
    </div>
    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="FName" placeholder="First Name">
    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="LName" placeholder="Last Name">
    <input type="email" class="form-control mb-2 mr-sm-2 mb-sm-0" name="Email" placeholder="Email Address">
    <input type="datetime-local" class="form-control mb-2 mr-sm-2 mb-sm-0" name="AwardCreationTime" placeholder="Date and Time">
    <button type="submit" class="btn btn-default">
      <span class="glyphicon glyphicon-plus"></span> Add Award
    </button>
</form>

<div id="award-message"></div>

<div id="award-table-holder" class="CSSTableGenerator"></div>

</body>
</html>