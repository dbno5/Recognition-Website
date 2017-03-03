$(document).ready(function() {
  loadTable();
});

function loadTable() {
  $('#award-table-holder').load('get_award.php');
}
