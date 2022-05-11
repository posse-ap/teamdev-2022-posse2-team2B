<?php
include(dirname(__FILE__) . '/../atoms/_html-head.php');
include(dirname(__FILE__) . '/../organisms/_header.php');
?>

<div class="container">
  <div class="area area_side">
    <?php
    include(dirname(__FILE__) . '/../organisms/_side-bar.php');
    ?>
  </div>
  <div class="area area_main">
    <?php
    include(dirname(__FILE__) . '/../atoms/_title.php');

    if ($pgdata['page_id'] == 4) {
      include(dirname(__FILE__) . '/../molecules/_student-detail-table.php');
    } else if ($pgdata['page_id'] == 5) {
      include(dirname(__FILE__) . '/../molecules/_agent-detail-table.php');
    }
    //if文で、エージェント詳細画面と学生詳細画面のmoleculesを切り分ける
    ?>
  </div>
</div>

<?php
include(dirname(__FILE__) . '/../../script/script.js.php');
include(dirname(__FILE__) . '/../atoms/_html-foot.php');
