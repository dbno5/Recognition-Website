// https://teamtreehouse.com/community/how-to-create-an-ajaxphp-contact-form
// http://www.codingcage.com/2016/09/bootstrap-modal-with-dynamic-mysql-data.html

$(document).ready(function() {
  // Enable tooltips
  $('[data-toggle="tooltip"]').tooltip();

  // Populate table
  loadTable();

  // Get form
  var form = $('#add-award-form');

  // Get messages div
  var awardMessage = $('#award-message');

  // Set up an event listener for form
  $(form).submit(function(event) {
    // Stop the browser from submitting form
    event.preventDefault();

    // Serialize form data
    var formData = $(form).serialize();

    // Submit form using AJAX
    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: formData
    }).done(function(response) {
      // Reset form fields
      $(form)[0].reset();

      // Load table
      loadTable();

      // Set success class
      $(awardMessage).removeClass('alert alert-danger');
      $(awardMessage).addClass('alert alert-success');

      // Set message text
      $(awardMessage).text(response);
    }).fail(function(data) {
      // Set error class
      $(awardMessage).removeClass('alert alert-success');
      $(awardMessage).addClass('alert alert-danger');

      // Set message text
      if (data.responseText !== '') {
        $(awardMessage).text(data.responseText);
      } else {
        $(awardMessage).text('Error adding award. Please try again.');
      }
    });
  });
});

$(document).on('click', '.edit-award', function(e) {
  e.preventDefault();

  // data-id of clicked row
  var awardID = $(this).data('id');

  $.ajax({
      url: 'edit_award.php',
      type: 'GET',
      data: 'id=' + awardID,
      dataType: 'html'
  })
  .done(function(data) {
    // Clear
    $('#dynamic-content').html('');
    // Load with data
    $('#dynamic-content').html(data);

    var form = $('#edit-award-form');

    var awardMessage = $('#award-message');

    $(form).submit(function(event) {
      event.preventDefault();

      var formData = $(form).serialize();

      $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData
      }).done(function(response) {
        loadTable();

        $(awardMessage).removeClass('alert alert-danger');
        $(awardMessage).addClass('alert alert-success');

        $(awardMessage).text(response);

        // Close modal
        $('#edit-modal').modal('toggle');
      }).fail(function(data) {
        $(awardMessage).removeClass('alert alert-success');
        $(awardMessage).addClass('alert alert-danger');

        if (data.responseText !== '') {
          $(awardMessage).text(data.responseText);
        } else {
          $(awardMessage).text('Error updating award. Please try again.');
        }

        // Close modal
        $('#edit-modal').modal('toggle');
      });
    });
  })
  .fail(function() {
    $('#dynamic-content').text('Error updating award. Please try again.');
  });
});

$(document).on('click', '.delete-award', function() {
  var awardMessage = $('#award-message');

  var awardID = $(this).attr('id');

  // Save row to be deleted
  var saveRow = $(this).closest('tr');
  var saveAward = {};
  saveAward.id = awardID;
  saveAward.type = saveRow.children('td:nth-child(2)').text();
  saveAward.fName = saveRow.children('td:nth-child(3)').text();
  saveAward.lName = saveRow.children('td:nth-child(4)').text();
  saveAward.email = saveRow.children('td:nth-child(5)').text();
  saveAward.date = saveRow.children('td:nth-child(6)').text();

  $.ajax({
    // Pass context so can access in success callback
    context: this,
    type: 'POST',
    url: 'delete_award.php',
    data: 'id=' + awardID
  }).done(function(response) {
    loadTable();

    $(awardMessage).removeClass('alert alert-danger');
    $(awardMessage).addClass('alert alert-success');

    // Set html so can render undo link
    $(awardMessage).html(response);

    $('#undo-link').on('click', function() {
      $.ajax({
        type: 'POST',
        url: 'undo_delete.php',
        data: {award: JSON.stringify(saveAward)}
      }).done(function(response) {
        loadTable();

        $(awardMessage).removeClass('alert alert-danger');
        $(awardMessage).addClass('alert alert-success');

        $(awardMessage).text(response);
      }).fail(function(data) {
        $(awardMessage).removeClass('alert alert-success');
        $(awardMessage).addClass('alert alert-danger');

        if (data.responseText !== '') {
          $(awardMessage).text(data.responseText);
        } else {
          $(awardMessage).text('Error undoing action.');
        }
      });
    });
  }).fail(function(data) {
    $(awardMessage).removeClass('alert alert-success');
    $(awardMessage).addClass('alert alert-danger');

    if (data.responseText !== '') {
      $(awardMessage).text(data.responseText);
    } else {
      $(awardMessage).text('Error deleting award. Please try again.');
    }
  });
});

function loadTable() {
  $('#award-table-holder').load('get_award.php');
}
