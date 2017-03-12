<?php
include 'includes/header.php';
include 'includes/configdb-oop.php';

if (!($stmt = $mysqli->prepare("SELECT AwardID, Type, FName, LName, Email, AwardCreationTime, FK_UserID FROM Award WHERE AwardID = ?"))) {
        echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}

if(!($stmt->bind_param("i", $_GET['id']))) {
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: " . $stmt->errno . " " . $stmt->error;
}

if (!$stmt->bind_result($awardID, $awardType, $recipientFName, $recipientLName, $recipientEmail, $awardCreationTime, $creatorUserID)) {
    echo "Bind failed: " . $stmt->errno . " " . $stmt->error;
}

$stmt->fetch();
$stmt->close();
?>

<form id="edit-award-form" action="process_edit_award" method="post">
    <div class="form-group">
        <select class="form-control" name="Type">
        <?php
        if ($awardType == 'month') {
            echo '<option value="month" selected>Employee of the Month</option>
                  <option value="week">Employee of the Week</option>';
        }
        else if ($awardType == 'week') {
            echo '<option value="month">Employee of the Month</option>
                  <option value="week" selected>Employee of the Week</option>';
        }
        else {
            echo '<option value="month">Employee of the Month</option>
                  <option value="week">Employee of the Week</option>';
        }
        ?>
        </select>
    </div>
    <div class="form-group">
        <input class="form-control" name="FName" type="text" value="<?php echo $recipientFName; ?>"/>
    </div>
    <div class="form-group">
        <input class="form-control" name="LName" type="text" value="<?php echo $recipientLName; ?>"/>
    </div>
    <div class="form-group">
        <input class="form-control" name="Email" type="email" value="<?php echo $recipientEmail; ?>"/>
    </div>
    <?php
    $formattedDate = DateTime::createFromFormat('Y-m-d H:i:s', $awardCreationTime);
    ?>
    <div class="form-group">
        <input class="form-control" name="AwardCreationTime" type="datetime-local" value="<?php echo $formattedDate->format('Y-m-d\TH:i:s'); ?>"/>
    </div>
    <input type="hidden" name="AwardID" value="<?php echo $awardID; ?>" />
    <button type="submit" class="btn btn-primary" name="submit">Update</button>
  </div>
</form>