<?php

require(dirname(__FILE__) . '/../parts.php');

// HTMLはじめ
a_html_head($pgdata['page_title']);

// ヘッダー
o_header();

// 確認ページ
o_check();

// HTMLおわり
a_html_foot();
