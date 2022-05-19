<?php
session_start();
require('../dbconnect.php');

if (isset($_SESSION['account_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  $_SESSION['time'] = time();
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/students.php');
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
    $_SESSION['agent_id'] = $account['agent_id'];
    $_SESSION['time'] = time();
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/students.php');
    exit();
  } else {
    echo 'メールアドレスまたはパスワードが間違っています。';
    $a = true;
  }
}
?>

<script type="text/javascript">
  <?php if (isset($a)) { ?>
    alert("メールアドレスまたはパスワードが間違っています。");
  <?php } ?>
</script>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン | CRAFT by boozer</title>
  <link rel="stylesheet" href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/admin/style/reset.css'; ?>">
  <link rel="stylesheet" href="<?= 'http://' . $_SERVER['HTTP_HOST'] . '/admin/style/admin.min.css'; ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,500;1,900&display=swap" rel="stylesheet">
</head>

<body>

  <?php
  include(dirname(__FILE__) . '/parts/organisms/_header.php');
  ?>
  <main>
    <div class="wrapper">
      <div class="container">
        <h1 class="login__title">管理者ログイン</h1>
        <form action=" /admin/login.php" method="POST" class=form-wrapper>
          <label>メールアドレス<input type="email" name="email" required></label>
          <br>
          <label>パスワード<input type="password" required name="password"></label>
          <br>
          <div class="submit">
            <input type="submit" value="ログイン" class="btn">
          </div>
        </form>
      </div>
    </div>
</body>
</main>

</html>
