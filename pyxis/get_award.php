<?php
include 'includes/header.php';
include 'includes/configdb.php';

$Username = $_SESSION['user_name'];

$result = mysqli_query($mysqli,"SELECT * FROM Award WHERE FK_UserID = (SELECT UserID FROM Users WHERE Username = '$Username') ORDER BY AwardID DESC");
?>

<script>
$(document).ready(function() {
  $('#award-table').tablesorter({
    headers: {
      // Disable sorting for these headers
      '.table-actions' : {
        sorter: false
      }
    }
  });
});
</script>

<?php
if(mysqli_num_rows($result) == 0) {
  echo '<div class="alert alert-info text-center">No awards found. Please try creating one.</div>';
}
else {
  echo '<table class="table table-bordered table-striped tablesorter" id="award-table">
<thead>
  <tr>
    <th>Award ID</th>
    <th>Award Type</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Date Granted</th>
    <th colspan="3"><span class="table-actions"></span></th>
  </tr>
</thead>
<tbody>';

  while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
  echo "<tr>
  <td>" . $row['AwardID'] . "</td>
  <td>" . $row['Type'] . "</td>
  <td>" . $row['FName'] . "</td>
  <td>" . $row['LName'] . "</td>
  <td>" . $row['Email'] . "</td>
  <td>" . $row['AwardCreationTime'] . "</td>
  <td><a href='generate.php?id=" . $row['AwardID'] . "' target='_blank'>Generate Award</a></td>
  <td><button type='button' class='btn btn-default btn-sm edit-award' data-toggle='modal' data-target='#edit-modal' data-id='" . $row['AwardID'] . "'>
    <span class='glyphicon glyphicon-pencil'></span> Edit</button>
  </td>
  <td><button type='button' class='btn btn-danger btn-sm delete-award' id='" . $row['AwardID'] . "'>
    <span class='glyphicon glyphicon-remove'></span> Delete</button>
  </td>
  </tr>
  </tbody>
  </table>";
  } 
}