<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 9);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('btn' => [
  'title' => 'この内容で登録する',
  'id' => 'regBtn'
]);


require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");

include(dirname(__FILE__) . "/parts/templates/_reg-agent-template.php");
