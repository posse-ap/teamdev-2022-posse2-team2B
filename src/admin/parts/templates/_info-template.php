<?php
include(dirname(__FILE__) . '/../atoms/_html-head.php');
include(dirname(__FILE__) . '/../organisms/_header.php');
?>

<div class="container">
  <div class="area">
    <?php
    include(dirname(__FILE__) . '/../organisms/_side-bar.php');
    ?>
  </div>
  <div class="area">
    <?php
    include(dirname(__FILE__) . '/../atoms/_title.php');
    include(dirname(__FILE__) . '/../molecules/_info-table.php');
    ?>
  </div>
</div>

<?php
include(dirname(__FILE__) . '/../../script/script.js.php');
include(dirname(__FILE__) . '/../atoms/_html-foot.php');
