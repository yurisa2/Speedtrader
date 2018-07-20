<?php
include 'include/include.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


echo "<pre>";

$sess = new sess;
$periods = $sess->return_periods(2);
var_dump($periods);
exit;
