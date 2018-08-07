<?php
require_once 'include/include.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');

$sess = new sess;
$session = $sess->select_db_sess();

$position = 0;

$deals = new deal;
$position = $deals->position_open();
$position_level = $deals->position_level();

$plot_type = $session["style"];

$position = $position["result"];

if (empty($plot_type)) $plot_type = 'candlesticks';

if($session["size"] == "") $size = 20;
else $size = $session["size"];

if(!isset($_GET['start'])) $start = $session["start"];
else $start = $_GET["start"];

$increm = $start + $size;
$tick = $sess->select_tick($increm);

$ohlcv = $sess->select_ticks($session["symbol_id"],$session["period"],$start,$size);

// var_dump($ohlcv);
// exit;

if($position > 0)
{
  $color_line = 'blue';
}

if($position < 0)
{
  $color_line = 'red';
}


$data = array();
$data2 = array();
$j = 0;
foreach ($ohlcv as $key => $value) {
  $j++;
  $data[] =  array($j,$key,$value["open"],$value["high"],$value["low"],$value["close"]);
  $data2[] =  array('',$value["volume2"]);
  if($position != 0) $op_level[] =  array('',$position_level);
  $position_level_buy = $value["high"];
  $position_level_sell = $value["low"];

  $data2_volume[] = $value["volume2"];
}

foreach ($ohlcv as $key => $value) {
  if($position > 0) $cur_level[] =  array('',$position_level_buy);
  if($position < 0) $cur_level[] =  array('',$position_level_sell);
}



if($size == 60) {
  $plot_width = 980;
  $plot_height = 380;
}
else {
  $plot_width = 360;
  $plot_height = 480;
}

$max_volume = max($data2_volume);
$min_volume = min($data2_volume);

$position_level_current = 0;

$tick_size = $sess->select_symbol($tick['symbol_id']);
$tick_size = $tick_size["tick_size"];

$symbol_name = $sess->select_symbol($tick['symbol_id']);
$symbol_name = $symbol_name["name"];

$delta = 0;

if($position > 0)
{
  $position_level_current = (float)$tick["high"];
  $delta = $position_level_current-$position_level;
  $delta = $delta/$tick_size;
}

if($position < 0)
{
  $position_level_current = (float)$tick["low"];
  $delta = $position_level-$position_level_current;
  $delta = $delta/$tick_size;
}

$cumulative = ($sess->calc_score()/$tick_size)+$delta;

if($delta == 0) $delta = "-";

// var_dump($cumulative);
// exit;
// $plot = new PHPlot(800, 600);
$plot = new PHPlot($plot_width, $plot_height);

$plot->SetPrintImage(0);

$plot->SetPlotAreaPixels(NULL, NULL, NULL, $plot_height * 0.75);

$plot->SetImageBorderType('none'); // Improves presentation in the manual
$plot->SetTitle("@yurisa2");
// $plot->SetFont('x_label',"5",NULL,NULL);
$plot->SetDataType('data-data');
$plot->SetDataValues($data);
$plot->SetPlotType($plot_type);

$plot->SetLegendPosition(0.5, 0.5, 'plot', 0.92, 0.15);
$plot->SetLegend(array($delta,$cumulative));

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

$plot->SetLegendPosition(10000, 10000, 'plot',10000,10000);


if($position != 0)
{
$plot->SetDataType('text-data');
$plot->SetDataValues($op_level);
$plot->SetLineStyles('dashed');
$plot->SetLineWidths('3');
$plot->SetDataColors(array($color_line));
$plot->SetPlotType('lines');

$plot->DrawGraph();

$plot->SetDataType('text-data');
$plot->SetDataValues($cur_level);
$plot->SetLineStyles('dashed');
$plot->SetLineWidths('3');
$plot->SetDataColors(array('green'));
$plot->SetPlotType('lines');
$plot->DrawGraph();

}



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
