<?php
// アカウント作成　フォームの値を全て受け取ったら
if (isset($_POST['acc_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['right_id'])) {
  $create_acc_stmt = $db->prepare(
    "INSERT INTO
      accounts (name, email, password, right_id, agent_id)
    VALUES
      (:acc_name, :email, sha1(:password), :right_id, :agent_id)"
  );
  $create_acc_stmt->execute([
    ':acc_name' => $_POST['acc_name'],
    ':email' => $_POST['email'],
    ':password' => $_POST['password'],
    ':right_id' => $_POST['right_id'],
    ':agent_id' => $_POST['agent_id']
  ]);
}
