<?php
session_start();
require('../dbconnect.php');
require(dirname(__FILE__) . "/parts/login-check.php");

// 権限判定
if ($_SESSION['right_id'] === 2) {
  $title = '管理者ページ';
} elseif ($_SESSION['right_id'] === 1) {
  $title = '共同管理者ページ';
} elseif ($_SESSION['right_id'] === 0) {
  $title = 'エージェント様向けページ';
} else {
  $title = 'error';
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
</head>

<body>
  <div>
    <h1><?= $title; ?></h1>
    <form action="" method="POST">
      <input type="submit" name="logout" value="ログアウト">
    </form>
  </div>
</body>

</html>
