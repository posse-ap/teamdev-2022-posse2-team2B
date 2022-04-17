<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../admin/style/studentdetailinfo.css">
  <title>学生情報詳細</title>
</head>
<?php include("./header.php"); ?>

<body>
  <main>
    <div class="wrapper">
      <div class="container">
        <h1>学生情報詳細</h1>
        <div class="content-wrapper">
          <div class="main-column-area">
            <table class="c-table">
              <tr>
                <th>氏名</th>
                <td>〇〇〇〇</td>
              </tr>
              <tr>
                <th>メールアドレス</th>
                <td>sample@samplemail.com</td>
              </tr>
              <tr>
                <th>電話番号</th>
                <td>090-1234-5678</td>
              </tr>
              <tr>
                <th>住所</th>
                <td>東京都港区南青山</td>
              </tr>
              <tr>
                <th>大学名</th>
                <td>慶應義塾大学</td>
              </tr>
              <tr>
                <th>学部学科</th>
                <td>理工学部情報工学科</td>
              </tr>
              <tr>
                <th>卒業年</th>
                <td>2026</td>
              </tr>
              <tr>
                <th>生年月日</th>
                <td>2002/01/01</td>
              </tr>
              <tr>
                <th>性別</th>
                <td>男性</td>
              </tr>
              <tr>
                <th>問い合わせ内容</th>
                <td>エージェントについて詳しく知りたい</td>
              </tr>
              <tr>
                <th>自由記入欄</th>
                <td>採用までの流れを教えてください。よろしくお願いします。</td>
              </tr>

            </table>
          </div>
        </div>
        <div class="submit">
          <input type="button" value="この学生情報を削除">
        </div>
      </div>
    </div>
  </main>
</body>

</html>
