<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hernandv-db","J9RlSghRw6FKvLq8","hernandv-db");
if($mysqli->connect_error){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
	<?php echo $pageTitle ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="CSS/style.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">User Database</a>
            <ul id="navigation" class="nav navbar-nav navbar-right">
                <li><a href="users.php">Account Management</a></li>
            	    <li><a href="export.php">Export a query as CSV</a></li>
            	    <li><a href="reportHome.php">Reporting</a></li>
            </ul>
        </div>
    </nav>
</head>

<body>
<div class="main-container">
