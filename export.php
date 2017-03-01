<?php
	$pageTitle = "export";
	include("includes/header.php");
?>

<?php
$address = '"export.php"';
?>


  <head>
    <meta charset="UTF-8">
  </head>
  <body>
  <br>
  <br>
  <br>
  <h2>Please enter your query and press submit. The download of your CSV will automatically begin. You will be notified if your query is invalid.
  </h2>
<form id="form" onsubmit="return false;">
    <input style="position:absolute; top:50%; left:5%; width:40%;" type="text" id="userInput" />
    <input style="position:absolute; top:55%; left:5%; width:40%;" type="submit" onclick="othername();" />
</form>

<script>
function othername() {
    var input = document.getElementById("userInput").value;
	window.location.href = "exportcsv.php?query=" + input;
}
</script>  
  </body>
