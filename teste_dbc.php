<?php
include 'include/include.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


echo "<pre>";

$sess = new sess;

// if(count($sess->select_db_sess()) == 0) $sess->create_db_sess();

$session = $sess->select_db_sess();

// var_dump($session);


// $session = $sess->return_random();
// $min_total = $sess->return_min_total_id($session["symbol_id"],$session["period"]);
// // var_dump($min_total);
//
// $start = rand($min_total["min_id"],$min_total["min_id"]+$min_total["total_ticks"]);
// // var_dump($start);

// var_dump($sess->select_ticks($session["symbol_id"],$session["period"],$session["start"],"4"));


var_dump($sess->select_symbol(1));


exit;
