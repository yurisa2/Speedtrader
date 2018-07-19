<?php
session_start();

$sess = json_decode(file_get_contents('include/sess/'.session_id()));

date_default_timezone_set('America/Sao_Paulo');
if (empty($plot_type)) $plot_type = 'candlesticks';
require_once 'phplot/phplot.php';

$csv = file_get_contents("win2.csv");
$csv = explode("\n", $csv);

$ohlcv = array();

if($_GET["start"] =="") $start_from_index = 0;
else $start_from_index = $_GET["start"];

if($sess["size"] == "") $size = 40;
else $size = $sess["size"];

for ($i=$start_from_index; $i < $start_from_index+$size; $i++) {

  $line = explode(",", $csv[$i]);

  $date = str_replace(".", "-", trim($line[0].":00"));
  $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
  $date = $date->format(U);

  $ohlcv[$date] = array(
    'open'  => $line[1],
    'high'  => $line[2],
    'low'  => $line[3],
    'close'  => $line[4],
    'volume_ticks'  => $line[5],
    'volume_deal'  => $line[6]
  );
}

$data = array();

foreach ($ohlcv as $key => $value) {

  $j++;

  $data[] =  array($j,$key,$value["open"],$value["high"],$value["low"],$value["close"]);
}

if($size == 40) {
  $plot_width = 1024;
  $plot_height = 540;
}
else {
  $plot_width = 360;
  $plot_height = 480;
}

$plot = new PHPlot($plot_width, $plot_height);
$plot->SetImageBorderType('none'); // Improves presentation in the manual
// $plot->SetTitle("Ladrao de Pensamentos\n@yurisa2");
// $plot->SetFont('x_label',"5",NULL,NULL);
$plot->SetDataType('data-data');
$plot->SetDataValues($data);
$plot->SetPlotType($plot_type);
$plot->SetDataColors(array('red', 'DarkGreen', 'red', 'DarkGreen'));
// $plot->SetXLabelAngle(90);
// $plot->SetXLabelType('data', 0);
$plot->SetDrawXDataLabelLines('false');
$plot->SetXTickIncrement(60); // M1
$plot->SetXTickLabelPos('none');     // Turn off X tick labels
$plot->SetYTickLabelPos('none');     // Turn off X tick labels
$plot->SetXTickPos('none');          // Turn off X tick marks
$plot->SetYTickPos('none');          // Turn off Y tick marks
$plot->SetXDataLabelPos('none');     // Turn off X data labels
$plot->SetYDataLabelPos('none');     // Turn off Y data labels
if (method_exists($plot, 'TuneYAutoRange'))
$plot->TuneYAutoRange(0); // Suppress Y zero magnet (PHPlot >= 6.0.0)
$plot->DrawGraph();
