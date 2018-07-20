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
    $session_id = session_id();
    $time = time();
    $start = 200;
    $size = 40;
    $symbol_id = '1';
    $period = 'M1';

    $return = $this->obj_db->query("insert into sessions (session_id,start,size,time,symbol_id,period) values
    ('$session_id','$start','$size','$time','$symbol_id','$period')");
  }



}


?>
