<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'include/include.php';
$sess = new sess;
$deals = new deal;

$size = $sess->select_db_sess()["size"];

$position = $deals->position_open();

if($position["result"] == 1)
{
  $btn_close = true;
  $btn_buy = false;
  $btn_sell = false;
}

if($position["result"] == 0)
{
  $btn_close = false;
  $btn_buy = true;
  $btn_sell = true;
}

$out = [
  'btn_close' => $btn_close,
  'btn_buy' => $btn_buy,
  'btn_sell' => $btn_sell
];

$out = json_encode($out);

echo $out;
