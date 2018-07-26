
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'include/include.php';

$sess = new sess;

$session = $sess->select_db_sess();

// var_dump($session);

$start = $session["start"];
$size = $session["size"];
$symbol_id = $session["symbol_id"];
$period = $session["period"];

echo "
Start: $start <br>
Size: $size <br>
Symbol: ".$sess->select_symbol($symbol_id)["symbol"]."  <br>
Name: ".$sess->select_symbol($symbol_id)["name"]." <br>
Period: ".$period." <br>
Tick size: ".$sess->select_symbol($symbol_id)["tick_size"]." <br>
calc_score: ".$sess->calc_score()." <br>
<pre>
";

// var_dump($sess->select_symbol(1));

 ?>
