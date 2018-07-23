<?php
include 'include/include.php';


$sess = new sess;

$session = $sess->select_db_sess();
$increm = $_GET["increm"];


// var_dump($session);

$start = $session["start"];
$size = $session["size"];
$symbol_id = $session["symbol_id"];
$period = $session["period"];

$increm = $increm + $size;
$tick = $sess->select_tick($increm);

echo "
Current: $increm <br>
Date: ".date("Y-m-d H:i:s",$tick["time"])." O: ".$tick["open"]." - H: ".$tick["high"]." - L: ".$tick["low"]." - C:".$tick["close"]."
<pre>
";

// var_dump($sess->select_tick($increm));

 ?>
