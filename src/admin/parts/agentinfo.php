<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../admin/style/agentinfo.css">
  <title>エージェント一覧</title>
</head>
<?php include("./header.php"); ?>

<body>
  <main>
    <div class="wrapper">
      <div class="container">
        <h1>エージェント一覧</h1>
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
                <th>会社名</th>
                <th>担当者氏名</th>
                <th>担当者メールアドレス</th>
                <th>担当者電話番号</th>
                <th>掲載期間</th>
                <th></th>
              </tr>
              <tr>
                <td>株式会社〇〇エージェント</td>
                <td>青柳仁</td>
                <td>sample@samplemail.com</td>
                <td>090-1234-5678</td>
                <td>2022.01.08-2022.04.30</td>
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
