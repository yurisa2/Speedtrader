<?php
error_reporting(E_ALL);
require_once 'include/include.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$chart = new chart;
$chart->plot_width = 700;
$chart->plot_height = 300;
// $chart->chart();
echo '<pre>';
var_dump($chart->chart_data_ohlc());
exit;

?>
