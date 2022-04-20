<?php
// このページにアクセス権限があるか確認
$page_right_stmt = $db->prepare("SELECT * FROM maint_page_rights WHERE page_id = :page_id AND right_id = :right_id");
$page_right_stmt->execute([
  ':page_id' => $pgdata['page_id'],
  ':right_id' => $pgdata['right_id']
]);
$page_right = $page_right_stmt->fetch();
if (!$page_right) {
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/error.php');
  exit();
}

// 権限名を取得
$right_name_stmt = $db->prepare("SELECT right_name FROM rights WHERE id = ?");
$right_name_stmt->execute([$pgdata['right_id']]);
$pgdata['right_name'] = $right_name_stmt->fetch()['right_name'];
