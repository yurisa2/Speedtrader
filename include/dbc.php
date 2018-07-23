<?php

class STdb
{
  public function __construct()
  {
    $db_string = "sqlite:include/sp.sqlite"; //To usando o front agora, mas sei lá, melhor fazer uma chave

    $this->obj_db = new PDO($db_string);
    $this->obj_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $this->ticks = new StdClass();
  }

  function select_ticks($symbol_id,$period,$start,$size)
  {
    $end = $start + $size;

    try {
      $return = $this->obj_db->query("select * from ticks where
      symbol_id = '$symbol_id' and period = '$period' and id >= '$start' and id < '$end'");
    }
    catch(Exception $e) {
      echo 'Exception -> ';
      var_dump($e->getMessage());
    }

    $result = $return->fetchall(PDO::FETCH_ASSOC);

    // var_dump($result); //DEBUG

    foreach ($result as $key => $value) {
      $id_obj = (integer)$value["id"];
      $this->ticks->$id_obj = $value;
    }
    //var_dump($this->ticks); //DEBUG
    return $result; //Colocar na documentaao que é funcao DUAL (array e objeto)
  }

  public function return_min_total_id($symbol_id,$period)
  {
    $return = $this->obj_db->query("select * from ticks where
    symbol_id = '$symbol_id' and period = '$period'
    order by id asc
    ");

    $return_count = $this->obj_db->query("select count(*) as total_ticks from ticks where
    symbol_id = '$symbol_id' and period = '$period'
    order by id asc
    ");

    $result = $return->fetch(PDO::FETCH_ASSOC);
    $result2 = $return_count->fetch(PDO::FETCH_ASSOC);
    $total_ticks = $result2["total_ticks"]-300;

    $ret = [
      'min_id' => $result["id"],
      'total_ticks' =>$total_ticks
    ];
    return $ret;
  }

  public function return_random()
  {
    $return = $this->obj_db->query("select * from ticks
   group by symbol_id,period
    ");

    $result = $return->fetchall(PDO::FETCH_ASSOC);
    $random_index = array_rand($result);

    $immet = $result[$random_index];

    $return1 = array(
      'symbol_id' => $immet["symbol_id"],
      'period' => $immet["period"]

    );
    return $return1;
  }

  public function select_symbol($symbol_id)
  {
    $return = $this->obj_db->query("select * from symbols where
    id = '$symbol_id' ");

    $result = $return->fetch(PDO::FETCH_ASSOC);

    return $result;
  }

}

?>
