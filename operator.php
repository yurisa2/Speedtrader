<?php
include 'include/include.php';

$op = $_GET["op"];
if(!isset($op)) exit;

$sess = new sess;

if($op == "new_session") $sess->create_db_sess();










 ?>
