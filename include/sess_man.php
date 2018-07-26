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

    $return = $this->obj_db->query("insert into sessions (session_id,start,size,time,symbol_id,period,style) values
    ('$session_id','$start','$size','$time','$symbol_id','$period','\"candlesticks\"')");
  }

  function select_db_sess()
  {
    $session_id = session_id();

    $return = $this->obj_db->query("select * from sessions where session_id = '$session_id'");
    $return = $return->fetch(PDO::FETCH_ASSOC);

    return $return;

  }

  function calc_score()
  {
    $session_id = session_id();
    $balance = 0;

    $return = $this->obj_db->query("select ticks.id, session_id,type,io from deals
inner join ticks on deals.tick_id = ticks.id
where deals.session_id = '$session_id'");
    $return = $return->fetchall(PDO::FETCH_ASSOC);

    foreach ($return as $key => $value) {
      $key_1 = $key+1;
      if($key_1 == count($return)) break;
      $tick1 = $this->select_tick($value["id"]);
      $tick2 = $this->select_tick($return[$key_1]["id"]);

      $position_level = ($tick1["high"] + $tick1["low"]) /2;

        if($value["io"] == 1 && $value["type"] == 1)
        {
          $balance = $balance + ($tick2["high"] - $position_level);
        }
        if($value["io"] == -1 && $value["type"] == 1)
        {
          $balance = $balance + ($position_level - $tick2["low"]);
        }

    }

    return $balance;
  }

  function change_style($style)
  {
    $session_id = session_id();
    $return = $this->obj_db->query("update sessions set style = '$style' where session_id = '$session_id'");
  }

}


?>
