<?php
  include(dirname(__FILE__) . '/../atoms/section/_section-start.php');
  ?>
    これはトップページの掲載エージェント一覧です。
  <?php
  include(dirname(__FILE__) . '/../organisms/_agent-card.php');
// ↑繰り返し文で生成していく。多分。

  include(dirname(__FILE__) . '/../atoms/section/_section-end.php');

?>
