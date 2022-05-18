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
    include(dirname(__FILE__) . '/../molecules/_info-table.php');
    if ($pgdata['page_id'] == 6) {
      echo '<a href="./account-maint.php" class="btn detail-btn">変更</a>';
    }
    ?>
  </div>
</div>

<?php
include(dirname(__FILE__) . '/../../script/script.js.php');
include(dirname(__FILE__) . '/../atoms/_html-foot.php');
