<?php
session_start();
require('../dbconnect.php');

if (isset($_SESSION['account_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  $_SESSION['time'] = time();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/index.php');
}

if (!empty($_POST)) {
  $login = $db->prepare('SELECT * FROM accounts WHERE email = :email AND password = :pw');
  $login->execute(array(
    ':email' => $_POST['email'],
    ':pw' => sha1($_POST['password'])
  ));
  $account = $login->fetch();

  if ($account) {
    $_SESSION = array();
    $_SESSION['account_id'] = $account['id'];
    $_SESSION['name'] = $account['name'];
    $_SESSION['agent_id'] = $account['agent_id'];
    $_SESSION['right_id'] = $account['right_id'];
    $_SESSION['time'] = time();
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/index.php');
    exit();
  } else {
    echo 'メールアドレスまたはパスワードが間違っています。';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理者ログイン</title>
</head>

<body>
  <div>
    <h1>管理者ログイン</h1>
    <form action="/admin/login.php" method="POST">
      <input type="email" name="email" required>
      <input type="password" required name="password">
      <input type="submit" value="ログイン">
    </form>
  </div>
</body>

</html>
