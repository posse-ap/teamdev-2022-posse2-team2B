<?php


a_section_start('検索結果');
?>

<div>
  これは検索結果画面です
</div>
<?php


require(dirname(__FILE__) . "/../molecules/section/_search-result-message.php");

require(dirname(__FILE__) . "/../organisms/_agent-card.php");


a_section_end();



?>
