<?php

class sess
{
  function __construct()
  {
    if(!file_exists("include/sess/".session_id()))
    {
      $sess_create = ['time' => time()];
      file_put_contents("include/sess/".session_id(),json_encode($sess_create));
    }
  }

}

$sess = new sess;
var_dump(session_id());



?>
