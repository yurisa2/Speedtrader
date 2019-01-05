<?php
include 'include/include.php';
$sess = new sess;
$leaderboard = new leaderboard;

// echo "<pre>";



$html_pre = "<br><br><br>
<h2>Leaderboard</h2>
<div class=\"table-responsive\">
  <table class=\"table table-striped\">
    <thead>
      <tr>
        <th>id</th>
            <th>session_id</th>
            <th>score</th>
            <th>symbol_id</th>
            <th>period</th>
            <th>owner</th>
            <th>start</th>
            <th>size</th>
            <th>time</th>
            <th>style</th>
            <th>lenght</th>
      </tr>
    </thead>
    <tbody>
";


foreach ($leaderboard->get_leaderboard() as $key => $value) {
  $html_pre .= "
  <tr>
        <th>$value[id]</th>
        <th>$value[session_id]</th>
        <th>$value[score]</th>
        <th>$value[symbol_id]</th>
        <th>$value[period]</th>
        <th>$value[owner]</th>
        <th>$value[start]</th>
        <th>$value[size]</th>
        <th>".date("Y-m-d G:i:s",$value["time"])."</th>
        <th>$value[style]</th>
        <th>$value[lenght]</th>
  </tr>
  ";

}
echo $html_pre;

// var_dump($leaderboard->get_leaderboard());

 ?>
