<?php

// セクションの開始
require(dirname(__FILE__) . "/../atoms/section/_section-start.php");
?>

<div>
  これはエージェントの詳細ページです
</div>
<?php


// 最終更新日
require(dirname(__FILE__) . "/../atoms/section/agent-page/_last-update.php");


// エージェントの画像
require(dirname(__FILE__) . "/../atoms/agent-card/_agent-card-img.php");

// 画像切り替えボタンみたいなやつ



// ★評価表
require(dirname(__FILE__) . "/../molecules/agent-card/_star-evaluation-table.php");

?>


<div class="Agent-page__inquiry-btn">
  <?php
  // 問い合わせボックスに追加ボタン
  require(dirname(__FILE__) . "/../atoms/agent-card/agent-card-btns/_put-into-inquiry-box-btn.php");

  // 問い合わせボックスから出すボタン
  require(dirname(__FILE__) . "/../atoms/agent-card/agent-card-btns/_put-out-of-inquiey-box.php");
  ?>
</div>

<?php
// 小見出しと紹介文
require(dirname(__FILE__) . "/../molecules/section/agent-page/agent-page-heading-and-text.php");



// セクションの終わり
require(dirname(__FILE__) . "/../atoms/section/_section-end.php");

?>


<!-- このあとには、閲覧履歴がくる。テンプレートつくる時にはひっぱってこよう！ -->