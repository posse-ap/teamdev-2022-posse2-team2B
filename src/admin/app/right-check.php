<?php
// このページにアクセス権限があるか確認
$page_right = in_array($pgdata['right_id'], $pages[$pgdata['page_id']]['right']); //ログイン中のアカウントのアクセス権限を$pagesと照合
if (!$page_right) {
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/error.php');
  exit();
}

// 権限名を取得
$right_name_stmt = $db->prepare("SELECT right_name FROM rights WHERE id = ?");
$right_name_stmt->execute([$pgdata['right_id']]);
$pgdata['right_name'] = $right_name_stmt->fetch()['right_name'];
