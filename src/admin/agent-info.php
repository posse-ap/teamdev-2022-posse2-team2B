<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持





$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 5);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('table_data' => [
  'th' => ['会社名', '会社所在地', '会社URL', '会社電話番号', '代表者氏名', '担当者氏名', '担当者電話番号', '担当者メールアドレス', '通知用メールアドレス','契約期間']
]);

$agent_id = $_GET['id'];

// テーブルに追加するデータ
$trs_stmt = $db->query(
  "SELECT
  *
    FROM
      agent_contract
      WHERE
      id = $agent_id
      "
);
$trs = $trs_stmt->fetch(PDO::FETCH_ASSOC);
$pgdata['table_data']['tr'] = $trs;



require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");
include(dirname(__FILE__) . "/parts/templates/_detail-template.php");
