<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 7);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('table_data' => [
  'th' => ['会社名', '会社所在地', '会社URL', '会社電話番号', '代表者氏名', '担当者氏名', '担当者電話番号', '担当者メールアドレス', '通知用メールアドレス', '契約開始', '契約終了']
]);

$agent_id = $_GET['id'];
// テーブルに追加するデータ
$trs_stmt = $db->prepare(
  "SELECT
      agents.agent_name,
      agent_contract.address,
      agents.url,
      agent_contract.tel,
      agent_contract.pres_name,
      agent_contract.pic_name,
      agent_contract.pic_tel,
      agent_contract.pic_email,
      agent_contract.notification_email,
      agents.start_at,
      agents.expires_at
    FROM
      agent_contract
    LEFT JOIN
      agents
    ON
      agent_contract.agent_id=agents.id
    WHERE
      agents.id=:agent_id "
);
$trs_stmt->execute([':agent_id' => $_SESSION['agent_id']]);
$trs = $trs_stmt->fetch();

$pgdata['table_data']['tr'] = $trs;

require(dirname(__FILE__) . "/app/right-check.php");
require(dirname(__FILE__) . "/app/fetch-account-name.php");

include(dirname(__FILE__) . "/parts/templates/_detail-template.php");
