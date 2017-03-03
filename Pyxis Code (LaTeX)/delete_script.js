// http://codepen.io/ashblue/pen/mCtuA

$(document).ready(function() {
  // Get the messages div.
  var awardMessage = $('#award-message');

  $('.delete-award').click(function() {
    var awardID = $(this).attr('id');
    console.log(awardID);

    // Submit the form using AJAX.
    $.ajax({
      // Pass context so can access in success callback
      context: this,
      type: 'POST',
      url: 'delete_award.php',
      data: 'id=' + awardID
    }).done(function(response) {
      // Remove row from table
      $(this).parents('tr').detach();

      // Make sure div has the 'success' class.
      $(awardMessage).removeClass('error');
      $(awardMessage).addClass('success');

      // Set the message text.
      $(awardMessage).text(response);
    }).fail(function(data) {
      // Make sure div has the 'error' class.
      $(awardMessage).removeClass('success');
      $(awardMessage).addClass('error');

      // Set the message text.
      if (data.responseText !== '') {
        $(awardMessage).text(data.responseText);
      } else {
        $(awardMessage).text('Award could not be deleted.');
      }
    });
  });
});
