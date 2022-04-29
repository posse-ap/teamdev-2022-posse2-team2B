<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

// テーブルに入れるデータ
$trs_stmt = $db->prepare(
  "SELECT
    *
  FROM
    agents
  LEFT JOIN agent_contract ON agents.id = agent_contract.agent_id
  WHERE
    agent_id = :agent_id"
);
$trs_stmt->execute([':agent_id' => $_SESSION['agent_id']]);
$trs = $trs_stmt->fetch();

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 7);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);

if ($trs) {
  $pgdata += array('info_table' => [
    'tr' => [
      '会社名' => $trs['agent_name'],
      '会社所在地' => $trs['address'],
      '会社URL' => $trs['url'],
      '会社電話番号' => $trs['tel'],
      '代表者氏名' => $trs['pres_name'],
      '担当者氏名' => $trs['pic_name'],
      '担当者電話番号' => $trs['pic_tel'],
      '担当者メールアドレス' => $trs['pic_email'],
      '通知用メールアドレス' => $trs['notification_email'],
      '契約期間' => $trs['start_at'] . '~' . $trs['expires_at']
    ]
  ]);
}

require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");

include(dirname(__FILE__) . "/parts/templates/_info-template.php");
