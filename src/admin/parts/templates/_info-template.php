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
    if ($pgdata['page_id'] == 6 ) {
      if($_SESSION['right_id'] == 3){
        echo '<a href="./account-maint.php?account_id=' . $_SESSION['account_id'] . '" class="btn detail-btn">変更</a>';
      }
    }
    ?>
  </div>
</div>

<?php
include(dirname(__FILE__) . '/../../script/script.js.php');
include(dirname(__FILE__) . '/../atoms/_html-foot.php');
