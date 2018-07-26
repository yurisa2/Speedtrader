<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'include/include.php';
$sess = new sess;
$deals = new deal;

$style = $sess->select_db_sess()["style"];

if(empty($style)) $style = "candlesticks";

if($style == "ohlc")
{
  $btn_ohlc = false;
  $btn_candlesticks = true;
}

if($style == "candlesticks")
{
  $btn_ohlc = true;
  $btn_candlesticks = false;
}



$out = [
  'btn_candlesticks' => $btn_candlesticks,
  'btn_ohlc' => $btn_ohlc,
  'style' => $style

];

$out = json_encode($out);

echo $out;
