// https://teamtreehouse.com/community/how-to-create-an-ajaxphp-contact-form

$(document).ready(function() {
  // Get the form.
  var form = $('#email-award-form');

  // Get the messages div.
  var emailMessage = $('#email-message');

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
      // Make sure div has the 'success' class.
      $(emailMessage).removeClass('error');
      $(emailMessage).addClass('success');

      // Set the message text.
      $(emailMessage).text(response);
    }).fail(function(data) {
      // Make sure div has the 'error' class.
      $(emailMessage).removeClass('success');
      $(emailMessage).addClass('error');

      // Set the message text.
      if (data.responseText !== '') {
        $(emailMessage).text(data.responseText);
      } else {
        $(emailMessage).text('Email could not be sent.');
      }
    });
  });
});
