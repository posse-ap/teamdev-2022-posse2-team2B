<?php
// ログイン判定
if (isset($_SESSION['account_id']) && isset($_SESSION['right_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  $_SESSION['time'] = time();
} else {
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
  exit();
}

// ログアウト時
if (isset($_POST['logout'])) {
  unset($_SESSION['account_id'], $_SESSION['name'], $_SESSION['right_id'], $_SESSION['time'], $_SESSION['agent_id'], $_SESSION['right_id'], $_SESSION['time']);
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
}
?>
