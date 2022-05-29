<?php

require(dirname(__FILE__) . '/../parts.php');

// HTMLはじめ
a_html_head($pgdata['page_title']);

// ヘッダー
o_header();

// 確認ページ
o_check($pgdata['disp_data']);

?>
<script src="./script/form-send.js"></script>
<?php

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