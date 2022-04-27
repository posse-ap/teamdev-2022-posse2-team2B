<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$trs_stmt = $db->prepare(
  "SELECT
    name, email, right_name
  FROM
    accounts
  LEFT JOIN rights ON accounts.right_id = rights.id
  WHERE accounts.id = :account_id"
);
$trs_stmt->execute([':account_id' => $_SESSION['account_id']]);
$trs = $trs_stmt->fetch();

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 6);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('info_table' => [
  'tr' => [
    '氏名' => $trs['name'],
    'メールアドレス' => $trs['email'],
    'パスワード' => '･･･････',
    'アクセス権限' => $trs['right_name']
  ]
]);

require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");

include(dirname(__FILE__) . "/parts/templates/_info-template.php");
