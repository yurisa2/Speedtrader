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
    ('$session_id','$tick','1','1')");
  }

  function open_sell($tick)
  {
    $session_id = session_id();

    $return = $this->obj_db->query("insert into deals (session_id,tick_id,type,io) values
    ('$session_id','$tick','-1','1')");
  }

  function deal_close($tick)
  {
    $session_id = session_id();

    $return = $this->obj_db->query("select sum(type) as type from deals where session_id = '$session_id'
    group by session_id");
    $return = $return->fetch(PDO::FETCH_ASSOC);

    if($return["type"] > 0)
    {
    $return = $this->obj_db->query("insert into deals (session_id,tick_id,type,io) values
    ('$session_id','$tick','-1','-1')");
    }

    if($return["type"] < 0)
    {
    $return = $this->obj_db->query("insert into deals (session_id,tick_id,type,io) values
    ('$session_id','$tick','1','-1')");
    }
  }

  function position_open()
  {
    $session_id = session_id();

    $return = $this->obj_db->query("select *, sum(io) as result from deals where session_id = '$session_id'
    group by session_id");
    $return = $return->fetch(PDO::FETCH_ASSOC);

    return $return;
  }
}


?>
