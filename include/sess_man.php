<?php
class sess extends STdb
{
  function __construct()
  {
    parent::__construct();
    $this->session_id = session_id();
  }

  function create_db_sess()
  {
    session_regenerate_id(true);
    $session_id = session_id();
    $time = time();

    $random = $this->return_random();
    $min_total = $this->return_min_total_id($random["symbol_id"],$random["period"]);
    $start = rand($min_total["min_id"],$min_total["min_id"]+$min_total["total_ticks"]);

    $symbol_id = $random["symbol_id"];
    $period = $random["period"];

    $size = 60;

    $return = $this->obj_db->query("insert into sessions (session_id,start,size,time,symbol_id,period) values
    ('$session_id','$start','$size','$time','$symbol_id','$period')");
  }

  function select_db_sess()
  {
    $session_id = session_id();

    $return = $this->obj_db->query("select * from sessions where session_id = '$session_id'");
    $return = $return->fetch(PDO::FETCH_ASSOC);

    return $return;

  }



}


?>
