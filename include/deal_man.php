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

    $return = $this->obj_db->query("select *, sum(type) as result from deals where session_id = '$session_id'
    group by session_id");
    $return = $return->fetch(PDO::FETCH_ASSOC);

    return $return;
  }

  function position_level()
  {
    $position = $this->position_open();

    if($position["result"] != 0)
    {
      $session_id = session_id();

      $return = $this->obj_db->query("select tick_id as tick from deals where session_id = '$session_id' order by id desc limit 1");
      $return = $return->fetch(PDO::FETCH_ASSOC);

      $return = $this->select_tick($return["tick"]);

      $return = ($return["high"] + $return["low"]) /2;

      return $return;
    }
  }
}

?>
