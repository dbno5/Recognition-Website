$(document).ready(function() {
  var searchParams = new URLSearchParams(window.location.search);
  if (searchParams.has('redirect') && searchParams.get('redirect') == '1') {
    var redirectMessage = $('#redirect-message');
    $(redirectMessage).text('Please ensure you have entered your job title and location, and uploaded a signature.');
    $(redirectMessage).addClass('alert alert-info');
  }
});
