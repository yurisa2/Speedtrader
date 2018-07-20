<?php
class sess extends STdb
{
  function __construct()
  {
    $this->session_id = session_id();
    echo "construtor SESS ".  $this->session_id;
  }

  function create_db_sess()
  {
    $session_id = session_id();
    $start = 200;
    $time = time();
    $size = 40;
    $symbol_id = '1';
    $period = 'M1';

    $return = $this->obj_db->query("insert into sessions (session_id,start,size,time,symbol_id,period) values
    ('$session_id','$start','$size','$time','$symbol_id','$period')");
  }
}


?>
