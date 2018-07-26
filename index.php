<?php
include 'include/include.php';

// $start = rand(200,700);
//
//
// $sess = [
// 'start' => $start,
// 'size' => $_GET["size"],
// 'time' => time()
// ];
//
//
// $start = $sess["start"];
// $size = $sess["start"];
//
// file_put_contents("include/sess/".session_id(), json_encode($sess));

$speed = $speed_base;
$n_candles = $n_candles_base;

$sess = new sess;
// $session = $sess->select_db_sess();
// if(!$session)
{
  $sess->create_db_sess();
$session = $sess->select_db_sess();
}

if($session["period"] == M1)
{
  $speed = $speed_base /2;
  $n_candles = $n_candles_base * 2;
}
if($session["period"] == M5)
{
  $speed = $speed_base;
  $n_candles = $n_candles_base;
}
if($session["period"] == M10)
{
  $speed = $speed_base * 2;
    $n_candles = $n_candles_base /2;
}
if($session["period"] == M15)
{
  $speed = $speed_base * 3;
  $n_candles = $n_candles_base /3;
}
$start = $session["start"];

echo "
<html>

<head>
<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css\" integrity=\"sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B\" crossorigin=\"anonymous\">
<script src=\"https://code.jquery.com/jquery-3.3.1.min.js\" integrity=\"sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=\"			  crossorigin=\"anonymous\"></script><script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js\" integrity=\"sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em\" crossorigin=\"anonymous\"></script>

 <script src=\"include/functions.js\"></script>
</head>

<body onload=\"setStart($start,$n_candles,$speed)\">
<center>

<div id=\"theater\">
<img id=\"chart\" src=\"ohlc.php?start=$start\"><br>
</div>

<br>
<div  id=\"progress\" class=\"progress\" style=\"width: 300px\">
  <div id=\"pg_bar\" class=\"progress-bar progress-bar-striped bg-warning\" role=\"progressbar\" style=\"width: 0%\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"$n_candles\"></div>
</div>
<br>
<button class=\"btn btn-warning btn-md\" onclick=\"window.location.reload(true);\" id=\"counter\"></button>
<button class=\"btn btn-success btn-md\" id=\"play\" onclick=\"Play()\">Play</button>
<button class=\"btn btn-md\" id=\"stop\" onclick=\"Stop()\">Stop</button>
<button class=\"btn btn-danger btn-sm\" id=\"btn_end_session\" onclick=\"the_end_session()\">End Session</button>
<br>
<br>

<button class=\"btn btn-primary btn-md\" id=\"btn_buy\" onclick=\"deal_buy()\" >Buy</button>
<button class=\"btn btn-danger btn-md\" id=\"btn_sell\" onclick=\"deal_sell()\">Sell</button>
<br>
<button class=\"btn btn-warning btn-md\" id=\"btn_close\" onclick=\"deal_close()\" >Close Position</button>
<br>
<div id=\"panel\"></div>
<div id=\"settings_panel\">
<button class=\"btn btn-outline-primary btn-sm\" id=\"btn_ohlc\" style=\"display:inline-block; height:35px\" onclick=\"change_style_ohlc()\" >OHLC</button>
<button class=\"btn btn-outline-primary btn-sm\" id=\"btn_candlesticks\" style=\"display:inline-block; height:35px\" onclick=\"change_style_candlesticks()\" >Candlesticks</button>
<button class=\"btn btn-outline-primary btn-sm\" style=\"display:inline-block; height:35px\" onclick=\"define_size()\" >Fast</button>
<button class=\"btn btn-outline-primary btn-sm\" style=\"display:inline-block; height:35px\" onclick=\"define_size()\" >Normal</button>
<button class=\"btn btn-outline-primary btn-sm\" style=\"display:inline-block; height:35px\" onclick=\"define_size()\" >Dark</button>
<button class=\"btn btn-outline-primary btn-sm\" style=\"display:inline-block; height:35px\" onclick=\"define_size()\" >Light</button>
<br>
<br>
<button class=\"btn btn-outline-success btn-sm\" style=\"display:inline-block; height:35px\" onclick=\"get_extract()\" >Fixed 1:1</button>
<button class=\"btn btn-outline-warning btn-sm\" style=\"display:inline-block; height:35px\" onclick=\"get_extract()\" >Fixed 1:2</button>
<button class=\"btn btn-outline-danger btn-sm\" style=\"display:inline-block; height:35px\" onclick=\"get_extract()\" >Manual</button>


</div>

</center>
</body>
</html>
";
