<?php
session_start();
require_once 'include/include.php';
date_default_timezone_set('America/Sao_Paulo');

$sess = new sess;
$session = $sess->select_db_sess();

if (empty($plot_type)) $plot_type = 'candlesticks';

if($session["size"] == "") $size = 20;
else $size = $session["size"];

if(!isset($_GET['start'])) $start = $session["start"];
else $start = $_GET["start"];


$ohlcv = $sess->select_ticks($session["symbol_id"],$session["period"],$start,$size);

// var_dump($size);
// exit;


$data = array();
$data2 = array();

foreach ($ohlcv as $key => $value) {
  $j++;
  $data[] =  array($j,$key,$value["open"],$value["high"],$value["low"],$value["close"]);
  $data2[] =  array('',$value["volume_ticks"]);
  $data2_volume[] = $value["volume_ticks"];
}

if($size == 60) {
  $plot_width = 1024;
  $plot_height = 540;
}
else {
  $plot_width = 360;
  $plot_height = 480;
}

$max_volume = max($data2_volume);
$min_volume = min($data2_volume);



// $plot = new PHPlot(800, 600);
$plot = new PHPlot($plot_width, $plot_height);

$plot->SetPrintImage(0);

$plot->SetPlotAreaPixels(NULL, NULL, NULL, $plot_height * 0.75);

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

$plot->SetPlotAreaPixels(NULL, $plot_height, NULL, $plot_height * 0.8);

$plot->SetDataType('text-data');
$plot->SetDataValues($data2);
$plot->SetPlotAreaWorld(NULL, $min_volume, NULL, $max_volume);
$plot->SetDataColors(array('green'));
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');
$plot->SetPlotType('bars');
$plot->DrawGraph();

$plot->PrintImage();

//http://phplot.sourceforge.net/phplotdocs/ex-twoplot1.html ADICIONAR 2 GRAFICOS
