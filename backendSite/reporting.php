<?php
    $pageTitle = "Awards per Employee";
    include("includes/header.php");
?>

<?php
$address = '"reporting.php"';
ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hernandv-db","J9RlSghRw6FKvLq8","hernandv-db");
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
   /* select all the weekly tasks from the table googlechart */
$result = $mysqli->query('SELECT Users.Username AS User, count(Award.AwardID) AS sumTest FROM Users LEFT JOIN Award ON Users.UserID = Award.FK_UserID group by Users.UserID');
/*
      ---------------------------
      example data: Table (googlechart)
      --------------------------
      Weekly_Task     percentage
      Sleep           30
      Watching Movie  10
      job             40
      Exercise        20       
  */
  $rows = array();
  $table = array();
  $table['cols'] = array(
    // Labels for your chart, these represent the column titles.
    /* 
        note that one column is in "string" format and another one is in "number" format 
        as pie chart only required "numbers" for calculating percentage 
        and string will be used for Slice title
    */
    array('label' => 'User', 'type' => 'string'),
    array('label' => 'sumTest', 'type' => 'number'),
   /* array('label' => 'LName', 'type' => 'string'),
    array('label' => 'Username', 'type' => 'string'),
    array('label' => 'UserPassword', 'type' => 'string'),
    array('label' => 'Signature', 'type' => 'string'),
    array('label' => 'JobTitle', 'type' => 'string'),
    array('label' => 'UserStatus', 'type' => 'string')
*/
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
