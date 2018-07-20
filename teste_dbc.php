<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'include/dbc.php';


echo "<pre>";

$dbc = new STdb();
// $dbc->retorn_least_id(2,"M1");

var_dump($dbc->return_min_id(1,"M1"));
