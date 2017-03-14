$(document).ready(function() {
  var searchParams = new URLSearchParams(window.location.search);

  if (searchParams.has('redirect') && searchParams.get('redirect') == '1') {
    var userMessage = $('#user-message');
    $(userMessage).text('Please ensure you have entered your job title and location, and uploaded a signature.');
    $(userMessage).addClass('alert alert-info');
  }

  else if (searchParams.has('update') && searchParams.get('update') == '1') {
    var userMessage = $('#user-message');
    $(userMessage).text('User details have been updated.');
    $(userMessage).addClass('alert alert-info');
  }
});
