// https://teamtreehouse.com/community/how-to-create-an-ajaxphp-contact-form

$(document).ready(function() {
  // Get the form.
  var form = $('#add-award-form');

  // Get the messages div.
  var awardMessage = $('#award-message');

  // Set up an event listener for the contact form.
  $(form).submit(function(event) {
    // Stop the browser from submitting the form.
    event.preventDefault();

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
      type: 'POST',
      url: $(form).attr('action'),
      data: formData
    }).done(function(response) {
      // Load table
      loadTable();

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
        $(awardMessage).text('Award could not be added.');
      }
    });
  });
});
