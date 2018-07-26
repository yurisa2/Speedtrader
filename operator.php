<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'include/include.php';
$sess = new sess;
$deals = new deal;

$size = $sess->select_db_sess()["size"];


$op = $_GET["op"];
$tick = $_GET["tick"] + $size;

$style = $_GET["style"];

if(!isset($op)) exit;



if($op == "new_session") $sess->create_db_sess();
if($op == "open_buy") $deals->open_buy($tick);
if($op == "open_sell") $deals->open_sell($tick);
if($op == "deal_close") $deals->deal_close($tick);
if($op == "change_style") $sess->change_style($style);



 ?>
