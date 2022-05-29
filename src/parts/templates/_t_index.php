<?php

require(dirname(__FILE__) . '/../parts.php');

// HTMLはじめ
a_html_head($pgdata['page_title']);

// ヘッダー
o_header();

?>

<div class="Page__container__center">

  <?php

  // 問い合わせまでの流れエリア
  o_howto();

  // 検索エリア
  o_search_area($pgdata['tag_categories']);

  // トップページの掲載エージェント一覧のエリア
  o_top_agent_list($pgdata['agents']);

  // 閲覧履歴のエリア
  o_history($agents);

  ?>

</div>

<?php

// 追従ボタン（まとめて問い合わせ、BOXを見る）
o_foot($pgdata['agents']);

// フッター
o_footer();

?>

<!-- IndexedDBのライブラリ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dexie/4.0.0-alpha.2/dexie.min.js" integrity="sha512-YVHSEwMLRaQHvifwu/g/7OeZPCGaBSAe44gR74njhuIBt1XBtS+NNo1hXyJ1nE3zzBV0ImktKwMxBYMwiaMVhA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- BOX追加機能 -->
<script src="./script/box.js"></script>
<!-- スマホ版 画面下固定BOX関連ボタン -->
<script src="./script/show-box-mobile.js"></script>
<!-- 検索エリアの動作 -->
<script src="./script/search.js"></script>
<!-- ハンバーガーメニュー -->
<script src="./script/nav.js"></script>

<?php

// HTMLおわり
a_html_foot();
