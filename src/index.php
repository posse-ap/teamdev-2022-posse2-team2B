<?php

require(dirname(__FILE__) . "/dbconnect.php");

// 掲載期間内かつ公開設定1(公開)である全エージェント情報を取得
$agents_stmt = $db->query("SELECT * FROM agents WHERE expires_at > NOW() && publication = 1");
$agents = $agents_stmt->fetchAll();

// 全タグカテゴリを取得
$tag_categories_stmt = $db->query("SELECT * FROM tag_categories");
$tag_categories = $tag_categories_stmt->fetchAll();

$pgdata = array();
$pgdata += array('page_title' => 'トップ');
$pgdata += array('tag_categories' => $tag_categories);
$pgdata += array('agents' => $agents);

// ここからHTML
include(dirname(__FILE__) . '/parts/templates/_t_index.php');

?>

<!-- ボックス追加機能テスト -->
<p>
<h3>お問合せBOX</h3>
<ul id="box"></ul>
</p>
