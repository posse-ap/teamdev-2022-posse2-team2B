<?php

require(dirname(__FILE__) . '/../parts.php');

// HTMLはじめ
a_html_head($pgdata['page_title']);

// ヘッダー
o_header();

// 完了ページ
o_thanks($pgdata['student']['name']);

// フッター
o_footer();
?>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- ハンバーガーメニュー -->
<script src="./script/nav.js"></script>


<?php
// HTMLおわり
a_html_foot();
