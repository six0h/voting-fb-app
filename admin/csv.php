<?php

@header("Last-Modified: " . @date("D, d M Y H:i:s",$_GET['timestamp']));
@header("Content-Type: text/csv");

$date = date('m-d-Y', $_GET['timestamp']);

require_once('../config.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

	header("Content-Disposition: attachment; filename=".DB_NAME."-users-".$date.".csv");

}

$q1 = $db->select('users', array('admin'=>array('$exists'=>false)));
$csvOutput = '';
foreach($q1 as $row) {
	$csvOutput .= $row['_id'] . ',';
	$csvOutput .= $row['first_name'] . ',';
	$csvOutput .= $row['last_name'] . ',';
	$csvOutput .= $row['email'] . ',';
	$csvOutput .= date('m d Y', $row['date']->sec) . "\n";
}

echo $csvOutput;

?>
