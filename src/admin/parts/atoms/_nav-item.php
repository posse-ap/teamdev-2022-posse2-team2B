<?php
// $indexは0, 1, 2, ...
// $nav_itemはページタイトル(string)
?>

<td id="nav_item_<?= $index; ?>" class="side_bar__nav__item" onclick="changePage('<?= $nav_item['name']; ?>')"><?= $nav_item['title']; ?></td>
