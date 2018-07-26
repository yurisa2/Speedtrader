<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'include/include.php';

$sess = new sess;
$deals = new deal;

$session = $sess->select_db_sess();
$increm = $_GET["increm"];

$position = $deals->position_open();
$position_level = $deals->position_level();

$delta = NULL;

$start = $session["start"];
$size = $session["size"];
$symbol_id = $session["symbol_id"];
$period = $session["period"];

$increm = $increm + $size;
$tick = $sess->select_tick($increm);
$position_level_current = 0;

$tick_size = $sess->select_symbol($tick['symbol_id']);
$tick_size = $tick_size["tick_size"];

$symbol_name = $sess->select_symbol($tick['symbol_id']);
$symbol_name = $symbol_name["name"];

if($position["result"] > 0)
{
  $position_level_current = (float)$tick["high"];
  $delta = $position_level_current-$position_level;
  $delta = $delta/$tick_size;
}

if($position["result"] < 0)
{
  $position_level_current = (float)$tick["low"];
  $delta = $position_level-$position_level_current;
  $delta = $delta/$tick_size;
}

$cumulative = ($sess->calc_score()/$tick_size)+$delta;

$badge_style_delta  = "primary";
$badge_style_cumulative  = "primary";
if($delta > 0) $badge_style_delta = "primary";
if($delta < 0) $badge_style_delta = "danger";
if($cumulative > 0) $badge_style_cumulative = "primary";
if($cumulative < 0) $badge_style_cumulative = "danger";


// Current: $increm <br>
//Date: ".date("Y-m-d H:i:s",$tick["time"])." O: ".$tick["open"]." - H: ".$tick["high"]." - L: ".$tick["low"]." - C:".$tick["close"]."<br>
// Position: ".$position["result"]." | position_level: ".$position_level." <br> | position_level_current: ".$position_level_current." <br>
// Symbol: ".$symbol_name." - Period: ".$tick["period"]."- Date: ".date("Y-m-d H:i:s",$tick["time"])."
echo "
<div style=\"display:inline-block; width:60px\" class=\"badge badge-$badge_style_delta\">&Delta;: ".$delta."</div>
<div style=\"display:inline-block; width:60px\" class=\"badge badge-success\">".$tick["period"]."</div>
<div style=\"display:inline-block; width:160px\" class=\"badge badge-$badge_style_cumulative\">Total &Delta;: ".$cumulative."</div>
<pre>
";
?>
