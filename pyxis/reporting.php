<?php
    $pageTitle = "Awards per Employee";
    include("includes/backendHeader.php");
?>

<?php
$address = '"reporting.php"';
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hernandv-db","J9RlSghRw6FKvLq8","hernandv-db");
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  
$result = $mysqli->query('SELECT concat(FName, ' ', LName) as User, count(AwardID) AS sumTest FROM Award GROUP BY User');

  $rows = array();
  $table = array();
  $table['cols'] = array(
    array('label' => 'User', 'type' => 'string'),
    array('label' => 'sumTest', 'type' => 'number')
);
    /* Extract the information from $result */
    foreach($result as $r) {
      $temp = array();
      
      $temp[] = array('v' => (string) $r['User']); 
      // The following line will be used to slice the Pie chart
      $temp[] = array('v' => (int) $r['sumTest']); 
      // Values of the each slice
      $rows[] = array('c' => $temp);
    }
$table['rows'] = $rows;
// convert data into JSON format
$jsonTable = json_encode($table);
//echo $jsonTable;
?>


<html>
  <head>
    <!--Load the Ajax API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
    function drawChart() {
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
           title: 'How Many Awards Users Have',
          is3D: 'true',
          width: 800,
          height: 600
        };
      // Instantiate and draw our chart, passing in some options.
      // Do not forget to check your div ID
      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>
  </head>


  <body>
    <!--this is the div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
