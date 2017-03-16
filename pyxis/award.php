<?php
include('includes/header.php');
include('includes/configdb.php');
include('includes/fieldCheck.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Create Award</title>
    <!-- jQuery -->
    <script
    src="http://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>

    <!-- Tablesorter -->
    <link href="tablesorter/css/theme.default.css" rel="stylesheet">
    <script src="tablesorter/jquery.tablesorter.min.js"></script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="CSS/styles.css" />
    <link rel="stylesheet" type="text/css" href="CSS/award.css" />

    <script src="js/award_script.js"></script>
</head>
<body>
<?php include('includes/navbar.php'); ?>
<div class="container">
<h2>Create an Award</h2>
<form class="form-inline" id="add-award-form" action="add_award.php" method="post">
    <div class="form-group">
        <select class="form-control" name="Type" required>
            <option value="" selected disabled>Type of Award</option>
            <option value="month">Employee of the Month</option>
            <option value="week">Employee of the Week</option>
        </select>
    </div>
    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="FName" placeholder="First Name" maxlength="12" required>
    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="LName" placeholder="Last Name" maxlength="12" required>
    <input type="email" class="form-control mb-2 mr-sm-2 mb-sm-0" name="Email" placeholder="Email Address" required>
    <input type="datetime-local" class="form-control mb-2 mr-sm-2 mb-sm-0" name="AwardCreationTime" required><span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-placement="top" title="Date and time when the award was granted"></span>
    <button type="submit" class="btn btn-primary">
      <span class="glyphicon glyphicon-plus"></span>
    </button>
</form>

<div id="award-message"></div>

<div id="award-table-holder"></div>
</div>

<div id="edit-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Award</h4>
      </div>
      <div class="modal-body">
        <div id="dynamic-content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>