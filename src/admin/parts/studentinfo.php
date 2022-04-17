<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../admin/style/studentinfo.css">
  <title>学生情報一覧</title>
</head>
<?php include("./header.php"); ?>

<body>
  <main>
    <div class="wrapper">
      <div class="container">
        <h1>学生情報一覧</h1>
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
                <td>アカウント情報</td>
              </tr>
              <tr>
                <td>ログアウト</td>
              </tr>
            </table>
          </div>
          <div class="main-column-area">
            <table class="c-table">
              <tr>
                <th>申込み日時</th>
                <th>氏名</th>
                <th>メールアドレス</th>
                <th>電話番号</th>
                <th>卒業年</th>
                <th></th>
              </tr>
              <tr>
                <td>2022/04/07 15:48</td>
                <td>青柳仁</td>
                <td>sample@samplemail.com</td>
                <td>090-1234-5678</td>
                <td>2026</td>
                <td><a href="">詳細</a></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
