<?php

require(dirname(__FILE__) . '/../parts.php');

// HTMLはじめ
a_html_head($pgdata['page_title']);

// ヘッダー
o_header();

// 確認ページ
o_check($pgdata['disp_data'], $pgdata['send_data']);

?>
<script src="./script/form-send.js"></script>
<?php

// フッター
o_footer();

// HTMLおわり
a_html_foot();
