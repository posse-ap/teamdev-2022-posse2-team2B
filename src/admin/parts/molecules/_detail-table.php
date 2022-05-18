<table border="1" class="list_table">

  <?php foreach (array_map(NULL, $pgdata['table_data']['th'], $pgdata['table_data']['tr']) as [$th, $td]) : ?>
    <tr>
      <th><?= $th; ?></th>
      <td><?= $td; ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<?php
if ($pgdata['page_id'] == 4) {
  include(dirname(__FILE__) . '/../atoms/_deletebtn.php');
} elseif ($pgdata['page_id'] == 7) {
  include(dirname(__FILE__) . '/../atoms/_changebtn.php');
}
