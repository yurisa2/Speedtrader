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

$start = $session["start"];
$size = $session["size"];
$symbol_id = $session["symbol_id"];
$period = $session["period"];

$increm = $increm + $size;
$tick = $sess->select_tick($increm);

echo "
Current: $increm <br>
Date: ".date("Y-m-d H:i:s",$tick["time"])." O: ".$tick["open"]." - H: ".$tick["high"]." - L: ".$tick["low"]." - C:".$tick["close"]."<br>
Position: ".$position["result"]." <br>
<pre>
";
 ?>
