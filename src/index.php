<?php
require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . '/parts/parts.php');

// 掲載期間内かつ公開設定1(公開)である全エージェント情報を取得
$agents_stmt = $db->query("SELECT * FROM agents WHERE expires_at > NOW() && publication = 1");
$agents = $agents_stmt->fetchAll();

// 全タグカテゴリを取得
$tag_categories_stmt = $db->query("SELECT * FROM tag_categories");
$tag_categories = $tag_categories_stmt->fetchAll();

// ここからHTML
a_html_head('トップ');
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
t_form($agents);

// 確認ページ
o_check();

// 完了ページ
o_thanks();

// フッター申し込み
o_foot($agents);
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
a_html_foot();
