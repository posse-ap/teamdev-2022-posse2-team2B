<?php

require(dirname(__FILE__) . '/../parts.php');

// HTMLはじめ
a_html_head($pgdata['page_title']);

// ヘッダー
o_header();
?>

<div class="Page__container">
  <div class="Page__right">
    <?php
    ?>
    <div class="Page__right__pc">
      <?php
      // お問い合わせボックス PC
      o_box();
      // 閲覧履歴 PC用
      o_history([]);
      ?>
    </div>
    <?php
    ?>
  </div>
  <div class="Page__left">
    <?php
    // エージェントの詳細ページ のメインコンテンツ
    o_agent_detail($pgdata['id'], $pgdata['agent_name'], $pgdata['updated_at'], $pgdata['agent_picture'], f_set_evals($pgdata['id']), $pgdata['paragraphs']);
    ?>
    <div class="Page__left__sp">
      <?php
      // 閲覧履歴のエリア SP用
      o_history([]);
      ?>
    </div>
  </div>
</div>

<?php


// 追従ボタン（まとめて問い合わせ、BOXを見る）
o_foot([$pgdata['agent']]);

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

<?php

// HTMLおわり
a_html_foot();
