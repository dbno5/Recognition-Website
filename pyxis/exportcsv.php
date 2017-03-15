<?php
	$pageTitle = "exportcsv";
	$address = '"exportcsv.php"';

ini_set('display_errors', 'On');
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","hernandv-db","J9RlSghRw6FKvLq8","hernandv-db");

$query = htmlspecialchars($_GET["query"]);

$result = $mysqli->query($query);
if (!$result) die('Couldn\'t fetch records');


$num_fields = mysqli_num_fields($result);
$headers = array();
while ($fieldinfo = mysqli_fetch_field($result)) {
    $headers[] = $fieldinfo->name;
}
$fp = fopen('php://output', 'w');
if ($fp && $result) {
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="export.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}
?>
