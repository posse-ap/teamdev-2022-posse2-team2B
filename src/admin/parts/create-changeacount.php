<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../admin/style/create-changeacount.css">
  <title>アカウント作成・変更
  </title>
</head>
<?php include("./header.php"); ?>

<body>
  <main>
    <div class="wrapper">
      <div class="container">
        <h1>アカウント作成・変更
        </h1>
        <div class="content-wrapper">
          <div class="side-bar">
            <table>
              <tr>
                <td>学生情報一覧</td>
              </tr>
              <tr>
                <td>エージェント一覧</td>
              </tr>
              <tr>
                <td>アカウント一覧</td>
              </tr>
              <tr>
                <td>マイアカウント</td>
              </tr>
              <tr>
                <td>ログアウト</td>
              </tr>
            </table>
          </div>

          <form action="/admin/login.php" method="POST" class=form-wrapper>
            <label>氏名<input type="text" name="text" required></label>
            <br>
            <label>メールアドレス<input type="email" required name="email"></label>
            <br>
            <label>パスワード<input type="password" required name="password"></label>
            <br>
            <label>パスワード（確認）<input type="password" required name="password"></label>
            <br>
            <label>アクセス権限<input type="select" required name="select"></label>
            <br>
            <div class="submit">
              <input type="submit" value="確定">
            </div>
          </form>


        </div>
      </div>
    </div>
  </main>
</body>

</html>
