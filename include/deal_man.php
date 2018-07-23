<?php
class deal extends STdb
{
  function __construct()
  {
    parent::__construct();
    $this->session_id = session_id();
  }

  function open_buy($tick)
  {
    $session_id = session_id();


    $return = $this->obj_db->query("insert into deals (session_id,tick_id,type,io) values
    ('$session_id','$tick','buy','1')");
  }

  function open_sell()
  {

  }

  function position_open()
  {
    $session_id = session_id();


  }



}


?>
