<?php
session_start();

require(dirname(__FILE__) . "/app/dbconnect.php"); //データベース接続
require(dirname(__FILE__) . "/app/login-check.php"); //ログイン判定 未ログインの場合ログインページに遷移
require(dirname(__FILE__) . "/app/_ctrl-pages.php"); //管理画面の全ページの情報を保持

// アカウント情報登録
if (isset($_POST['action'])) {
  // アカウント情報変更の場合
  if ($_POST['action'] == 'update') {
    if ($_POST['password'] == '') {
      $acc_update_stmt = $db->prepare(
        "UPDATE
      accounts
    SET
      name = :name, email = :email, right_id = :right_id, agent_id = :agent_id
    WHERE id = :id"
      );
      $acc_update_stmt->execute([
        ':name' => $_POST['acc_name'],
        ':email' => $_POST['email'],
        ':right_id' => $_POST['right_id'],
        ':agent_id' => $_POST['agent_id'],
        ':id' => $_GET['account_id']
      ]);
    } else {
      $acc_update_stmt = $db->prepare(
        "UPDATE
      accounts
    SET
      name = :name, email = :email, password = sha1(:password), right_id = :right_id, agent_id = :agent_id
    WHERE id = :id"
      );
      $acc_update_stmt->execute([
        ':name' => $_POST['acc_name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':right_id' => $_POST['right_id'],
        ':agent_id' => $_POST['agent_id'],
        ':id' => $_GET['account_id']
      ]);
    }
  } elseif ($_POST['action'] == 'insert') {
    $acc_insert_stmt = $db->prepare(
      "INSERT INTO
        accounts (name, email, password, right_id, agent_id)
      VALUES
        (:name, :email, sha1(:password), :right_id, :agent_id)"
    );
    $acc_insert_stmt->execute([
      ':name' => $_POST['acc_name'],
      ':email' => $_POST['email'],
      ':password' => $_POST['password'],
      ':right_id' => $_POST['right_id'],
      ':agent_id' => $_POST['agent_id']
    ]);
  }
}

$pgdata = array();
$pgdata += array('right_id' => $_SESSION['right_id']);
$pgdata += array('page_id' => 3);
$pgdata += array('page_title' => $pages[$pgdata['page_id']]['title']);
$pgdata += array('btn' => [
  'title' => 'この内容で登録する',
  'id' => 'btn'
]);
$pgdata += array('account' => array());

// エージェント情報取得
$pgdata += array('agents' => array());
$agents_stmt = $db->query("SELECT id, agent_name FROM agents");
$pgdata['agents'] = $agents_stmt->fetchAll();

if (!isset($_GET['account_id'])) {
  include(dirname(__FILE__) . '/parts/templates/_create-acc-template.php');
  exit();
}
$pgdata['account'] += array('id' => $_GET['account_id']);

$account_stmt = $db->prepare("SELECT id, name, email, right_id, agent_id FROM accounts WHERE id = :account_id");
$account_stmt->execute([
  ':account_id' => $pgdata['account']['id']
]);
$account = $account_stmt->fetch();

$pgdata['account'] += array('name' => $account['name']);
$pgdata['account'] += array('email' => $account['email']);
$pgdata['account'] += array('right_id' => $account['right_id']);
$pgdata['account'] += array('agent_id' => $account['agent_id']);

include(dirname(__FILE__) . '/parts/templates/_change-acc-template.php');
