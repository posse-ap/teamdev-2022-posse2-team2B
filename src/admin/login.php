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
      <div class="login__container">
        <h1 class="login__title">管理者ログイン</h1>
        <div class="login__form">
          <form action=" /admin/login.php" method="POST" class="form-wrapper">
            <label>メールアドレス<input type="email" name="email" class="login__input" required></label>
            <br>
            <label>パスワード<input type="password" required name="password" class="login__input"></label>
            <br>
            <div class="submit login__btn btn">
              <input type="submit" value="ログイン">
            </div>
            <a href="mailto:admin@test?cc=boozer@test&amp;subject=%E3%83%91%E3%82%B9%E3%83%AF%E3%83%BC%E3%83%89%E9%96%8B%E7%A4%BA%E4%BE%9D%E9%A0%BC&amp;body=%E3%82%A8%E3%83%BC%E3%82%B8%E3%82%A7%E3%83%B3%E3%83%88%E4%BC%9A%E7%A4%BE%E3%82%84%E5%90%91%E3%81%91%E3%81%AE%E3%83%91%E3%82%B9%E3%83%AF%E3%83%BC%E3%83%89%E3%82%92%E5%BF%98%E3%82%8C%E3%81%9F%E3%81%AE%E3%81%A7%E3%80%81%E9%96%8B%E7%A4%BA%E3%82%92%E3%81%8A%E9%A1%98%E3%81%84%E3%81%97%E3%81%BE%E3%81%99%E3%80%82" class="forgot-password">パスワードをお忘れの方</a>
          </form>
        </div>
      </div>
    </div>
</body>
</main>

</html>
