<?php
// 必須：　/admin/app/_ctrl-pages.php

// $pagesの中からナビゲーションに表示するページ情報を取得
$nav_items = array_filter($pages, function ($el) {
  global $pgdata;
  return $el['show_nav'] == true && in_array($pgdata['right_id'], $el['right']);
});
?>

<div class="side_bar__nav">
  <div class="side_bar__nav__spacer"></div>
  <table>
    <?php
    // $nav_items ... [ページタイトル, ページタイトル, ...]
    foreach ($nav_items as $index => $nav_item) : ?>
      <tr>
        <?php
        include(dirname(__FILE__) . "/../atoms/_nav-item.php");
        ?>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
