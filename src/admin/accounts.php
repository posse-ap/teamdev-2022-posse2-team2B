<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 2);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('table_data' => [
  'th' => ['氏名', 'メールアドレス', 'アクセス権限', '変更'],
  'tr' => array()
]);

// テーブルに追加するデータ
$trs_stmt = $db->query(
  "SELECT
    accounts.id AS account_id, name, email, right_name
  FROM
    accounts
  LEFT JOIN rights ON accounts.right_id = rights.id"
);
$trs = $trs_stmt->fetchAll();
foreach ($trs as $tr) :
  array_push($pgdata['table_data']['tr'], [$tr['name'], $tr['email'], $tr['right_name'], '<a href="./account-maint.php?account_id=' . $tr['account_id'] . '" class="link">変更</a>']);
endforeach;

require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");

include(dirname(__FILE__) . "/parts/templates/_list-template.php");
