<?php
# $Id: range-log5.php 1623 2013-04-26 21:57:53Z lbayuk $
# PHPlot test: Log/log scales
# This is a parameterized test. See the script named at the bottom for details.
$tp = array(
  'c' => 1000,       # Plotting XY = C
  't' => 100,        # If set, use this for X and Y tick steps, else auto
  'ar' => TRUE,      # Auto-range: if false, use SetPlotAreaWorld
  );
require 'range-log.php';
