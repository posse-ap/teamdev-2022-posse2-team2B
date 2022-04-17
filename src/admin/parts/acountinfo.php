<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../admin/style/acountinfo.css">
  <title>アカウント一覧</title>
</head>
<?php include("./header.php"); ?>

<body>
  <main>
    <div class="wrapper">
      <div class="container">
        <h1>アカウント一覧</h1>
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
          <div class="main-column-area">
            <table class="c-table">
            <tr>
              <th>氏名</th>
              <th>メールアドレス</th>
              <th>パスワード</th>
              <th>アクセス権限</th>
              <th></th>
            </tr>
            <tr>
              <td>〇〇〇〇</td>
              <td>sample@samplemail.com</td>
              <td>navfnua</td>
              <td>共同管理者</td>
              <td><a href="">変更</a></td>
            </tr>
            </table>
          </div>
        </div>
        <div class="submit">
          <input type="button" value="新規作成">
        </div>
      </div>
    </div>
  </main>
</body>

</html>
