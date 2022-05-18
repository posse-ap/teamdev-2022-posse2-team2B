<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 1);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('table_data' => [
  'th' => ['会社名', '担当者氏名', '担当者メールアドレス', '担当者電話番号', '掲載期間', '詳細'],
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
  array_push($pgdata['table_data']['tr'], [$tr['agent_name'], $tr['pic_name'], $tr['pic_email'], $tr['pic_tel'], $tr['start_at'] . '<br>~' . $tr['expires_at'], '<a href="agent-info.php?id=' . $tr["id"] . '" target="" class="link">詳細</a>']);
endforeach;




require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");

include(dirname(__FILE__) . "/parts/templates/_list-template.php");
