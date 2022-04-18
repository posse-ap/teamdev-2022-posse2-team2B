<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../admin/style/claiminfo.css">
  <title>請求情報</title>
</head>
<?php include("./header.php"); ?>

<body>
  <main>
    <div class="wrapper">
      <div class="container">
        <h1>請求情報</h1>
        <div class="content-wrapper">
          <div class="side-bar">
            <table>
              <tr>
                <td>学生情報</td>
              </tr>
              <tr>
                <td>登録情報</td>
              </tr>
              <tr>
                <td>請求情報</td>
              </tr>
              <tr>
                <td>ログアウト</td>
              </tr>
            </table>
          </div>
          <div class="main-column-area">
            <table class="c-table">
              <tr>
                <th>請求日</th>
                <th>請求額</th>
                <th>対象月</th>
                <th>ステータス</th>
              </tr>
              <tr>
                <td>2022/04/07</td>
                <td>￥100,000</td>
                <td>2022/03</td>
                <td>受領済</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
