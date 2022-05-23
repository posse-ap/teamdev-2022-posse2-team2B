<?php

require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . '/app/functions.php');

if(!isset($_POST)) {
  echo 'エラー';
  exit();
}

f_register_student($_POST);

$pgdata = array();
$pgdata += array('page_title' => '問い合わせ完了');

// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_thanks.php');
