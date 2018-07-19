<?php

$start = $_GET["start"];
$size = $_GET["size"];
$start_1 = $start+1;

echo "
<html>

<head>
<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css\" integrity=\"sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B\" crossorigin=\"anonymous\">
<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>
<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js\" integrity=\"sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em\" crossorigin=\"anonymous\"></script>

 <script src=\"functions.js\"></script>
</head>

<body onload=\"setStart($start,$size)\">
<center>


<img id=\"chart\" src=\"ohlc.php?start=$start&size=$size\"><br>

<br>
<button class=\"btn btn-warning btn-md\" onclick=\"Rolling()\" id=\"counter\">i</button>

<button class=\"btn btn-success btn-md\" id=\"play\" onclick=\"Play()\">Play</button>
<button class=\"btn btn-md\" id=\"stop\" onclick=\"Stop()\">Stop</button>
<br>
<br>

<button class=\"btn btn-primary btn-md\" id=\"btn_buy\" >Buy</button>
<button class=\"btn btn-danger btn-md\" id=\"btn_sell\" >Sell</button>

</center>
</body>
</html>
";
