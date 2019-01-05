<?php
error_reporting(E_ALL);
require_once 'include/include.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$screen_w = $_GET["width"];

$chart = new chart;
$chart->plot_width = $screen_w;
$chart->plot_height = $screen_w / 1.7;

$chart->sess->size = round($screen_w / 12);
$chart->sess->create_db_sess();


$chart->chart();

?>
