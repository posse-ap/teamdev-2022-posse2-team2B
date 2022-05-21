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
    include(dirname(__FILE__) . '/../molecules/_bill-table.php');
    include(dirname(__FILE__) . '/../molecules/_table.php');
    //ここに、「今月の請求情報」のmoleculesのファイルを挿入
    ?>
  </div>
</div>

<?php
include(dirname(__FILE__) . '/../../script/script.js.php');
include(dirname(__FILE__) . '/../atoms/_html-foot.php');
