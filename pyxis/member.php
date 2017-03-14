<?php
include('includes/header.php');
include('includes/configdb.php');
include('includes/fieldCheck.php');
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Pyxis Recognition Awards</title>
    <!-- jQuery -->
    <script
    src="http://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <script src="js/signature.js"></script>
</head>
<body>
<?php include('includes/navbar.php'); ?>
<div class="container">
<h2>Welcome <?php echo "" . $_SESSION['user_name']; ?> to the Pyxis Employee Recognition website!</h2>
<p>
This site allows you to create recognition awards that can be emailed to employees. You will also be able to edit and delete awards previously given as well as view and edit your user details that were entered upon account creation.</p>
</div>
</body>
</html>