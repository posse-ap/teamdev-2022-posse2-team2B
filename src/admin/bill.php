<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 8);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('table_data' => [
  'th' => ['請求日', '請求額', '対象月', 'ステータス'],
  'tr' => array()
]);

$trs_stmt = $db->query(
  "SELECT
    *
  FROM
    agents
  LEFT JOIN agent_contract ON agents.id = agent_contract.agent_id"
);
$trs = $trs_stmt->fetchAll();
foreach ($trs as $tr) :
  array_push($pgdata['table_data']['tr'], [$tr['agent_name'], $tr['pic_name'], $tr['pic_email'], $tr['pic_tel']]);
endforeach;

require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");
include(dirname(__FILE__) . "/parts/templates/_list-template.php");
