<?php

require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . '/app/functions.php');

if(!isset($_POST)) {
  echo 'データ送信エラー';
  exit();
}

if(!f_check_token()) {
  echo 'アクセスエラー';
  exit();
}

$registered = f_register_student($_POST);

if(!$registered) {
  echo 'エラーが発生しました。最初からやり直してください。';
  exit();
}

$pgdata = array();
$pgdata += array('page_title' => '問い合わせ完了');

// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_thanks.php');
