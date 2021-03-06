<?php

require(dirname(__FILE__) . '/../parts.php');

// HTMLはじめ
a_html_head($pgdata['page_title']);

// ヘッダー
o_header();

?>

<!-- メインコンテンツ -->
<div class="Page__container__center">
  <?php
  // 問い合わせフォームのエリア
  o_form($pgdata['inq_agents'], $pgdata['version']);
  ?>
</div>

<?php
// フッター
o_footer();
?>

<!-- IndexedDBのライブラリ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dexie/4.0.0-alpha.2/dexie.min.js" integrity="sha512-YVHSEwMLRaQHvifwu/g/7OeZPCGaBSAe44gR74njhuIBt1XBtS+NNo1hXyJ1nE3zzBV0ImktKwMxBYMwiaMVhA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- BOX追加機能 -->
<script src="./script/box.js"></script>
<!-- 検索エリアのタグクリック時の動作 -->
<script src="./script/search.js"></script>
<!-- 住所自動入力 -->
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
<!-- フォーム送信前のチェック -->
<script src="./script/form-send.js"></script>
<!-- ハンバーガーメニュー -->
<script src="./script/nav.js"></script>

<?php

// HTMLおわり
a_html_foot();
