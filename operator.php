<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'include/include.php';

$op = $_GET["op"];
$tick = $_GET["tick"];

if(!isset($op)) exit;

$sess = new sess;
$deals = new deal;


if($op == "new_session") $sess->create_db_sess();
if($op == "open_buy") $deals->open_buy($tick);



 ?>
