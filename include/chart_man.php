<?php
require_once 'include/include.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class chart extends STdb {
  function __construct() {
    parent::__construct();

    $this->sess = new sess;
    $this->session = $this->sess->select_db_sess();
    // var_dump($this->session);
    // exit;
    }

  function chart_ticks_full() {
    $this->chart_ticks_full = $this->sess->select_ticks($this->session["symbol_id"],
                                 $this->session["period"],
                                 $this->session["start"],
                                 $this->session["size"]);

    return $this->chart_ticks_full;
  }

  function chart_data_ohlc() {
    $data = array();
    $i = 0;

    foreach ($this->chart_ticks_full() as $key => $value) {
      $data[] =  array('',$i++,$value["open"],$value["high"],$value["low"],$value["close"]);
    }

    $this->chart_data = $data;

    return $data;
  }

  function chart() {

    $data = $this->chart_data_ohlc();

    $plot = new PHPlot($this->plot_width,$this->plot_height);


    $plot->SetImageBorderType('plain'); // Improves presentation in the manual
    $plot->SetTitle("@yurisa2");
    $plot->SetPlotType('candlesticks2');
    $plot->SetDataType('data-data');
    $plot->SetDataValues($data);

    $plot->SetXTickLabelPos('none');     // Turn off X tick labels
    $plot->SetYTickLabelPos('none');     // Turn off X tick labels
    $plot->SetXTickPos('none');          // Turn off X tick marks
    $plot->SetYTickPos('none');          // Turn off Y tick marks
    $plot->SetXDataLabelPos('none');     // Turn off X data labels
    $plot->SetYDataLabelPos('none');     // Turn off Y data labels

    $plot->DrawGraph();
  }
}
