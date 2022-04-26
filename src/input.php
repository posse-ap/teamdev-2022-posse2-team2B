<?php
require(dirname(__FILE__) . "/dbconnect.php");
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>申込み</title>
  <link rel="stylesheet" href="style/header/header.css">
  <link rel="stylesheet" href="style/reset.css">
  <script src="https://kit.fontawesome.com/a60c81f350.js" crossorigin="anonymous"></script>
</head>

<body>
  <!-- system -->

  <?php
  require(dirname(__FILE__) . "/parts/header.php");
  ?>


  <!DOCTYPE html>
  <html lang="ja">

  <head>
    <meta charset="UTF-8">
    <title>お問い合わせ入力フォーム</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <form action="check.php" method="post" id="inquiry">
      <h2>お問い合わせメールフォーム</h2>
      <p>このフォームはphpの練習で作成したサンプルです。</p>

      <table summary="お問い合わせに関する入力項目名とその入力欄">
        <tr>
          <th><label for="inquiry_option_id">お問い合わせ内容</label></th>
          <td>
            <input type="radio" name="inquiry_option_id" value="1" id="one"><label for="one">1</label>
          </td>
        </tr>
        <tr>
          <th><label for="student_name">お名前</label></th>
          <td><input type="text" name="student_name" size="30" id="student_name" placeholder="例）山田太郎" required></td>
        </tr>
        <tr>
          <th><label for="student_name_ruby">お名前（フリガナ）</label></th>
          <td><input type="text" name="student_name_ruby" size="30" id="student_name_ruby" placeholder="例）ヤマダタロウ" required></td>
        </tr>
        <tr>
          <th><label for="email">メールアドレス</label></th>
          <td><input type="text" name="email" size="30" id="email" placeholder="例）xxx@example.com" required></td>
        </tr>
        <tr>
          <th><label for="tel">電話番号</label></th>
          <td><input type="text" name="tel" size="30" id="tel" placeholder="例）08012345678"></td>
        </tr>
        <tr>
          <th><label for="school_id">大学名</label></th>
          <td><input type="number" name="school_id" size="30" id="school_id" placeholder="例）慶應義塾大学" required></td>
        </tr>
        <tr>
          <th><label for="faculty">学部名</label></th>
          <td><input type="text" name="faculty" size="30" id="faculty" placeholder="例）法学部" required></td>
        </tr>
        <tr>
          <th><label for="department">学科名</label></th>
          <td><input type="text" name="department" size="30" id="department" placeholder="例）法律学科" required></td>
        </tr>
        <tr>
          <th><label for="graduate_year">卒業年</label></th>
          <td><select type="select" name="graduate_year" size="1" id="graduate_year" placeholder="例）26卒">
              <option value="2024" required>24卒</option>
              <option value="2025">25卒</option>
              <option value="2026">26卒</option>
            </select></td>
        </tr>
        <tr>
          <th><label for="postal_code">郵便番号</label></th>
          <td><input type="text" name="postal_code" size="30" id="postal_code" placeholder="例1234567" required></td>
        </tr>
        <tr>
          <th><label for="pref_id">都道府県</label></th>
          <td><input type="text" name="pref_id" size="30" id="pref_id" placeholder="例）"></td>
        </tr>
        <tr>
          <th><label for="address">住所</label></th>
          <td><input type="text" name="address" size="30" id="address" placeholder="例）東京都港区南青山" required></td>
        </tr>
        <tr>
          <th><label for="building">建物・部屋番号</label></th>
          <td><input type="text" name="building" size="30" id="building" placeholder="例）HarborS表参道" required></td>
        </tr>
        <tr>
          <th><label for="optional_comment">お問い合わせの内容</label></th>
          <td><input type="text" name="optional_comment" size="30" id="optional_comment" placeholder="例）コメント"></td>
        </tr>
      </table>
      <div class="submit">
        <input type="submit" value="確認画面へ">
      </div>
    </form>
  </body>

  </html>
  <!-- system end -->



</body>

</html>
