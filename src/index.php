<?php
require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . '/parts/parts.php');

// 掲載期間内かつ公開設定1(公開)である全エージェント情報を取得
$agents_stmt = $db->query("SELECT * FROM agents WHERE expires_at > NOW() && publication = 1");
$agents = $agents_stmt->fetchAll();

// 全タグカテゴリを取得
$tag_categories_stmt = $db->query("SELECT * FROM tag_categories");
$tag_categories = $tag_categories_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>トップ</title>
  <!-- <link rel="stylesheet" href="style/header/header.css"> -->
  <link rel="stylesheet" href="style/user.min.css">
  <link rel="stylesheet" href="style/reset.css">
  <script src="https://kit.fontawesome.com/a60c81f350.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  o_header();
  o_howto();
  o_search_area($tag_categories);
  ?>

  <!-- ボックス追加機能 -->
  <p>
  <h3>お問合せBOX</h3>
  <ul id="box"></ul>
  </p>

  <?php
  // トップページの掲載エージェント一覧のエリア
  o_agent_list($agents);

  // 再検索のエリア
  o_re_search();

  // 検索結果のカードが並んでいるエリア
  o_result($agents);

  // 閲覧履歴のエリア
  o_history($agents);

  // エージェントの詳細ページ
  o_agent_detail(2);

  // 問い合わせフォームのエリア
  require(dirname(__FILE__) . "/parts/templates/_application-page.php");

  // 確認ページ
  require(dirname(__FILE__) . "/parts/organisms/_check.php");

  // 完了ページ
  require(dirname(__FILE__) . "/parts/organisms/_finish.php");

  // フッター申し込み
  require(dirname(__FILE__) . "/parts/organisms/_apply-btn-footer.php");
  ?>



  <!-- IndexedDBのライブラリ -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dexie/4.0.0-alpha.2/dexie.min.js" integrity="sha512-YVHSEwMLRaQHvifwu/g/7OeZPCGaBSAe44gR74njhuIBt1XBtS+NNo1hXyJ1nE3zzBV0ImktKwMxBYMwiaMVhA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- BOX追加機能 -->
  <script src="./script/box.js"></script>
  <!-- 再検索部分の折りたたみ -->
  <script src="./script/accordion.js"></script>
  <!-- スマホ版 画面下固定BOX関連ボタン -->
  <script src="./script/show-box-mobile.js"></script>
  <!-- 検索エリアのタグクリック時の動作 -->
  <script src="./script/search.js"></script>
</body>

</html>
