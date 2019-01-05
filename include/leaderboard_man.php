<?php
class leaderboard extends STdb
{
  function __construct()
  {
    parent::__construct();
    $this->session_id = session_id();
  }

  function get_leaderboard()
  {
      $session_id = session_id();

      $return = $this->obj_db->query("select * from leaderboard
                                      inner join sessions
on leaderboard.session_id = sessions.session_id");
      $return = $return->fetchAll(PDO::FETCH_ASSOC);


      return $return;
  }
}

?>
