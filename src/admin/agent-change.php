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
  'th' => ['会社名', '会社所在地', '会社URL', '会社電話番号', '代表者氏名', '担当者氏名', '担当者電話番号', '担当者メールアドレス', '通知用メールアドレス', '契約開始', '契約終了']
]);

$agent_id = $_GET['id'];

try {

  $db->beginTransaction();
  $agent_contract_update_stmt = $db->prepare(
    "UPDATE
    agent_contract
    SET
    `address` = :address,
    tel = :tel,
    pres_name = :pres_name,
    pic_name = :pic_name,
    pic_tel = :pic_tel,
    pic_email = :pic_email,
    notification_email = :notification_email
    WHERE
    id=$agent_id;"
  );
  $agent_contract_update_stmt->execute(
    [
      ':address' => $_POST['address'],
      ':tel' => $_POST['tel'],
      ':pres_name' => $_POST['pres_name'],
      ':pic_name' => $_POST['pic_name'],
      ':pic_tel' => $_POST['pic_tel'],
      ':pic_email' => $_POST['pic_email'],
      ':notification_email' => $_POST['notification_email'],
    ]
  );
  $agent_update_stmt = $db->prepare(
    "UPDATE
    agents
    SET
    agent_name = :agent_name,
    `url` = :url,
    start_at = :start_at,
    expires_at = :expires_at
    WHERE
    id=$agent_id;"
  );
  $agent_update_stmt->execute(
    [
      ':agent_name' => $_POST['agent_name'],
      ':url' => $_POST['url'],
      ':start_at' => $_POST['start_at'],
      ':expires_at' => $_POST['expires_at'],
    ]
  );
  $db->commit();
  header('Location:/admin/agents.php');
  // echo "登録されたエージェント会社の変更に成功しました。管理画面に戻ってリロードしてください。";
} catch (\Throwable $th) {
  //throw $th;
  $db->rollBack();
  echo "失敗" . $th->getMessage();
}
