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

$sess = new sess;
$session = $sess->select_db_sess();
if(!$session)
{
  $sess->create_db_sess();
$session = $sess->select_db_sess();
}

$start = $session["start"];

echo "
<html>

<head>
<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css\" integrity=\"sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B\" crossorigin=\"anonymous\">
<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js\" integrity=\"sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em\" crossorigin=\"anonymous\"></script>

 <script src=\"functions.js\"></script>
</head>

<body onload=\"setStart($start,$n_candles,$speed)\">
<center>


<img id=\"chart\" src=\"ohlc.php?start=$start\"><br>

<br>
<div class=\"progress\" style=\"width: 300px\">
  <div class=\"progress-bar progress-bar-striped bg-warning\" role=\"progressbar\" style=\"width: 0%\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"$n_candles\"></div>
</div>
<br>
<button class=\"btn btn-warning btn-md\" onclick=\"window.location.reload(true);\" id=\"counter\"></button>
<button class=\"btn btn-success btn-md\" id=\"play\" onclick=\"Play()\">Play</button>
<button class=\"btn btn-md\" id=\"stop\" onclick=\"Stop()\">Stop</button>
<br>
<br>

<button class=\"btn btn-primary btn-md\" id=\"btn_buy\" >Buy</button>
<button class=\"btn btn-danger btn-md\" id=\"btn_sell\" >Sell</button>
<br>
<button class=\"btn btn-warning btn-md\" id=\"btn_close\" >Close Position</button>
<br>
<div id=\"panel\">PANEL</div>

</center>
</body>
</html>
";
