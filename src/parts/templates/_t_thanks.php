<?php

require(dirname(__FILE__) . '/../parts.php');

// HTMLはじめ
a_html_head($pgdata['page_title']);

// ヘッダー
o_header();

// 完了ページ
o_thanks();

// HTMLおわり
a_html_foot();
