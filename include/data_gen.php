<?php

class Data_Gen{

  public function __construct($start) {
    global $sess;
    $this->sess = $sess;
    $this->start = $start;


    $this->to_ohlcv();


  }
  public function to_ohlcv() {

    $csv = file_get_contents("win2.csv");
    $csv = explode("\n", $csv);

    for ($i = $this->start; $i < $this->start + $this->sess->size; $i++) {

      $line = explode(",", $csv[$i]);

      $date = str_replace(".", "-", trim($line[0].":00"));
      $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
      $date = $date->format("U");

      $this->ohlcv[$date] = array(
        'open'  => $line[1],
        'high'  => $line[2],
        'low'  => $line[3],
        'close'  => $line[4],
        'volume_ticks'  => $line[5],
        'volume_deal'  => $line[6]
      );
    }
  }






}





 ?>
